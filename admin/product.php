<?php require_once('header.php');

// Phân trang
$per_page = 4; // Số lượng sản phẩm mỗi trang
$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page_number - 1) * $per_page;

// Tính tổng số sản phẩm
$sql_total = "SELECT COUNT(*) as total FROM tbl_product p
JOIN tbl_product_style ps ON p.product_id = ps.product_id";
$sta_total = $pdo->prepare($sql_total);
$sta_total->execute();
$total_products = $sta_total->fetch(PDO::FETCH_OBJ)->total;

// Tính tổng số trang
$total_pages = ceil($total_products / $per_page);

// Lấy dữ liệu sản phẩm cho trang hiện tại
$sql = "SELECT p.*, ps.product_color, ps.product_image, ps.product_size 
        FROM tbl_product p
        JOIN tbl_product_style ps ON p.product_id = ps.product_id
        LIMIT :start, :per_page";
$sta = $pdo->prepare($sql);
$sta->bindParam(':start', $start, PDO::PARAM_INT);
$sta->bindParam(':per_page', $per_page, PDO::PARAM_INT);
$sta->execute();
if ($sta->rowCount() > 0) {
    $products = $sta->fetchAll(PDO::FETCH_OBJ);
} else {
    $products = [];
}

// Load select option
$sql = "SELECT * FROM tbl_product_type";
$sta = $pdo->prepare($sql);
$sta->execute();
$product_types = $sta->fetchAll(PDO::FETCH_OBJ);

$tb = "";

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
<?php
//Tìm kiếm sản phẩm 
$search_type = isset($_GET["searchType"]) ? $_GET["searchType"] : null;
$search_input = isset($_GET["searchInput"]) ? $_GET["searchInput"] : null;

if ($search_type === "name" && $search_input) {
    $search_input = '%' . $search_input . '%';
    $query = "SELECT p.*, ps.product_color, ps.product_image, ps.product_size 
              FROM tbl_product p
              JOIN tbl_product_style ps ON p.product_id = ps.product_id 
              WHERE product_name LIKE ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$search_input]);
} elseif ($search_type === "color" && $search_input) {
    $search_input = '%' . $search_input . '%';
    $query = "SELECT p.*, ps.product_color, ps.product_image, ps.product_size 
              FROM tbl_product p
              JOIN tbl_product_style ps ON p.product_id = ps.product_id
              WHERE ps.product_color LIKE ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$search_input]);
} else {
    $query = "SELECT p.*, ps.product_color, ps.product_image, ps.product_size 
              FROM tbl_product p
              JOIN tbl_product_style ps ON p.product_id = ps.product_id
              LIMIT :start, :per_page";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $stmt->execute();
}

if ($stmt->rowCount() > 0) {
    $products = $stmt->fetchAll(PDO::FETCH_OBJ);
} else {
    $products = [];
}
?>
<h1>Quản lý sản phẩm</h1>
<button class="btn btn-primary"><a href="addproduct.php" class="text-white text-decoration-none">ADD NEW</a></button>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td colspan="8">
                <form method="get">
                    <select class="form-select" name="searchType" id="searchType">
                        <option value="name">Tìm theo tên sản phẩm</option>
                        <option value="color">Tìm theo màu</option>
                    </select>
                    <input class="form-control" type="text" placeholder="Tìm kiếm..." id="searchInput" name="searchInput" value="<?php echo isset($_GET['searchInput']) ? $_GET['searchInput'] : ''; ?>">
                    <button class="btn btn-light" type="submit">
                        <i class="fa-thin fa-magnifying-glass" style="color: #3557ff;"></i>
                        Tìm kiếm</button>
                </form>
            </td>

        </tr>

    </thead>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Mô tả</th>
        <th>Giá</th>
        <th>Giảm giá</th>
        <th>Điểm đánh giá</th>
        <th>Hình ảnh</th>
        <th>Màu</th>
        <th>Size</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($products as $item) : ?>
        <tr>
            <td><?php echo $item->product_name ?></td>
            <td><?php echo $item->product_description ?></td>
            <td><?php echo $item->product_price ?></td>
            <td><?php echo $item->product_discount ?></td>
            <td><?php echo $item->product_rating ?></td>
            <td><img src="../shop/image/product/<?php echo explode('|', $item->product_image)[0] ?>" alt="<?php echo explode('|', $item->product_image)[0] ?>" width="60px"></td>
            <td><?php echo $item->product_color ?></td>
            <td><?php echo $item->product_size ?></td>
            <td style="width: 80px;">
                <button class="btn btn-light"> 
                    <a href="update_product.php?id=<?php echo $item->product_id ?>&color=<?php echo $item->product_color?>"> <i class="fa-light fa-pen-to-square text-decoration-none"></i></a>
               
                </button>
                <form action="product.php" method="post" class="d-inline">
                    <input type="hidden" name="delete_id" value="<?php echo $item->product_id ?>">
                    <input type="hidden" name="product_color" value="<?php echo $item->product_color ?>">
                    <button type="submit" class="btn danger"><i class="fa-light fa-xmark"></i></button>
                </form>

            </td>
        </tr>
    <?php endforeach; ?>
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Chi tiết sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">

                <div class="mb-3">
                    <label for="">Loại sản phẩm</label>
                    <select id="productTypeSelect" name="product_type" class="form-control">
                        <?php foreach ($product_types as $type) : ?>
                        <option value="<?php echo $type->product_type_id; ?>"><?php echo $type->product_type_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                </div>
            </div>
        </div>
    </div>

