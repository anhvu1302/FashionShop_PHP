<?php require_once('header.php');
// Load select option
$sql = "SELECT * FROM tbl_product_type";
$sta = $pdo->prepare($sql);
$sta->execute();
$product_types = $sta->fetchAll(PDO::FETCH_OBJ);

$tb = "";

if (isset($_GET['id']) && isset($_GET['color'])) {
    $product_id = $_GET['id'];
    $product_color = $_GET['color'];
    
    $sql = "SELECT p.*, ps.product_color, ps.product_image, ps.product_size 
    FROM tbl_product p
    JOIN tbl_product_style ps ON p.product_id = ps.product_id
    WHERE p.product_id = ? AND ps.product_color = ?";
    $sta = $pdo->prepare($sql);
    $sta->execute([$product_id, $product_color]);
    $item = $sta->fetch(PDO::FETCH_OBJ);

    if (!$item) {
        die("Không tìm thấy sản phẩm!");
    }
} else {
    die("Invalid product ID or color!");
}

// Xử lý form submit
if (isset($_POST["btnSubmit"])) {
    $masp = $_POST["product_id"];
    $tensp = $_POST["txtTen"];
    $mota = $_POST["txtMoTa"];
    $gia = $_POST["txtprice"];
    $giamGia = $_POST["txtdiscount"];
    $mau = $_POST["product_color"];
    $size = $_POST["txtsize"];
    $product_type = $_POST["product_type"];

    // Xử lý upload hình ảnh
    $images = $_POST['imgArr'];
    // foreach ($_FILES["image"]["error"] as $key => $error) {
    //     if ($error == UPLOAD_ERR_OK) {
    //         $tmp_name = $_FILES["image"]["tmp_name"][$key];
    //         $name = $_FILES["image"]["name"][$key];
    //         move_uploaded_file($tmp_name, "../shop/image/product/$name");
    //         $uploaded_images[] = $name;
    //     }
    // }
    if (!empty($images)) {
        $sql = "UPDATE tbl_product_style SET product_image = ?, product_size = ? WHERE product_id = ? AND product_color = ?";
        $param = array($images, $size, $masp, $mau);
    } else {
        $sql = "UPDATE tbl_product_style SET product_size = ? WHERE product_id = ? AND product_color = ?";
        $param = array($size, $masp, $mau);
    }
    $sta = $pdo->prepare($sql);
    $kq = $sta->execute($param);

    $sql = "UPDATE tbl_product SET product_name= ?, product_description= ?, product_price = ?, product_discount = ?, product_type_id= ? WHERE product_id = ?";
    $param = array($tensp, $mota, $gia, $giamGia, $product_type, $masp);
    $sta = $pdo->prepare($sql);
    $sta->execute($param);

    if ($kq) {
        $tb = "Cập nhật thành công";
    } else {
        $tb = "Cập nhật bị lỗi, xem lại";
    }
} elseif (isset($_POST["btnAdd"])) {
    $masp = $_POST["product_id"];
    $mau = $_POST["txtcolor"];
    $size = $_POST["txtsize"];

    $uploaded_images = [];
    foreach ($_FILES["image"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["image"]["tmp_name"][$key];
            $name = $_FILES["image"]["name"][$key];
            move_uploaded_file($tmp_name, "../shop/image/product/$name");
            $uploaded_images[] = $name;
        }
    }

    $images = implode('|', $uploaded_images);
    $sql = "INSERT INTO tbl_product_style (product_id, product_color, product_image, product_size) VALUES (?, ?, ?, ?)";
    $param = array($masp, $mau, $images, $size);
    $sta = $pdo->prepare($sql);
    $kq = $sta->execute($param);

    if ($kq) {
        $tb = "Thêm kiểu sản phẩm thành công";
    } else {
        $tb = "Thêm kiểu sản phẩm bị lỗi, vui lòng kiểm tra lại";
    }
}

?>

