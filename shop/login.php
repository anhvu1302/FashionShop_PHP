<?php
session_start();
include("../admin/inc/config.php");

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Input validation
    if (empty($username) || empty($password)) {
        $error_message = 'Tên tài khoản và mật khẩu không được để trống.';
    } else {
        // Query to check the user credentials
        $statement = $pdo->prepare("SELECT * FROM tbl_account WHERE username = ?");
        $statement->execute([$username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $error_message = $user['is_verified'];
        if ($user['is_verified'] == 1) {
            if ($user && ($user['password']==md5($password))) {
                $_SESSION['user'] = $user;

                header('Location: index.php');
                exit();
            } else {
                $error_message = 'Tên tài khoản hoặc mật khẩu không đúng.';
            }
        } else {
            $error_message = 'Tài khoản của bạn đã đăng ký nhưng chưa xác nhận. Vui lòng xác nhận trong email của bạn.';
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
    <title>Đăng nhập tài khoản</title>
</head>

<body>
    <div style="background-image: url('../admin/assets/img/login-bg.png');background-repeat: no-repeat; background-size: cover;">
        <div class="d-flex flex-column container">
            <div class="align-items-center justify-content-center g-0 min-vh-100 row">
                <div class="py-8 py-xl-0 col-xxl-4 col-lg-6 col-md-8 col-12">
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
                                <h2 class="mb-1">Login</h2>
                                <p class="mb-6">Vui lòng nhập thông tin người dùng của bạn.</p>
                            </div>
                            <?php if (!empty($error_message)) : ?>
                                <div class="mb-2 alert-danger alert text-center rounded rounded-1 p-2">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Tên tài khoản</label>
                                    <input name="username" placeholder="Nhập tên tài khoản" type="text" id="username" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    <input name="password" placeholder="**************" type="password" id="password" class="form-control" />
                                </div>
                                <div class="d-lg-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="rememberme" class="form-check-input" />
                                        <label for="rememberme" class="form-check-label">Remember me</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Sign In
                                            </button>
                                        </div>
                                        <div class="col-3"></div>
                                    </div>
                                    <div class="d-md-flex justify-content-between mt-4">
                                        <div class="mb-2 mb-md-0">
                                            <a class="fs-6 text-decoration-none" href="./registration.php">Create
                                                An Account
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