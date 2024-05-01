-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 05:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_fashionshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `account_type_id` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `username`, `password`, `account_type_id`) VALUES
(1, 'admin', 'admin@123', 'ad'),
(2, 'admin1', '123456', 'ad'),
(3, 'admin2', 'admin@123', 'ad'),
(4, 'customer1', '123456', 'kh'),
(5, 'customer2', '123456', 'kh'),
(6, 'customer3', 'thaian45', 'kh'),
(7, 'customer4', 'bichthuy14', 'kh'),
(8, 'customer5', 'myhuyen15', 'kh'),
(9, 'customer6', 'nhile21', 'kh'),
(10, 'customer7', 'thunguyen25', 'kh'),
(11, 'customer8', 'thaipham05', 'kh'),
(12, 'customer9', '123', 'kh'),
(13, 'customer10', 'lanle31', 'kh'),
(14, 'customer11', 'minhhieu17', 'kh'),
(15, 'customer12', 'ductran35', 'kh'),
(16, 'customer13', 'mainguyen15', 'kh'),
(17, 'customer14', 'thule21', 'kh'),
(18, 'customer15', 'vanhai16', 'kh'),
(19, 'customer16', 'trannhung21', 'kh'),
(20, 'customer17', 'hungle45', 'kh'),
(21, 'customer18', 'thitrinh21', 'kh'),
(22, 'customer19', 'vanthanh15', 'kh'),
(23, 'customer20', 'quynhtran31', 'kh'),
(24, 'customer21', 'loinguye35', 'kh'),
(25, 'customer22', 'thingoc25', 'kh'),
(26, 'customer23', 'namtran21', 'kh'),
(27, 'customer24', 'hongnguyen31', 'kh'),
(28, 'customer25', 'vanphuc1502', 'kh'),
(29, 'customer26', 'kimnguyen3010', 'kh'),
(30, 'customer27', 'thihuong15', 'kh'),
(31, 'customer28', 'tranphuong27', 'kh'),
(32, 'customer29', 'haiyen1506', 'kh'),
(33, 'customer30', 'thilinh12', 'kh'),
(34, 'customer31', 'thuydung0206', 'kh'),
(35, 'customer32', 'thanhhang31', 'kh'),
(36, 'customer33', 'nguyenha12', 'kh'),
(37, 'customer34', 'loantran17', 'kh'),
(38, 'customer35', 'phamngoc25', 'kh'),
(39, 'customer36', 'thaovy20', 'kh'),
(40, 'customer37', 'hongnhung01', 'kh'),
(41, 'customer38', 'thutrang24', 'kh'),
(42, 'customer39', 'dieulinh06', 'kh'),
(43, 'customer40', 'thanhtruc12', 'kh'),
(44, 'customer41', 'lananh10', 'kh'),
(45, 'customer42', 'bichngoc18', 'kh'),
(46, 'customer43', 'thanhhuong31', 'kh'),
(47, 'customer44', 'hoaithu35', 'kh'),
(48, 'customer45', 'mylinh07', 'kh');

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `account_id` int(4) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` char(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`account_id`, `customer_name`, `gender`, `date_of_birth`, `address`, `phone`, `email`) VALUES
(1, 'Vũ Văn Anh', 'Nam', '2003-02-13', 'Tây Thạnh, Tân Phú, Thành phố Hồ Chí Minh', '0393222222', 'fashionshop@gmail.com'),
(2, 'Hà Tri Thủy', 'Nam', '2003-01-17', 'Tân Sơn Nhì, Tân Phú, Thành phố Hồ Chí Minh', '0393222455', 'hatrithuy@gmail.com'),
(3, 'Nguyễn Bảo Long', 'Nam', '2003-04-24', 'Phường 7, Quận 5, Thành phố Hồ Chí Minh, Việt Nam', '0393555222', 'nguyenbaolong@gmail.com'),
(4, 'Vũ Văn Anh', 'Nam', '2003-02-13', 'Số 351A Hùng Vương, Phường An Sơn, Tam Kỳ, Quảng N', '0393123456', 'vuvananh@gmail.com'),
(5, 'Trần Thái An', 'Nam', '2003-04-13', 'Ấp 6A, Tam Bình, Vĩnh Long, Việt Nam', '093755621', 'thienhuonglogistics@gmail.com'),
(6, 'Lê Bích Thủy', 'Nữ', '2003-05-13', 'Hoà Tân, Châu Thành, Đồng Tháp, Việt Nam', '0979598491', 'customer3@gmail.com'),
(7, 'Trần Mỹ Huyền', 'Nữ', '2003-06-13', 'Mỹ Hoà, Thành phố Long Xuyên, An Giang, Việt Nam', '0979598492', 'vantaiduongviet@gmail.com'),
(8, 'Lê Ly Trang Nhi', 'Nam', '2003-07-13', 'ĐT745, Uyên Hưng, Tân Uyên, Bình Dương, Việt Nam', '0393888888', 'taynambacsg@gmail.com'),
(9, 'Nguyễn Thị Thu', 'Nữ', '2003-08-13', '26B Đường Võ Văn Tần, Phú Chánh, Tân Uyên, Bình Dư', '0393888889', 'vantaivohongphat@gmail.com'),
(10, 'Phạm Hồng Thái', 'Nam', '2003-09-13', 'Ấp Xóm Đồng, xã Thanh Phước, huyện Gò Dầu, Tây Nin', '0393123457', 'customer7@gmail.com'),
(11, 'Nguyễn Văn Tú', 'Nam', '2003-10-13', '19 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123458', 'customer8@gmail.com'),
(12, 'Lê Thị Lan', 'Nữ', '2003-11-13', '20 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123459', 'customer9@gmail.com'),
(13, 'Nguyễn Minh Hiếu', 'Nam', '2003-12-13', '98 Ng. Tất Tố,Phường 19, Bình Thạnh, Thành phố Hồ ', '0393123460', 'customer10@gmail.com'),
(14, 'Trần Văn Đức', 'Nam', '2003-05-14', '21 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123461', 'customer11@gmail.com'),
(15, 'Nguyễn Thị Mai', 'Nữ', '2003-05-21', '317 Quang Trung, Trần Hưng Đạo, Quảng Ngãi, Việt N', '0393123462', 'customer12@gmail.com'),
(16, 'Lê Thị Thu', 'Nữ', '2003-05-06', 'Thị trấn, Phong Nha, Sơn Trạch, Quảng Bình, Việt N', '0393123463', 'customer13@gmail.com'),
(17, 'Phạm Văn Hải', 'Nam', '2004-05-19', '118A Hữu Nghị, Nam Lý, Đồng Hới, Quảng Bình, Việt ', '0393123464', 'customer14@gmail.com'),
(18, 'Trần Thị Nhung', 'Nữ', '2004-05-05', 'Tịnh Châu, Sơn Tịnh, Quảng Ngãi, Việt Nam', '0393123465', 'customer15@gmail.com'),
(19, 'Lê Văn Hưng', 'Nam', '2003-06-21', '1026 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức, Thàn', '0393123466', 'customer16@gmail.com'),
(20, 'Nguyễn Thị Trinh', 'Nữ', '2003-04-09', '14 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123467', 'customer17@gmail.com'),
(21, 'Phạm Văn Thanh', 'Nam', '2003-07-19', 'Bàu Đưng, thôn Thuận Vinh, xã Thuận Đức Cuối đường', '0393123468', 'customer18@gmail.com'),
(22, 'Trần Thị Quỳnh', 'Nữ', '2003-05-31', '16 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123469', 'customer19@gmail.com'),
(23, 'Nguyễn Văn Lợi', 'Nam', '2003-04-22', '27 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ', '0393123470', 'customer20@gmail.com'),
(24, 'Phạm Thị Ngọc', 'Nữ', '2003-03-19', 'QL24B, Tịnh Sơn, Sơn Tịnh, Quảng Ngãi, Việt Nam', '0393123471', 'customer21@gmail.com'),
(25, 'Trần Văn Nam', 'Nam', '2003-05-04', '777 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ C', '0393123472', 'customer22@gmail.com'),
(26, 'Nguyễn Thị Hồng', 'Nữ', '2003-03-11', '664 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ C', '0393123473', 'customer23@gmail.com'),
(27, 'Lê Văn Phúc', 'Nam', '2003-05-16', 'Vinh Thanh, Phú Vang, Thừa Thiên Huế, Việt Nam', '0393123474', 'customer24@gmail.com'),
(28, 'Nguyễn Thị Kim', 'Nữ', '2003-05-24', 'Nghé Vang, Thừa Thiên Huế, Việt Nam', '0393123475', 'customer25@gmail.com'),
(29, 'Nguyễn Thị Hương', 'Nữ', '2005-05-05', '85 Duy Tân, An Phú, Tam Kỳ, Quảng Nam, Việt Nam', '0393123476', 'customer26@gmail.com'),
(30, 'Trần Thị Phương', 'Nữ', '1995-05-18', '6-8 Trần Thánh Tông, Phường Tân Thạnh, Tam Kỳ, Quả', '0393123477', 'customer27@gmail.com'),
(31, 'Lê Thị Hải Yến', 'Nữ', '1994-05-13', '81 Huyền Trân Công Chúa, Hoà Hải, Ngũ Hành Sơn, Đà', '0393123478', 'customer28@gmail.com'),
(32, 'Phạm Thị Trang', 'Nữ', '1995-05-19', 'K3/12 Hà Thị Thân, An Hải Tây, Sơn Trà, Đà Nẵng, V', '0393123479', 'customer29@gmail.com'),
(33, 'Nguyễn Thị Linh', 'Nữ', '1995-05-26', '270 Võ Nguyên Giáp, Bắc Mỹ Phú, Ngũ Hành Sơn, Đà N', '0393123480', 'customer30@gmail.com'),
(34, 'Trần Thị Thuỳ Dung', 'Nữ', '2000-05-20', 'Lô e, Đường số 7, khu công nghiệp, Liên Chiểu, Đà ', '0393123481', 'customer31@gmail.com'),
(35, 'Lê Thị Thanh Hằng', 'Nữ', '2001-05-10', '89 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123482', 'customer32@gmail.com'),
(36, 'Nguyễn Thị Hà', 'Nữ', '1997-05-15', '50 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123483', 'customer33@gmail.com'),
(37, 'Trần Thị Hồng Loan', 'Nữ', '1997-05-14', '43 Nguyễn Chí Thanh, Ba Đình, Thủ đô Hà Nội', '0393123484', 'customer34@gmail.com'),
(38, 'Phạm Thị Ánh Ngọc', 'Nữ', '2004-05-13', '27 Nguyễn Thái Sơn, Phường 7, Quận Gò Vấp, Thành p', '0393123485', 'customer35@gmail.com'),
(39, 'Nguyễn Thị Thảo Vy', 'Nữ', '1996-05-18', '20 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố ', '0393123486', 'customer36@gmail.com'),
(40, 'Trần Thị Hồng Nhung', 'Nữ', '1999-05-07', '100 Ng. Tất Tố,Phường 19, Bình Thạnh,Thành phố Hồ ', '0393123487', 'customer37@gmail.com'),
(41, 'Trần Thị Thu Trang', 'Nữ   ', '1999-05-14', '1210 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành ph', '0393123488', 'customer38@gmail.com'),
(42, 'Nguyễn Thị Diệu Linh', 'Nữ', '2004-05-13', '10 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố ', '0393123489', 'customer39@gmail.com'),
(43, 'Lê Thị Thanh Trúc', 'Nữ', '1994-05-28', '30 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ', '0393123490', 'customer40@gmail.com'),
(44, 'Phạm Thị Lan Anh', 'Nữ', '1994-05-11', '106 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức, Thành', '0393123491', 'customer41@gmail.com'),
(45, 'Trần Thị Bích Ngọc', 'Nữ', '1995-05-19', '98 Ng. Tất Tố,Phường 19, Bình Thạnh, Thành phố Hồ ', '0393123492', 'customer42@gmail.com'),
(46, 'Nguyễn Thị Thanh Hương', 'Nữ', '1994-05-12', '1026 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức,', '0393123493', 'customer43@gmail.com'),
(47, 'Lê Thị Hoài Thu', 'Nữ', '1999-05-14', '27 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ', '0393163493', 'customer44@gmail.com'),
(48, 'Phạm Thị Mỹ Linh', 'Nữ', '1996-03-06', '8 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố H', '0393123494', 'customer45@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `account_type_id` varchar(4) NOT NULL,
  `account_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `account_type_name`) VALUES
