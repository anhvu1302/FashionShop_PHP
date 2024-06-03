<?php require_once('header.php'); ?>
<?php
$tb = "";
// Lấy thông tin khách hàng từ cơ sở dữ liệu để hiển thị trên biểu mẫu
if (isset($_GET['mkh'])) {
    $mkh = $_GET['mkh'];
    $sql = "SELECT * FROM tbl_account A JOIN tbl_account_details AD ON A.account_id = AD.account_id WHERE account_type='user'AND A.account_id = ?";
    $sta = $pdo->prepare($sql);
    $sta->execute([$mkh]);
    if ($sta->rowCount() > 0) {
        $khach_hang = $sta->fetch(PDO::FETCH_ASSOC);
    }
}

if (isset($_POST["btnSubmit"])) {
    $ma_khach_hang =isset($_GET['mkh']) ? $_GET['mkh'] : null;
    $username = $_POST["txtuser"];
    $password = "e6e061838856bf47e1de730719fb2609";
    $token = "5620ffd5755f0f198166ea7c98c14ffc";
    $type = "user";
    $verified = 1;
    $ten_khach_hang = $_POST["txtName"];
    $gioi = $_POST["txtGender"];
    $ngsinh = $_POST["txtDateOfBirth"];
    $dia_chi = $_POST["txtAddress"];
    $dien_thoai = $_POST["txtPhoneNum"];
    $email = $_POST["txtEmail"];

    $sql_check_email = "SELECT * FROM tbl_account A JOIN tbl_account_details AD ON A.account_id = AD.account_id WHERE account_type='user' AND email=:email AND A.account_id != :mkh";
    $sta_check_email = $pdo->prepare($sql_check_email);
    $sta_check_email->bindParam(':email', $email, PDO::PARAM_STR);
    $sta_check_email->bindParam(':mkh', $mkh, PDO::PARAM_INT);
    $sta_check_email->execute();

    // Kiểm tra trùng số điện thoại
    $sql_check_phone = "SELECT * FROM tbl_account A JOIN tbl_account_details AD ON A.account_id = AD.account_id WHERE account_type='user' AND phone=:phone AND A.account_id != :mkh";
    $sta_check_phone = $pdo->prepare($sql_check_phone);
    $sta_check_phone->bindParam(':phone', $dien_thoai, PDO::PARAM_STR);
    $sta_check_phone->bindParam(':mkh', $mkh, PDO::PARAM_INT);
    $sta_check_phone->execute();

    if ($sta_check_email->rowCount() > 0) {
        $tb = "Mail này đã tồn tại !";
    } elseif ($sta_check_phone->rowCount() > 0) {
        $tb = "Số điện thoại này đã tồn tại!";
    } else {
        //Xây dựng câu lệnh thêm vào bảng tbl_account
        $sql = "UPDATE tbl_account SET username='$username', password='$password' WHERE account_id='$ma_khach_hang'";
        $sta = $pdo->prepare($sql);
        $sta->execute();
        //Xây dựng câu lệnh thêm vào bảng tbl_account_details
        $sql = "UPDATE tbl_account_details SET customer_name = '$ten_khach_hang', gender = '$gioi', date_of_birth = '$ngsinh', address = '$dia_chi', phone = '$dien_thoai', email = '$email' WHERE account_id = '$ma_khach_hang'";
        $sta = $pdo->prepare($sql);
        $kq = $sta->execute();
        if ($kq) {
            $tb = "Cập nhật khách hàng thành công";
            
        } else {
            $tb = "Cập nhật bị lỗi, xem lại";
        }
    }
}
?>

<div class="container">
    <br>
    <h2 align="center">CẬP NHẬT KHÁCH HÀNG</h2>
    <form method="post" action="update_customer.php?mkh=<?php echo $mkh?>" enctype="multipart/form-data">
        <input type="hidden" name="ma_khach_hang" value="<?php echo $mkh; ?>">
        <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="text" name="txtuser" value="<?php echo $khach_hang['username']; ?>" id="" class="form-control" placeholder="Nhập tên tài khoản" required="required">
        </div>
        <div class="form-group">
            <label for="">Tên khách hàng</label>
            <input type="text" name="txtName" id="idName" value="<?php echo $khach_hang['customer_name']; ?>" class="form-control" placeholder="Nhập tên khách hàng" required="required">

        </div>
        <div class="form-group">
            <label for="">Giới tính</label>
            <input type="text" name="txtGender" id="" value="<?php echo $khach_hang['gender'] ?>" class="form-control" placeholder="Giới tính" aria-describedby="helpId">

        </div>
        <div class="form-group">
            <label for="txtDateOfBirth">Ngày sinh</label>
            <input type="date" id="txtDateOfBirth" name="txtDateOfBirth" value="<?php echo $khach_hang['date_of_birth'] ?>" class="form-control" required="required" placeholder="Ngày sinh">
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <input type="text" name="txtAddress" id="" class="form-control" value="<?php echo $khach_hang['address'] ?>" placeholder="Nhập địa chỉ khách hàng" required="required">

        </div>
        <div class="form-group">
            <label for="">Điện thoại</label>
            <input type="number" name="txtPhoneNum" id="" class="form-control" value="<?php echo $khach_hang['phone'] ?>" placeholder="Nhập điện thoại khách hàng" aria-describedby="helpId">

        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="txtEmail" id="" class="form-control" value="<?php echo $khach_hang['email'] ?>" placeholder="Nhập Email khách hàng" required="required">

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnSubmit">Cập nhật</button>
            <button class="btn btn-primary" name="btnSubmit"> <a class="text-light text-decoration-none" href="customer.php">Show Customer</a></button>
        </div>
        <div form-group class="text-danger">
            <?php if ($tb != NULL)  echo $tb ;?>
        </div>
    </form>
</div>


<?php require_once('footer.php'); ?>