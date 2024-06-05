<?php require_once('header.php');
if (isset($_REQUEST["accept_id"])) {
    $query = "UPDATE tbl_invoice SET note = 'Đã xác nhận' WHERE invoice_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_REQUEST["accept_id"]]);
}
?>

<div class="activity">
    <div class="title">
        <i class="fa-solid fa-boxes-packing" style="height: 38px;width: 38px;"></i>
        <span class="text">Danh sách đơn hàng</span>
    </div>
    <div class="activity-data">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td colspan="7">
                        <form action="" method="get">
                            <select class="form-select" name="type">
                                <option value="orderId">Tìm theo mã đơn</option>
                                <option value="customerId">Tìm theo mã khách hàng</option>
                            </select>
                            <input class="form-control" type="text" placeholder="Tìm kiếm..." name="value" required>
                            <button class="btn btn-light" type="submit">
                                <i class="fa-solid fa-magnifying-glass" style="color: #3557ff;"></i>
                                Tìm kiếm
                            </button>
                        </form>
                    </td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Số điện thoại</th>
                    <th>Thời gian đặt hàng</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái đơn</th>
                    <th>Tình trạng đơn</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $searchType = isset($_GET['type']) ? $_GET['type'] : '';
                $searchValue = isset($_GET['value']) ? $_GET['value'] : '';

                $query = "SELECT * FROM tbl_invoice";

                if (!empty($searchValue)) {
                    if ($searchType === 'orderId') {
                        $query .= " WHERE invoice_id = ?";
                    } elseif ($searchType === 'customerId') {
                        $query .= " WHERE customer_id = ?";
                    }
                }

                $query .= " ORDER BY date DESC;";

                $statement = $pdo->prepare($query);

                if (!empty($searchValue)) {
                    $statement->execute([$searchValue]);
                } else {
                    $statement->execute();
                }
                $orders = $statement->fetchAll();
                // $query = "SELECT * FROM tbl_invoice ORDER BY date DESC;";
                // $statement = $pdo->prepare($query);
                // $statement->execute();
                // $orders = $statement->fetchAll();
                foreach ($orders as $order) {

                ?>
                    <tr>
                        <td><?php echo $order['invoice_id'] ?></td>
                        <td><?php echo $order['customer_id'] ?></td>
                        <td><?php echo number_format($order['total'], 0, ',', '.') ?>VNĐ</td>
                        <td>0<?php echo $order['phone'] ?></td>
                        <td><?php echo date("H:i:s d/m/Y", strtotime($order['date'])); ?></td>
                        <td><?php echo $order['payment_method'] ?></td>
                        <td>
                            <span class="<?php
                                            if ($order['note'] == "Đã thanh toán") {
                                                echo 'text-success';
                                            }
                                            ?>"><?php echo $order['note'] ?></span>

                        </td>
                        <td>
                            <?php
                            if ($order['cancelled'] == "Yes") {
                                echo '<span class="badge text-bg-danger">Đã hủy</span>';
                            } else {
                                echo '<span class="badge text-bg-info">Tồn tại</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <div class="d-flex flex-row gap-2">
                                <a href="?accept_id=<?php echo $order['invoice_id'] ?>" class="btn btn-success">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                                <button class="btn btn-success view-order" data-bs-toggle="modal" data-bs-target="#exampleModal" data-invoice-id="<?php echo $order['invoice_id']; ?>">
                                    <i class="fa-light fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailModalLabel">Thông tin đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <fieldset disabled>
                                <div class="mb-3 row justify-content-center align-items-center">
                                    <label for="invoice_id" class="form-label col-5">Mã đơn hàng:</label>
                                    <div class="col-7">
                                        <input type="text" id="invoice_id" name="invoice_id" class="form-control w-100">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset disabled>
                                <div class="mb-3 row justify-content-center align-items-center">
                                    <label for="customer_id" class="form-label col-4">Khách hàng:</label>
                                    <div class="col-8">
                                        <input type="text" id="customer_id" name="customer_id" class="form-control w-100">
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <fieldset disabled>
                                <div class="mb-3 row justify-content-center align-items-center">
                                    <label for="total" class="form-label col-5">Tổng tiền:</label>
                                    <div class="col-7">
                                        <input type="text" id="total" name="total" class="form-control w-100">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset disabled>
                                <div class="mb-3 row justify-content-center align-items-center">
                                    <label for="date" class="form-label col-4">Thời gian đặt hàng:</label>
                                    <div class="col-8">
                                        <input type="datetime" id="date" name="date" class="form-control w-100">
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 row justify-content-center align-items-center">
                                <label for="note" class="form-label col-5">Ghi chú:</label>
                                <div class="col-7">
                                    <select id="note" name="note" class="form-select w-100">
                                        <option value="Đã xác nhận">Đã xác nhận</option>
                                        <option value="Chờ thanh toán">Chờ thanh toán</option>
                                        <option value="Đã thanh toán">Đã thanh toán</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 row justify-content-center align-items-center">
                                <label for="payment_method" class="form-label col-4">Thanh toán:</label>
                                <div class="col-8">
                                    <select id="payment_method" name="payment_method" class="form-select w-100">
                                        <option value="COD">COD</option>
                                        <option value="VNPAY">VNPAY</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 row justify-content-center align-items-center">
                                <label for="cancelled" class="form-label col-5">Trạng thái đơn hàng:</label>
                                <div class="col-7">
                                    <select id="cancelled" name="cancelled" class="form-select w-100">
                                        <option value="Yes">Đã hủy</option>
                                        <option value="No">Tồn tại</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 row justify-content-center align-items-center">
                                <label for="phone" class="form-label col-4">Số điện thoại:</label>
                                <div class="col-8">
                                    <input type="text" id="phone" name="phone" class="form-control w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 row justify-content-center align-items-center">
                                <label for="address" class="form-label col-3">Địa chỉ:</label>
                                <div class="col-9">
                                    <textarea id="address" name="address" class="form-control w-100"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <h3>Danh sách sản phẩm</h3>
                <div id="order-details">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Phụ kiện</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng </th>
                                <th>Đơn giá </th>
                                <th>Thành tiền </th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateOrder()">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".view-order").click(function() {
            var invoiceId = $(this).data("invoice-id");
            $.ajax({
                type: "GET",
                url: "get_order_details.php",
                data: {
                    invoice_id: invoiceId
                },
                dataType: "json",
                success: function(response) {
                    $("#invoice_id").val(response.invoice_id);
                    $("#customer_id").val(response.customer_id);
                    $("#total").val(response.total.toLocaleString() + " đ");
                    $("#date").val(response.date);
                    $("#note").val(response.note);
                    $("#payment_method").val(response.payment_method);
                    $("#cancelled").val(response.cancelled);
                    $("#phone").val("0" + response.phone);
                    $("#address").val(response.address);

                    document.getElementById("order-details").innerHTML = `
                        <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng </th>
                                <th>Đơn giá </th>
                                <th>Thành tiền </th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body">
                            ${response.orderDetails.map(
                                (detail) => `
                                <tr>
                                    <td>${detail.product_id}</td>
                                    <td class="text-start td-img">
                                        <a class="text-black text-decoration-none" href="../shop/details.php?id=${
                                        detail.product_id
                                        }"  data-bs-toggle="tooltip"
                                            title="${detail.product_name}"
                                            target="_blank">
                                            ${detail.product_name}
                                        </a>
                                    </td>
                                    <td>
                                        <div style="width: 120px; height: 160px;">
                                            <img class="w-100 h-100" id="product-image"
                                                src="../shop/image/product/${detail.product_image.split("|")[0]}"
                                                alt="${detail.product_image.split("|")[0]}">
                                        </div>
                                    </td>
                                    <td>${detail.quantity}</td>
                                    <td style="text-wrap: nowrap;">${
                                    detail.price.toLocaleString() + " đ"
                                    }</td>
                                    <td style="text-wrap: nowrap;">${
                                    (detail.price * detail.quantity).toLocaleString() + " đ"
                                    }</td>
                                </tr>`
                            )}
                        </tbody>
                    </table>`;
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function updateOrder() {
        const invoice_id = $("#invoice_id").val();
        const note = $("#note").val();
        const payment_method = $("#payment_method").val();
        const cancelled = $("#cancelled").val();
        const phone = $("#phone").val();
        const address = $("#address").val();

        // Tạo đối tượng chứa dữ liệu
        const data = {
            invoice_id,
            note,
            payment_method,
            cancelled,
            phone,
            address
        };
        console.log(data)
        fetch('update-order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<?php require_once('footer.php'); ?>