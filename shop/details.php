<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Thời Trang</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/details.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>

    <?php

    session_start();

    include "library/layout.php";
    include "library/helper.php";

    $connection = connectDatabase();

    $user = isset($_SESSION["user"]) ? $_SESSION["user"] : [];

    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;

    $query = "select * from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id where p.product_id = $id";
    $statement = $connection->prepare($query);
    $statement->execute();
    $all = $statement->fetchAll();
    $product = $all[0];

    if (isset($_REQUEST["color"])) {
        $color = $_REQUEST["color"];

        $query = "select product_image from tbl_product_style where product_id = $id and product_color = '$color'";
        $statement = $connection->prepare($query);
        $statement->execute();

        $item = $statement->fetch();
        $image = isset($_REQUEST["image"]) ? $_REQUEST["image"] : explode("|", $item["product_image"])[0];
    } else {
        $color = $product["product_color"];
        $image = isset($_REQUEST["image"]) ? $_REQUEST["image"] : explode("|", $product["product_image"])[0];
    }

    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

    if (isset($_REQUEST["insert"])) {
        $query = "select * from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id where p.product_id = $id and ps.product_color = '$color'";
        $statement = $connection->prepare($query);
        $statement->execute();

        $fetch = $statement->fetch();

        $flag = false;
        for ($index = 0; $index < sizeof($cart); $index = $index + 1) {
            if ($cart[$index][0] == $id && $cart[$index][3] == $color) {
                $flag = true;
                $cart[$index][4] = $_REQUEST["size"];
                $cart[$index][5] = $_REQUEST["quantity"] + $cart[$index][5];
                $cart[$index][7] = $cart[$index][5] * $cart[$index][6];
                break;
            }
        }

        if (!$flag) {
            $new_item = [$id, $fetch["product_name"], $image, $color, $_REQUEST["size"], $_REQUEST["quantity"], $fetch["product_price"], $fetch["product_price"] * $_REQUEST["quantity"]];
            $cart[] = $new_item;
        }
    }

    $_SESSION["cart"] = $cart;
    $_SESSION["tquantity"] = sizeof($_SESSION["cart"]);
    $_SESSION["tprice"] = 0;
    foreach ($cart as $stuff) {
        $_SESSION["tprice"] = $stuff[7] + $_SESSION["tprice"];
    }

    addHeader();
    addFormSign();

    ?>

    <section class="products" id="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="product-details-left">
                        <?php

                        $query = "select product_image from tbl_product_style where product_id = $id and product_color = '$color'";
                        $statement = $connection->prepare($query);
                        $statement->execute();

                        $item = $statement->fetch();
                        $image_array = explode("|", $item["product_image"]);

                        ?>

                        <div class="product-image-container">
                            <img src="image/product/<?php echo $image ?>" alt="<?php echo $image ?>">
                        </div>
                        <div class="list-product-image-compact">

                            <?php

                            foreach ($image_array as $image_item) {
                            ?>

                                <div class="product-image-compact">
                                    <a href="details.php?id=<?php echo $id ?>&color=<?php echo $color ?>&image=<?php echo $image_item ?>">
                                        <img src="image/product/<?php echo $image_item ?>" alt="<?php echo $image_item ?>">
                                    </a>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <form action="details.php?id=<?php echo $id ?>&color=<?php echo $color ?>" method="post" class="product-details-right">
                        <h1 class="title-product"><?php echo $product["product_name"] ?></h1>
                        <?php echo generatePrice("price", $product["product_price"], $product["product_discount"]) ?>
                        <?php

                            $cquery = "select * from tbl_comment where product_id=$id";
                            $cstatement = $connection->prepare($cquery);
                            $cstatement->execute();
                            $cll = $cstatement->fetchAll();

                        ?>
                        <?php echo generateRating($product["product_rating"], true, sizeof($cll)) ?><br>
                        <div class="color" style="font-size: 24px;">
                            <div style="margin-right: 20px">Chọn Màu Sắc:</div>
                            <?php
                                foreach ($all as $item) 
                                {
                                    ?><input type="hidden" name="color" value="<?php echo $color ?>"><?php
                                    if ($item["product_color"] == $color) echo generateColor(true, $id, $item["product_color"]);
                                    else echo generateColor(false, $id, $item["product_color"]);
                                }
                            ?>
                        </div><br>
                        <div class="size" style="font-size: 24px;">
                            <div style="margin-right: 20px">Chọn Kích Thước:</div>
                            <?php

                                $query = "select product_size from tbl_product_style where product_id = $id and product_color = '$color'";
                                $statement = $connection->prepare($query);
                                $statement->execute();

                                $item = $statement->fetch();
                                $size_array = explode("|", $item["product_size"]);

                                ?><select name="size" style="background-color: #F3F2F2; padding-right: 10px"><?php

                                foreach ($size_array as $size_item) 
                                {
                                    ?><option value="<?php echo $size_item ?>"><?php echo $size_item ?></option><?php
                                }
                            ?>
                            </select>
                        </div><br>
                        <div class="quantity" style="font-size: 24px;">
                            <div style="margin-right: 20px">Số Lượng:</div>
                            <input style="border: 1px solid black; width: 5%" type="number" name="quantity" min="1" required>
                        </div><br>
                        <div class="description">
                            <div style="font-size: 24px;">Thông Tin Sản Phẩm:</div>
                            <div style="font-size: 16px; text-transform: none; margin-top: 5px"><?php echo showLineBreak($product["product_description"]) ?></div>
                        </div><br>
                        <div class="button_actions">
                            <button type="submit" name="insert" class="btn btn_base btn_add_cart btn-cart add_to_cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span style="margin-left: 30px;" class="text_1">Thêm Vào Giỏ Hàng</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row">
                <h2 class="heading">Đánh Giá Sản Phẩm</h2>
                <?php 

                    if(isset($_REQUEST["new_comment"]))
                    {
                        $comment = $_REQUEST["comment"];
                        $rating = $_REQUEST["rating"];
                        $account_id = $user["account_id"];

                        $query = "select * from tbl_comment where product_id=$id";
                        $statement = $connection->prepare($query);
                        $statement->execute();

                        $exists = false;

                        while($scan = $statement->fetch())
                        {
                            if($scan["account_id"] == $account_id)
                            {
                                $exists = true;
                                break;
                            }
                        }

                        if(!$exists)
                        {
                            $query = "insert into tbl_comment (customer_id, product_id, rating, comment) values(?, ?, ?, ?)";
                            $statement = $connection->prepare($query);
                            $statement->bindParam(1, $account_id);
                            $statement->bindParam(2, $id);
                            $statement->bindParam(3, $rating);
                            $statement->bindParam(4, $comment);
    
                            $statement->execute();
                        }
                    }

                    if(sizeof($user) != 0)
                    {
                        $account_id = $user["account_id"];
                        $bought = false;
                        $query = "select product_id from tbl_invoice i inner join tbl_invoice_details id on i.invoice_id = id.invoice_id where customer_id=$account_id";
                        $statement = $connection->prepare($query);
                        $statement->execute();

                        while($scan = $statement->fetch())
                        {
                            if($scan["product_id"] == $id) 
                            {
                                $bought = true;
                                $break;
                            }
                        }

                        if($bought)
                        {
                            ?>
                                <div class="comment_container">
                                    <form action="details.php?" method="post" class="comment_form">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <div class="comment_label">Comment</div>
                                        <textarea class="comment_box" name="comment" id=""></textarea>
                                        <div style="display: flex; flex-direction: row; align-items: center;">
                                            <span class="comment_label" style="margin-right: 10px">Rating</span>
                                            <span class="star-rating">
                                                <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">★</label>
                                                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">★</label>
                                                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">★</label>
                                                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">★</label>
                                                <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">★</label>
                                            </span>
                                        </div>  
                                        <input type="submit" name="new_comment" value="Comment" class="btn"> <br>
                                    </form>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?><h2 class="heading" style="font-size: 20px">Mua Sản Phẩm Để Đánh Giá</h2><?php
                        }
                    }
                    else
                    {
                        ?><h2 class="heading" style="font-size: 20px">Đăng Nhập Để Đánh Giá</h2><?php
                    }

                ?>

            </div>
            <br><br>
            <div class="row">
                <h2 class="heading">Danh Sách Đánh Giá</h2>
                <div class="comment_list_conatiner">

                    <?php

                        $query = "select * from tbl_comment inner join tbl_account a on customer_id = account_id inner join tbl_account_details ad on a.account_id = ad.account_id where product_id=$id";
                        $statement = $connection->prepare($query);
                        $statement->execute();
                        $all = $statement->fetchAll();

                        foreach($all as $item)
                        {
                            ?>

                                <div class="comment_list">
                                    <div class="comment_label" style="text-align: center; color: #EB4D4B"><?php echo $item["customer_name"] ?></div>
                                    <div class="comment_label">Comment</div>
                                    <div class="comment_box" style="border: none"><?php echo $item["comment"] ?></div><br>
                                    <div style="display: flex; flex-direction: row; align-items: center;">
                                        <span class="comment_label" style="margin-right: 10px">Rating</span>
                                        <span style="color: #FFD700; font-size: 2rem"><?php echo generateRating($item["rating"], false, sizeof($all)) ?></span>
                                    </div>
                                </div>
                                

                            <?php
                        }

                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php

    addContact();

    addFooter();

    ?>
    <script src="js/main.js"></script>
</body>