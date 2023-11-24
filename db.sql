-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2023 at 03:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_at` date DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billdetails`
--

CREATE TABLE `billdetails` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `bill_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int NOT NULL,
  `account_id` int DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `pay_method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'MOMO',
  `create_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sneaker'),
(2, 'Thể Thao'),
(3, 'Công sở'),
(4, 'Cao gót');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `account_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `product_id`, `link`) VALUES
(25, 16, './assets/image/giay_tuvis_unisex_denim_cot_day_3fd0.jpg'),
(26, 16, './assets/image/giay_tuvis_unisex_denim_cot_day_8d91.jpg'),
(27, 16, './assets/image/giay_tuvis_unisex_denim_cot_day_c032.jpg'),
(28, 16, './assets/image/giay_tuvis_unisex_denim_cot_day_e396.jpg'),
(29, 17, './assets/image/giay_cot_day_nu_kim_tuyen_quickfree_w160505_1fec.jpg'),
(30, 17, './assets/image/giay_cot_day_nu_kim_tuyen_quickfree_w160505_5bd5.jpg'),
(31, 17, './assets/image/giay_cot_day_nu_kim_tuyen_quickfree_w160505_50e8.jpg'),
(32, 18, './assets/image/giay_sneaker_must_korea_nu_i01_935c.jpg'),
(33, 18, './assets/image/giay_sneaker_must_korea_nu_i01_a402.jpg'),
(34, 18, './assets/image/giay_sneaker_must_korea_nu_i01_b336.jpg'),
(35, 18, './assets/image/giay_sneaker_must_korea_nu_i01_f6c9.jpg'),
(36, 19, './assets/image/giay_nu_got_nhon_cindydrella_b29_29d3.jpg'),
(37, 19, './assets/image/giay_nu_got_nhon_cindydrella_b29_64bf.jpg'),
(38, 19, './assets/image/giay_nu_got_nhon_cindydrella_b29_e865.jpg'),
(39, 20, './assets/image/giay_cao_got_nu_phoi_day_cheo_x_8f6e.jpg'),
(40, 20, './assets/image/giay_cao_got_nu_phoi_day_cheo_x_19c1.jpg'),
(41, 20, './assets/image/giay_cao_got_nu_phoi_day_cheo_x_de40.jpg'),
(45, 21, './assets/image/IMG_1013-700x700.jpg'),
(46, 21, './assets/image/IMG_1062-700x700.jpg'),
(47, 21, './assets/image/IMG_1079-700x700.jpg'),
(48, 21, './assets/image/IMG_2256-150x150.jpg.webp'),
(49, 22, './assets/image/2-1-1024x1024-1-scaled-700x700.jpg'),
(50, 22, './assets/image/balemc-1-700x700.jpg'),
(51, 22, './assets/image/balemc-4-700x700.jpg'),
(52, 23, './assets/image/dosiin-mlb-giay-sneaker-co-thap-big-ball-chunky-174618174618.webp'),
(53, 23, './assets/image/dosiin-mlb-giay-sneaker-co-thap-big-ball-chunky-174619174619.webp'),
(54, 23, './assets/image/dosiin-mlb-giay-sneaker-co-thap-big-ball-chunky-174620174620.webp'),
(55, 23, './assets/image/dosiin-mlb-giay-sneaker-co-thap-big-ball-chunky-174622174622.webp'),
(56, 24, './assets/image/20231011_f2McwCaBz9.jpeg'),
(57, 24, './assets/image/20231011_Gujj5atny7.jpeg'),
(58, 24, './assets/image/20231011_VYQsltQM1p.jpeg'),
(59, 24, './assets/image/20231019_N82ey1361m.jpeg'),
(60, 24, './assets/image/20231019_o2p0LM2cAO.jpeg'),
(61, 24, './assets/image/20231019_V3N5IAqrTP.jpeg'),
(62, 25, './assets/image/giay-mlb-liner-high-ny-white-black-quai-dan.jpg'),
(67, 25, './assets/image/giay-mlb-liner-high-ny-white-black-quai-dan-2.jpeg'),
(69, 25, './assets/image/giay-mlb-liner-high-ny-white-black-quai-dan.jpeg'),
(70, 26, './assets/image/126.jpg'),
(71, 26, './assets/image/giay-mlb-liner-high-ny-white-black-quai-dan-2.jpeg'),
(72, 26, './assets/image/giay-nike-air-jordan-1-retro-high-dior-like-auth-99-3.jpeg'),
(73, 26, './assets/image/giay-nike-air-jordan-1-retro-high-dior-like-auth-99-5.jpeg'),
(74, 26, './assets/image/giay-nike-air-jordan-1-retro-high-dior-like-auth-99-8.jpeg'),
(75, 27, './assets/image/dila1p.webp'),
(76, 27, './assets/image/dila_multi_9270ac_master.webp'),
(78, 27, './assets/image/dilla2p.webp'),
(79, 27, './assets/image/dila_multi_965-002.webp'),
(83, 27, './assets/image/dila_multi_965-002-0r.webp'),
(84, 27, './assets/image/dila_greyr.webp'),
(85, 27, './assets/image/dila_grey_05r.webp'),
(86, 28, './assets/image/438183050-2-4__66130__1665642082-medium@2x.jpg'),
(87, 28, './assets/image/sdn-0740-org--5-__66005__1665028662-medium.jpg'),
(88, 28, './assets/image/5__66096__1665463127-medium.jpg'),
(89, 28, './assets/image/sdn-0740-org--2-__66006__1665028664-medium.jpg'),
(90, 29, './assets/image/hong_cg09160_2_20230724151624_3a5336c5870f45f1acd3b5b59f3ed08b_master.webp'),
(91, 29, './assets/image/hong_cg09160_17_20230721092752_8b0e2826c86246ecb3dfa210e5b4d073_master.webp'),
(92, 29, './assets/image/hong_cg09160_19_20230721092752_54473c85836a4c4ab534e57c4860ea49_master.webp'),
(93, 29, './assets/image/hong_cg09160_21_20230721092752_9e26519778084154b3e573e80d91cc84_master.webp'),
(94, 29, './assets/image/kem_cg09160_9_20230721092752_0fe5b60307e04547868c61babe16702d_master.webp'),
(95, 29, './assets/image/kem_cg09160_13_20230721092752_91d2b1e0eb0b4922808e3297bca9e35c_master.webp'),
(96, 29, './assets/image/den_cg09160_4_20230721092752_6c0056690c584b05be65b3d63c555a6c_master.webp'),
(97, 29, './assets/image/den_cg09160_5_20230721092752_831e203384dd47f8b142bd49618b1a3b_master.webp'),
(98, 29, './assets/image/den_cg09160_12_20230724151625_df8b6224278a43c09fdb818f34292f4c_master.webp'),
(99, 30, './assets/image/7-bjwdh88.webp'),
(100, 30, './assets/image/bjwdh88 (1).webp'),
(101, 30, './assets/image/bjwdh88.webp'),
(102, 31, './assets/image/RO559-1-1-1200x1200.jpg'),
(103, 31, './assets/image/RO559-4-1-1200x1200.jpg'),
(104, 31, './assets/image/RO559-1200x1200.png'),
(105, 31, './assets/image/RO559-B.png'),
(106, 32, './assets/image/007-bjwdh51.05.rgold.thuyenhoavang.34_.jpg'),
(107, 32, './assets/image/7-bjwdh51.05.rgold.thuyenhoavang.3.jpg'),
(108, 32, './assets/image/7-bjwdh51.05.rgold.thuyenhoavang.34.jpg'),
(109, 32, './assets/image/7-bjwdh51.05.rgold.thuyenhoavang.jpg'),
(110, 33, './assets/image/bjwdh92.webp'),
(111, 33, './assets/image/wdh.jpg'),
(112, 33, './assets/image/wdh92.webp'),
(113, 34, './assets/image/007-bjwds46.05.thuyenhoahong.trang.3.jpg'),
(114, 34, './assets/image/7-bjwds46.05.thuyenhoahong.trang.35.jpg'),
(115, 34, './assets/image/7-bjwds46.05.thuyenhoahong.trang.35-5756ea0437794c529a432f077238777a_1024x1024.jpg'),
(116, 34, './assets/image/7-bjwds46.05.thuyenhoahong.trang.35-jpg.jpg'),
(117, 35, './assets/image/img_0471_178cd.jpg'),
(118, 35, './assets/image/img_0470_223eb39266b94c9.jpg'),
(119, 35, './assets/image/img_0472_a38f75.jpg'),
(120, 35, './assets/image/img_0473_0b0b2db.jpg'),
(121, 36, './assets/image/0ff795c44e68d2cebc602e7efeee2c23.jpg.webp'),
(122, 36, './assets/image/98d03d4dab90c540c5bf260cc203c470.jpg.webp'),
(123, 36, './assets/image/429c6fa2831bb334a75582b183707a75.jpg.webp'),
(124, 36, './assets/image/10f1b61da4a8e52c7b65f35a980ca5a2.jpg.webp'),
(125, 37, './assets/image/d6fae49794d19af696bf833337e866cd.jpg.webp'),
(126, 37, './assets/image/295ff61c65fedd6eb2bbe89e226a4df9.jpg.webp'),
(127, 37, './assets/image/bc630920fd86a151d31d65c92150c81b.jpg.webp'),
(128, 37, './assets/image/ecde7f4a14cb6bc1be0407cafc04bceb.jpg.webp'),
(130, 38, './assets/image/xanh5-master.webp'),
(131, 38, './assets/image/xanh-master.webp'),
(132, 38, './assets/image/xanh-tim_cg05124_1.webp'),
(133, 38, './assets/image/hong_cg05124_19_20master.webp'),
(134, 38, './assets/image/hong_cg05124_21_20220912135325aster.webp'),
(135, 39, './assets/image/34_bf406fdddee44d23bd983278c8536e55_master.webp'),
(136, 39, './assets/image/136_a4b4cb64bcc8469d8578013efec6b4f9_master.webp'),
(137, 39, './assets/image/dsc01234_81c2279ef32c47d9b0fce497eca97075_master.webp'),
(138, 39, './assets/image/dsc01236_540a18b6c09540e78f2df1ed03fefa11_master.webp'),
(139, 40, './assets/image/giay-the-thao-z-by-zuciani-GYJ11-trang-4_400x.webp'),
(140, 40, './assets/image/giay-the-thao-z-by-zuciani-GYJ11-trang-5.webp'),
(141, 40, './assets/image/giay-the-thao-z-by-zuciani-GYJ11-trang-7_400x.webp'),
(142, 40, './assets/image/giay-the-thao-z-by-zuciani-GYJ11-trang-3_400x.webp'),
(143, 40, './assets/image/giay-the-thao-z-by-zuciani-GYJ11.webp'),
(144, 40, './assets/image/giay-the-thao-z-by-zuciani-GYJ11-hong.webp');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discount` int DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `view` int DEFAULT '0',
  `purchase` int DEFAULT '0',
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `discount`, `description`, `view`, `purchase`, `create_at`, `update_at`) VALUES
(16, 1, 'Giày Tuvis unisex denim cột dây SID36110', 15, 'Giày Tuvis unisex denim cột dây: Chất liệu: Cotton + Cao su. Thiết kế kiểu giày cột dây mang đến phong cách khỏe khoắn, năng động', 0, 0, '2023-11-20 17:39:16', NULL),
(17, 1, 'Giày Cột Dây Nữ kim tuyến QuickFree', 10, 'Là mẫu giày bạn có thể mang bất cứ ở đâu, bất cứ khi nào, phù hợp với mọi loại trang phục', 0, 0, '2023-11-20 17:53:26', NULL),
(18, 1, 'Giày Sneaker MUST Korea nữ I01 SID45677', 0, 'Giày Sneaker MUST Korea nữ I01: Chất liệu làm bằng da PU mềm mại tự nhiên, bền chắc, tạo sự thoải mái trong mỗi bước chân. Thiết kế ôm vừa chân với thương hiệu MUST đẳng cấp, thời trang, mang đến cho bạn gái vẻ ngoài trẻ trung, năng động', 0, 0, '2023-11-20 18:01:10', NULL),
(19, 4, 'Giày nữ gót nhọn Cindydrella B29 SID33517', 12, 'Giày nữ gót nhọn Cindydrella B29: Chất liêu Da PU bền đẹp, sáng bóng, tỉ mỉ, chắc chắn cho bạn thêm an tâm khi sử dụng. Thiêt kế giày gót nhọn sang trọng, mang tới cho bạn sự thanh lịch, duyên dáng.', 0, 0, '2023-11-20 18:06:50', NULL),
(20, 4, 'Giày cao gót nữ phối dây chéo X SID39138', 13, 'Giày cao gót nữ phối dây chéo: Chất liệu nhung mềm mại, đẹp, mang đến vẻ sang trọng cho đôi giày. Thiết kế hiện đại, giày mũi nhọn thời trang, mang đến nét trẻ trung, thanh lịch', 0, 0, '2023-11-20 18:12:35', NULL),
(21, 1, 'Air Force 1 Shadow Pale Ivory', 10, 'Nike Air Force 1 Shadow đang cho thấy sức ảnh hưởng mãnh liệt của mình khi thu hút rất nhiều đầu giày hay thậm chí một số người nổi tiếng diện nó trên chân. Đúng với cái tên Shadow, mỗi chi tiết trên thân giày đều có hình bóng của chính nó bên dưới, đi theo phong cách “nhân đôi niềm vui” với 2 Swoosh, 2 mid-sole, 2 hàng lỗ xỏ dây và 2 mud-guard được đặt chồng lên nhau. Bộ đế Air được nâng cao hơn so với của Air Force 1 nguyên bản, giúp “hack” chiều cao dễ hơn mà không quá lố. Mỗi một phiên bản phối màu mới được ra mắt của dòng giày này đều gây sốt khi pha trộn các mảng màu khác sắc độ với nhau vô cùng tinh tế.\r\n\r\nChất liệu upper: da tổng hợp\r\nĐế giày cao su\r\nChiều cao đế: 4.1 cm\r\nLớp lót bằng lưới và đệm foam gấp đôi sự êm ái\r\nCó lỗ thông hơi trên mũi giày\r\nTem giày thêu trên phần lưỡi gà\r\nChất liệu tag dây giày: nhựa\r\nMàu sắc: trắng ngà/vàng/tím pastel/xanh lá\r\nThương hiệu: ', 0, 0, '2023-11-22 22:15:37', NULL),
(22, 1, 'Balenciaga Triple S Trainer White', 33, 'Balenciaga là thương hiệu thời trang lâu đời nổi tiếng, cao cấp nhất nhì thế giới được thành lập từ năm 1919. Tiếp nối sự thành công, thương hiệu tiếp tục tung ra Triple S – dòng giày đa sắc màu, phá bỏ mọi giới hạn, đủ đẹp, đủ chất để khiến giới mộ điệu lại một lần nữa phải điên đảo Đây là mẫu giày cũng được nhiều người nghệ sĩ thế giới lựa chọn. Tại Việt Nam, giày Triple S được rất nhiều nghệ sĩ nổi tiếng yêu thích. Thiết kế đột phá. Một đôi giày ra đời đã phá vỡ những tiêu chuẩn về thời trang hiện nay. Phần đế cao, uốn lượn hơn hẳn để bạn ăn gian thêm vài centimet Pha trộn những gam màu vintage và nhiều chất liệu vải khác nhau. Trên thân, gót hay đế giày cũng đều được thêu và khắc tên thương hiệu, tạo sự đẳng cấp.', 0, 0, '2023-11-22 22:23:32', NULL),
(23, 1, 'MLB - Giày sneaker cổ thấp Big Ball Chunky', 15, 'Chất liệu: Composition leather, Compounded rubber Kiểu dáng giày sneaker đế cao thời trang Thiết kế lấy cảm hứng từ hiệp hội bóng chày MLB Cộng hưởng cùng chi tiết chữ sắc nét Lớp lót êm ái, nâng dáng bước chân Gam màu hiện đại dễ dàng phối với nhiều trang phục và phụ kiện Xuất xứ thương hiệu: Hàn quốc. Sản xuất tại: Việt Nam', 0, 0, '2023-11-22 23:11:59', NULL),
(24, 1, 'SUEDE Sneakers - FS', 20, '- Màu sắc: Đen\r\n\r\n- Chất liệu da lộn. \r\n\r\n- Đế cao su dẻo dai, độ bền cao, được sản xuất theo công nghệ mới.\r\n\r\n- Thiết kế năng động. \r\n\r\n- Đế giày được ép nhiệt kết hợp những đường khâu chắc chắn.', 0, 0, '2023-11-22 23:34:21', NULL),
(25, 1, 'Giày MLB Liner High NY White Black', 45, 'Giày MLB Liner High NY ‘White Black’ (QUAI DÁN) với thiết kế đẹp, tinh tế & màu sắc vô cùng dễ phối đồ. Vậy nên đôi giày này trở nên phổ biến, mang tính biểu tượng và được rất nhiều giới trẻ yêu thích. Và nếu bạn cũng là một người đam mê dòng sneaker dễ mang, dễ phố đồ thì không nên bỏ qua mẫu giày siêu phẩm này đâu nhé! Dưới đây là một số hình ảnh của đôi Giày MLB Liner High NY ‘White Black’ (QUAI DÁN) tại TyHi Sneaker (hàng chuẩn Siêu cấp bản xịn nhất thị trường).', 0, 0, '2023-11-22 23:39:51', NULL),
(26, 1, 'Giày Nike Air Jordan 1 Retro High Dior Like Auth', 50, 'Giày Nike Air Jordan 1 Retro High Dior Like Auth 99% với thiết kế đẹp, tinh tế & màu sắc vô cùng dễ phối đồ. Vậy nên đôi giày này trở nên phổ biến, mang tính biểu tượng và được rất nhiều giới trẻ yêu thích. Thế giới thời trang là một bảo tàng vô tận của sự sáng tạo và phong cách, và “Giày Nike Air Jordan 1 Retro High Dior” đã đưa thế giới này lên một tầm cao hoàn toàn mới. Sự kết hợp độc đáo giữa hai biểu tượng của ngành thời trang, Nike và Dior, đã tạo ra một sản phẩm tuyệt đẹp và đầy ấn tượng. Chúng ta sẽ cùng khám phá chi tiết hơn về đôi giày này và tìm hiểu tại sao nó trở thành một biểu tượng của sự sáng tạo và phong cách trong thế giới thời trang.', 0, 0, '2023-11-23 00:11:13', NULL),
(27, 1, 'GIÀY SNEAKERS NỮ DILA', 15, 'Đôi sneakers DILA với thiết kế phom to đế dày, tạo cảm giác dễ chịu, êm ái cho đôi chân của bạn. Hoạ tiết đan xen nhiều màu sắc mang đến tổng thể trẻ trung. Đệm lót Pillow Walk êm ái độc quyền tại ALDO cho bạn thoải mái di chuyển cả ngày dài.\r\n\r\nĐặc trưng\r\nChi tiết: Giày chạy bộ\r\nChi tiết: Mũi tròn\r\nChi tiết: Đế Bệt\r\nChất Liệu\r\nChất liệu: Da Tổng Hợp\r\nChất liệu chính: Chất liệu tổng hợp\r\nChất liệu đế: Nhựa EVA kết hợp cùng Sinh khối Tảo biển\r\nKích Thước\r\nChiều cao đế: 2.00 In (5.08 Cm)', 0, 0, '2023-11-23 00:28:36', NULL),
(28, 4, 'BST SPLENDID NIGHT - GIÀY SANDAL ANKLE STRAP', 50, 'Thương hiệu\r\nVASCARA\r\nMã sản phẩm\r\n1010SDN0740\r\nLoại sản phẩm\r\nGiày Cao Gót\r\nKiểu gót\r\nGót nhọn\r\nĐộ cao gót\r\n8 cm\r\nLoại mũi\r\nHở mũi nhọn\r\nChất liệu\r\nMicrofiber\r\nKiểu giày\r\nSandals\r\nPhù hợp sử dụng\r\nĐi làm, đi học, đi chơi', 0, 0, '2023-11-23 04:54:03', NULL),
(29, 4, 'Giày Cao Gót Hở Hậu Dây Chéo', 12, 'Giày cao gót hở hậu dây chéo thanh lịch nữ tính Gót cao 9cm kèm miếng đệm chống trơn trượt cho bạn dễ dàng di chuyển Chất liệu da cao cấp tổng hợp. Giày phù hợp đi mọi dịp, như đi làm, dạo phố Mã sản phẩm: CG09160 Kiểu dáng: Giày cao gót Chất liệu: Si mờ trơn Độ cao: 9cm Màu sắc: Kem-Đen-Hồng Kích cỡ: 35-36-37-38-39 Xuất xứ: Việt Nam Giá đã bao gồm VAT', 0, 0, '2023-11-23 05:52:57', NULL),
(30, 4, 'Giày Luxury Bejo H88 Trắng Thuyền 3 Màu, Xoàn', 10, 'Các mẫu giày Bejo luôn tự tin là một trong những nhãn hàng hàng đầu Việt Nam, mang đến giá trị sản phẩm về mẫu mã đa dạng, hợp thời trang mang đến sự tự tin, ấn tượng, cũng như phong cách thời thượng giúp cho bạn có thể tự tin và toả sáng. Ngoài việc chú trọng đến chất lượng về sự êm ái mềm mại, giá cả phải chăng, thì Bejo luôn còn chú ý đến từng dịch vụ chăm sóc cũng như nhu cầu của từng khách hàng.\r\n- Chất liệu:da PU tổng hợp cao cấp\r\n\r\n- Đường may chắc chắn\r\n\r\n- Lót da êm ái, bảo vệ đôi bàn chân của bạn\r\n\r\n- Mũi giày tròn, êm đi không đau chân\r\n\r\n- Đế giày chống trơn trượt có các rãnh sâu tăng độ bám cho giày.', 0, 0, '2023-11-23 06:22:59', NULL),
(31, 4, 'GIÀY CAO GÓT THỜI TRANG RO559', 0, 'RA MẮT MẪU GIÀY MỚI\r\n►MÃ SẢN PHẨM: RO559\r\n►GIÁ : 49Ok\r\n►KIỂU DÁNG: GIÀY CAO GÓT\r\n►CHẤT LIỆU: PU LOẠI 1\r\n►SIZE : 35,36,37,38,39,40\r\n►CHIỀU CAO GÓT ĐÚP :+9CM (+3CM)\r\n►MÀU : ĐỒNG – BẠC', 0, 0, '2023-11-23 06:45:50', NULL),
(32, 4, 'Giày Luxury Bejo H51 Thuyền Hoa Vàng', 16, 'Các mẫu giày Bejo luôn tự tin là một trong những nhãn hàng hàng đầu Việt Nam, mang đến giá trị sản phẩm về mẫu mã đa dạng, hợp thời trang mang đến sự tự tin, ấn tượng, cũng như phong cách thời thượng giúp cho bạn có thể tự tin và toả sáng. Ngoài việc chú trọng đến chất lượng về sự êm ái mềm mại, giá cả phải chăng, thì Bejo luôn còn chú ý đến từng dịch vụ chăm sóc cũng như nhu cầu của từng khách hàng.\r\n\r\nĐặc điểm sản phẩm:\r\n\r\n- Chất liệu:da PU tổng hợp cao cấp\r\n\r\n- Đường may chắc chắn\r\n\r\n- Lót da êm ái, bảo vệ đôi bàn chân của bạn\r\n\r\n- Mũi giày tròn, êm đi không đau chân\r\n\r\n- Đế giày chống trơn trượt có các rãnh sâu tăng độ bám cho giày', 0, 0, '2023-11-23 06:55:15', NULL),
(33, 4, 'Giày Luxury Bejo H92 3 Hoa, Cành Vàng Ngọc', 28, 'Các mẫu giày Bejo luôn tự tin là một trong những nhãn hàng hàng đầu Việt Nam, mang đến giá trị sản phẩm về mẫu mã đa dạng, hợp thời trang mang đến sự tự tin, ấn tượng, cũng như phong cách thời thượng giúp cho bạn có thể tự tin và toả sáng. Ngoài việc chú trọng đến chất lượng về sự êm ái mềm mại, giá cả phải chăng, thì Bejo luôn còn chú ý đến từng dịch vụ chăm sóc cũng như nhu cầu của từng khách hàng. Đặc điểm sản phẩm: - Chất liệu:da PU tổng hợp cao cấp - Đường may chắc chắn - Lót da êm ái, bảo vệ đôi bàn chân của bạn - Mũi giày tròn, êm đi không đau chân - Đế giày chống trơn trượt có các rãnh sâu tăng độ bám cho giày.', 0, 0, '2023-11-23 07:19:23', NULL),
(34, 4, 'Giày Luxury Bejo S46 Thuyền Hoa Hồng', 20, 'Các mẫu giày Bejo luôn tự tin là một trong những nhãn hàng hàng đầu Việt Nam, mang đến giá trị sản phẩm về mẫu mã đa dạng, hợp thời trang mang đến sự tự tin, ấn tượng, cũng như phong cách thời thượng giúp cho bạn có thể tự tin và toả sáng. Ngoài việc chú trọng đến chất lượng về sự êm ái mềm mại, giá cả phải chăng, thì Bejo luôn còn chú ý đến từng dịch vụ chăm sóc cũng như nhu cầu của từng khách hàng.\r\n\r\nĐặc điểm sản phẩm:\r\n\r\n- Chất liệu:da PU tổng hợp cao cấp\r\n\r\n- Đường may chắc chắn\r\n\r\n- Lót da êm ái, bảo vệ đôi bàn chân của bạn\r\n\r\n- Mũi giày tròn, êm đi không đau chân\r\n\r\n- Đế giày chống trơn trượt có các rãnh sâu tăng độ bám cho giày.', 0, 0, '2023-11-23 07:28:09', NULL),
(35, 4, 'Giày Cưới Luxury Bejo H94.05 Hoa Lụa, Mai nhí', 13, 'Giày cưới Bejo, với thiết kế tinh xảo,độc đáo, đặc biệt chú ý đến phần mũi và gót, chất liệu da nhân tạo mềm, lót mút làm phần mũi giày êm, có miếng lót gót rất mềm, không đau mỏi gót khi sử dụng, mang đến sự thoải mái cho bạn cả ngày.\r\n\r\nCác mẫu giày Bejo luôn tự tin là một trong những nhãn hàng hàng đầu Việt Nam, mang đến giá trị sản phẩm về mẫu mã đa dạng, hợp thời trang mang đến sự tự tin, ấn tượng, cũng như phong cách thời thượng giúp cho bạn có thể tự tin và toả sáng. Ngoài việc chú trọng đến chất lượng về sự êm ái mềm mại, giá cả phải chăng, thì Bejo luôn còn chú ý đến từng dịch vụ chăm sóc cũng như nhu cầu của từng khách hàng.', 0, 0, '2023-11-23 07:35:44', NULL),
(36, 3, 'Giày Da Pierre Cardin - PCMFWL732', 5, 'Sản phẩm: Giày Da Pierre Cardin - PCMFWLF 732\r\n\r\n \r\n\r\nThiết kế: Giày tây có buộc dây sang trọng. Không hoạ tiết cầu kỳ cùng chất liệu đen đơn sắc giúp bạn dễ dàng mix-match với nhiều trang phục khác nhau. Blank Derby sẽ đẹp hơn, lịch lãm và sang trọng hơn khi được đồng bộ với veston, suit, tuxedo, quần âu, áo sơ mi.\r\n\r\n \r\n\r\nChất liệu: Blank Derby làm bằng chất lượng da cao cấp nhập khẩu Italia. Chất da thật êm ái, mềm mịn và bền chắc với độ đàn hồi cao. Giày da bò cao cấp chính hãng Pierre Cardin Blank Derby sản xuất bằng kỹ thuật ép Cement.\r\n\r\nĐế giày được làm từ cao su tránh trơn trượt, thiết kế ôm chân tự tin khi cất bước.\r\n\r\nGiày da Pierre Cardin phù hợp với nơi công sở hay gặp mặt đối tác, khẳng định vị thế quý ông', 0, 0, '2023-11-23 07:42:34', NULL),
(37, 3, 'Giày tây nam Pierre Cardin - PCMFWLG 757', 7, 'Giày Tây Nam Pierre Cardin - PCMFWLG 757: Chất Lượng và Phong Cách Đẳng Cấp\r\n\r\nKhám phá sự hoàn hảo với mẫu giày tây nam Pierre Cardin - PCMFWLG 757. Với chất liệu da thật nhập khẩu 100% và thiết kế giày không dây tinh tế, sản phẩm này thể hiện sự sang trọng và lịch lãm trong mọi trang phục của bạn. Được tạo ra với tâm huyết, giày nam Pierre Cardin PCMFWLG 757 mang đến sự tinh tế và đẳng cấp.', 0, 0, '2023-11-23 07:48:12', NULL),
(38, 3, 'Giày Cao Gót Búp Bê Trang Trí Xích Đôi', 9, 'Mã sản phẩm: CG05124\r\nKiểu dáng: Giày cao gót\r\nChất liệu: Si mờ trơn\r\nĐộ cao: 5cm\r\nMàu sắc: Đen-Hồng-Xanh tím\r\nKích cỡ: 35-36-37-38-39\r\nXuất xứ: Việt Nam\r\nGiá đã bao gồm VAT', 0, 0, '2023-11-23 07:57:17', NULL),
(39, 2, 'Giày Thể Thao Sneaker chính hãng Goya GY232', 30, 'Là một trong những mẫu giày chính hãng do công ty Goya sản xuất và phân phối. Có kiểu dáng rất hiện đại trẻ trung, phù hợp đi chơi, dã ngoại, hoạt động thể dục cho những tín đồ đam mê phong cách thể thao năng động \r\n\r\n- Đế: Cao su cao cấp nguyên khối: Siêu nhẹ, đàn hồi cực tốt, êm chân, chắc chắn\r\n\r\n- Chất liệu: Vải dệt lưới thông hơi thoáng khí đi rất thoải mái\r\n\r\n- Form dáng thời trang, ôm khít chân\r\n\r\n- Chiều cao: 3cm \r\n\r\n- Màu sắc: nhiều màu\r\n\r\n- Kiểu dáng: Sneaker, giày thể thao năng động\r\n\r\n- Chất lượng: Goya bảo cam kết bảo hành 365 ngày', 0, 0, '2023-11-23 08:05:04', NULL),
(40, 2, 'GIÀY THỂ THAO ZUCIANI THE COMFORT N.11', 8, 'Giày Thể Thao Zuciani không chỉ hợp thời trang mà còn đảm bảo sự thoải mái và sự tự tin trong mỗi bước đi. Với thiết kế nữ tính và sự kết hợp giữa chất liệu vải dệt êm ái và đế TPU nhẹ nhàng, đôi giày thể thao này sẽ là một phụ kiện tuyệt vời để thể hiện phong cách và sự năng động của bạn.\r\n\r\n- Mã sản phẩm: GYJ11\r\n\r\n- Màu: Hồng, Trắng\r\n\r\n- Size: 35 - 40\r\n\r\n- Chất liệu: Vải dệt (Knit) siêu nhẹ\r\n\r\n- Đế: Cao su\r\n\r\n- Cao: 3cm', 0, 0, '2023-11-23 08:10:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `size` int DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `quantity` int DEFAULT '0',
  `price` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `size`, `color`, `quantity`, `price`) VALUES
(4, 16, 39, 'Xanh', 442, 300000),
(5, 17, 35, 'Hồng', 542, 399000),
(6, 18, 36, 'Trắng', 3113, 900000),
(7, 19, 35, 'Đen', 412, 347000),
(8, 16, 40, 'Xanh', 435, 350000),
(9, 20, 35, 'Đen', 123, 550000),
(10, 16, 41, 'Xanh', 356, 320000),
(11, 16, 42, 'Xanh', 87, 320000),
(12, 17, 36, 'Hồng', 344, 395000),
(13, 17, 37, 'Hồng', 442, 395000),
(14, 17, 38, 'Hồng', 256, 399000),
(16, 18, 35, 'Trắng', 548, 900000),
(17, 18, 37, 'Trắng', 879, 900000),
(18, 18, 35, 'Đen', 277, 900000),
(19, 18, 36, 'Đen', 488, 900000),
(20, 18, 37, 'Đen', 73, 900000),
(21, 19, 36, 'Đen', 568, 347000),
(22, 19, 37, 'Đen', 674, 347000),
(23, 19, 38, 'Đen', 50, 347000),
(24, 19, 35, 'Đỏ', 56, 350000),
(25, 19, 37, 'Đỏ', 55, 350000),
(26, 19, 36, 'Đỏ', 46, 350000),
(27, 20, 36, 'Đen', 423, 550000),
(28, 20, 37, 'Đen', 86, 550000),
(29, 20, 38, 'Đen', 75, 550000),
(30, 21, 35, 'Một màu', 43, 1195000),
(31, 21, 36, 'Một màu', 61, 1195000),
(32, 21, 37, 'Một màu', 68, 1195000),
(33, 21, 38, 'Một màu', 16, 1195000),
(34, 22, 36, 'Một màu', 56, 1795000),
(35, 22, 37, 'Một màu', 67, 1795000),
(36, 22, 38, 'Một màu', 87, 1795000),
(37, 22, 39, 'Một màu', 87, 1795000),
(38, 22, 40, 'Một màu', 55, 1795000),
(39, 22, 41, 'Một màu', 65, 1795000),
(40, 22, 42, 'Một màu', 43, 1795000),
(41, 23, 39, 'Đen', 67, 2490000),
(42, 23, 40, 'Đen', 667, 2490000),
(43, 23, 41, 'Đen', 87, 2490000),
(44, 23, 42, 'Đen', 78, 2490000),
(45, 23, 35, 'Xanh', 235, 2490000),
(46, 23, 36, 'Xanh', 67, 2490000),
(47, 23, 37, 'Xanh', 69, 2490000),
(48, 23, 38, 'Xanh', 42, 2490000),
(49, 24, 30, 'Đen', 15, 1150000),
(50, 24, 39, 'Đen', 52, 1150000),
(51, 24, 40, 'Đen', 41, 1150000),
(53, 24, 42, 'Đen', 78, 1150000),
(54, 24, 41, 'Đen', 56, 1150000),
(55, 25, 36, 'Một màu', 56, 1700000),
(56, 25, 37, 'Một màu', 60, 1700000),
(57, 25, 38, 'Một màu', 35, 1700000),
(58, 25, 39, 'Một màu', 234, 1700000),
(59, 25, 40, 'Một màu', 79, 1700000),
(60, 25, 41, 'Một màu', 98, 1700000),
(61, 25, 42, 'Một màu', 83, 1700000),
(62, 26, 36, 'Xám', 54, 5000000),
(63, 26, 37, 'Xám', 14, 5000000),
(64, 26, 38, 'Xám', 98, 5000000),
(65, 26, 39, 'Xám', 29, 5000000),
(66, 26, 40, 'Xám', 72, 5000000),
(67, 26, 41, 'Xám', 82, 5000000),
(68, 26, 42, 'Xám', 95, 5000000),
(69, 27, 35, ' Pastel', 65, 2250000),
(70, 27, 36, ' Pastel', 8, 2550000),
(71, 27, 37, ' Pastel', 45, 2550000),
(72, 27, 38, ' Pastel', 42, 2550000),
(73, 27, 35, 'Trắng', 15, 2550000),
(74, 27, 36, 'Trắng', 36, 2550000),
(75, 27, 37, 'Trắng', 19, 2550000),
(76, 27, 38, 'Trắng', 24, 2550000),
(77, 27, 35, 'Xám', 26, 2550000),
(78, 27, 38, 'Xám', 51, 2550000),
(79, 28, 35, 'Cam', 43, 1203000),
(80, 28, 36, 'Cam', 77, 1203000),
(81, 28, 37, 'Cam', 38, 1203000),
(82, 28, 38, 'Cam', 84, 1203000),
(83, 28, 39, 'Cam', 48, 1203000),
(84, 29, 35, 'Hồng', 58, 489000),
(85, 29, 36, 'Hồng', 75, 489000),
(86, 29, 37, 'Hồng', 58, 489000),
(87, 29, 38, 'Hồng', 82, 489000),
(88, 29, 39, 'Hồng', 66, 489000),
(89, 29, 35, 'Trắng', 92, 489000),
(90, 29, 36, 'Trắng', 18, 489000),
(91, 29, 37, 'Trắng', 18, 489000),
(92, 29, 38, 'Trắng', 51, 489000),
(93, 29, 35, 'Đen', 92, 489000),
(94, 29, 36, 'Đen', 92, 489000),
(95, 29, 37, 'Đen', 83, 489000),
(96, 30, 34, 'Trắng', 28, 1300000),
(97, 30, 35, 'Trắng', 86, 1300000),
(98, 30, 36, 'Trắng', 83, 1300000),
(99, 30, 37, 'Trắng', 57, 1300000),
(100, 31, 35, 'Bạc', 87, 490000),
(101, 31, 36, 'Bạc', 92, 490000),
(102, 31, 37, 'Bạc', 98, 490000),
(103, 31, 38, 'Bạc', 85, 490000),
(104, 31, 35, 'Đồng', 28, 490000),
(105, 31, 36, 'Đồng', 92, 490000),
(106, 31, 38, 'Đ', 89, 490000),
(107, 32, 35, 'Vàng', 13, 1300000),
(108, 32, 34, 'Vàng', 29, 1300000),
(109, 32, 36, 'Vàng', 23, 1300000),
(110, 32, 38, 'Vàng', 9, 1300000),
(111, 33, 34, 'Trắng', 24, 1300000),
(112, 33, 35, 'Trắng', 55, 1300000),
(113, 33, 36, 'Trắng', 84, 1300000),
(114, 33, 37, 'Trắng', 13, 1300000),
(115, 33, 38, 'Trắng', 43, 1300000),
(116, 34, 35, 'Trắng', 14, 1350000),
(117, 34, 36, 'Trắng', 27, 1350000),
(118, 34, 37, 'Trắng', 52, 1350000),
(119, 34, 38, 'Trắng', 26, 1350000),
(120, 35, 35, 'Trắng', 23, 1400000),
(121, 35, 36, 'Trắng', 51, 1400000),
(122, 35, 37, 'Trắng', 62, 1400000),
(123, 35, 38, 'Trắng', 15, 1400000),
(124, 35, 39, 'Trắng', 11, 1400000),
(125, 36, 39, 'Đen', 41, 2990000),
(126, 36, 40, 'Đen', 51, 2990000),
(127, 36, 41, 'Đen', 51, 2990000),
(128, 36, 42, 'Đen', 14, 2990000),
(129, 37, 39, 'Nâu', 41, 2990000),
(130, 37, 41, 'Nâu', 14, 2990000),
(131, 37, 42, 'Nâu', 25, 2990000),
(132, 38, 35, 'Xanh', 41, 446000),
(133, 38, 36, 'Xanh', 53, 446000),
(134, 38, 37, 'Xanh', 67, 446000),
(135, 38, 38, 'Xanh', 68, 446000),
(136, 38, 35, 'Hồng', 56, 446000),
(137, 38, 36, 'Hồng', 49, 446000),
(138, 38, 37, 'Hồng', 84, 446000),
(139, 38, 38, 'Hồng', 68, 446000),
(140, 39, 40, 'Xanh', 51, 950000),
(141, 39, 44, 'Xanh', 846, 950000),
(142, 40, 35, 'Hồng', 51, 820000),
(143, 40, 36, 'Hồng', 94, 820000),
(144, 40, 37, 'Hồng', 95, 820000),
(145, 40, 38, 'Hồng', 46, 820000),
(146, 40, 40, 'Hồng', 86, 820000),
(147, 40, 35, 'Trắng', 85, 820000),
(148, 40, 36, 'Trắng', 87, 820000),
(149, 40, 38, 'Trắng', 84, 820000),
(150, 40, 39, 'Trắng', 58, 820000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billdetails`
--
ALTER TABLE `billdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_billdetails_bill_id` (`bill_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_comments_accounts` (`account_id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billdetails`
--
ALTER TABLE `billdetails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billdetails`
--
ALTER TABLE `billdetails`
  ADD CONSTRAINT `billdetails_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_billdetails_bill_id` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_comments_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
