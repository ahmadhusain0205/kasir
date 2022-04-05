-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 12:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pointofsale`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `code` varchar(200) NOT NULL,
  `categori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`code`, `categori`) VALUES
('SC', 'Snack'),
('MN', 'Minuman'),
('MK', 'Makanan'),
('ST', 'satuan'),
('OBT', 'obat');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `address`, `phone`) VALUES
(13, 'umum', 'umum', '000999000999');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `categori_code` varchar(200) NOT NULL,
  `stock_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`code`, `name`, `price`, `purchase`, `categori_code`, `stock_id`) VALUES
('098098', 'Sabun Lifeboy', 6000, 8000, 'ST', 999),
('123', 'susu', 11000, 15000, 'MN', 992),
('123123', 'nabati', 10000, 12000, 'MK', 1000),
('123123123123', 'Sosis', 7000, 10000, 'MN', 98),
('123222', 'mixagrib', 1000, 2000, 'OBT', 1000),
('123321', 'oreo', 4500, 5000, 'SC', 990);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `status`) VALUES
(1, 'administartor'),
(2, 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_login` int(11) NOT NULL,
  `time_logout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id`, `user_id`, `time_login`, `time_logout`) VALUES
(208, 39, 1647740588, 1649135125),
(209, 39, 1648618213, 1649135125),
(210, 39, 1649135029, 1649135125);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `cek` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `beli` int(11) NOT NULL,
  `jual` int(11) NOT NULL,
  `keuntungan` int(11) DEFAULT NULL,
  `sub_total_jual` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `invoice`, `code`, `type`, `detail`, `supplier_id`, `qty`, `date`, `created`, `user_id`, `discount`, `purchase`, `price`) VALUES
