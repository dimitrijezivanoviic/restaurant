-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 11:58 PM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `product_code`, `usernameID`) VALUES
(466, 'Caesar Beef', '490.00', 'burgers.jpeg', 1, '490', 4, 144),
(467, 'Caesar Chicken', '500.00', 'burger14.jpeg', 1, '500', 5, 144),
(478, 'Big Tasty Bacon', '450.00', 'burger15.jpg', 1, '450', 6, 144),
(494, 'Caesar Chicken', '500.00', 'burger14.jpeg', 1, '500', 5, 146),
(526, 'Caesar Beef', '490.00', 'burgers.jpeg', 1, '490', 4, 166),
(527, 'Caesar Chicken', '500.00', 'burger14.jpeg', 1, '500', 5, 166),
(528, 'Capricciosa', '780.00', 'pizza7.jpg', 1, '780', 11, 165),
(529, 'Quattro Formage', '900.00', 'pizza3.jpg', 1, '900', 12, 165),
(530, 'Fanta', '50.00', 'fanta.png', 1, '50', 35, 165),
(531, 'Coca Cola', '50.00', 'cola.png', 1, '50', 30, 165),
(532, 'Caesar Beef', '490.00', 'burgers.jpeg', 1, '490', 4, 165);

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
(186, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0641235567', 'Beograd', 'Srpskog Sovjeta 10', '', ' Fanta x 1,  Caesar Beef x 1,  Caesar Beef Jalapeno x 1, ', '1040', 'completed', 'no', '2021-09-22 02:36:14'),
(188, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0642845711', 'Beograd', 'Srpskog Sovjeta 10', '', ' Caesar Chicken x 2,  Big Tasty Bacon x 2,  Capricciosa x 3,  Coca Cola x 2,  Fanta x 2, ', '4440', 'completed', 'no', '2021-09-21 11:21:51'),
(189, 'Dimitrije Zivanovic', 'dimitrije@gmail.com', 144, '0642845711', 'Beograd', 'Srpskog Sovjeta 10', '', ' Caesar Beef x 1, ', '490', 'completed', 'no', '2021-09-21 11:22:39'),
(190, 'Dimitrije Zivanovic', 'admin@admin.com', 144, '0642845711', 'Beograd', 'Srpskog Sovjeta 10', '', ' Caesar Chicken x 1,  Caesar Beef Jalapeno x 1, ', '1000', 'completed', 'no', '2021-09-29 11:23:03'),
(220, 'Dimitrije Zivanovic', 'dimitrije@gmail.com', 165, '0641234567', 'Beograd', 'Savski nasip', '', ' Caesar Beef x 2,  Capricciosa x 3,  Quattro Formage x 1,  Coca Cola x 1, ', '4270', 'completed', 'no', '2022-03-02 23:16:03'),
(221, 'Dimitrije Zivanovic', 'dimitrije@gmail.com', 165, '0641234567', 'Beograd', 'Savski nasip', '', ' Caesar Chicken x 1,  Caesar Beef Jalapeno x 1,  Grand Dupli Jalapeno x 1, ', '1700', 'completed', 'no', '2022-03-02 23:20:47'),
(222, 'Dimitrije Zivanovic', 'dimitrije@gmail.com', 165, '0641234567', 'Beograd', 'Savski nasip', '', ' Caesar Beef x 1,  Fresh line Margarita x 1,  Capricciosa x 1,  Fanta x 1, ', '2070', 'completed', 'no', '2022-03-02 23:20:49'),
(223, 'Dimitrije Zivanovic', 'dimitrije@gmail.com', 165, '0641234567', 'Beograd', 'Savski nasip', '', ' Capricciosa x 1,  Fanta x 1, ', '830', 'completed', 'no', '2022-03-02 23:20:50'),
(224, 'Dimitrije Zivanovic', 'dimitrije@gmail.com', 165, '0641234567', 'Beograd', 'Savski nasip', '', ' Caesar Beef x 1,  Caesar Chicken x 1,  Big Tasty Bacon x 1, ', '1440', 'completed', 'no', '2022-03-02 23:20:50'),
(227, 'Nikola Zivanovic', 'nikola@gmail.com', 166, '0641234567', 'Beograd', 'Savski nasip', '', ' Caesar Beef x 1,  Caesar Chicken x 1,  Capricciosa x 1, ', '1770', 'preuzeo dostavljac', 'no', '2022-03-02 23:39:12'),
(228, 'Nikola Zivanovic', 'nikola@gmail.com', 166, '0641234567', 'Beograd', 'Savski nasip', '', ' Big Tasty Bacon x 1,  Caesar Beef Jalapeno x 1,  Capricciosa x 1,  Fanta x 1, ', '1780', 'ceka dostavu', 'no', '2022-03-02 23:49:06'),
(229, 'Nikola Zivanovic', 'nikola@gmail.com', 166, '0641234567', 'Beograd', 'Savski nasip', '', ' Capricciosa x 1, ', '780', 'priprema', 'no', '2022-03-02 23:59:02'),
(230, 'Nikola Zivanovic', 'nikola@gmail.com', 166, '0641234567', 'Beograd', 'Savski nasip', '', ' Caesar Chicken x 1,  Sprite x 3, ', '650', 'ordered', 'no', '2022-03-03 00:12:31'),
(231, 'Nikola Zivanovic', 'nikola@gmail.com', 166, '0641234567', 'Beograd', 'Savski nasip', '', ' Caesar Beef Jalapeno x 1, ', '500', 'canceled', 'no', '2022-03-02 23:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `recepti`
--

CREATE TABLE `recepti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `kategorija` varchar(255) NOT NULL,
  `sastojci` varchar(255) NOT NULL,
  `opis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recepti`
--

INSERT INTO `recepti` (`id`, `naziv`, `kategorija`, `sastojci`, `opis`) VALUES
(10, 'Pizza margarita', '9', 'Prilozi:  Voda, so, brašno, pelat, mozzarella,', 'Staviite pellat u činiju, a nakon toga nalijte malo ekstra devičanskog maslinovog ulja, posolite i prodinstajte dok se malo ne zgusne da dobije gustinu sosa.');

-- --------------------------------------------------------

--
-- Table structure for table `sastojci`
--

CREATE TABLE `sastojci` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sastojci`
--

INSERT INTO `sastojci` (`id`, `name`, `image`, `status`, `categoryID`) VALUES
(1, 'kačkavalj', 'kackavalj.jpg', 'active', 9),
(2, 'origano', 'origano.jpg', 'active', 9),
(3, 'kečap', 'kecap.jpg', 'active', 9),
(4, 'pečurke', 'pecurke.jpg', 'active', 9),
(5, 'masline', 'masline.jpg', 'active', 9),
(6, 'pršut', 'prsut.jpg', 'active', 9),
(9, 'Voda', 'voda.jpg', 'active', 14),
(10, 'so', 'so.png', 'active', 14),
(11, 'biber', 'biber.jpg', 'active', 14),
(12, 'brašno', 'brasno.jpg', 'active', 14),
(13, 'slanina', 'slanina.png', 'active', 13),
(14, 'šunka', 'sunka.jpg', 'active', 9),
(15, 'luk', 'luk.jpg', 'active', 9),
(16, 'papričica', 'papricica.png', 'active', 9),
(17, 'pelat', 'pelat.jpg', 'active', 9),
(18, 'mozzarella', 'mozzarella.png', 'active', 9),
(19, 'kozji sir', 'kozji isr.jpg', 'active', 9),
(20, 'čili', 'cili.jpg', 'active', 9),
(21, 'majonez', 'majonez.jpg', 'active', 9),
(22, 'rukola', 'rukola.jpg', 'active', 9);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(144, 'Dimitrije', 'admin', '0192023a7bbd73250516f069df18b500', 'active', 'admin@admin.com', 'admin'),
(146, 'Nikola', 'kuvar', '46525807d4067269d8567dc7137aec4e', 'active', 'kuvar@kuvar.com', 'kuvar'),
(150, 'Miloš', 'dostavljac', '88fd731149832d64babdff8b11fcaf9d', 'active', 'dostavljac@dostavljac.com', 'dostavljac'),
(165, 'Dimitrije', 'dimitrije', 'd6511f6f72a6d3061ba7eb9fc63f45d7', 'active', 'dimitrije@gmail.com', 'korisnik'),
(166, 'Nikola', 'nikola', 'a646e457db47ad218d6d9d3ce325878b', 'active', 'nikola@gmail.com', 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `food` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `food`) VALUES
(8, 'burgeri', 'yes'),
(9, 'pizza', 'yes'),
(10, 'pića', 'no'),
(13, 'pasta', 'yes'),
(14, 'Osnovni sastojci', 'no');

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
-- Indexes for table `recepti`
--
ALTER TABLE `recepti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sastojci`
--
ALTER TABLE `sastojci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryID` (`categoryID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=533;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id_coupons` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `recepti`
--
ALTER TABLE `recepti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sastojci`
--
ALTER TABLE `sastojci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
-- Constraints for table `sastojci`
--
ALTER TABLE `sastojci`
  ADD CONSTRAINT `sastojci_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `tbl_category` (`id`);

--
-- Constraints for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD CONSTRAINT `tbl_food_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `tbl_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
