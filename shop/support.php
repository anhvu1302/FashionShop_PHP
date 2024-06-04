<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Thời Trang</title>

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/checkout.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php

    session_start();

    include "library/layout.php";
    include "library/helper.php";

    $connection = connectDatabase();

    addHeader();
    addFormSign();
    $token = $_SESSION['user']['user_token'];
    ?>

    <section class="product-list-in-cart" style="font-size: 17px;">
        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-5" style="background-color: #f1f1f1; height: 100vh; border-right:1px solid #ccc;">
                    <input type="hidden" name="login_user_id" id="login_user_id" value="1">

                    <input type="hidden" name="is_active_chat" id="is_active_chat" value="Yes">

                    <div class="mt-3 mb-3 text-center">
                        <img src="https://ui-avatars.com/api/?name=V" class="img-fluid rounded-circle img-thumbnail" width="150">
                        <h3 class="mt-2"><?php echo $_SESSION['user']['customer_name'] ?></h3>
                    </div>
                    <div class="list-group" style=" max-height: 100vh; margin-bottom: 10px; overflow-y:scroll; -webkit-overflow-scrolling: touch;">
                    </div>
                </div>

                <div class="col-lg-9 col-md-8 col-sm-7">
                    <br>
                    <h3 class="text-center">Hỗ trợ khách hàng 24/7</h3>
                    <hr>
                    <br>
                    <div id="chat_area">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <b>Chat with <span class="text-danger" id="chat_user_name">Chăm sóc khách hàng</span></b>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="messages_area" style="height: 75vh;overflow-y: auto;">

                            </div>
                        </div>

                        <form id="chat_form" method="POST" data-parsley-errors-container="#validation_error" novalidate="">
                            <div class="input-group mb-3" style="height:7vh">
                                <textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" data-parsley-maxlength="1000" required="" style="font-size: 18px;text-transform: none;"></textarea>
                                <div class="input-group-append">
                                    <button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                            <div id="validation_error"></div>
                            <br>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php

    addFooter();

    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var receiver_userid = '';

            var conn = new WebSocket('ws://localhost:8080?token=<?php echo $token; ?>');
            conn.onopen = function(event) {
                console.log('Connection Established');
            };

            conn.onmessage = function(event) {
                var data = JSON.parse(event.data);
                if (data.userId == <?php echo $_SESSION['user']['account_id'] ?>) {
                    var row_class = '';
                    var background_class = '';
                    var user_name = '';
                    if (!data.employeeId) {
                        row_class = 'row justify-content-end';

                        background_class = 'alert-primary';

                        user_name = 'Me';
                    } else {
                        row_class = 'row justify-content-start';

                        background_class = 'alert-success';

                        user_name = "Chăm sóc khách hàng";
                    }
                    var html_data = `
                <div class="` + row_class + `">
                    <div class="col-sm-10">
                        <div class="shadow-sm alert ` + background_class + `">
                            <b>` + user_name + ` - </b>` + data.msg + `<br />
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

            function fetchChat(customerId) {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        action: 'fetch_chat',
                        customer_id: customerId,
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
                                    row_class = 'row justify-content-end';

                                    background_class = 'alert-primary';

                                    user_name = 'Me';
                                } else {
                                    row_class = 'row justify-content-start';

                                    background_class = 'alert-success';

                                    user_name = "Chăm sóc khách hàng";
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

                            $('#userid_' + receiver_userid).html('');

                            $('#messages_area').html(html_data);

                            $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);
                        }
                    }
                })

            }
            fetchChat(<?php echo $_SESSION['user']['account_id'] ?>)
            $(document).on('submit', '#chat_form', function(event) {
                event.preventDefault();

                if ($('#chat_form').parsley().isValid()) {
                    var user_id = parseInt(<?php echo $_SESSION['user']['account_id'] ?>);

                    var message = $('#chat_message').val();

                    var data = {
                        userId: user_id,
                        msg: message,
                        employeeId: null,
                        command: 'private'
                    };
                    conn.send(JSON.stringify(data));
                }

            });
        })
    </script>
</body>

</html>