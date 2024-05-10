<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';
if (isset($_POST['form1'])) {

	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error_message = 'Tên tài khoản hoặc mật khẩu không được để trống<br>';
	} else {

		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);

		$statement = $pdo->prepare("SELECT * FROM tbl_account A join tbl_account_details AD on A.account_id = AD.account_id WHERE a.username = ? OR email = ?;");
		$statement->execute(array($username, $username));
		$total = $statement->rowCount();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		if ($total > 0) {
			foreach ($result as $row) {
				$row_password = $row['password'];
				$row_account_type = $row['account_type'];
			}
			if ($row_account_type != 'admin') {
				$error_message .= 'Tài khoản của bạn không có quyền truy cập trang quản trị<br>';
			} else {
				if ($row_password != md5($password)) {
					$error_message .= 'Tên tài khoản hoặc mật khẩu không đúng<br>';
				} else {
					$_SESSION[$ss_admin] = $row;
					header("location: index.php");
				}
			}
		} else {
			$error_message .= 'Tên tài khoản hoặc mật khẩu không đúng<br>';
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="../assets/img/logo192.png" type="image/x-icon">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<title>Đăng nhập quản trị hệ thống</title>
</head>

<body>
	<div style="background-image: url('../assets/img/login-bg.png');background-repeat: no-repeat; background-size: cover;">
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
									<a href="/"><img src="../assets/img/logo192.png" alt="logo" style="width: 3rem; height: 3rem" class="mb-2" /></a>
								</div>
								<h2 class="mb-1">Đăng nhập trang quản trị</h2>
							</div>
							<?php
							if ((isset($error_message)) && ($error_message != '')) :
								echo '<div class="mb-2 text-danger text-center bg-white rounded rounded-1 p-2">
								' . $error_message . '
							</div>';
							endif;
							?>

							<form method="post" action="">
								<?php $csrf->echoInputField(); ?>
								<div class="mb-3">
									<label class="form-label" for="username">Tên tài khoản</label>
									<input name="username" placeholder="Nhập tên tài khoản" type="text" id="username" class="form-control" />
								</div>
								<div class="mb-4">
									<label class="form-label" for="password">Mật khẩu</label>
									<input name="password" placeholder="**************" type="password" id="password" class="form-control" />
								</div>
								<div class="mb-3">
									<div class="row">
										<div class="col-3"></div>
										<div class="col-6">
											<input type="submit" class="btn btn-primary w-100 btn-block btn-flat login-button" name="form1" value="Log In">
										</div>
										<div class="col-3"></div>
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