<?php

function addHeader()
{

    $_SESSION["tquantity"] = isset($_SESSION["tquantity"]) ? $_SESSION["tquantity"] : 0;
    $_SESSION["tprice"] = isset($_SESSION["tprice"]) ? $_SESSION["tprice"] : 0;

    $connection = connectDatabase();

    $asearch = isset($_REQUEST["asearch"]) ? $_REQUEST["asearch"] : "";
    $acart = isset($_REQUEST["acart"]) ? $_REQUEST["acart"] : "none";

    $query = "select * from tbl_product_type";
    $statement = $connection->prepare($query);
    $statement->execute();

    $male = [];
    $female = [];
    $accessory = [];

    while ($item = $statement->fetch()) {
        if ($item["product_category"] == "Nam") $male[] = $item;
        else if ($item["product_category"] == "Nữ") $female[] = $item;
        else $accessory[] = $item;
    }

?>

    <header class="header">
        <a href="index.php" class="logo"> <i class="fas fa-shopping-cart"></i> shop </a>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Trang Chủ</a></li>
                <li>
                    <a href="display.php?type=-1">Sản Phẩm</a>
                    <ul>
                        <li>
                            <a href="display.php?type=-2">Đồ Nam</a>
                            <ul>
                                <?php
                                foreach ($male as $item) {
                                ?><li><a href="display.php?type=<?php echo $item["product_type_id"] ?>"><?php echo $item["product_type_name"] ?></a></li><?php
                                                                                                                                                        }
                                                                                                                                                            ?>
                            </ul>
                        </li>
                        <li>
                            <a href="display.php?type=-3">Đồ Nữ</a>
                            <ul>
                                <?php
                                foreach ($female as $item) {
                                ?><li><a href="display.php?type=<?php echo $item["product_type_id"] ?>"><?php echo $item["product_type_name"] ?></a></li><?php
                                                                                                                                                        }
                                                                                                                                                            ?>
                            </ul>
                        </li>
                        <li>
                            <a href="display.php?type=-4">Phụ Kiện</a>
                            <ul>
                                <?php
                                foreach ($accessory as $item) {
                                ?><li><a href="display.php?type=<?php echo $item["product_type_id"] ?>"><?php echo $item["product_type_name"] ?></a></li><?php
                                                                                                                                                        }
                                                                                                                                                            ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#featured">nổi bật</a></li>
                <li><a href="#review">đánh giá</a></li>
                <li><a href="#contact">liên hệ</a></li>
                <li><a href="#blogs">blogs</a></li>
            </ul>
        </nav>
        <div class="icons">
            <a href="" id="menu-btn" style="text-decoration: none" class="fas fa-bars"></a>
            <?php if (isset($_SESSION['user'])) : ?>
                <a id="user-btn" style="text-decoration: none" class="fas fa-user"><span>Y</span></a>
            <?php else : ?>
                <a href="./login.php" style="text-decoration: none" class="fas fa-user"></a>
            <?php endif; ?>
            <a href="<?php echo getSearchUrl($asearch) ?>" style="text-decoration: none" id="search-btn" class="fas fa-search"></a>
            <a href="<?php echo getCartUrl($acart) ?>" style="text-decoration: none" class="fas fa-shopping-cart"><span id="num-of-product-cart"><?php echo $_SESSION["tquantity"] ?></span></a>
            <a href="" style="text-decoration: none" class="fas fa-heart"><span id="num-of-product-heart">0</span></a>
        </div>
        <form action="search.php" method="put" class="search-form <?php echo $asearch ?>">
            <input type="search" name="search" placeholder="Tìm kiếm..." />
            <input type="submit" style="background-color: #EB4D4B; color: #ffffff" value="Tìm Kiếm" />
        </form>
        <div class="user-box" id="user-box" style="display:none;">
            <div class="user-details">
                <div class="image-user">
                    <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/avatarUser.jpg" alt="Avatar" class="avatar">
                </div>
                <div class="user-infor">
                    <h2 class="user-name"><?php echo $_SESSION['user']['customer_name'] ?></h2>
                    <p class="user-email"><?php echo $_SESSION['user']['email'] ?></p>
                </div>
            </div>
            <?php
            if (strtolower($_SESSION['user']['account_type']) == strtolower("admin")) {
            ?>
                <div class="logout-box">
                    <a class="logout-button" href="../admin">
                        <i class="fa-thin fa-solar-system"></i>
                        <span>Trang Quản Trị</span>
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="logout-box">
                <a class="logout-button" href="./support.php">
                    <i class="fa-brands fa-rocketchat"></i>
                    <span>Hỗ trợ khách hàng</span>
                </a>
            </div>
            <div class="logout-box">
                <a class="logout-button" href="./MyOrder.php">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Đơn hàng của tôi</span>
                </a>
            </div>
            <div class="logout-box">
                <a href="./logout.php" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </div>
        <ul class="product-cart-box" style="display: <?php echo $acart ?>;">
            <li>
                <h1 class="title-product-cart">Giỏ Hàng</h1>
            </li>
            <?php

            $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

            foreach ($cart as $item) {

            ?>

                <li>
                    <div class="image"><img src="image/product/<?php echo $item[2] ?>" alt="<?php echo $item[2] ?>"></div>
                    <div class="item-description">
                        <a href="details.php?id=<?php echo $item[0] ?>" class="title-name"><?php echo $item[1] ?></a>
                        <p class="title-amount">Số lượng: <span class="amount"><?php echo $item[5] ?></span></p>
                    </div>
                    <div class="right">
                        <p class="price"><?php echo number_format($item[7], 0, ',', '.') ?></p>
                        <p>VNĐ</p>
                    </div>
                </li>

            <?php
            }
            ?>
            <li><span class="total">Tổng: <strong><?php echo number_format($_SESSION["tprice"], 0, ',', '.') ?> VNĐ</strong></span><a href="cart.php" style="text-decoration: none" class="checkout btn" id="checkout-btn">CheckOut</a></li>
        </ul>
        <ul class="product-heart-box" style="display: none;">
            <li>
                <h1 class="title-product-heart">Sản Phẩm Yêu Thích</h1>
            </li>
        </ul>
    </header>

<?php
}

function addFormSign()
{
?>

    <div class="account">
        <div class="close-btn">&times;</div>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form id="sign-up-form" action="#">
                    <h1>Tạo tài khoản</h1>
                    <input type="text" id="signup-name-input" placeholder="Họ tên">
                    <input type="text" id="signup-username-input" placeholder="Tên đăng nhập">
                    <input type="email" id="signup-email-input" placeholder="Email">
                    <input type="password" id="signup-password-input" placeholder="Mật khẩu">
                    <input type="password" id="signup-repassword-input" placeholder="Nhập lại mật khẩu">
                    <button type="submit">Đăng ký</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="#" id="login-form">
                    <h1>Đăng nhập</h1>
                    <span>Sử dụng tài khoản của bạn</span>
                    <input type="text" placeholder="Tên Đăng nhập" id="username-input">
                    <input type="password" placeholder="Mật khẩu" id="password-input">
                    <a href="#">Quên mật khẩu?</a>
                    <button type="submit">Đăng nhập</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Chào mừng trở lại!</h1>
                        <p>Để tiếp tục kết nối với chúng tôi, vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                        <button class="ghost" id="signIn">Đăng nhập</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Xin chào, bạn!</h1>
                        <p>Nhập thông tin cá nhân của bạn và bắt đầu cuộc hành trình cùng chúng tôi</p>
                        <button class="ghost" id="signUp">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}

function addSlideShow()
{
?>

    <section class="home" id="home">
        <div id="demo" class="carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/banner1.jpg" alt="Los Angeles" class="d-block" style="width: 100%">
                    <div class="carousel-caption caption-left">
                        <span>Giảm 50%</span>
                        <h3>Thời Trang Nữ</h3>
                        <a href="#" class="btn">Mua Ngay</a>
                    </div>
                </div>
                <div class="carousel-item active">
                    <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/banner2.jpg" alt="Chicago" class="d-block" style="width: 100%">
                    <div class="carousel-caption caption-left">
                        <span>Giảm 50%</span>
                        <h3>Thời Trang Nam</h3>
                        <a href="#" class="btn">Mua Ngay</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/banner3.jpg" alt="New York" class="d-block" style="width: 100%">
                    <div class="carousel-caption caption-left">
                        <span>Giảm 40%</span>
                        <h3>Phụ Kiện</h3>
                        <a href="#" class="btn">Mua Ngay</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

<?php
}

function addBanner()
{
?>

    <section class="banner-container">
        <div class="container">
            <div class="col-md">
                <div class="banner">
                    <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/shop_banner_img1.jpg" alt="" />
                    <div class="content">
                        <span>Ưu đãi đặc biệt</span>
                        <h3>Giảm giá lên đến 50%</h3>
                        <a href="#" class="btn">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="banner">
                    <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/shop_banner_img2.jpg" alt="" />
                    <div class="content">
                        <span>Ưu đãi đặc biệt</span>
                        <h3>Giảm giá lên đến 50%</h3>
                        <a href="#" class="btn">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
}

function addDeal()
{
?>

    <section class="deal">
        <div class="image">
            <img src="https://raw.githubusercontent.com/anhvu13/fashion.github.io/main/tranding_img.png" alt="" />
        </div>

        <div class="content">
            <span>mùa mới đang hot!</span>
            <h3>bộ sưu tập mùa hè tốt nhất</h3>
            <p>giảm giá lên đến 50%</p>
            <a href="#" class="btn">mua ngay</a>
        </div>
    </section>

<?php
}

function addContact()
{
?>

    <section class="contact" id="contact">
        <h1 class="heading"><span>Liên hệ</span> với chúng tôi</h1>
        <div class="container">
            <div class="col-md">
                <div class="icons">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>address</h3>
                    <p>17 Lê Duẩn, Phường Bến Nghé, Quận 1, TP. Hồ Chí Minh</p>
                </div>
            </div>
            <div class="col-md">
                <div class="icons">
                    <i class="fas fa-envelope"></i>
                    <h3>email</h3>
                    <p>contactUs@gmail.com</p>
                    <p>fashionShop@gmail.com</p>
                </div>
            </div>
            <div class="col-md">
                <div class="icons">
                    <i class="fas fa-phone"></i>
                    <h3>phone</h3>
                    <p>+123-456-7890</p>
                    <p>+111-222-3333</p>
                </div>
            </div>
        </div>
        <div class="container contact-form">
            <div class="col-md">
                <form id="feedbackForm">
                    <h3>Phản Hồi</h3>
                    <div class="row">
                        <div class="col">
                            <input id="phoneNumber" type="text" placeholder="Số điện thoại của bạn">
                        </div>
                        <div class="col">
                            <input id="issue" type="text" placeholder="Vấn Đề">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <textarea id="feedback" placeholder="Nội dung phản hồi của bạn" cols="30" rows="10"></textarea>
                            <input type="submit" value="Gửi Phản Hồi" class="btn">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d501726.4604617804!2d106.41502662042029!3d10.754666392389565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529292e8d3dd1%3A0xf15f5aad773c112b!2sHo%20Chi%20Minh%20City%2C%20Vietnam!5e0!3m2!1sen!2sin!4v1678547723395!5m2!1sen!2sin" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

<?php
}

function addFooter()
{

?>

    <section class="footer">
        <div class="container">
            <div class="col-md box">
                <h3>Giới thiệu</h3>
                <p>Chào mừng bạn đến với trang web thời trang của chúng tôi! Chúng tôi là một nhóm các chuyên gia thời
                    trang và kinh doanh trực tuyến, cung cấp cho bạn những sản phẩm thời trang chất lượng cao với giá cả
                    hợp lý.</p>
            </div>


            <div class="col-md box">
                <h3>category</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> Đồ Nam </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> Đồ Nữ </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> Đồ Phụ Kiện </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> Bán chạy nhất </a>
            </div>


            <div class="col-md box">
                <h3>quick links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> trang chủ </a>
                <a href="#products"> <i class="fas fa-arrow-right"></i> sản phẩm </a>
                <a href="#featured"> <i class="fas fa-arrow-right"></i> nổi bật </a>
                <a href="#review"> <i class="fas fa-arrow-right"></i> đánh giá </a>
                <a href="#blogs"> <i class="fas fa-arrow-right"></i> liên hệ </a>
            </div>


            <div class="col-md box">
                <h3>extra links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> đơn hàng </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> tài khoản </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> danh sách </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> mua ngay </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> ưu đãi mới </a>
            </div>

        </div>

        <div class="share">
            <a href="https://www.facebook.com/Van.Anh.130203/" class="fab fa-facebook-f"></a>
            <a href="https://github.com/anhvu13" class="fab fa-twitter"></a>
            <a href="https://www.pinterest.com/vuvananh010203/" class="fab fa-pinterest"></a>
            <a href="#" class="fab fa-github"></a>
            <a href="https://www.instagram.com/vananhvu1302/" class="fab fa-instagram"></a>
        </div>

        <div class="credit">
            &copy; copyright @ 2023 by <span>Vũ Văn Anh</span>
        </div>
    </section>

<?php
}
?>