(86, 'WA2201010001', '123', 'out', 'terjual', 0, 10, '2022-01-01', '2022-01-01 14:45:36', 39, 0, 0, 0),
(87, 'WA2201030001', '123', 'out', 'terjual', 0, 90, '2022-01-03', '2022-01-03 09:11:46', 39, 0, 0, 0),
(89, 'WA2201030002', '123', 'in', 'kulakan', 10, 100, '2022-01-03', '2022-01-03 09:13:25', 39, 0, 0, 0),
(90, 'WA2201030002', '123', 'out', 'kadaluarsa', NULL, 10, '2022-01-03', '2022-01-03 09:13:50', 39, 0, 0, 0),
(91, 'WA2201030002', '123', 'out', 'terjual', 0, 1, '2022-01-03', '2022-01-03 09:33:14', 39, 0, 0, 0),
(94, 'WA2201030003', '123', 'in', 'kulakan', 10, 11, '2022-01-03', '2022-01-03 17:05:51', 39, 0, 0, 0),
(96, 'WA2201030003', '123', 'out', 'rusak', NULL, 20, '2022-01-03', '2022-01-03 17:06:54', 39, 0, 0, 0),
(97, 'WA2202020001', '123', 'out', 'terjual', 0, 7, '2022-02-02', '2022-02-02 20:47:49', 39, 5000, 15000, 0),
(98, 'WA2202020002', '123', 'out', 'terjual', 0, 5, '2022-02-02', '2022-02-02 20:51:09', 39, 3000, 15000, 0),
(99, 'WA2202020002', '123123', 'out', 'terjual', 0, 4, '2022-02-02', '2022-02-02 20:51:09', 39, 0, 12000, 0),
(100, 'WA2202040001', '123', 'out', 'terjual', 0, 3, '2022-02-04', '2022-02-04 09:40:17', 39, 5000, 15000, 0),
(101, 'WA2202040001', '123123', 'out', 'terjual', 0, 2, '2022-02-04', '2022-02-04 09:40:17', 39, 0, 12000, 0),
(102, 'WA2202040001', '123222', 'out', 'terjual', 0, 1, '2022-02-04', '2022-02-04 09:40:17', 39, 0, 2000, 0),
(103, 'WA2202040001', '123321', 'out', 'terjual', 0, 5, '2022-02-04', '2022-02-04 09:40:17', 39, 1000, 5000, 0),
(104, 'WA2202060001', '123', 'out', 'terjual', 0, 1, '2022-02-06', '2022-02-06 23:52:51', 39, 0, 15000, 0),
(105, 'WA2202060001', '098098', 'out', 'terjual', 0, 5, '2022-02-06', '2022-02-06 23:52:51', 39, 0, 8000, 0),
(106, 'WA2202060001', '123123', 'out', 'terjual', 0, 1, '2022-02-06', '2022-02-06 23:52:51', 39, 2000, 12000, 0),
(107, 'WA2202060001', '123222', 'out', 'terjual', 0, 5, '2022-02-06', '2022-02-06 23:52:51', 39, 0, 2000, 0),
(108, 'WA2202060001', '123321', 'out', 'terjual', 0, 1, '2022-02-06', '2022-02-06 23:52:51', 39, 0, 5000, 0),
(109, 'WA2202060001', '123', 'in', 'kulakan', 10, 36, '2022-02-06', '2022-02-07 00:04:43', 39, 0, 0, 0),
(110, 'WA2202060001', '098098', 'in', 'tambahan', 10, 5, '2022-02-06', '2022-02-07 00:05:00', 39, 0, 0, 0),
(111, 'WA2202060001', '123123', 'in', 'tambahan', 10, 7, '2022-02-06', '2022-02-07 00:05:14', 39, 0, 0, 0),
(112, 'WA2202060001', '123222', 'in', 'tambahan', 10, 6, '2022-02-06', '2022-02-07 00:05:29', 39, 0, 0, 0),
(113, 'WA2202060001', '123321', 'in', 'kulakan', 10, 881, '2022-02-06', '2022-02-07 00:05:58', 39, 0, 0, 0),
(114, 'WA2202180001', '123', 'out', 'terjual', 0, 1, '2022-02-18', '2022-02-18 18:13:07', 39, 0, 15000, 10000),
(115, 'WA2202180002', '123', 'out', 'terjual', 0, 1, '2022-02-18', '2022-02-18 18:14:33', 39, 0, 15000, 11000),
(116, 'WA2202180003', '123123123123', 'out', 'terjual', 0, 1, '2022-02-18', '2022-02-18 18:16:59', 39, 0, 11000, 9000),
(117, 'WA2202180004', '123123123123', 'out', 'terjual', 0, 1, '2022-02-18', '2022-02-18 18:18:33', 39, 0, 10000, 7000),
(118, 'WA2202180005', '123', 'out', 'terjual', 0, 5, '2022-02-18', '2022-02-18 18:21:18', 39, 200, 15000, 11000),
(119, 'WA2202180005', '123321', 'out', 'terjual', 0, 10, '2022-02-18', '2022-02-18 18:21:18', 39, 2000, 5000, 4500),
(120, 'WA2202250001', '123', 'out', 'terjual', 0, 1, '2022-02-25', '2022-02-25 14:42:49', 39, 0, 15000, 11000),
(121, 'WA2202250001', '098098', 'out', 'terjual', 0, 1, '2022-02-25', '2022-02-25 14:42:50', 39, 0, 8000, 6000),
(122, 'WA2202250001', '123', 'out', 'terjual', 0, 1, '2022-02-25', '2022-02-25 14:42:58', 39, 0, 15000, 11000),
(123, 'WA2202250001', '098098', 'out', 'terjual', 0, 1, '2022-02-25', '2022-02-25 14:42:58', 39, 0, 8000, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `phone`, `address`, `description`, `created`, `updated`) VALUES
(10, 'umum', '12345678901', 'umum', 'umum', '2021-12-09 01:34:25', '2021-12-23 14:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `sale_id` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `sub_purchase` int(11) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `changes` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_done`
--

CREATE TABLE `transaction_done` (
  `id` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `sub_purchase` int(11) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_done`
--

INSERT INTO `transaction_done` (`id`, `created`, `user_id`, `invoice`, `sub_total`, `sub_purchase`, `profit`) VALUES
(59, '2022-01-01', 39, 'WA2201010001', 135000, 100000, 35000),
(60, '2022-01-03', 39, 'WA2201030001', 1080000, 900000, 180000),
(61, '2022-01-03', 39, 'WA2201030002', 15000, 10000, 5000),
(62, '2022-02-02', 39, 'WA2202020001', 100000, 70000, 30000),
(63, '2022-02-02', 39, 'WA2202020002', 120000, 90000, 30000),
(64, '2022-02-04', 39, 'WA2202040001', 90000, 73500, 16500),
(65, '2022-02-06', 39, 'WA2202060001', 80000, 59500, 20500),
(66, '2022-02-18', 39, 'WA2202180001', 15000, 10000, 5000),
(67, '2022-02-18', 39, 'WA2202180002', 15000, 11000, 4000),
(68, '2022-02-18', 39, 'WA2202180003', 11000, 9000, 2000),
(69, '2022-02-18', 39, 'WA2202180004', 10000, 7000, 3000),
(70, '2022-02-18', 39, 'WA2202180005', 122800, 100000, 22800),
(71, '2022-02-25', 39, 'WA2202250001', 23000, 17000, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(200) NOT NULL,
  `on_off` int(11) NOT NULL,
  `is_actived` int(1) NOT NULL COMMENT '0. belum aktif, 1. aktif, ',
  `date_created` int(11) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1. admin, 2. kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `image`, `phone`, `address`, `on_off`, `is_actived`, `date_created`, `level`) VALUES
(39, 'admin', '$2y$10$xbzzdHBqj6.FM9k4frP1lOmTJweO.9MsnVcsGOSeS3sBv3mohTJGu', 'Admin', 'default.png', '1231222222222', 'kajoran', 0, 1, 1640247947, 1),
(41, 'kasir', '$2y$10$N75yojITL6bmxgE1RQFrA.RDleQyf39BMISTrr3Hz4R2JWGbNRYve', 'kasir', 'default.png', '111111111', 'kajoran', 0, 1, 1640264204, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `transaction_done`
--
ALTER TABLE `transaction_done`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=788;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `transaction_done`
--
ALTER TABLE `transaction_done`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
