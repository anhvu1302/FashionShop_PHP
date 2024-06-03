<?php require_once('header.php'); ?>

<br>
<h1>Quản lý Khách hàng</h1>
<?php //danh sách khách hàng
$sql = "SELECT * FROM tbl_account A join tbl_account_details AD on A.account_id = AD.account_id where account_type='user'";
$sta = $pdo->prepare($sql);
$sta->execute();
if ($sta->rowCount() > 0) {
    $khach_hang = $sta->fetchAll((PDO::FETCH_OBJ));
} ?>
<?php
// Số lượng khách hàng mỗi trang
$per_page = 6;

// Trang hiện tại
$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page_number - 1) * $per_page;

// Tính tổng số khách hàng
$sql_total = "SELECT COUNT(*) as total FROM tbl_account A JOIN tbl_account_details AD ON A.account_id = AD.account_id WHERE account_type='user'";
$sta_total = $pdo->prepare($sql_total);
$sta_total->execute();
$total_customers = $sta_total->fetch(PDO::FETCH_OBJ)->total;

// Tính tổng số trang
$total_pages = ceil($total_customers / $per_page);

// Lấy dữ liệu khách hàng cho trang hiện tại
$sql = "SELECT * FROM tbl_account A JOIN tbl_account_details AD ON A.account_id = AD.account_id WHERE account_type='user' LIMIT :start, :per_page";
$sta = $pdo->prepare($sql);
$sta->bindParam(':start', $start, PDO::PARAM_INT);
$sta->bindParam(':per_page', $per_page, PDO::PARAM_INT);
$sta->execute();
if ($sta->rowCount() > 0) {
    $khach_hang = $sta->fetchAll(PDO::FETCH_OBJ);
}
?>
<button class="btn btn-primary"><a href="addcustomer.php" class="text-white text-decoration-none">ADD NEW</a></button>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Mã KH</th>
            <th>Tên KH</th>
            <th>Tên Tài Khoản</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Địa Chỉ</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <?php
    if (!empty($khach_hang)) {
        foreach ($khach_hang as $khach) {
    ?>
            <tr>
                <td><?php echo $khach->account_id ?></td>
                <td><?php echo $khach->customer_name ?></td>
                <td><?php echo $khach->username ?></td>
                <td><?php echo $khach->gender ?></td>
                <td><?php echo $khach->date_of_birth ?></td>
                <td><?php echo $khach->address ?></td>
                <td><?php echo $khach->phone ?></td>
                <td><?php echo $khach->email ?></td>

                <td>
                    <button class="btn btn-success" type="submit"> <a href="update_customer.php?mkh=<?php echo $khach->account_id ?>" class="text-white text-decoration-none"><i class="fa-light fa-pen-to-square"></i></a></button>

                    </button>
                    <button class="btn btn-danger delete-button" data-id="<?php echo $khach->account_id; ?>">
                        <i class="fa-light fa-xmark"></i>
                    </button>

                </td>

            </tr>
    <?php }
    } else {
        echo '<tr><td colspan="8">Không có khách hàng nào</td></tr>';
    }
    ?>
</table>
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
<?php require_once('footer.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Kiểm tra xem khách hàng có hóa đơn trong bảng invoice hay không
    $sql_check_invoice = "SELECT COUNT(*) as total FROM tbl_invoice WHERE customer_id = ':customer_id'";
    $sta_check_invoice = $pdo->prepare($sql_check_invoice);
    $sta_check_invoice->bindParam(':customer_id', $delete_id, PDO::PARAM_INT);
    $sta_check_invoice->execute();
    $invoice_count = $sta_check_invoice->fetch(PDO::FETCH_OBJ)->total;

    // Nếu có hóa đơn liên kết với khách hàng, không cho phép xóa và hiển thị thông báo
    if ($invoice_count > 0) {
        echo json_encode(['success' => false, 'message' => 'Khách hàng đã có đơn hàng và không thể xóa.']);
        exit;
    }

    // Xóa khách hàng từ bảng tbl_account
    $sql_delete_account = "DELETE FROM tbl_account WHERE account_id = ':account_id'";
    $sta_delete_account = $pdo->prepare($sql_delete_account);
    $sta_delete_account->bindParam(':account_id', $delete_id, PDO::PARAM_INT);

    // Xóa khách hàng từ bảng tbl_account_details
    $sql_delete_account_details = "DELETE FROM tbl_account_details WHERE account_id = ':account_id'";
    $sta_delete_account_details = $pdo->prepare($sql_delete_account_details);
    $sta_delete_account_details->bindParam(':account_id', $delete_id, PDO::PARAM_INT);


    // Thực thi xóa
    $pdo->beginTransaction();
    try {
        $sta_delete_account->execute();
        $sta_delete_account_details->execute();
        $pdo->commit();
        echo json_encode(['success' => true]);
        exit; // Dừng lại sau khi gửi phản hồi JSON
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false]);
        exit; // Dừng lại sau khi gửi phản hồi JSON
    }
}
?>
<script>
// Xử lý sự kiện click cho nút xóa
document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của form

        let delete_id = this.getAttribute('data-id');
        if (confirm('Bạn có chắc chắn muốn xóa?')) {
            // Gửi yêu cầu xóa bằng AJAX
            fetch('customer.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'delete_id=' + delete_id
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Xóa thành công, cập nhật giao diện ngay tại đây (vd: ẩn dòng)
                    this.closest('tr').remove();
                    alert('Đã xóa khách hàng thành công.');
                } else {
                    // Xóa không thành công, hiển thị thông báo lỗi
                    alert('Có lỗi xảy ra. Không thể xóa khách hàng.');
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
            });
        }
    });
});
</script>