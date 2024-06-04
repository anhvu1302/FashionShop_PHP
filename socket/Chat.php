<?php

//Chat.php

namespace MyApp;

include "../shop/library/helper.php";

use Exception;
use PDO;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

// require dirname(__DIR__) . "/database/ChatUser.php";
// require dirname(__DIR__) . "/database/ChatRooms.php";
// require dirname(__DIR__) . "/database/PrivateChat.php";

class Chat implements MessageComponentInterface
{
    protected $clients;
    protected $connection;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->connection = connectDatabase();
        echo "Server Started\n";
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();
        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {
            $updateStatement = $this->connection->prepare("UPDATE tbl_account SET user_connection_id = ? WHERE user_token = ?");
            $updateStatement->execute([$conn->resourceId, $queryarray['token']]);

            $query = "SELECT account_id FROM tbl_account WHERE user_token = :user_token";
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':user_token', $queryarray['token']);
            $statement->execute();
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user_data) {
                $user_id = $user_data['account_id'];

                echo "New connection! ({$conn->resourceId}) for user ID {$user_id}\n";
            } else {
                echo "Invalid token received: {$queryarray['token']}\n";
                $conn->close();
            }
        } else {
            echo "No token provided\n";
            $conn->close();
        }
    }


    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        $data = json_decode($msg, true);

        if ($data['command'] == 'private') {
            $sql = "INSERT INTO tbl_chat_message (customer_id,employee_id, chat_message, timestamp, status) VALUES (:customer_id,:employee_id, :chat_message, NOW(), :status)";
            $sta = $this->connection->prepare($sql);

            $sta->execute([
                ':customer_id' => $data['userId'],
                ':employee_id' => $data['employeeId'],
                ':chat_message' => $data['msg'],
                ':status' => isset($data['employeeId']) ? "No" : "Yes"
            ]);

            $chat_message_id = $this->connection->lastInsertId();

            $query = "SELECT * FROM tbl_account a JOIN tbl_account_details ad on a.account_id = ad.account_id WHERE a.account_id = :user_id";
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':user_id', $data['userId']);
            try {
                if ($statement->execute()) {
                    $sender_user_data = $statement->fetch(PDO::FETCH_ASSOC);
                } else {
                    $sender_user_data = array();
                }
            } catch (Exception $error) {
                echo $error->getMessage();
            }
            $sender_user_name = $sender_user_data['customer_name'];


            $query2 = "SELECT * FROM tbl_account a JOIN tbl_account_details ad on a.account_id = ad.account_id WHERE a.account_id = :user_id";
            $statement2 = $this->connection->prepare($query2);
            $statement2->bindParam(':user_id', $data['customerId']);
            try {
                if ($statement->execute()) {
                    $receiver_user_data = $statement->fetch(PDO::FETCH_ASSOC);
                } else {
                    $receiver_user_data = array();
                }
            } catch (Exception $error) {
                echo $error->getMessage();
            }
            $receiver_user_connection_id = $receiver_user_data['user_connection_id'];
            foreach ($this->clients as $client) {

                if ($from == $client) {
                    $data['from'] = 'Me';
                } else {
                    $data['from'] = $sender_user_name;
                }
                $client->send(json_encode($data));
                // if ($client->resourceId == $receiver_user_connection_id || $from == $client) {
                // } else {
                //     $query = "UPDATE tbl_chat_message SET status = ? WHERE chat_message_id = ?";
                //     $statement = $this->connection->prepare($query);

                //     $status = 'No';

                //     $statement->execute([$status, $chat_message_id]);
                // }
            }
        } else {
        }
    }

    public function onClose(ConnectionInterface $conn)
    {

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {

            // $user_object = new \ChatUser;

            // $user_object->setUserToken($queryarray['token']);

            // $user_data = $user_object->get_user_id_from_token();

            // $user_id = $user_data['user_id'];

            // $data['status_type'] = 'Offline';

            // $data['user_id_status'] = $user_id;

            // foreach ($this->clients as $client) {
            //     $client->send(json_encode($data));
            // }
        }
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
