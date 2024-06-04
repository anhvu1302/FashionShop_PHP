<?php

//action.php

session_start();
include "library/helper.php";

$connection = connectDatabase();

if (isset($_POST["action"]) && $_POST["action"] == 'fetch_chat') {
    $query = "SELECT * FROM tbl_chat_message cm LEFT JOIN tbl_account_details a on cm.employee_id = a.account_id WHERE customer_id = " . $_POST["customer_id"] . ";";
    $statement = $connection->prepare($query);
    $statement->execute();
    if (isset($_POST["role"]) && $_POST["role"] == 'admin') {
        $query2 = "UPDATE tbl_chat_message SET status = 'Yes' WHERE customer_id = :customer_id;";
        $statement2 = $connection->prepare($query2);
        $statement2->bindParam(':customer_id', $_POST["customer_id"], PDO::PARAM_INT);
        $statement2->execute();
    }
    echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
}
