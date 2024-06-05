<?php require_once('header.php'); ?>
<?php
$tb = "";
if (isset($_POST["btnSubmit"])) {
    $ma_khach_hang = NULL;
    $username = $_POST["txtuser"];
    $password = "e6e061838856bf47e1de730719fb2609";
    $token = "5620ffd5755f0f198166ea7c98c14ffc";
    $type = "user";
    $verified = 1;
    $user_login_status = "Logout";
    $ten_khach_hang = $_POST["txtName"];
    $gioi = $_POST["txtGender"];
    $ngsinh = $_POST["txtDateOfBirth"];
    $dia_chi = $_POST["txtAddress"];
    $dien_thoai = $_POST["txtPhoneNum"];
    $email = $_POST["txtEmail"];

    //kt trùng mail
    $sql = "SELECT * FROM tbl_account A JOIN tbl_account_details AD ON A.account_id = AD.account_id WHERE account_type='user' AND email='$email'";
    $sta = $pdo->prepare($sql);
    $sta->execute();

    // Kiểm tra trùng số điện thoại
    $sql_phone = "SELECT * FROM tbl_account A JOIN tbl_account_details AD ON A.account_id = AD.account_id WHERE account_type='user' AND phone='$dien_thoai'";
    $sta_phone = $pdo->prepare($sql_phone);
    $sta_phone->execute();

    if ($sta->rowCount() > 0) {
        $tb = "Mail này đã tồn tại !";
    } elseif ($sta_phone->rowCount() > 0) {
        $tb = "Số điện thoại này đã tồn tại!";
    } else {
        //Xây dựng câu lệnh thêm vào bảng tbl_account
        $sql = "INSERT INTO tbl_account (account_id, username, password, token, account_type, is_verified, user_login_status) VALUES(?,?,?,?,?,?,?)";
        //khai báo tham số truyền các giá trị nhập từ form
        $param = array($ma_khach_hang, $username, $password, $token, $type, $verified,$user_login_status);
        $sta = $pdo->prepare($sql);
        $sta->execute($param);
        //Lấy mã khách hàng vừa được tạo ở bảng tbl_account
        $ma_khach_hang = $pdo->lastInsertId();
        //Xây dựng câu lệnh thêm vào bảng tbl_account_details
        $sql = "INSERT INTO tbl_account_details VALUES(?,?,?,?,?,?,?)";
        $param = array($ma_khach_hang, $ten_khach_hang, $gioi, $ngsinh, $dia_chi, $dien_thoai, $email);
        $sta = $pdo->prepare($sql);
        $kq = $sta->execute($param);
        if ($kq) {
            $tb = "Thêm khách hàng thành công";
        } else {
            $tb = "Thêm bị lỗi, xem lại";
        }
    }
}
?>

<div class="container">
    <br>
    <h2 align="center">TRANG THÊM MỚI KHÁCH HÀNG</h2>
    <form method="post" action="addcustomer.php" enctype="multipart/form-data">

        <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="text" name="txtuser" id="" class="form-control" placeholder="Nhập tên tài khoản" required="required">
        </div>
        <div class="form-group">
            <label for="">Tên khách hàng</label>
            <input type="text" name="txtName" id="idName" class="form-control" placeholder="Nhập tên khách hàng" required="required">

        </div>
        <div class="form-group">
            <label for="">Giới tính</label>
            <input type="text" name="txtGender" id="" class="form-control" placeholder="Giới tính" aria-describedby="helpId">

        </div>
        <div class="form-group">
            <label for="txtDateOfBirth">Ngày sinh</label>
            <input type="date" id="txtDateOfBirth" name="txtDateOfBirth" class="form-control" required="required" placeholder="Ngày sinh">
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <input type="text" name="txtAddress" id="" class="form-control" placeholder="Nhập địa chỉ khách hàng" required="required">

        </div>
        <div class="form-group">
            <label for="">Điện thoại</label>
            <input type="number" name="txtPhoneNum" id="" class="form-control" placeholder="Nhập điện thoại khách hàng" aria-describedby="helpId">

        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="txtEmail" id="" class="form-control" placeholder="Nhập Email khách hàng" required="required">

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnSubmit">Create</button>
            <button class="btn btn-primary" name="btnSubmit"> <a class="text-light text-decoration-none" href="customer.php">Show Customer</a></button>
        </div>
        <div form-group class="text-danger">
            <?php if ($tb != NULL)  echo $tb ?>
        </div>
    </form>
</div>


<?php require_once('footer.php'); ?>