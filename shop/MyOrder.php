<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Đơn hàng của tôi</title>

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <?php

    session_start();


    include "library/layout.php";
    include "library/main.php";
    include "library/helper.php";

    $connection = connectDatabase();

    addHeader();

    ?>
    <section class="products" style="margin-top: 75px">
        <div class="container" style="display: unset;padding: 10rem;">
            <div class="row text-danger text-center mb-5">
                <h1>Danh sách đơn hàng</h1>
            </div>

            <?php
            $query = "SELECT * FROM tbl_invoice WHERE customer_id = " . $_SESSION['user']['account_id'] . " ORDER BY date DESC;";
            $statement = $connection->prepare($query);
            $statement->execute();
            $orders = $statement->fetchAll();
            foreach ($orders as $order) {
            ?>

                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card border rounded rounded-4 shadow-none fs-3">
                            <div class="card-header p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3>Đơn hàng: <span class="text-danger"><?php echo $order['invoice_id'] ?></span></h3>
                                    <div class="d-flex align-items-center gap-5">
                                        <?php
                                        if ($order["cancelled"] == "Yes") {
                                            echo '<h3 class="text-danger text-uppercase">Đã hủy</h3>';
                                        } else {
                                            echo '<button class="btn btn-primary m-0 repay" data-payment-method="' . $order['payment_method'] . '" data-order-id="' . $order['invoice_id'] . '" data-amount="' . $order['total'] . '">Thanh toán</button>';
                                            echo '<h3 class="text-danger text-uppercase m-0">' . $order['note'] . '</h3>';
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $query2 = "SELECT ID.*,P.*,MIN(product_image) AS product_image 
                                FROM tbl_invoice_details ID 
                                INNER JOIN tbl_product P ON ID.product_id = P.product_id 
                                INNER JOIN tbl_product_style PS ON P.product_id = PS.product_id 
                                WHERE invoice_id = " . $order['invoice_id'] . " GROUP BY ID.product_id;";
                                $statement2 = $connection->prepare($query2);
                                $statement2->execute();
                                $orderDetails = $statement2->fetchAll();
                                foreach ($orderDetails as $item) {
                                ?>
                                    <div class="d-flex align-items-start border-bottom pb-3">
                                        <div class="me-4">
                                            <img src="image/product/<?php echo explode('|', $item["product_image"])[0] ?>" alt="" class="rounded" style="height: 9rem;width: 6rem;">
                                        </div>
                                        <div class="flex-grow-1 align-self-center overflow-hidden row">
                                            <div class="col-6 d-flex align-items-center">
                                                <h5 class="text-wrap font-size-18">
                                                    <a href="details.php?id=<?php echo $item["product_id"] ?>" class="text-dark text-decoration-none" target="_blank"><?php echo $item["product_name"] ?></a>
                                                </h5>

                                            </div>
                                            <div class="flex-grow-1 align-self-center overflow-hidden col-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mt-3">
                                                            <p class="text-muted mb-2">Đơn giá</p>
                                                            <h5 class="mb-0 mt-2">
                                                                <span class="text-muted me-2">
                                                                    <del class="font-size-16 fw-normal text-decoration-line-through">
                                                                        <?php echo number_format($item["product_price"], 0, '', ',') ?> VND
                                                                    </del>
                                                                </span>
                                                                <?php echo number_format($item["product_price"] * (100 - $item["product_discount"]) / 100, 0, '', ',') ?> VND
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="mt-3">
                                                            <p class="text-muted mb-2">Số lượng</p>
                                                            <h5 class="mb-0 mt-2">
                                                                <del class="font-size-16 fw-normal">
                                                                    <?php
                                                                    echo $item['quantity']
                                                                    ?>
                                                                </del>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <p class="text-muted mb-2">Thành tiền</p>
                                                            <h5>
                                                                <?php echo number_format($item["product_price"] * (100 - $item["product_discount"]) / 100 * $item['quantity'], 0, '', ',') ?> VND
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between ms-2">
                                    <div>Tổng tiền: <span class="text-danger"><?php echo number_format($order['total'], 0, '', ',') ?> VNĐ</span></div>
                                    <ul class="list-inline mb-0 font-size-16">
                                        <li class="list-inline-item">
                                            <a href="#" class="text-muted px-1">
                                                <i class="fa fa-xmark text-danger fs-2"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>
        </div>
    </section>

    <?php
    addFooter();

    ?>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            $(".repay").click(function(event) {
                event.preventDefault();

                var paymentMethod = $(this).data("payment-method");
                var orderId = $(this).data("order-id");
                var amount = $(this).data("amount");

                if (paymentMethod) {
                    switch (paymentMethod) {
                        case "VNPAY":
                            window.location.href = `vnpay_create_payment.php?invoice_id=${orderId}&amount=${amount}`
                            break;
                        case "COD":
                            alert('Vui lòng thanh toán khi nhận hàng.')
                            break;
                        default:
                            console.log("Phương thức thanh toán không được hỗ trợ");
                    }
                } else {
                    console.log("Không có phương thức thanh toán được chọn");
                }
            });
        });
    </script>
</body>

</html>