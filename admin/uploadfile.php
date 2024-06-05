<?php
// Kiểm tra xem có tệp được gửi lên không
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];

    // Tách phần mở rộng của tên tệp
    $file_name_parts = explode('.', $file_name);
    $file_ext = strtolower(end($file_name_parts)); // Sửa đổi dòng này

    // Các phần mở rộng tệp hợp lệ
    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Chỉ các tệp JPEG, JPG và PNG được phép.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'Kích thước tệp phải nhỏ hơn 2 MB';
    }

    if (empty($errors) == true) {
        // Đổi tên tệp thành timestamp + tên gốc
        $new_file_name = time() . '_' . $file_name;
        move_uploaded_file($file_tmp, "../shop/image/product/" . $new_file_name);
        echo  $new_file_name;
    } else {
        print_r($errors);
    }
}