</table>
<!-- Phân trang -->
<div class="pagination justify-content-end pe-5">
    <span class="step-links">
        <?php if ($page_number > 1) : ?>
            <a href="?page=1">&laquo; First</a>
            <a href="?page=<?php echo $page_number - 1; ?>">Previous</a>
        <?php endif; ?>
        <span class="current">
            Page <?php echo $page_number; ?> of <?php echo $total_pages; ?>.
        </span>
        <?php if ($page_number < $total_pages) : ?>
            <a href="?page=<?php echo $page_number + 1; ?>">Next</a>
            <a href="?page=<?php echo $total_pages; ?>">Last &raquo;</a>
        <?php endif; ?>
    </span>
</div>
<?php
// Xử lý yêu cầu xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $product_color = $_POST['product_color'];
    // Kiểm tra xem sản phẩm có tồn tại trong bảng tbl_invoice_details hay không
    $sql_check = "SELECT * FROM tbl_invoice_details WHERE product_id = ?";
    $sta_check = $pdo->prepare($sql_check);
    $sta_check->execute([$delete_id]);

    // Nếu sản phẩm đã tồn tại trong tbl_invoice_details, không cho phép xóa
    if ($sta_check->rowCount() > 0) {
        // Thông báo cho người dùng rằng sản phẩm đã được sử dụng trong đơn đặt hàng và không thể xóa
        echo "Sản phẩm đã được sử dụng trong đơn đặt hàng và không thể xóa.";
        exit(); // Dừng việc thực thi mã tiếp theo
    }
    // Xóa sản phẩm và thông tin liên quan từ cơ sở dữ liệu
    $sql_delete_style = "DELETE FROM tbl_product_style WHERE product_id = ? AND product_color = ?";
    $sta_delete_style = $pdo->prepare($sql_delete_style);
    $sta_delete_style->execute([$delete_id, $product_color]);

    $sql_check = "SELECT * FROM tbl_product_style WHERE product_id = ?";
    $sta_check = $pdo->prepare($sql_check);
    $sta_check->execute([$delete_id]);
    if ($sta_check->rowCount() == 0) {
        $sql_delete_product = "DELETE FROM tbl_product WHERE product_id = ?";
        $sta_delete_product = $pdo->prepare($sql_delete_product);
        $sta_delete_product->execute([$delete_id]);
    }


    // Redirect lại đến trang sản phẩm sau khi xóa
    header("Location: product.php");
    exit();
} ?>
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
<script>
document.addEventListener("DOMContentLoaded", function() {

    function makeValidId(str) {
        return str.replace(/[^a-zA-Z0-9_-]/g, '_');
    }

    const productTypes = <?php echo json_encode($product_types); ?>;
    console.log(productTypes);

    const productTypeMap = {};
    <?php foreach ($product_types as $type) : ?>
    productTypeMap[<?php echo $type->product_type_id; ?>] = "<?php echo $type->product_type_name; ?>";
    <?php endforeach; ?>

    // Function để mở modal và render dữ liệu
    window.openDetailModal = function(item) {
        // Lấy modal body
        var modalBody = document.getElementById('modalBody');

        // Chuyển đổi các trường hợp có ký tự đặc biệt thành id hợp lệ
        var validProductColor = makeValidId(item.product_color);
        var validId = `${item.product_id}-${validProductColor}`;

        // Tạo nội dung của modal
        var modalContent = `
            <form action="" method="post" enctype="multipart/form-data" class="container-fluid">
                <input type="hidden" name="product_id" value="${item.product_id}">
                <input type="hidden" name="product_color" value="${item.product_color}">
                <div class="mb-3">
                    <label for="" class="form-label"><strong>Tên:</strong></label>
                    <input type="text" name="txtTen" class="form-control" value="${item.product_name}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label"><strong>Mô tả:</strong></label>
                    <input type="text" name="txtMoTa" class="form-control" value="${item.product_description}">
                </div>
                <div class="mb-3">
                    <label for="txtPrice" class="form-label"><strong>Giá:</strong></label>
                    <input type="number" name="txtprice" class="form-control" value="${item.product_price}">
                </div>
                <div class="mb-3">
                    <label for="txtDiscount" class="form-label"><strong>Giảm giá:</strong></label>
                    <input type="number" name="txtdiscount" class="form-control" value="${item.product_discount}">
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Màu sắc:</strong></label>
                    <input type="text" name="txtcolor" class="form-control" value="${item.product_color}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label"><strong>Hình ảnh:</strong></label>
                    <div id="imageInputs-${validId}">
                        <input type="file" class="inputImage" name="image[]" class="form-control mt-2">
                        <button type="button" class="btn btn-primary mt-2 btnUpload">Thêm hình ảnh</button>
                    </div>
                    <input type="hidden" name="imgArr" id="imgArr" value="${item.product_image}">
                    <div id="upload-box">
                        ${item.product_image.split('|').map(image => `<img src="../shop/image/product/${image}" alt="${image}" width="100px" class="mt-2">`).join('')}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="txtSize" class="form-label"><strong>Kích cỡ:</strong></label>
                    <input type="text" name="txtsize" class="form-control" value="${item.product_size}">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" name="btnSubmit">Cập nhật</button>
                    <button type="submit" class="btn btn-primary" name="btnAdd">Thêm kiểu</button>
                </div>
            </form>
        `;

        // Gán nội dung vào modal body
        modalBody.innerHTML = modalContent;

        // Thêm sự kiện cho nút "Thêm hình ảnh"
        document.querySelector(`#imageInputs-${validId} .btnUpload`).addEventListener('click', function() {
            let newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'image[]';
            newInput.className = 'form-control mt-2';
            document.querySelector(`#imageInputs-${validId}`).insertBefore(newInput, this);
        });

        // Hiển thị modal
        var modal = new bootstrap.Modal(document.getElementById('detailModal'));
        modal.show();
    }
});
</script>
<?php require_once('footer.php'); ?>