('ad', 'admin'),
('kh', 'Khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(4) NOT NULL,
  `customer_id` int(4) NOT NULL,
  `product_id` int(4) NOT NULL,
  `rating` int(4) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `customer_id`, `product_id`, `rating`, `comment`) VALUES
(1, 6, 1, 5, 'Chất lượng tốt. Sẽ tiếp tục ủng hộ'),
(2, 45, 6, 5, 'Giao hàng nhanh chóng. Rất hài lòng'),
(3, 4, 2, 5, 'Hình thức thanh toán đa dạng và tiện lợi'),
(4, 12, 3, 5, 'Sản phẩm chất lượng, giá cả hợp lý'),
(5, 45, 4, 5, 'Sản phẩm tốt đúng nhưng hình ảnh hơi mờ'),
(6, 45, 6, 5, 'Dịch vụ khách hàng tốt'),
(7, 6, 26, 5, 'Chất lượng tốt. Sẽ tiếp tục ủng hộ'),
(8, 12, 8, 4, 'Giao hàng không đúng thời gian'),
(9, 4, 10, 2, 'Sản phẩm không đạt yêu cầu'),
(10, 6, 2, 5, 'Nhân viên phục vụ rất nhiệt tình');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(4) NOT NULL,
  `customer_id` int(4) NOT NULL,
  `total` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `customer_id`, `total`, `date`, `note`, `address`, `phone`) VALUES
