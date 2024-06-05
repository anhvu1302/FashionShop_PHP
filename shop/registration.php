<?php
ob_start();
session_start();
include("../admin/inc/config.php");
include("../admin/inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';

require '../vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/PHPMailer/src/SMTP.php';
require '../vendor/PHPMailer/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['form1'])) {

    $valid = 1;

    if (empty($_POST['username'])) {
        $valid = 0;
        $error_message .= "Vui lòng nhập tên tài khoản<br>";
    } elseif (strlen($_POST['username']) < 8) {
        $valid = 0;
        $error_message .= "Tên tài khoản phải có ít nhất 8 ký tự<br>";
    } elseif (!preg_match("/^[a-zA-Z0-9]+([._@]?[a-zA-Z0-9]+)*$/", $_POST['username'])) {
        $valid = 0;
        $error_message .= "Tên tài khoản không đúng định dạng<br>";
    }

    if (empty($_POST['customer_name'])) {
        $valid = 0;
        $error_message .= "Vui lòng nhập họ và tên<br>";
    } elseif (strlen($_POST['customer_name']) < 4) {
        $valid = 0;
        $error_message .= "Họ và tên phải có ít nhất 4 ký tự<br>";
    } elseif (!preg_match("/^[\p{L}\p{N}\s]+$/u", $_POST['customer_name'])) {
        $valid = 0;
        $error_message .= "Họ và tên không đúng định dạng<br>";
    }

    if (empty($_POST['email'])) {
        $valid = 0;
        $error_message .= "Vui lòng nhập email<br>";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST['email'])) {
        $valid = 0;
        $error_message .= "Email không đúng định dạng<br>";
    }

    if (empty($_POST['phone'])) {
        $valid = 0;
        $error_message .= "Vui lòng nhập số điện thoại<br>";
    }
    if (empty($_POST['password'])) {
        $valid = 0;
        $error_message .= 'Vui lòng nhập mật khẩu<br>';
    } elseif (strlen($_POST['password']) < 8) {
        $valid = 0;
        $error_message .= 'Mật khẩu phải có ít nhất 8 ký tự<br>';
    }
    if (empty($_POST['confirm_password'])) {
        $valid = 0;
        $error_message .= 'Vui lòng nhập lại mật khẩu<br>';
    } elseif (strlen($_POST['confirm_password']) < 8) {
        $valid = 0;
        $error_message .= 'Mật khẩu phải có ít nhất 8 ký tự<br>';
    } elseif ($_POST['confirm_password'] != $_POST['password']) {
        $valid = 0;
        $error_message .= 'Nhập lại mật khẩu không giống<br>';
    }

    if ($valid == 1) {
        $token = md5(time());
        $pdo->beginTransaction();
        try {
            $statement1 = $pdo->prepare("INSERT INTO tbl_account (username, password, token, account_type, is_verified) VALUES (?,?,?,?,?)");
            $statement1->execute(array($_POST['username'], md5($_POST['password']), $token, 'user', false));

            $statement2 = $pdo->prepare("INSERT INTO tbl_account_details (account_id, customer_name, phone, email) VALUES (?,?,?,?)");
            $statement2->execute(array($pdo->lastInsertId(), $_POST['customer_name'], $_POST['phone'], $_POST['email']));

            $to = $_POST['email'];
            $subject = 'Xác minh đăng ký tài khoản';
            $verify_link = BASE_URL . 'shop/verify.php?email=' . $to . '&token=' . $token;
            $message = 'Vui lòng click vào url để xác minh tài khoản<br><br><a href="' . $verify_link . '">' . $verify_link . '</a>';

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'cskhvavshop@gmail.com';
                $mail->Password = 'frml wcsa qyak jmgu';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('cskhvavshop@gmail.com', 'Chăm sóc khách hàng shop.'); 
                $mail->addAddress($to);

                // Content
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();
                $pdo->commit();
                $error_message .= 'Đăng ký thành công. Vui lòng đăng nhập<br>';
            } catch (Exception $e) {
                $pdo->rollBack();
                $error_message .= 'Không thể gửi email xác minh tài khoản. Mailer Error: ' . $mail->ErrorInfo . '<br>';
            }

            unset($_POST['username']);
            unset($_POST['customer_name']);
            unset($_POST['phone']);
            unset($_POST['email']);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $error_message .= 'Đăng ký không thành công<br>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../admin/assets/img/logo192.png" type="image/x-icon">
    <link rel="stylesheet" href="../admin/assets/css/bootstrap.min.css" />
    <title>Đăng ký tài khoản</title>
</head>

<body>
    <div style="background-image: url('../admin/assets/img/login-bg.png');background-repeat: no-repeat; background-size: cover;">
        <div class="d-flex flex-column container">
            <div class="align-items-center justify-content-center g-0 min-vh-100 row">
                <div class="py-8 py-xl-0 col-xxl-4 col-lg-6 col-md-8 col-12" style="width: 40rem;">
                    <div class="card" style="
                  box-shadow: 0 1px 2px rgba(21, 30, 40, 0.07),
                    0 2px 4px rgba(21, 30, 40, 0.07),
                    0 4px 8px rgba(21, 30, 40, 0.07),
                    0 8px 16px rgba(21, 30, 40, 0.07),
                    0 16px 32px rgba(21, 30, 40, 0.07),
                    0 32px 64px rgba(21, 30, 40, 0.07);
                    background-color: rgb(255 255 255 / 70%);">
                        <div class="px-3 py-4">
                            <div class="mb-4 text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="/"><img src="../admin/assets/img/logo192.png" alt="logo" style="width: 3rem; height: 3rem" class="mb-2" /></a>
                                </div>
                                <h2 class="mb-1">Sign up</h2>
                                <p class="mb-6">Vui lòng nhập thông tin của bạn.</p>
                            </div>
                            <?php
                            if ((isset($error_message)) && ($error_message != '')) :
                                echo '<div class="mb-2 text-danger text-center bg-white rounded rounded-1 p-2">
                                ' . $error_message . '
                            </div>';
                            endif;
                            ?>
                            <form class="row" action="" method="post">
                                <?php echo $csrf->echoInputField() ?>
                                <div class="mb-3 col-sm-6 col-12">
                                    <label class="form-label" for="username">Tên tài khoản</label>
                                    <input name="username" placeholder="Nhập tên tài khoản" type="text" id="username" class="form-control" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" />
                                </div>
                                <div class="mb-3 col-sm-6 col-12">
                                    <label class="form-label" for="customer_name">Họ và tên</label>
                                    <input name="customer_name" placeholder="Nhập họ và tên" type="text" id="customer_name" class="form-control" value="<?php echo isset($_POST['customer_name']) ? $_POST['customer_name'] : ''; ?>" />
                                </div>
                                <div class="mb-3 col-sm-6 col-12">
                                    <label class="form-label" for="email">Email</label>
                                    <input name="email" placeholder="Nhập email" type="email" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" />
                                </div>
                                <div class="mb-3 col-sm-6 col-12">
                                    <label class="form-label" for="phone">Số điện thoại</label>
                                    <input name="phone" placeholder="Nhập số điện thoại" type="text" id="phone" class="form-control" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" />
                                </div>
                                <div class="mb-3 col-sm-6 col-12">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    <input name="password" placeholder="Nhập mật khẩu" type="password" id="password" class="form-control" />
                                </div>
                                <div class="mb-3 col-sm-6 col-12">
                                    <label class="form-label" for="confirm_password">Nhập lại mật khẩu</label>
                                    <input name="confirm_password" placeholder="Nhập lại mật khẩu" type="password" id="confirm_password" class="form-control" />
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-6">
                                            <input type="submit" class="btn btn-primary w-100 btn-block btn-flat login-button" name="form1" value="Create Account">
                                        </div>
                                        <div class="col-3"></div>
                                    </div>
                                    <div class="d-md-flex justify-content-between mt-4">
                                        <div class="mb-2 mb-md-0">
                                            <a class="fs-6 text-decoration-none" href="./login.php">
                                                Login with your account
                                            </a>
                                        </div>
                                        <div>
                                            <a class="text-black fs-6 text-decoration-none" href="./forget-password.php">Forgot your
                                                password?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
