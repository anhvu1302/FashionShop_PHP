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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <?php

    session_start();

    // unset($_SESSION["cart"]);
    // unset($_SESSION["tquantity"]);
    // unset($_SESSION["tprice"]);
    // unset($_SESSION["user"]);

    include "library/layout.php";
    include "library/main.php";
    include "library/helper.php";

    $connection = connectDatabase();

    addHeader();
    addSlideShow();
    addBanner();

    ?>

    <section class="products">
        <h1 class="heading"><span>Sản Phẩm </span>Nổi Bật</h1>
        <div class="container" style="margin-top: -50px">
            <?php

            $query = "SELECT p.*, MIN(product_color)as product_color,MIN(product_image) as product_image,MIN(product_size) as product_size
            FROM tbl_product p
            INNER JOIN  tbl_product_style
            ps ON p.product_id = ps.product_id
            WHERE p.product_rating >= 4
            GROUP BY p.product_id;
            ";
            $statement = $connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $result = array_slice($result, 0, 8);

            foreach ($result as $item) 
            {
            ?>

                <div class="col-md-auto box">
                    <div class="icons">
                        <a href="details.php?id=<?php echo $item["product_id"] ?>" class="fas fa-shopping-cart"></a>
                        <a href="" class="fas fa-heart"></a>
                        <a href="details.php?id=<?php echo $item["product_id"] ?>" class="fas fa-eye"></a>
                    </div>
                    <div class="image"><img src="image/product/<?php echo explode('|', $item["product_image"])[0] ?>" alt="<?php echo explode('|', $item["product_image"])[0] ?>"></div>
                    <div class="content">
                        <h3 class="title-name"><a href=""><?php echo $item["product_name"] ?></a></h3>
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
    </section>

    <?php

    addDeal();
    addContact();
    addFooter();

    ?>
    <script src="js/main.js"></script>
</body>

</html>