(1, 6, 0, '2024-04-01', 'Đã thanh toán', '12 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 393123456),
(2, 7, 0, '2024-03-21', 'Đã thanh toán', '98 Ng. Tất Tố,Phường 19, Bình Thạnh, Thành phố Hồ Chí Minh', 393755621),
(3, 8, 0, '2024-04-01', 'Chờ thanh toán', '1026 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức, Thành phố Hồ Chí Minh', 979598491),
(4, 45, 0, '2024-04-17', 'Đã thanh toán', '27 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ Chí Minh', 979951492),
(5, 4, 0, '2024-04-24', 'Chờ thanh toán', '12 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 393888888),
(6, 12, 0, '2024-04-24', 'Đã thanh toán', '8 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố Hồ Chí Minh', 979541478),
(7, 4, 0, '2024-04-24', 'Đã thanh toán', '12 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 393123456);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_id` int(4) NOT NULL,
  `product_id` int(4) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` bigint(10) NOT NULL,
  `commented` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_id`, `product_id`, `quantity`, `price`, `commented`) VALUES
(1, 1, 2, 1319000, 1),
(1, 2, 1, 2199000, 1),
(1, 26, 1, 19460000, 1),
(2, 10, 10, 359000, 0),
(3, 3, 2, 359000, 0),
(3, 9, 1, 4100000, 0),
(4, 4, 2, 790000, 1),
(4, 6, 1, 19460000, 1),
(4, 7, 1, 749000, 1),
(5, 2, 2, 2199000, 0),
(5, 4, 1, 1144000, 0),
(5, 7, 1, 4100000, 0),
(6, 3, 2, 359000, 1),
(6, 8, 1, 1319000, 1),
(7, 2, 2, 2199000, 1),
(7, 3, 2, 359000, 0),
(7, 10, 2, 519000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(4) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(200) NOT NULL,
  `product_price` bigint(100) NOT NULL,
  `product_discount` int(100) NOT NULL,
  `product_rating` int(5) NOT NULL,
  `product_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`, `product_discount`, `product_rating`, `product_type_id`) VALUES
(1, 'Đầm ngắn 2 dây', 'Đầm ngắn 2 dây cup ngực sang trọng, gợi cảm\\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...\\nKích thước áo: S - M - L\\nChiều dài: S : 60,5 cm - M: 62 cm - L : 63,5 cm', 1319000, 20, 5, 9),
(2, 'Blazer nam trắng', 'Áo Blazer nam phom Premio phù hợp mọi dáng người\\nGam màu trung tính, lịch lãm tạo điểm nhấn nổi bật và thời thượng', 2199000, 30, 5, 3),
(3, 'Áo 2 dây xếp li', 'Áo 2 dây xếp li thời trang, nữ tính\\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...\\nKích thước áo: S - M - L\\nS : 38.7cm &#8226; M : 39.4cm &#8226; L : 40.1cm', 359000, 15, 5, 5),
(4, 'Sơ mi tay dài', 'Áo sơ mi dài tay phom Regular fit có độ suông rộng vừa đủ\\nThiết kế chỉn chu đến từng chi tiết với tà lượn, túi ngực.', 1144000, 15, 5, 1),
(5, 'Áo blazer oversize', 'Áo blazer oversize chất liệu Tweed thời trang\\nTrang phục phù hợp dạo phố, đi làm, đi tiệc....\\nKích thước áo: S - M - L\\nS: 67.5cm - M: 68.5cm - L: 69.5cm', 790000, 20, 0, 7),
(6, 'Áo polo nam', 'Áo polo chất liệu polyester pha cafe, cổ đức tay cộc, phom regular.', 524000, 5, 5, 1),
(7, 'Chân váy midi xẻ', 'Chân váy midi xẻ nữ tính\\nTrang phục phù hợp dạo phố, thường ngày...', 749000, 25, 5, 11),
(8, 'Air Jordan I High G', 'Giày thể thao\\nTrang phục phù hợp dạo phố, thường ngày,...\\nKích thước giày: 36 &#8594; 46', 4100000, 28, 4, 4),
(9, 'Váy lửng dáng xoè', 'Váy lửng dáng xoè nữ tính\\nTrang phục phù hợp dạo phố, thường ngày,đi tiệc...', 599000, 20, 0, 10),
(10, 'Mắt Kính Polygon', 'Mắt kính polygon Classic kim loại thời trang\\nThiết kế phù hợp phối với nhiều trang phục thời trang đa dạng\\nHộp kính tam giác da PU chống nước, nắp nam châm và kèm khăn lau kính', 519000, 30, 2, 14),
(11, 'Khoác blazer oversize sọc', 'Khoác blazer oversized phối denim cá tính\\nTrang phục phù hợp dạo phố, thường ngày,...', 1689000, 30, 0, 7),
(12, 'Đầm nhung 2 dây midi', 'Đầm nhung 2 dây midi thời trang, sang trọng\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...', 874000, 25, 0, 9),
(13, 'Đầm Thun Mini Tay Lở Dáng Xoè', 'Đầm thun mini tay lở dáng xoè thiết kế basic tôn dáng\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...', 588000, 10, 0, 9),
(14, 'Đầm Mini Tay Dài, Đắp Chéo Xếp Ly', 'Đầm Đầm mini tay dài, đắp chéo xếp ly thanh lịch, ôm eo tạo điểm nhấn\nTrang phục phù hợp dạo phố, thường ngày,đi tiệc, đi làm...', 682000, 25, 0, 9),
(15, 'Set Quần Short Áo Sơ Mi Oversize Tay Phồng', 'Áo sơ mi oversize tay phồng năng động, trẻ trung\nTrang phục phù hợp đi làm, thường ngày,...', 784000, 25, 0, 5),
(16, 'Đầm 2 dây dài buộc nơ vai', 'Đầm 2 dây dài buộc nơ vai.\\nTrẻ trung - Nữ tính.\\nTrang phục dạo phố.', 799000, 10, 0, 9),
(17, 'Đầm bút chì phối Organza', 'Đầm bút chì phối Organza.\\nThanh lịch - Hiện đại..\\nTrang phục phù hợp dạo phố, đi tiệc,...', 699000, 15, 0, 9),
(18, 'Áo Thun BabyTee Tay Ngắn In Hình', 'Áo thun BabyTee tay ngắn in hình trẻ trung, năng động.\\nTrang phục phù hợp dạo phố, thường ngày, đi học...', 399000, 30, 0, 5),
(19, 'Đầm Mini Phối Ren Cúp Ngực Tay Dài', 'Đầm mini phối ren cúp ngực tay dài thời trang, gợi cảm\\nTrang phục phù hợp dạo phố, đi tiệc,...', 599000, 17, 0, 9),
(20, 'Đầm lửng bẹt vai nhún tà', 'Đầm lửng bẹt vai nhún tà.\\nTrẻ trung - Nữ tính.', 699000, 15, 0, 9),
(21, 'Áo Vest Blazer Nam Tay Dài Trơn', 'Áo vest cũng mang đến một hình ảnh chỉnh chu, sang trọng và nam tính quyến rũ\\nTrang phục phù hợp lễ cưới, sự kiện, tham gia tiệc, đi làm, hẹn hò,... ', 1400000, 8, 0, 3),
(22, 'Áo Vest Blazer Nam Kẻ Sọc Dọc', 'Áo vest cũng mang đến một hình ảnh chỉnh chu, sang trọng và nam tính quyến rũ\\nTrang phục phù hợp môi trường làm việc công sở hoặc những buổi tiệc sang trọng,... ', 1340000, 10, 0, 3),
(23, 'Áo sơ mi dài tay dây rút', 'Áo sơ mi dài tay dây rút  sành điệu, hiện đại\\nTrang phục phù hợp dạo phố, thường ngày,đi chơi... ', 599000, 10, 0, 5),
(24, 'Áo Cropped Blazer', 'Áo Cropped Blazer cá tính\\nTrang phục phù hợp dạo phố, thường ngày,...', 599000, 0, 0, 5),
(25, 'Áo Parka Hai Mặt', 'Hai phong cách trong một chiếc áo.\\nÁo parka không thấm nước để bảo vệ chống lại các yếu tố thời tiết.', 980000, 20, 0, 1),
(26, 'Đồng hồ ORIENT Star 39.3 mm Nam', 'Đến từ hãng đồng hồ Orient, thương hiệu Nhật Bản nổi tiếng với nhiều chiếc đồng hồ thời thượng\\nĐồng hồ cơ tự động, bền bỉ, không cần dùng pin, lên dây cót bằng chuyển động của cổ tay\\nVới đường kính ', 19460000, 30, 5, 20),
(27, 'Đồng hồ CITIZEN Mechanical 42 mm Nam', 'Mẫu đồng hồ đến từ thương hiệu Citizen - một trong những thương hiệu nổi tiếng và uy tín đến từ Nhật Bản\\nĐồng hồ CITIZEN Mechanical 42 mm Nam NJ0080-50E sở hữu đường kính mặt 42 mm và độ rộng dây 18 ', 11185000, 20, 0, 20),
(28, 'Áo Sơ Mi Nam Oxford Tay Dài', 'Thiết kế đặc biệt với phần cổ trụ, áo vẫn giữ nguyên được nét trang nhã và tối giản nhưng không mang lại cảm giác tẻ nhạt.\\nForm dáng ôm vừa vặn, phần thân và tay áo suông, không ôm sẽ mang đến cảm gi', 569000, 6, 0, 1),
(29, 'Áo kiểu bẹt vai tay phồng', 'Miêu tả: ÁO BẸT VAI TAY PHỒNG.\\nĐặc tính: Trẻ trung - Nữ tính - Gợi cảm.\\nThể loại: Trang phục dạo phố, tiệc.', 499000, 10, 0, 5),
(30, 'Áo cúp ngang bẹt vai', 'Miêu tả: ÁO CÚP NGANG BẸT VAI.\\nĐặc tính: Hiện đại - Nữ tính.\\nThể loại: Trang phục tiệc, dạo phố. ', 499000, 10, 0, 5),
(31, 'Áo Kiểu Dây Yếm Cổ Tay Phồng', 'Miêu tả: ÁO KIỂU DÂY YẾM CỔ TAY PHỒNG.\\nĐặc tính: Nữ tính - Cá tính.\\nThể loại: Trang phục dạo phố.', 699000, 10, 0, 5),
(32, 'Áo kiểu tay lỡ cổ gấp nếp', 'Áo kiểu tay lỡ cổ gấp nếp nữ tính, sang trọng\\nTrang phục phù hợp dạo phố, thường ngày,đi làm...', 699000, 15, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_style`
--

CREATE TABLE `product_style` (
  `product_id` int(4) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_style`
--

INSERT INTO `product_style` (`product_id`, `product_color`, `product_image`, `product_size`) VALUES
(1, 'đen', 'product_img1_den.jpg|product_img1_compact1_den.jpg', 'M|L'),
(1, 'trắng', 'product_img1.jpg|product_img1_compact1.jpg|product', 'M|L'),
(2, 'trắng', 'product_img2.jpg|product_img2_compact1.jpg|product', 'S|M|L|XL|XXL'),
(2, 'xanh tím than', 'product_img2_xanhtimthan.jpg|product_img2_compact1', 'S|M|L|XL|XXL'),
(3, 'đỏ', 'product_img3_do.jpg|product_img3_compact1_do.jpg|p', 'S|M|L'),
(3, 'kem', 'product_img3.jpg|product_img3_compact1.jpg|product', 'S|M|L'),
(4, 'đen', 'product_img4.jpg|product_img4_compact1.jpg|product', '38|39|40|41|42|43'),
(5, 'be', 'product_img5.jpg|product_img5_compact1.jpg|product', 'M|L'),
(5, 'đen', 'product_img5_den.jpg|product_img5_compact1_den.jpg', 'M|L'),
(6, 'SB194', 'product_img6.jpg|product_img6_compact1.jpg|product', 'S|L|XL'),
(7, 'be', 'product_img7.jpg|product_img7_compact1.jpg|product', 'S|M|L'),
(7, 'den', 'product_img7_den.jpg|product_img7_compact1_den.jpg', 'S|M|L'),
(7, 'nau', 'product_img7_nau.jpg|product_img7_compact1_nau.jpg', 'S|M|L'),
(8, 'green', 'product_img8.jpg|product_img8_compact1.jpg|product', '36|37|38|39|40|41|42|43|44|45|46'),
(9, 'trangxam', 'product_img9.jpg|product_img9_compact1.jpg|product', 'M'),
(10, 'den', 'product_img10_den.jpg|product_img10_compact1_den.j', ' '),
(10, 'greyblue', 'product_img10.jpg|product_img10_compact1.jpg|produ', ' '),
(10, 'nau', 'product_img10_nau.jpg|product_img10_compact1_nau.j', ''),
(11, 'Caro đen', 'product_img11_den.jpg|product_img11_compact1_den.j', 'S|M|L'),
(11, 'Caro nâu', 'product_img11.jpg|product_img11_compact1.jpg', 'S|M|L'),
(12, 'đen', 'product_img12.jpg|product_img12_compact1.jpg|produ', 'S|M|L'),
(13, 'đen', 'product_img13_den.jpg|product_img13_compact1_den.j', 'S|M|L'),
(13, 'xanh', 'product_img13.jpg|product_img13_compact1.jpg|produ', 'S|M|L'),
(14, 'tim', 'product_img14.jpg|product_img14_compact1.jpg|produ', 'S|M|L'),
(15, 'trang', 'product_img15.jpg|product_img15_compact1.jpg| prod', 'F (Freesize)'),
(16, 'do', 'product_img16.jpg|product_img16_compact1.jpg|produ', 'S|M|L'),
(17, 'den', 'product_img17.jpg|product_img17_compact1.jpg|produ', 'S|M|L'),
(18, 'trang|den', 'product_img18.jpg|product_img18_compact1.jpg| prod', 'S|M|L'),
(19, 'den', 'product_img19.jpg|product_img19_compact1.jpg|produ', 'S|M|L'),
(20, 'den|trang', 'product_img20.jpg|product_img20_compact1.jpg|produ', 'S|M|L'),
(21, 'den', 'product_img21.jpg|product_img21_compact1.jpg|produ', 'L|XL|XXL'),
(22, 'den', 'product_img22.jpg|product_img22_compact1.jpg|produ', 'S|M|L|XL'),
(23, 'trang|kem', 'product_img23.jpg|product_img23_compact1.jpg|produ', 'S|M|L'),
(24, 'den|nau', 'product_img24.jpg|product_img24_compact1.jpg|produ', 'S|M|L'),
(25, 'den|nau', 'product_img25.jpg|product_img25_compact1.jpg|produ', 'L|XL|XXL'),
(26, 'trang', 'product_img26.jpg|product_img26_compact1.jpg|produ', ' '),
(27, 'den', 'product_img27.jpg|product_img27_compact1.jpg|produ', ' '),
(28, 'den|trang', 'product_img28.jpg|product_img28_compact1.jpg|produ', 'L|XL|XXL'),
(29, 'xanh|cam|den|kem', 'product_img29.jpg|product_img29_compact1.jpg|produ', 'S|M|L'),
(30, 'den|kem', 'product_img30.jpg|product_img30_compact1.jpg|produ', 'S|M'),
(31, 'xanh|kem|den', 'product_img31.jpg|product_img31_compact1.jpg|produ', 'S|M'),
(32, 'den|trang|kem', 'product_img32.jpg|product_img32_compact1.jpg|produ', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(4) NOT NULL,
  `product_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `product_type_name`) VALUES
(1, 'Áo nam'),
(2, 'Quần nam'),
(3, 'Vest - Blazer'),
(4, 'Áo khoác nam'),
(5, 'Áo nữ'),
(6, 'Áo dài'),
(7, 'Áo khoác nữ'),
(8, 'Quần nữ'),
(9, 'Đầm'),
(10, 'Váy'),
(11, 'Chân váy'),
(12, 'Quần'),
(13, 'Áo'),
(14, 'Mắt kính'),
(15, 'Giày - Dép'),
(16, 'Mũ - Nón'),
(17, 'Vớ - Tất'),
(18, 'Túi - Ví'),
(19, 'Thắt lưng'),
(20, 'Đồng hồ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `pmr_account_accounttype` (`account_type_id`);

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_type_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`invoice_id`,`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Indexes for table `product_style`
--
ALTER TABLE `product_style`
  ADD PRIMARY KEY (`product_id`,`product_color`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `account_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_style`
--
ALTER TABLE `product_style`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `frn_account_accountype` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`account_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account_details`
--
ALTER TABLE `account_details`
  ADD CONSTRAINT `frn_accountdetails_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `frn_comment_account` FOREIGN KEY (`customer_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frn_comment_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `frn_invoicedetails_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `frn_product_producttype` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`product_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_style`
--
ALTER TABLE `product_style`
  ADD CONSTRAINT `frn_productstyle_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
