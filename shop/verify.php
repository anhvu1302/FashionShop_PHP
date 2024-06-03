<?php
ob_start();
session_start();
include("../admin/inc/config.php");
include("../admin/inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
?>
<?php
$error_message = ''; // Khởi tạo biến $error_message
$success_message = ''; // Khởi tạo biến $success_message

if ((!isset($_REQUEST['email'])) || (isset($_REQUEST['token']))) {
    $var = 1;

    // check if the token is correct and match with database.
    $statement = $pdo->prepare("SELECT * FROM tbl_account A join tbl_account_details AD on A.account_id = AD.account_id WHERE email = ?;");
    $statement->execute(array($_REQUEST['email']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $account_id = $row['account_id'];
        if ($_REQUEST['token'] != $row['token']) {
            header('location: ' . BASE_URL.'shop');
            exit;
        }
    }

    if ($var != 0) {

        $query = "UPDATE tbl_account SET token = '', is_verified = b'1' WHERE account_id = '" . $account_id . "';";
        $statement = $pdo->prepare($query);
        $statement->execute();

        $success_message = '<p style="color:green;">Your email is verified successfully. You can now login to our website.</p><p><a href="' . BASE_URL . 'shop/login.php" style="color:#167ac6;font-weight:bold;">Click here to login</a></p>';
    }
}
?>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
    }

    h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left: -15px;
    }

    .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }
</style>

<body>
    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1>Registration Successful</h1>
        <?php
        echo $error_message;
        echo $success_message;
        ?>
    </div>
</body>

</html>