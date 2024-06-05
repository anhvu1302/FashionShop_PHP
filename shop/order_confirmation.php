<?php
$invoice_id = isset($_GET["invoice_id"]) ? (int)$_GET["invoice_id"] : 0;

if ($invoice_id <= 0) {
    echo "Invalid invoice ID.";
    exit();
}

// Kết nối và lấy thông tin hóa đơn nếu cần
include "library/helper.php";
$connection = connectDatabase();

$query = "SELECT * FROM tbl_invoice WHERE invoice_id = :invoice_id";
$statement = $connection->prepare($query);
$statement->execute(['invoice_id' => $invoice_id]);
$invoice = $statement->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Đơn Hàng Của Bạn Đã Được Đặt Thành Công!</h1>
        <p>Mã hóa đơn của bạn là: <?php echo htmlspecialchars($invoice["invoice_id"]); ?></p>
        <p>Ngày: <?php echo htmlspecialchars($invoice["date"]); ?></p>
        <p>Tổng tiền: <?php echo number_format($invoice["total"], 0, ',', '.'); ?> VNĐ</p>
        <p>Địa chỉ: <?php echo htmlspecialchars($invoice["address"]); ?></p>
        <p>Điện thoại: <?php echo htmlspecialchars($invoice["phone"]); ?></p>
        <p>Ghi chú: <?php echo htmlspecialchars($invoice["note"]); ?></p>

        <div>
        <a href="./index.php" class="btn btn-success">Trang chủ</a>
    </div>
    </div>

</body>

</html>