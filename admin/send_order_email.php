<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendOrderEmail($to, $order)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cskhvavshop@gmail.com';
        $mail->Password = 'frml wcsa qyak jmgu';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('cskhvavshop@gmail.com', 'Chăm sóc khách hàng shop.');
        $mail->addAddress($to, $order['customer_name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Order Confirmation';

        // Load the email template
        $template = file_get_contents('order_email_template.html');

        // Replace placeholders with actual values
        $template = str_replace('{{customer_name}}', $order['customer_name'], $template);
        $template = str_replace('{{order_id}}', $order['order_id'], $template);
        $template = str_replace('{{order_date}}', $order['order_date'], $template);
        $template = str_replace('{{total}}', $order['total'], $template);
        $template = str_replace('{{payment_method}}', $order['payment_method'], $template);
        $template = str_replace('{{order_status}}', $order['order_status'], $template);
        $template = str_replace('{{customer_id}}', $order['customer_id'], $template);
        $template = str_replace('{{phone}}', $order['phone'], $template);
        $template = str_replace('{{address}}', $order['address'], $template);
        $template = str_replace('{{note}}', $order['note'], $template);

        // Generate the product list HTML
        $product_list_html = '';
        foreach ($order['products'] as $product) {
            $product_list_html .= "<tr>
                <td>{$product['id']}</td>
                <td>{$product['name']}</td>
                <td><img src='{$product['image']}' alt='{$product['name']}' style='width: 50px; height: 50px;'></td>
                <td>{$product['quantity']}</td>
                <td>\${$product['price']}</td>
                <td>\${$product['total']}</td>
            </tr>";
        }
        $template = str_replace('{{product_list}}', $product_list_html, $template);

        $mail->Body = $template;

        $mail->send();
        echo "Order confirmation email has been sent to {$order['customer_name']} ({$to})\n";
    } catch (Exception $e) {
        echo "Order confirmation email could not be sent to {$order['customer_name']} ({$to}). Mailer Error: {$mail->ErrorInfo}\n";
    }
}
