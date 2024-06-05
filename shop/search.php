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
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="shop/css/search.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php 

        session_start();

        include "library/layout.php";
        include "library/main.php";
        include "library/helper.php";
        include "library/pager.php";

        $connection = connectDatabase();

        $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
        $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;

        addHeader();


    ?>

    <section class="products" style="margin-top: 110px" id="products">
        <h2 class="heading">Kết quả tìm kiếm cho từ khóa: <strong><?php echo $search ?></strong></h2>
            <?php

                $query = "select p.*, MIN(product_color)as product_color,MIN(product_image) as product_image,MIN(product_size) as product_size from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id where product_name like '%$search%' group by p.product_id";

                $statement = $connection->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();

                if(sizeof($result) == 0)
                {
                    ?><h2 class="heading" style="font-size: 20px">Không Có Sản Phẩm Nào</h2><?php
                }
                else
                {
                    ?><h2 class="heading" style="font-size: 20px">Số Lượng Sản Phẩm Tìm Thấy Là: <strong style="color: red"><?php echo sizeof($result) ?></strong></h2><?php
                }

                ?><div class="container" style="margin-top: -50px"><?php

                $limit = 8;
                $start = findStart($limit);
                $page_number = findPageNumber(count($result), $limit);
                $result = array_slice($result, $start, $limit);

                foreach($result as $item)
                {
                    ?>

                        <div class="col-md-auto box">
                            <div class="icons">  
                                <a href="cart.php" class="fas fa-shopping-cart"></a>
                                <a href="" class="fas fa-heart"></a>
                                <a href="details.php?id=<?php echo $item["product_id"] ?>" class="fas fa-eye"></a>
                            </div>
                            <div class="image"><img src="image/product/<?php echo explode('|', $item["product_image"])[0] ?>" alt="<?php echo explode('|', $item["product_image"])[0] ?>"></div>
                            <div class="content">
                            <h3 class="title-name"><span class="text-truncate d-block" title="<?php echo $item["product_name"] ?>" data-bs-toggle="tooltip"><?php echo $item["product_name"] ?></span></h3>
                                <?php echo generatePrice("box-price", $item["product_price"], $item["product_discount"]) ?>
                                <?php

                                    $cquery = "select * from tbl_comment where product_id=" . $item["product_id"];
                                    $cstatement = $connection->prepare($cquery);
                                    $cstatement->execute();
                                    $cll = $cstatement->fetchAll();

                                ?>
                                <?php echo generateRating($item["product_rating"], true, sizeof($cll)) ?>
                            </div>
                        </div>

                    <?php
                }

            ?>
        </div>
        <div class="break-page">
            <?php printPageListSearch($page, $page_number, $search); ?>
        </div>
    </section>

    <?php

        addFooter();

    ?>
    <script src="js/main.js"></script>
</body>