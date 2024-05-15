<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png"
        type="image/x-icon" />
    <title>Thời Trang</title>

    <!-- css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/user.css">

    <!-- js -->
    <script src="../data/database.js"></script>
    <script src="../js/shared.js"></script>
    <script src="../js/user.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php 

        include("library/layout.php");

        addHeader();

        addFormSign();

    ?>

    <div class="user-infor container">
        
    </div>
    <div class="list-order container" id="list-order-container">
    </div>

    <?php

        addFooter();

    ?>

</body>