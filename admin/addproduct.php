<?php require_once('header.php'); ?>
<?php
$tb = "";
$sql = "SELECT * FROM tbl_product_type";
$sta = $pdo->prepare($sql);
$sta->execute();
$product_types = $sta->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["btnSubmit"])) {
    $masp = NULL;
    $tensp = $_POST["txtTen"];
    $mota = $_POST["txtMoTa"];
    $gia = $_POST["txtprice"];
    $giamGia = $_POST["txtdiscount"];
    $rating = 0;

    // $type = 0;
    $mau = $_POST["txtcolor"];
    $size = $_POST["txtsize"];
    $hinh = $_FILES["image"]["error"] == 0 ? $_FILES["image"]["name"] : "";
    


    $product_type=$_POST["product_type"];
    //Xây dựng câu lệnh thêm vào bảng tbl_product
    $sql = "INSERT INTO tbl_product VALUES(?,?,?,?,?,?,?)";
    //khai báo tham số truyền các giá trị nhập từ form
    $param = array($masp, $tensp, $mota, $gia, $giamGia, $rating, $product_type);
    $sta = $pdo->prepare($sql);
    $sta->execute($param);
    //Lấy mã sản phẩm vừa được tạo ở bảng tbl_product
    $masp = $pdo->lastInsertId();
    //Xây dựng câu lệnh thêm vào bảng tbl_product_style
    $sql = "INSERT INTO tbl_product_style VALUES(?,?,?,?)";
    $param = array($masp, $mau, $hinh, $size);
    $sta = $pdo->prepare($sql);
    $kq = $sta->execute($param);
    if ($kq) {
        $tb = "Thêm sản phẩm thành công";
        if ($hinh != "") {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../shop/image/product/$hinh");
        }
    } else {
        $tb = "Thêm bị lỗi, xem lại";
    }
}
?>
<style>
    .form-container {
        max-width: 800px;
        margin: auto;
        padding: 2rem;
        background-color: #f7f7f7;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-group label {
        font-weight: bold;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .text-danger {
        font-weight: bold;
    }
</style>
<h2 align="center">TRANG THÊM MỚI SẢN PHẨM</h2>
<div class="container mt-5">
    <div class="form-container">
<form action="addproduct.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" name="txtTen" id="" class="form-control" placeholder="" require>
            </div>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="txtMoTa" id=""></textarea>
            </div>
            <div class="form-group">
                <label for="">Giá tiền</label>
                <input type="number" name="txtprice" id="" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Giảm giá</label>
                <input type="number" name="txtdiscount" id="" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Loại sản phẩm</label> 
                <select name="product_type" class="form-control">
                    <?php foreach ($product_types as $type) : ?>
                        <option value="<?php echo $type->product_type_id; ?>"><?php echo $type->product_type_name; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">Màu</label>
                <input type="text" name="txtcolor" id="" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="image" id="" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Kích cỡ sản phẩm</label>
                <input type="text" name="txtsize" id="" class="form-control" placeholder="">

            </div>

        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="btnSubmit">Create</button>
        <button class="btn btn-primary" name="btnSubmit"> <a class="text-light text-decoration-none" href="product.php">Show Product</a></button>
    </div>
    <div form-group class="text-danger">
        <?php if ($tb != NULL)  echo $tb ?>
    </div>
</form>
</div>
</div>
<?php require_once('footer.php'); ?>