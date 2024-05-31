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
</head>

<body>

    <?php

        include "library/layout.php";
        include "library/main.php";
        include "library/helper.php";

        $connection = connectDatabase();

        addHeader();
        addFormSign();
        addSlideShow();
        addBanner();

    ?>

    <section class="products">
        <h1 class="heading"><span>Sản Phẩm </span>Nổi Bật</h1>
        <div class="container" style="margin-top: -50px">
        <?php

            $query = "select p.product_id, product_name, product_price, product_discount, product_rating, product_image from tbl_product p inner join tbl_product_style ps on p.product_id = ps.product_id where product_rating >= 4 group by p.product_id";
            $statement = $connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $result = array_slice($result, 0, 8);

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
        </div>
    </section>

    <?php

        addDeal();
        addContact();
        addFooter();

    ?>

</body>
