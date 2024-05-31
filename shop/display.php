<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/icon.png" type="image/x-icon" />
    <title>Thời Trang</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <script src="data/database.js"></script>
    <script src="js/shared.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .td_display
        {
            width: 250px; text-align: center
        }

        .td_a_display
        {
            text-decoration: none; margin-right: 10px; font-weight: bold
        }
    </style>
</head>

<body>

    <?php

        include "library/layout.php";
        include "library/main.php";
        include "library/helper.php";
        include "library/pager.php";

        $connection = connectDatabase();

        $type = isset($_REQUEST["type"]) ? $_REQUEST["type"] : -1;
        $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;

        addHeader();
        addFormSign();

    ?>

    <section class="products" style="margin-top: 110px">
        <h1 class="heading"><span>Sản Phẩm </span>Danh Mục</h1>
        <table class="filter-buttons table" style="width: 100%%">
            <?php

                $query = "select * from tbl_product_type";
                $statement = $connection->prepare($query);
                $statement->execute();

                $male = [];
                $female = [];
                $accessory = [];

                while($item = $statement->fetch())
                {
                    if($item["product_category"] == "Nam") $male[] = $item;
                    else if ($item["product_category"] == "Nữ") $female[] = $item;
                    else $accessory[] = $item;
                }

                $largest = (sizeof($male) > sizeof($female) ? sizeof($male) : sizeof($female)) > sizeof($accessory) ? (sizeof($male) > sizeof($female) ? sizeof($male) : sizeof($female)) : sizeof($accessory);

                ?><tr><td colspan="<?php echo $largest + 1?>" style="text-align: center;"><a style="text-decoration: none; font-weight: bold;" href="display.php?type=-1" class="buttons">Tất Cả</a></td></tr><?php
                ?><tr><td class="td_display"><a href="display.php?type=-2" class="buttons td_a_display">Đồ Nam</a></td><?php
                renderType($male, $largest);
                ?></tr><tr><td class="td_display"><a href="display.php?type=-3" class="buttons td_a_display">Đồ Nữ</a></td><?php
                renderType($female, $largest);
                ?></tr><tr><td class="td_display"><a href="display.php?type=-4" class="buttons td_a_display">Phụ Kiện</a></td><?php
                renderType($accessory, $largest);

            ?>
            </tr>
        </table>
        <section class="container" style="margin-top: -50px">
            <?php

                if($type == -1) $query = "select p.product_id, product_name, product_price, product_discount, product_rating, product_image from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id group by p.product_id";
                else if($type == -2) $query = "select p.product_id, product_name, product_price, product_discount, product_rating, product_image from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id inner join tbl_product_type pt on p.product_type_id = pt.product_type_id where product_category = 'Nam' group by p.product_id;";
                else if($type == -3) $query = "select p.product_id, product_name, product_price, product_discount, product_rating, product_image from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id inner join tbl_product_type pt on p.product_type_id = pt.product_type_id where product_category = 'Nữ' group by p.product_id;";
                else if($type == -4) $query = "select p.product_id, product_name, product_price, product_discount, product_rating, product_image from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id inner join tbl_product_type pt on p.product_type_id = pt.product_type_id where product_category = 'Phụ Kiện' group by p.product_id;";
                else $query = "select p.product_id, product_name, product_price, product_discount, product_rating, product_image from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id where product_type_id = $type group by p.product_id";

                $statement = $connection->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();

                $limit = 8;
                $start = findStart($limit);
                $page_number = findPageNumber(count($result), $limit);
                $result = array_slice($result, $start, $limit);

                foreach($result as $item)
                {
                    ?>

                        <div class="col-md-auto box">
                            <div class="icons">  
                                <a href="javascript:void(0)" class="fas fa-shopping-cart"></a>
                                <a href="javascript:void(0)" class="fas fa-heart"></a>
                                <a href="details.php?id=<?php echo $item["product_id"] ?>" class="fas fa-eye"></a>
                            </div>
                            <div class="image"><img src="image/product/<?php echo explode('|', $item["product_image"])[0] ?>" alt="<?php echo explode('|', $item["product_image"])[0] ?>"></div>
                            <div class="content">
                                <h3 class="title-name"><a href=""><?php echo $item["product_name"] ?></a></h3>
                                <?php echo generatePrice("box-price", $item["product_price"], $item["product_discount"]) ?>
                                <?php echo generateRating($item["product_rating"]) ?>
                            </div>
                        </div>

                    <?php
                }

            ?>
        </section>
        <div class="break-page">
            <?php printPageList($page, $page_number, $type); ?>
        </div>
    </section>

    <?php

        addFooter();

    ?>

</body>