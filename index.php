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
    <link rel="stylesheet" href="shop/css/style.css" />

    <script src="data/database.js"></script>
    <script src="js/shared.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <?php

        include "shop/library/layout.php";
        include "shop/library/main.php";
        include "shop/library/connect.php";

        $connection = connectDatabase();

        addHeader();

        addFormSign();

        addSlideShow();

        addBanner();

    ?>

    <section class="products" id="products">
        <h1 class="heading"><span>Sản Phẩm</span>Đặc Biệt</h1>
        <div class="container" id="product-list">
        <?php

            $query = "select * from tbl_product";
            $statement = $connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $result = array_slice($result, 0, 5);

            foreach($result as $item)
            {
                
            }

        ?>
        </div>
        <div class="break-page">
        </div>
    </section>


    <?php

        addDeal();

        addContact();

        addFooter();
    ?>

</body>