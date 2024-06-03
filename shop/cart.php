<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Thời Trang</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/checkout.css" />

    <script src="../data/database.js"></script>
    <script src="../js/shared.js"></script>
    <script src="../js/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php 

        session_start();

        include "library/layout.php";
        include "library/helper.php";

        $connection = connectDatabase();

        $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

        if(isset($_REQUEST["update"]))
        {
            $id = $_REQUEST["id"];
            $color = $_REQUEST["color"];
            $quantity = $_REQUEST["quantity"];

            for($index = 0; $index < sizeof($cart); $index = $index + 1)
            {
                if($cart[$index][0] == $id && $cart[$index][3] == $color) 
                {
                    $cart[$index][5] = $quantity;
                    $cart[$index][7] = $cart[$index][5] * $cart[$index][6];
                    break;
                }
            }
        }

        if(isset($_REQUEST["delete_id"]))
        {
            $id = $_REQUEST["delete_id"];
            $color = $_REQUEST["delete_color"];

            if(sizeof($cart) == 1) $cart = [];

            for($index = 0; $index < sizeof($cart); $index = $index + 1)
            {
                if($cart[$index][0] == $id && $cart[$index][3] == $color) 
                {
                    unset($cart[$index]);
                    break;
                }
            }
        }

        $_SESSION["cart"] = $cart;
        $_SESSION["tquantity"] = sizeof($_SESSION["cart"]); 
        $_SESSION["tprice"] = 0;
        foreach($cart as $stuff)
        {
            $_SESSION["tprice"] = $stuff[7] + $_SESSION["tprice"];
        }

        addHeader();
        addFormSign();

    ?>

    <section class="product-list-in-cart">
        <h1 class="heading">Giỏ Hàng Của Bạn</h1>
        <table class="table">
            <tr>
                <td>Mã</td>
                <td>Tên</td>
                <td>Hình</td>
                <td>Màu</td>
                <td>Kích Thước</td>
                <td>Số Lượng</td>
                <td>Đơn Giá</td>
                <td>Tổng Tiền</td>
                <td>Hành Động</td>
            </tr>
            <?php

                foreach($cart as $item)
                {
                    ?>

                        <tr>
                            <td><?php echo $item[0] ?></td>
                            <td ><?php echo $item[1] ?></td>
                            <td style="width: 10%"><img style="width: 25%; height: 25%" src="image/product/<?php echo $item[2] ?>" alt="<?php echo $item[2] ?>"></td>
                            <td><?php echo $item[3] ?></td>
                            <td><?php echo $item[4] ?></td>
                            <td>
                                <form action="cart.php" method="post">
                                    <input type="number" style="width: 10%" name="quantity" placeholder="<?php echo $item[5] ?>">
                                    <input type="hidden" name="id" value="<?php echo $item[0] ?>">
                                    <input type="hidden" name="color" value="<?php echo $item[3] ?>">
                                    <input type="submit" class="btn" name="update" value="Update">
                                </form>
                            </td>
                            <td><?php echo number_format($item[6], 0, ',', '.') ?> VNĐ</td>
                            <td><?php echo number_format($item[7], 0, ',', '.') ?> VNĐ</td>
                            <td><a href="cart.php?delete_id=<?php echo $item[0] ?>&delete_color=<?php echo $item[3] ?>" style="text-decoration: none" class="btn">Delete</a></td>
                        </tr>

                    <?php
                }

            ?>
            <tr>
                <td colspan="6"></td>
                <td>Tổng Số Lượng: <?php echo $_SESSION["tquantity"] ?></td>
                <td>Tổng Tiền:  <?php echo $_SESSION["tprice"] ?></td>
                <td></td>
            </tr>
        </table>
        <div style="display: flex; align-items: center; justify-content: right; margin-bottom: 120px"><a href="checkout.php" style="text-decoration: none; margin-right: 10px" class="btn">Checkout</a></div>
    </section>

    <?php

        addFooter();

    ?>
</body>
