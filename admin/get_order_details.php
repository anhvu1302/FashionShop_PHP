<?php
ob_start();
session_start();
include("inc/config.php");

if (isset($_REQUEST["invoice_id"])) {
    $invoiceId = $_REQUEST["invoice_id"];
    $query = "SELECT * FROM tbl_invoice WHERE invoice_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$invoiceId]);

    $order = $statement->fetch(PDO::FETCH_ASSOC);


    if ($order) {
        $query_details = "SELECT ID.*,P.*,MIN(product_image) AS product_image 
        FROM tbl_invoice_details ID 
        JOIN tbl_product P ON ID.product_id = P.product_id 
        JOIN tbl_product_style PS ON P.product_id = PS.product_id 
        WHERE invoice_id = ? 
        GROUP BY P.product_id;";
        
        $statement_details = $pdo->prepare($query_details);
        $statement_details->execute([$invoiceId]);

        $orderDetails = $statement_details->fetchAll(PDO::FETCH_ASSOC);

        $order['orderDetails'] = $orderDetails;

        echo json_encode($order);
    } else {
        echo json_encode([]);
    }
}
