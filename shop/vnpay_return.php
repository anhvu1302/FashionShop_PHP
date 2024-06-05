<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php
    session_start();

    include "library/layout.php";
    include "library/main.php";
    include "library/helper.php";
    include "library/pager.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
    require '../vendor/PHPMailer/PHPMailer/src/SMTP.php';
    require '../vendor/PHPMailer/PHPMailer/src/Exception.php';

    $connection = connectDatabase();
    require_once("./config.php");

    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    if ($secureHash == $vnp_SecureHash) {
        if ($_GET['vnp_ResponseCode'] == '00') {
            $invoice_id = $_GET['vnp_TxnRef'];

            $query5 = "SELECT * FROM fashionshop.tbl_invoice WHERE invoice_id =" . $invoice_id . ";";
            $statement5 = $connection->prepare($query5);
            $statement5->execute();
            $order = $statement5->fetch(PDO::FETCH_ASSOC);
            if ($order['note'] == "Đã thanh toán" || $order['note'] == "Đã xác nhận") {
            } else {
                $query = "UPDATE tbl_invoice SET note = 'Đã thanh toán' WHERE invoice_id = " . $_GET['vnp_TxnRef'] . ";";
                $statement = $connection->prepare($query);
                $statement->execute();

                // Lấy thông tin đơn hàng từ cơ sở dữ liệu
                $query = "SELECT * FROM tbl_invoice WHERE invoice_id = $invoice_id";
                $statement = $connection->prepare($query);
                $statement->execute();
                $order = $statement->fetch(PDO::FETCH_ASSOC);

                // Lấy thông tin khách hàng từ cơ sở dữ liệu
                $customer_id = $order['customer_id'];
                $query = "SELECT * FROM tbl_account_details WHERE account_id = $customer_id";
                $statement = $connection->prepare($query);
                $statement->execute();
                $customer = $statement->fetch(PDO::FETCH_ASSOC);

                // Lấy thông tin sản phẩm từ cơ sở dữ liệu
                $query = "SELECT tbl_invoice_details.*, tbl_product.product_name, MIN(tbl_product_style.product_image) AS product_image
            FROM tbl_invoice_details 
            JOIN tbl_product ON tbl_invoice_details.product_id = tbl_product.product_id 
            JOIN tbl_product_style ON tbl_invoice_details.product_id = tbl_product_style.product_id 
            WHERE tbl_invoice_details.invoice_id = " . $invoice_id . "
            GROUP BY product_id";
                $statement = $connection->prepare($query);
                $statement->execute();
                $products = $statement->fetchAll(PDO::FETCH_ASSOC);

                $order_data = [
                    'customer_name' => $customer['customer_name'],
                    'order_id' => $order['invoice_id'],
                    'order_date' => $order['date'],
                    'total' => $order['total'],
                    'payment_method' => $order['payment_method'],
                    'order_status' => $order['note'],
                    'customer_id' => $customer['account_id'],
                    'phone' => $order['phone'],
                    'address' => $order['address'],
                    'note' => $order['note'],
                    'products' => []
                ];

                foreach ($products as $product) {
                    $order_data['products'][] = [
                        'id' => $product['product_id'],
                        'name' => $product['product_name'],
                        'image' => $product['product_image'],
                        'quantity' => $product['quantity'],
                        'price' => $product['price'],
                        'total' => $product['quantity'] * $product['price']
                    ];
                }

                sendOrderEmail($customer['email'], $order_data);
            }
        } else {
            echo "<span style='color:red'>Giao dịch không thành công</span>";
        }
    } else {
        echo "<span style='color:red'>Chữ ký không hợp lệ</span>";
    }

    function sendOrderEmail($to, $order)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cskhvavshop@gmail.com';
            $mail->Password = 'frml wcsa qyak jmgu';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('cskhvavshop@gmail.com', 'Chăm sóc khách hàng shop.');
            $mail->addAddress($to, $order['customer_name']);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Đơn hàng của bạn';

            $template = file_get_contents('order_email_template.html');

            $template = str_replace('{{customer_name}}', $order['customer_name'], $template);
            $template = str_replace('{{order_id}}', $order['order_id'], $template);
            $template = str_replace('{{order_date}}', $order['order_date'], $template);
            $template = str_replace('{{order_total}}', number_format($order['total'], 0, '', ',') . ' VND', $template);
            $template = str_replace('{{payment_method}}', $order['payment_method'], $template);
            $template = str_replace('{{order_status}}', $order['order_status'], $template);
            $template = str_replace('{{customer_id}}', $order['customer_id'], $template);
            $template = str_replace('{{phone}}', $order['phone'], $template);
            $template = str_replace('{{address}}', $order['address'], $template);
            $template = str_replace('{{note}}', $order['note'], $template);

            $product_list_html = '';
            foreach ($order['products'] as $product) {
                $product_list_html .= "<tr>
                    <td>{$product['id']}</td>
                    <td>{$product['name']}</td>
                    <td><img src='{$product['image']}' alt='{$product['name']}' style='width: 50px; height: 50px;'></td>
                    <td>{$product['quantity']}</td>
                    <td>" . number_format($product['price'], 0, '', ',') . ' VND' . "</td>
                    <td>" . number_format($product['total'], 0, '', ',') . ' VND' . "</td>
                </tr>";
            }
            $template = str_replace('{{product_list}}', $product_list_html, $template);
            $mail->Body = $template;

            $mail->send();
        } catch (Exception $e) {
            echo "Order confirmation email could not be sent to {$order['customer_name']} ({$to}). Mailer Error: {$mail->ErrorInfo}\n";
        }
    }
    ?>
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">THÔNG TIN ĐƠN HÀNG</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>
                <label class="text-danger"><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">
                <label>Số tiền:</label>
                <label class="text-danger"><?php echo number_format((int)$_GET['vnp_Amount'] / 100, 0, '', ',') . ' VND' ?></label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label><?php echo $_GET['vnp_PayDate'] ?></label>
            </div>
            <div class="form-group">
                <h1 class="text-danger">Vui lòng kiểm tra đơn hàng trong email</h1>
            </div>
            <div>
                <a href="./index.php" class="btn btn-success">Trang chủ</a>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; Fashion Shop <?php echo date('Y') ?></p>
            </footer>
        </div>
    </div>
</body>

</html>