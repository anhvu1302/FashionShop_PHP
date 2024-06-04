<?php require_once('header.php'); ?>
<?php
$token = $_SESSION['user']['user_token'];
?>
<div class="container-fluid">

    <div class="row">

        <div class="col-lg-3 col-md-4 col-sm-5" style="background-color: #f1f1f1; border-right:1px solid #ccc;">
            <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" />

            <input type="hidden" name="is_active_chat" id="is_active_chat" value="No" />

            <div class="mt-3 mb-3 text-center">
                <img src="https://ui-avatars.com/api/?name=V" class="img-fluid rounded-circle img-thumbnail" width="150">
                <h3 class="mt-2"><?php echo $_SESSION['user']['customer_name'] ?></h3>
            </div>

            <?php
            $query = "SELECT 
            a.account_id,
            customer_name, 
            (SELECT COUNT(*) 
             FROM tbl_chat_message 
             WHERE customer_id = a.account_id 
               AND status = 'No') AS count_status 
          FROM tbl_account a 
          JOIN tbl_account_details ad ON a.account_id = ad.account_id 
          WHERE account_type = 'user'";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $user_data = $statement->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="list-group" style=" max-height: 100vh; margin-bottom: 10px; overflow-y:scroll; -webkit-overflow-scrolling: touch;">
                <?php

                foreach ($user_data as $user) {
                    $countStatus = intval($user['count_status']);
                    if ($countStatus > 0) {
                        $total_unread_message = '<span class="badge badge-danger badge-pill text-danger">' . $countStatus . '</span>';
                    } else {
                        $total_unread_message = '';
                    }

                    echo "
                        <a class='list-group-item list-group-item-action select_user' style='cursor:pointer' data-userid = '" . $user['account_id'] . "'>
                            <img src='https://ui-avatars.com/api/?name=" . $user["customer_name"] . "' class='img-fluid rounded-circle img-thumbnail' width='50' />
                            <span class='ml-1'>
                                <strong>
                                    <span id='list_user_name_" . $user["account_id"] . "'>" . $user['customer_name'] . "</span>
                                    <span id='userid_" . $user['account_id'] . "'>" . $total_unread_message . "</span>
                                </strong>
                            </span>
                            <span class='mt-2 float-right' id='userstatus_" . $user['account_id'] . "'></span>
                        </a>
                        ";
                }


                ?>
            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-7">
            <br />
            <h3 class="text-center">Hỗ trợ khách hàng 24/7</h3>
            <hr />
            <br />
            <div id="chat_area"></div>
        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var employeeId = <?php echo $_SESSION['user']['account_id'] ?>;

        var conn = new WebSocket('ws://localhost:8080?token=<?php echo $token; ?>');
        conn.onopen = function(event) {
            console.log('Connection Established');
        };

        conn.onmessage = function(event) {
            var data = JSON.parse(event.data);

            var messagesArea = $('#messages_area');
            if (messagesArea.length) {
                var row_class = '';
                var background_class = '';

                if (data.employeeId) {
                    row_class = 'row justify-content-end';

                    background_class = 'alert-success';

                    user_name = 'NV: <?php echo $_SESSION['user']['customer_name'] ?>';
                } else {
                    row_class = 'row justify-content-start';

                    background_class = 'alert-primary';

                    user_name = "Chăm sóc khách hàng";
                }
                var html_data = `
                <div class="` + row_class + `">
                    <div class="col-sm-10">
                        <div class="shadow-sm alert ` + background_class + `">
                            <b>` + data.from + ` - </b>` + data.msg + `<br />
                            <div class="text-right">
                                <small><i>` + formatDate(new Date()) + `</i></small>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                $('#messages_area').append(html_data);

                $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

                $('#chat_message').val("");

            }

        };

        conn.onclose = function(event) {
            console.log('connection close');
        };

        function formatDate(date) {
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            let hours = String(date.getHours()).padStart(2, '0');
            let minutes = String(date.getMinutes()).padStart(2, '0');
            let seconds = String(date.getSeconds()).padStart(2, '0');

            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }

        function make_chat_area(customerId, customerName) {
            var html = `
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col col-sm-6">
							<b>Chat with <span class="text-danger" id="chat_user_name">` + customerName + `</span></b>
							<b style="display:none;" id="customerId">` + customerId + `</b>
						</div>
						<div class="col col-sm-6 text-right">
							
						</div>
					</div>
				</div>
				<div class="card-body" id="messages_area" style="height: 75vh;overflow-y: auto;">

				</div>
			</div>

			<form id="chat_form" method="POST" data-parsley-errors-container="#validation_error">
				<div class="input-group mb-3" style="height:7vh">
					<textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" data-parsley-maxlength="1000" required></textarea>
					<div class="input-group-append">
						<button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
				<div id="validation_error"></div>
				<br />
			</form>
			`;

            $('#chat_area').html(html);

            $('#chat_form').parsley();
        }

        $(document).on('click', '.select_user', function() {

            customerId = $(this).data('userid');

            var from_user_id = $('#login_user_id').val();

            var customerName = $('#list_user_name_' + customerId).text();

            $('.select_user.active').removeClass('active');

            $(this).addClass('active');

            make_chat_area(customerId, customerName);

            $('#is_active_chat').val('Yes');
            fetchChat(customerId, customerName, 'admin');

        });

        function fetchChat(customerId, customerName, role) {

            $.ajax({
                url: "../shop/action.php",
                method: "POST",
                data: {
                    action: 'fetch_chat',
                    customer_id: customerId,
                    role: role
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.length > 0) {
                        var html_data = '';

                        for (var count = 0; count < data.length; count++) {
                            var row_class = '';
                            var background_class = '';
                            var user_name = '';

                            if (!data[count].employee_id) {
                                row_class = 'row justify-content-start';

                                background_class = 'alert-primary';

                                user_name = customerName;
                            } else {
                                row_class = 'row justify-content-end';

                                background_class = 'alert-success';

                                user_name = "NV: " + data[count].customer_name;
                            }

                            html_data += `
            <div class="` + row_class + `">
                <div class="col-sm-10">
                    <div class="shadow alert ` + background_class + `">
                        <b>` + user_name + ` - </b>
                        ` + data[count].chat_message + `<br />
                        <div class="text-right">
                            <small><i>` + data[count].timestamp + `</i></small>
                        </div>
                    </div>
                </div>
            </div>
            `;
                        }

                        $('#userid_' + employeeId).html('');

                        $('#messages_area').html(html_data);

                        $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);
                    }
                }
            })

        }

        $(document).on('submit', '#chat_form', function(event) {

            event.preventDefault();

            if ($('#chat_form').parsley().isValid()) {
                var customerId = $('#customerId').text();
                var message = $('#chat_message').val();

                var data = {
                    userId: customerId,
                    msg: message,
                    employeeId: employeeId,
                    command: 'private'
                };
                conn.send(JSON.stringify(data));
            }

        });

    })
</script>
<?php require_once('footer.php'); ?>