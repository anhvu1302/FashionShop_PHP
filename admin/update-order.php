<?php
ob_start();
session_start();
include("inc/config.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
    $invoice_id = $data['invoice_id'];
    $note = $data['note'];
    $payment_method = $data['payment_method'];
    $cancelled = $data['cancelled'];
    $phone = $data['phone'];
    $address = $data['address'];
    $query = "UPDATE tbl_invoice SET note = ?, payment_method = ?, cancelled = ?, phone = ?, address = ? WHERE invoice_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$note, $payment_method, $cancelled, $phone, $address, $invoice_id]);
    echo json_encode(['success' => true, 'message' => 'Dữ liệu đã được cập nhật thành công.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Request method is valid.']);
}
