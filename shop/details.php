<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Thời Trang</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/details.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../data/database.js"></script>
    <script src="../js/shared.js"></script>
    <script src="../js/details.js"></script>

</head>

<body>

    <?php 

        include "library/layout.php";
        include "library/helper.php";

        $connection = connectDatabase();
        
        $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;

        $query = "select * from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id where p.product_id = $id";
        $statement = $connection->prepare($query);
        $statement->execute();
        $all = $statement->fetchAll();
        $product = $all[0];

        if(isset($_REQUEST["color"]))
        {
            $color = $_REQUEST["color"];

            $query = "select product_image from tbl_product_style where product_id = $id and product_color = '$color'";
            $statement = $connection->prepare($query);
            $statement->execute();

            $item = $statement->fetch();
            $image = isset($_REQUEST["image"]) ? $_REQUEST["image"] : explode("|", $item["product_image"])[0];
        }
        else
        {
            $color = $product["product_color"];
            $image = isset($_REQUEST["image"]) ? $_REQUEST["image"] : explode("|", $product["product_image"])[0];
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

                            foreach($image_array as $image_item)
                            {
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
                    <form action="" method="post" class="product-details-right">
                        <h1 class="title-product"><?php echo $product["product_name"] ?></h1>
                        <?php echo generatePrice("price", $product["product_price"], $product["product_discount"]) ?>
                        <?php echo generateRating($product["product_rating"]) ?><br>    
                        <div class="color" style="font-size: 24px;">
                            <div style="margin-right: 20px">Chọn Màu Sắc:</div>
                            <?php
                                foreach($all as $item)
                                {
                                    ?><input type="hidden" name="color" value="<?php echo $color?>"><?php
                                    if($item["product_color"] == $color) echo generateColor(true, $id, $item["product_color"]);
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

                                foreach($size_array as $size_item)
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
                            <div style="font-size: 16px; text-transform: none"><?php echo showLineBreak($product["product_description"]) ?></div>
                        </div><br>
                        <div class="button_actions">
                            <button type="submit" class="btn btn_base btn_add_cart btn-cart add_to_cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span style="margin-left: 30px" class="text_1">Thêm Vào Giỏ Hàng</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php

        addContact();

        addFooter();

    ?>

</body>