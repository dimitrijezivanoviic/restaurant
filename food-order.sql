-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 10:31 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` int(11) NOT NULL,
  `usernameID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id_coupons` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `percentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id_coupons`, `code`, `percentage`) VALUES
(1, 'nothing', 1),
(4, 'popust10', 0.9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usernameID` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `membership_order` varchar(100) NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `name`, `email`, `usernameID`, `phone`, `city`, `address`, `pmode`, `products`, `amount_paid`, `order_status`, `membership_order`, `time`) VALUES
(185, 'qdwqdw qwdwqdqwd', 'adwawd@adw.com', 149, '123412124', 'Beograd', 'qwdqwdqwd', '', ' Burger x 1,  Burger x 1, ', '1000', 'priprema', 'no', '2021-07-14 10:59:13'),
(186, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0641235567', 'Beograd', 'Srpskog Sovjeta 10', '', ' Fanta x 1,  Caesar Beef x 1,  Caesar Beef Jalapeno x 1, ', '1040', 'completed', 'no', '2021-07-14 02:36:14'),
(187, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0642845711', 'Beograd', 'Srpskog Sovjeta 10', '', ' Caesar Beef x 1,  Caesar Chicken x 1, ', '990', 'completed', 'no', '2021-07-14 11:15:35'),
(188, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0642845711', 'Beograd', 'Srpskog Sovjeta 10', '', ' Caesar Chicken x 2,  Big Tasty Bacon x 2,  Capricciosa x 3,  Coca Cola x 2,  Fanta x 2, ', '4440', 'completed', 'no', '2021-07-14 11:21:51'),
(189, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0642845711', 'Beograd', 'Srpskog Sovjeta 10', '', ' Caesar Beef x 1, ', '490', 'completed', 'no', '2021-07-14 11:22:39'),
(190, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0642845711', 'Beograd', 'Srpskog Sovjeta 10', '', ' Caesar Chicken x 1,  Caesar Beef Jalapeno x 1, ', '1000', 'completed', 'no', '2021-07-14 11:23:03'),
(191, 'Aleksa Aleksic', 'aleksa@gmail.com', 149, '0612432451', 'Beograd', 'Knez Mihailova', '', ' Burger x 1,  Burger x 1, ', '600', 'preuzeo dostavljac', 'no', '2021-07-14 10:39:21'),
(192, 'Aleksa Aleksic', 'aleksa@gmail.com', 149, '0641212434', 'Beograd', 'Knez Mihailova', '', ' Caesar Chicken x 1, ', '500', 'ordered', 'no', '2021-07-14 11:26:30'),
(193, 'Aleksa Aleksic', 'aleksa@gmail.com', 149, '064124151', 'Beograd', 'Knez Mihailova', '', ' Caesar Chicken x 1,  Caesar Beef x 1, ', '990', 'ceka dostavu', 'no', '2021-07-14 10:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `sastojci`
--

CREATE TABLE `sastojci` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sastojci`
--

INSERT INTO `sastojci` (`id`, `name`, `image`, `status`) VALUES
(1, 'kackavaljadw', 'kackavalj.jpg', 'active'),
(2, 'origano', 'origano.jpg', 'active'),
(3, 'kecap', 'kecap.jpg', 'active'),
(4, 'pecurke', 'pecurke.jpg', 'active'),
(5, 'masline', 'masline.jpg', 'active'),
(6, 'prsut', 'prsut.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`) VALUES
(1, 'awd'),
(2, 'awd'),
(3, 'awd'),
(4, 'awd'),
(5, 'adwawdawdadw'),
(6, 'adwawdawdadw'),
(7, 'awdawdawd'),
(8, 'awdawdawd'),
(9, 'awdawdadwawdawdadwadw'),
(10, 'awdawdadwawdawdadwadw'),
(11, 'awdawdadwawdawdadwadw'),
(12, 'dwaadw'),
(13, 'dwaadw'),
(14, 'dwaadw'),
(15, 'dwaadw'),
(16, 'dwaadw'),
(17, 'dwaadw'),
(18, 'dwaadw'),
(19, 'dwaadw'),
(20, 'dwaadw'),
(21, 'dwaadw'),
(22, 'dwaadw'),
(23, 'dwaadw'),
(24, 'dwaadw'),
(25, 'dwaadw'),
(26, 'dwaadw'),
(27, 'dwaadw'),
(28, 'dwaadw'),
(29, 'dwaadw'),
(30, 'dwaadw'),
(31, 'dwaadw'),
(32, 'dwaadw'),
(33, 'dwaadw'),
(34, 'dwaadw'),
(35, 'dwaadw'),
(36, 'dwaadw'),
(37, 'dwaadw'),
(38, 'dwaadw'),
(39, 'dwaadw'),
(40, 'dwaadw'),
(41, 'dwaadw'),
(42, 'dwaadw'),
(43, 'dwaadw'),
(44, 'dwaadw'),
(45, 'dwaadw'),
(46, 'dwaadw'),
(47, 'dwaadw'),
(48, 'dwaadw'),
(49, 'dwaadw'),
(50, 'dwaadw'),
(51, 'dwaadw'),
(52, 'dwaadw'),
(53, 'dwaadw'),
(54, 'dwaadw'),
(55, 'dwaadw'),
(56, 'dwaadw'),
(57, 'dwaadw'),
(58, 'dwaadw'),
(59, 'dwaadw'),
(60, 'dwaadw'),
(61, 'dwaadw'),
(62, 'dwaadw'),
(63, 'dwaadw'),
(64, 'dwaadw'),
(65, 'dwaadw'),
(66, 'dwaadw'),
(67, 'dwaadw'),
(68, 'dawawdaw'),
(69, 'dawawdaw'),
(70, 'dawawdaw'),
(71, 'dawawdaw'),
(72, 'dawawdaw'),
(73, 'dawawdaw'),
(74, 'dawawdaw'),
(75, 'dawawdaw'),
(76, 'dawawdaw'),
(77, 'dawawdaw'),
(78, 'dawawdaw'),
(79, 'dawawdaw'),
(80, 'dawawdaw'),
(81, 'dawawdaw'),
(82, 'dawawdaw'),
(83, 'dawawdaw'),
(84, 'dawawdaw'),
(85, 'dawawdaw'),
(86, 'dawawdaw'),
(87, 'dawawdaw'),
(88, 'dawawdaw'),
(89, 'dawawdaw'),
(90, 'dawawdaw'),
(91, 'dawawdaw'),
(92, 'dawawdaw'),
(93, 'dawawdaw'),
(94, 'dawawdaw'),
(95, 'dawawdaw'),
(96, 'dawawdaw'),
(97, 'dawawdaw'),
(98, 'dawawdaw'),
(99, 'dawawdaw'),
(100, 'dawawdaw'),
(101, 'dawawdaw'),
(102, 'dawawdaw'),
(103, 'dawawdaw'),
(104, 'awd@awd.com'),
(105, 'awd@awd.com'),
(106, 'rdg@dgr.com'),
(107, 'rdg@dgr.com'),
(108, 'rdg@dgr.com'),
(109, 'dica@awd'),
(110, 'adw@adw'),
(111, 'wqeawd@adw.com'),
(112, 'dica@dica.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`, `status`, `email`, `role`) VALUES
(128, 'Dimitrije', 'dica', '202cb962ac59075b964b07152d234b70', 'inactive', 'dica@dica.com', 'admin'),
(144, 'Dimitrije', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'active', 'admin@dica.com', 'admin'),
(145, 'Milos', 'dostavljac', '0bbb636c4241945f113c1fef71a115cf', 'active', 'dostavljac@dostavljac.com', 'dostavljac'),
(146, 'Nikola', 'kuvar', 'd44bb93f7b408a6da9045a40d103cbc6', 'active', 'kuvar@kuvar.com', 'kuvar'),
(149, 'Aleksa', 'korisnik', '202cb962ac59075b964b07152d234b70', 'active', 'aleksa@gmail.com', 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`) VALUES
(8, 'burgeri'),
(9, 'pizza'),
(10, 'pića'),
(13, 'pasta');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `active` varchar(10) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `active`, `categoryID`) VALUES
(4, 'Caesar Beef', 'Caesar zemička, dva reda 100% govedine, Emmentaler sir, paradajz, rukola, crveni luk, prženi luk i Caesar sos.', '490.00', 'burgers.jpeg', 'yes', 8),
(5, 'Caesar Chicken', 'Caesar zemička, panirano pileće belo meso Emmentaler sir, paradajz, rukola, crveni luk, prženi luk i Caesar sos.', '500.00', 'burger14.jpeg', 'yes', 8),
(6, 'Big Tasty Bacon', 'Big Tasty Bacon 🥓 se sastoji od zemičke, slanina, Emmentaler sira, 100% govedine, paradajza, frisee salate, crnog luka, Big Tasty sosa.', '450.00', 'burger15.jpg', 'yes', 8),
(7, 'Caesar Beef Jalapeno', 'Caesar zemička, dva reda 100% govedine, Emmentaler sir, paradajz, rukola, crveni luk, prženi luk, Jalapeño paprika i Caesar sos.', '500.00', 'burger16.jpg', 'yes', 8),
(8, 'Big Tasty Jalapeno', 'Big Tasty Jalapeño 🌶️ se sastoji od zemičke, Emmentaler sira, 100% govedine, paradajza, frisee salate, crnog luka i jalapeño ljute paprike.', '500.00', 'burger12.jpeg', 'yes', 8),
(9, 'Grand Dupli Jalapeno', 'Caesar zemička, dva reda 100% govedine, Emmentaler sir, paradajz, rukola, crveni luk, prženi luk i Caesar sos.', '700.00', 'buerger18.jpg', 'yes', 8),
(11, 'Capricciosa', 'Testo, pelat, šunka, sir, šampinjoni, kečap, paprika.', '780.00', 'pizza7.jpg', 'yes', 9),
(12, 'Quattro Formage', 'Rukola, sir, kačkavalj, masline, šampinjoni, kečap.', '900.00', 'pizza3.jpg', 'yes', 9),
(13, 'Fresh line Margarita', 'Testo, pelat, sir, paradajz, rukola, kečap, paprika', '750.00', 'pizza4.jpg', 'yes', 9),
(30, 'Coca Cola', 'Gazirano bezalkoholno piće', '50.00', 'cola.png', 'yes', 10),
(35, 'Fanta', 'Gazirano bezalkoholno piće', '50.00', 'fanta.png', 'yes', 10),
(36, 'Sprite', 'Gazirano bezalkoholno piće', '50.00', 'sprite.png', 'yes', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usernameID` (`usernameID`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id_coupons`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `usernameID` (`usernameID`);

--
-- Indexes for table `sastojci`
--
ALTER TABLE `sastojci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryID` (`categoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id_coupons` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `sastojci`
--
ALTER TABLE `sastojci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`usernameID`) REFERENCES `tbl_admin` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `tbl_food` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`usernameID`) REFERENCES `tbl_admin` (`id`);

--
-- Constraints for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD CONSTRAINT `tbl_food_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `tbl_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
