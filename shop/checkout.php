<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Thời Trang</title>

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/checkout.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php 

        session_start();

        include "library/layout.php";
        include "library/helper.php";

        $connection = connectDatabase();

        $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

        addHeader();
        addFormSign();

    ?>

    <section class="product-list-in-cart">

    </section>

    <?php

        addFooter();

    ?>

    <div class="checkout-box">
        <div class="close-btn">×</div>
        <div class="container" id="container">
            <form id="checkout-form">
               
            </form>
        </div>
    </div>

</body>

