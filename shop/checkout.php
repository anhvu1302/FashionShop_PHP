<?php
session_start();
include "library/layout.php";
include "library/helper.php";

$connection = connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection->beginTransaction();

    try {
        $customer_id = isset($_SESSION["user"]) ? $_SESSION["user"]["account_id"] : null;
        $name = $customer_id ? $_SESSION["user"]["customer_name"] : $_POST["name"];
        $email = $customer_id ? $_SESSION["user"]["email"] : $_POST["email"];
        $address = $customer_id ? $_SESSION["user"]["address"] : $_POST["address"];
        $phone = $customer_id ? $_SESSION["user"]["phone"] : $_POST["phone"];
        $total = isset($_SESSION["tprice"]) ? $_SESSION["tprice"] : 0;

        $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

        $payment_method = isset($_POST["off_checkout"]) ? "offline" : (isset($_POST["onl_checkout"]) ? "online" : "");


        $query = "INSERT INTO tbl_invoice (customer_id, total, date, note, address, phone,payment_method,cancelled) 
                VALUES (:customer_id, :total, NOW(),  'Chờ thanh toán', :address, :phone, :payment_method,'No')";
        $statement = $connection->prepare($query);
        $statement->execute([
            'customer_id' => $customer_id,
            'total' => $total,
            'address' => $address,
            'phone' => $phone,
            'payment_method' => $payment_method == "offline" ? "COD" : "VNPAY"
        ]);

        $invoice_id = $connection->lastInsertId();

        foreach ($cart as $item) {
            $query = "INSERT INTO tbl_invoice_details (invoice_id, product_id, quantity, price) 
                    VALUES (:invoice_id, :product_id, :quantity, :price)";
            $statement = $connection->prepare($query);
            $statement->execute([
                'invoice_id' => $invoice_id,
                'product_id' => $item[0],
                'quantity' => $item[5],
                'price' => $item[7]
            ]);
        }

        $connection->commit();

        unset($_SESSION["cart"]);
        unset($_SESSION["tquantity"]);
        unset($_SESSION["tprice"]);

        if ($payment_method == "online") {
            header("Location: vnpay_create_payment.php?invoice_id=" . $invoice_id . "&amount=" . $total);
            exit();
        } else {
            header("Location: order_confirmation.php?invoice_id=" . $invoice_id . "&payment_method=" . $payment_method);
            exit();
        }
    } catch (Exception $e) {
        // Rollback lại các thao tác nếu có lỗi xảy ra
        $connection->rollBack();
        echo "Lỗi xảy ra: " . $e->getMessage();
    }
}
?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <style>
        .checkout_label {
            font-size: 20px;
            font-weight: bold;
        }

        .checkout_box {
            width: 100%;
            border: 1px solid black;
            border-radius: 5px;
            font-size: 20px;
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>

<body>

    <?php
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    $user = isset($_SESSION["user"]) ? $_SESSION["user"] : [];

    addHeader();
    addFormSign();
    ?>

    <section class="product-list-in-cart" style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
        <div style="width: 80%;">
            <h1 class="heading">Check Out</h1>
            <div class="row">
                <?php
                if (empty($cart)) {
                    echo '<div class="col-12 text-center"><p>Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thực hiện thanh toán.</p></div>';
                } else {
                    if (sizeof($user) == 0) {
                ?>
                        <form class="col-8" style="padding-right:20px" method="post" action="checkout.php">
                            <div style="font-size: 30px; font-weight: bold;">Thanh Toán Vãng Lai</div><br>
                            <label class="checkout_label" for="name">Tên Khách Hàng</label><br>
                            <input class="checkout_box" type="text" name="name" required><br><br>
                            <label class="checkout_label" for="email">Email</label><br>
                            <input class="checkout_box" type="email" name="email" required><br><br>
                            <label class="checkout_label" for="address">Địa Chỉ</label><br>
                            <input class="checkout_box" type="text" name="address" required><br><br>
                            <label class="checkout_label" for="phone">Điện Thoại</label><br>
                            <input class="checkout_box" type="number" name="phone" required><br><br>
                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: row;">
                                <input type="submit" style="margin-left: 10px" class="btn" name="off_checkout" value="Thanh Toán Khi Giao" style="width: 40%">
                                <input type="submit" style="margin-left: 10px" class="btn" name="onl_checkout" value="Thanh Toán Trực Tuyến" style="width: 40%">
                            </div>
                        </form>
                    <?php
                    } else {
                        $id = $user["account_id"];

                        $query = "select * from tbl_account_details where account_id=$id";
                        $statement = $connection->prepare($query);
                        $statement->execute();

                        $info = $statement->fetch();
                    ?>
                        <form class="col-8" style="padding-right:20px" method="post" action="checkout.php">
                            <div style="font-size: 30px; font-weight: bold;">Thanh Toán Khách Hàng</div><br>
                            <label class="checkout_label" for="name">Tên Khách Hàng</label><br>
                            <input class="checkout_box" type="text" name="name" readonly value="<?php echo $info["customer_name"] ?>"><br><br>
                            <label class="checkout_label" for="email">Email</label><br>
                            <input class="checkout_box" type="email" name="email" readonly value="<?php echo $info["email"] ?>"><br><br>
                            <label class="checkout_label" for="address">Địa Chỉ</label><br>
                            <input class="checkout_box" type="text" name="address" readonly value="<?php echo $info["address"] ?>"><br><br>
                            <label class="checkout_label" for="phone">Điện Thoại</label><br>
                            <input class="checkout_box" type="number" name="phone" readonly value="<?php echo $info["phone"] ?>"><br><br>
                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: row;">
                                <input type="submit" style="margin-left: 10px" class="btn" name="off_checkout" value="Thanh Toán Khi Giao" style="width: 40%">
                                <input type="submit" style="margin-left: 10px" class="btn" name="onl_checkout" value="Thanh Toán Trực Tuyến" style="width: 40%">
                            </div>
                        </form>
                <?php
                    }
                }
                ?>
                <div class="col-4">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="font-size: 30px; text-align: left; font-weight: bold;">Giỏ Hàng</div>
                        <div style="background-color: #888888; border-radius: 50%; width: 50px; display: flex; justify-content: center; align-items: center; text-align: center; color: #ffffff; font-weight: bold; font-size: 20px"><?php echo $_SESSION["tquantity"] ?></div>
                    </div>
                    <br>
                    <table class="table">
                        <?php
                        foreach ($cart as $item) {
                        ?>
                            <tr style="border-bottom: 1px solid #dee2e6">
                                <td style="width: 20%"><img style="width: 100%; height: 100%;" src="image/product/<?php echo $item[2] ?>" alt="<?php echo $item[2] ?>"></td>
                                <td>
                                    <a href="details.php?id=<?php echo $item[0] ?>" style="text-decoration: none; color: black; font-weight: bold"><?php echo $item[1] ?></a>
                                    <p>Số lượng: <span class="amount"><?php echo $item[5] ?></span></p>
                                </td>
                                <td class="right">
                                    <p class="price"><?php echo number_format($item[7], 0, ',', '.') ?></p>
                                    <p>VNĐ</p>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr style="border-bottom: 1px solid #dee2e6">
                            <td colspan="2" style="border: none">
                                <div style="text-align: right; font-size: 20px; font-weight: bold;"><span class="total">Tổng: <strong><?php echo number_format($_SESSION["tprice"], 0, ',', '.') ?> VNĐ</strong></span></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <br><br><br><br>
    <?php
    addFooter();
    ?>
    <script src="js/main.js"></script>
</body>

</html>