<h2>Cập nhật sản phẩm</h2>
<form action="update_product.php?id=<?php echo $item->product_id ?>&color=<?php echo $item->product_color ?>" method="post">
    <div class="form-group">
        <input type="hidden" name="product_id" value="<?php echo $item->product_id ?>">
        <input type="hidden" name="product_color" value="<?php echo $item->product_color ?>">
        <label for="" class="form-label"><strong>Tên:</strong></label>
        <input type="text" name="txtTen" class="form-control" value="<?php echo $item->product_name ?>">
    </div>
    <div class="form-group">
        <label for="" class="form-label"><strong>Mô tả:</strong></label>
        <input type="text" name="txtMoTa" class="form-control" value="<?php echo $item->product_description ?>">
    </div>
    <div class="form-group">
        <label for="txtPrice" class="form-label"><strong>Giá:</strong></label>
        <input type="number" name="txtprice" class="form-control" value="<?php echo $item->product_price ?>">
    </div>
    <div class="form-group">
        <label for="txtDiscount" class="form-label"><strong>Giảm giá:</strong></label>
        <input type="number" name="txtdiscount" class="form-control" value="<?php echo $item->product_discount ?>">
    </div>
    <div class="form-group">
        <label class="form-label"><strong>Màu sắc:</strong></label>
        <input type="text" name="txtcolor" class="form-control" value="<?php echo $item->product_color ?>">
    </div>
    <div class="form-group">
        <label for="image" class="form-label"><strong>Hình ảnh:</strong></label>
        <div id="imageInputs-<?php echo $item->product_id . $item->product_color ?>">
            <!-- Hiển thị input type file và button thêm hình ảnh -->
            <input type="file" class="inputImage" name="image[]" class="form-control mt-2">
            <button type="button" class="btn btn-primary mt-2 btnUpload">Thêm hình ảnh</button>
        </div>
        <!-- Hiển thị các ảnh đã có -->
        <input type="hidden" name="imgArr" id="imgArr" value="<?php echo  $item->product_image ?>">

        <div id="upload-box">
            <?php foreach (explode('|', $item->product_image) as $image) : ?>

                <img src="../shop/image/product/<?php echo $image ?>" alt="<?php echo $image ?>" width="100px" class="mt-2">

            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="txtSize" class="form-label"><strong>Kích cỡ:</strong></label>
        <input type="text" name="txtsize" class="form-control" value="<?php echo $item->product_size ?>">
    </div>
    <div class="form-group">
        <label for="">Loại sản phẩm</label>
        <select name="product_type" class="form-control">
            <?php foreach ($product_types as $type) : ?>
                <option value="<?php echo $type->product_type_id; ?>" <?php echo ($type->product_type_id == $item->product_type_id) ? 'selected' : ''; ?>><?php echo $type->product_type_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary" name="btnSubmit">Cập nhật</button>
        <button type="submit" class="btn btn-primary" name="btnAdd">Thêm kiểu</button>
    </div>
    <div class="text-danger text-center">
        <?php if ($tb != NULL) echo $tb; ?>
    </div>
</form>

<script>
    var uploadButtons = document.getElementsByClassName('btnUpload');
    for (var i = 0; i < uploadButtons.length; i++) {
        uploadButtons[i].addEventListener('click', function() {
            var fileInput = this.previousElementSibling; // Lấy phần tử input trước button được nhấn
            var file = fileInput.files[0];
            console.log(file);
            var formData = new FormData();
            formData.append('image', file);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'uploadfile.php', true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var uploadBox = document.getElementById("upload-box");
                    var img = document.createElement("img");
                    img.src = "../shop/image/product/" + xhr.responseText;
                    img.alt = "Uploaded Image";
                    img.width = "100";
                    img.classList.add("mt-2");
                    uploadBox.appendChild(img);
                    addImageUrl(xhr.responseText);
                }
            };

            xhr.onerror = function() {

            };

            xhr.send(formData);
        });
    }

    function addImageUrl(newUrl) {
        var imgArrInput = document.getElementById('imgArr');
        var currentUrls = imgArrInput.value.split('|');
        currentUrls.push(newUrl);
        var newImageUrlString = currentUrls.join('|');
        imgArrInput.value = newImageUrlString;
    }
</script>

<?php require_once('footer.php'); ?>