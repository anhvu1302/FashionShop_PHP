<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect;
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['account_type']) == 'user') {
    header('location: ../shop/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Admin Dashboard Panel</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/admin.min.css">
    <!-- Icon css -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css">


    <script src="./assets/js/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nav-links li a').click(function() {
                $('.nav-links li a').removeClass('active'); // Remove active class from all links
                $(this).addClass('active'); // Add active class to the clicked link
            });
        });
    </script>
    <style>
        .nav-links li a.active {
            color: #fff;
            font-weight: bold;
        }
    </style>

</head>


<body>
    <?php
    // Lấy tên tệp hiện tại của trang
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <?php echo (strtolower($_SESSION['user']['account_type']) == strtolower("user")) ?>
    <?php echo isset($_SESSION['user']) ?>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <a href="../index.html"><i class="fas fa-shopping-cart"></i></a>
            </div>

            <span class="logo_name">Admin Panel</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="#" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>
                        <i class="fa-light fa-house"></i>
                        <span class="link-name">Dahsboard</span>
                    </a>
                </li>
                <li>
                    <a href="./product.php" <?php if ($current_page == 'product.php') echo 'class="active"'; ?>>
                        <i class="fa-light fa-boxes-stacked"></i>
                        <span class="link-name">Sản Phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="#"<?php if ($current_page == 'order.php') echo 'class="active"'; ?> >
                        <i class="fa-light fa-cart-shopping"></i>
                        <span class="link-name">Đơn Hàng</span>
                    </a>
                </li>
                <li>
                    <a href="./customer.php"<?php if ($current_page == 'customer.php') echo 'class="active"'; ?> >
                        <i class="fa-light fa-user"></i>
                        <span class="link-name">Khách Hàng</span>
                    </a>
                </li>
                <li>
                    <a href="./SupportCustomer.php" <?php if ($current_page == 'SupportCustomer.php') echo 'class="active"'; ?>>
                        <i class="fa-brands fa-rocketchat"></i>
                        <span class="link-name">Hỗ trợ khách hàng</span>
                    </a>
                </li>
            </ul>

            <ul class="logout-mode">
                <li>
                    <a href="../shop/logout.php" id="logout-link">
                        <i class="fa-light fa-arrow-right-from-bracket"></i>
                        <span class="link-name" onclick="">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <a href="#">
                        <i class="fa-light fa-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="admin-profile">
                <div class="icons">
                    <i class="fa-light fa-envelope"></i>
                    <i class="fa-light fa-bell"></i>
                </div>
                <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/profiles.svg" alt="">
                <p style="color: var(--black-light-color);">Administrator</p>
            </div>
        </div>

        <div id="dashboard" class="dash-content">
            <!-- Nội dung dashboard -->