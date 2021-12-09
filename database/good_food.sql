-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 11:30 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `good_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`) VALUES
(1, 'vipin', 'vayu', '100', 'vipinnegi996@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `sub_heading` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `link_text` varchar(100) NOT NULL,
  `order_number` int(100) NOT NULL,
  `added_on` datetime NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `heading`, `sub_heading`, `link`, `link_text`, `order_number`, `added_on`, `status`) VALUES
(7, '733994726-slider-1.jpg', 'Drink and Healthy Food', 'Fresh Healthy and Organic 😃', 'shop', 'Order Now', 1, '2021-11-26 04:09:02', 1),
(8, '243300635-slider-2.jpg', 'THERE WILL NO NEXT', 'Come With Us', 'shop', 'Order Us', 2, '2021-11-26 04:13:58', 1),
(9, '541562193-slider-3.jpg', 'Food Is Good', 'Offer Available', 'shop', 'Welcome', 3, '2021-11-26 04:15:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) CHARACTER SET latin1 NOT NULL,
  `order_number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `order_number`, `status`, `added_on`) VALUES
(1, 'Category 1', 1, 1, '2021-11-18 17:40:59'),
(2, 'Category 2', 2, 1, '2021-11-19 17:40:59'),
(3, 'Category 3', 3, 1, '2021-11-20 17:42:06'),
(4, 'Category 4', 4, 1, '2021-11-21 17:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `added_on`) VALUES
(1, 'Vipin Negi', 'negivipin886@gmail.com', '9999999999', 'Rotten Food Received', 'Message Particular 1', '2021-11-27 09:57:38'),
(2, 'Ram', 'Ram@gmail.com', '8888888888', 'Late Delivery', 'Message 2.', '2021-11-27 09:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(20) CHARACTER SET latin1 NOT NULL,
  `coupon_type` enum('P','F') CHARACTER SET latin1 NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `expired_on` date NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `coupon_code`, `coupon_type`, `coupon_value`, `cart_min_value`, `expired_on`, `status`, `added_on`) VALUES
(1, 'Fifty50', 'F', 50, 98, '2021-12-04', 1, '2021-11-26 07:04:18'),
(2, 'TenTen10', 'F', 100, 20, '2021-12-06', 1, '2021-11-26 07:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mobile` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `name`, `mobile`, `password`, `status`, `added_on`) VALUES
(1, 'raju', '88262032311', 'raju', 1, '2021-03-16 10:48:25'),
(2, 'vipin', '8826203231', 'vipin', 1, '2021-03-16 10:48:25'),
(3, 'rahul', '88262032312', 'rahul', 1, '2021-03-31 07:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dish` varchar(100) CHARACTER SET latin1 NOT NULL,
  `dish_detail` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(100) CHARACTER SET latin1 NOT NULL,
  `type` enum('veg','non-veg') NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `category_id`, `dish`, `dish_detail`, `image`, `type`, `status`, `added_on`) VALUES
(1, 1, 'Dish 1', 'Dish Detail 1', '910798292-product-1.jpg', 'veg', 1, '2021-11-26 07:20:45'),
(2, 2, 'Dish 2', 'Dish Detail 2', '923466700-product-2.jpg', 'non-veg', 1, '2021-11-26 07:22:12'),
(3, 3, 'Dish 3', 'Dish Detail 3', '654288854-product-3.jpg', 'veg', 1, '2021-11-26 07:23:47'),
(4, 4, 'Dish 4', 'Dish Detail 4', '431155646-product-4.jpg', 'non-veg', 1, '2021-11-26 07:24:54'),
(5, 1, 'Dish 5', 'Dish Detail 5', '890295879-product-5.jpg', 'veg', 1, '2021-11-26 07:25:42'),
(6, 2, 'Dish 6', 'Dish Detail 6', '113166564-product-6.jpg', 'non-veg', 1, '2021-11-26 07:26:56'),
(7, 3, 'Dish 7', 'Dish Detail 7', '666693466-product-7.jpg', 'veg', 1, '2021-11-26 07:28:10'),
(8, 4, 'Dish 8', 'Dish Detail 8', '824967123-product-9.jpg', 'non-veg', 0, '2021-11-26 07:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `dish_cart`
--

CREATE TABLE `dish_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_detail_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dish_details`
--

CREATE TABLE `dish_details` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `attribute` varchar(100) CHARACTER SET latin1 NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_details`
--

INSERT INTO `dish_details` (`id`, `dish_id`, `attribute`, `price`, `status`, `added_on`) VALUES
(1, 1, 'Half', 100, 1, '2021-11-26 07:20:45'),
(2, 1, 'Full', 200, 1, '2021-11-26 07:20:45'),
(3, 2, 'Half', 20, 1, '2021-11-26 07:22:12'),
(4, 2, 'Full', 30, 1, '2021-11-26 07:22:12'),
(5, 2, 'Double Size', 60, 1, '2021-11-26 07:22:12'),
(6, 3, 'Half', 30, 1, '2021-11-26 07:23:47'),
(7, 4, 'Half', 20, 1, '2021-11-26 07:24:54'),
(8, 5, 'Half', 60, 1, '2021-11-26 07:25:42'),
(9, 5, 'Full', 80, 1, '2021-11-26 07:25:42'),
(10, 6, 'Half', 20, 1, '2021-11-26 07:26:56'),
(11, 6, 'Full ', 40, 1, '2021-11-26 07:26:56'),
(12, 6, 'Double Full ', 80, 1, '2021-11-26 07:26:56'),
(13, 7, 'Half Liter', 15, 1, '2021-11-26 07:28:10'),
(14, 7, 'Full Liter', 30, 1, '2021-11-26 07:28:10'),
(15, 8, 'Liquid Form', 100, 1, '2021-11-26 07:28:56'),
(16, 8, 'Solid Form', 200, 1, '2021-11-26 07:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_details_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `dish_details_id`, `price`, `qty`) VALUES
(1, 2, 1, 100, 1),
(2, 2, 3, 20, 1),
(3, 2, 6, 30, 3),
(4, 3, 1, 100, 10),
(5, 3, 5, 60, 10),
(6, 3, 6, 30, 9),
(7, 4, 3, 20, 3),
(8, 4, 8, 60, 17),
(9, 4, 7, 20, 17),
(10, 5, 3, 20, 3),
(11, 5, 8, 60, 17),
(12, 5, 7, 20, 17),
(13, 6, 3, 20, 7),
(14, 6, 6, 30, 4),
(15, 7, 1, 100, 2),
(16, 7, 6, 30, 4),
(17, 7, 10, 20, 2),
(18, 8, 1, 100, 2),
(19, 8, 6, 30, 4),
(20, 8, 10, 20, 2),
(21, 9, 1, 100, 2),
(22, 9, 6, 30, 4),
(23, 9, 10, 20, 2),
(24, 10, 1, 100, 2),
(25, 10, 6, 30, 4),
(26, 10, 10, 20, 2),
(27, 11, 1, 100, 2),
(28, 11, 6, 30, 4),
(29, 11, 10, 20, 2),
(30, 11, 8, 60, 4),
(31, 11, 7, 20, 3),
(32, 12, 1, 100, 2),
(33, 12, 6, 30, 4),
(34, 12, 10, 20, 2),
(35, 12, 8, 60, 4),
(36, 12, 7, 20, 3),
(37, 1, 14, 30, 1),
(38, 1, 1, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mobile` varchar(50) CHARACTER SET latin1 NOT NULL,
  `address` text CHARACTER SET latin1 NOT NULL,
  `total_price` float NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `final_price` float NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `payment_status` varchar(11) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `order_status` int(11) NOT NULL,
  `cancel_by` enum('user','admin') NOT NULL,
  `cancel_at` datetime NOT NULL,
  `added_on` datetime NOT NULL,
  `delivered_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `user_id`, `name`, `email`, `mobile`, `address`, `total_price`, `coupon_code`, `final_price`, `zipcode`, `delivery_boy_id`, `payment_status`, `payment_type`, `payment_id`, `order_status`, `cancel_by`, `cancel_at`, `added_on`, `delivered_on`) VALUES
(1, 1, 'vayuanada', 'radhanegi996@gmail.com', '7291049887', ' Delhi Khichripue', 130, 'Fifty50', 80, ' 110091', 0, 'success', 'paytm', '20211127111212800110168017103207833', 1, '', '0000-00-00 00:00:00', '2021-11-27 03:17:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_status`) VALUES
(1, 'Pending'),
(2, 'Cooking '),
(3, 'On the Way'),
(4, 'Delivered'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_detail_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `cart_min_price` int(11) NOT NULL,
  `cart_min_price_msg` varchar(250) NOT NULL,
  `website_close` int(11) NOT NULL,
  `wallet_amt` int(11) NOT NULL,
  `website_close_msg` varchar(250) NOT NULL,
  `referral_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `cart_min_price`, `cart_min_price_msg`, `website_close`, `wallet_amt`, `website_close_msg`, `referral_amt`) VALUES
(1, 50, 'Cart Balance is not sufficient', 0, 80, 'WEBSITE CLOSED', 70);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` int(10) NOT NULL,
  `email_verify` varchar(40) NOT NULL,
  `rand_str` varchar(20) NOT NULL,
  `referral_code` varchar(20) NOT NULL,
  `from_referral_code` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `mobile`, `password`, `status`, `email_verify`, `rand_str`, `referral_code`, `from_referral_code`, `added_on`) VALUES
(1, 'vayuanada', 'radhanegi996@gmail.com', '7291049887', '$2y$10$8LRVMxzA5ZVHYTxfVWpAzeGofDYDYgVdsr/Kg6AC8t6btIPUu5ooC', 1, '1', 'ufysmyjhtkavdsq', 'bfdplwlcuhtzzmf', '', '2021-11-26 08:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `userorderids`
--

CREATE TABLE `userorderids` (
  `id` int(10) NOT NULL,
  `userid` int(10) DEFAULT NULL,
  `orderid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userorderids`
--

INSERT INTO `userorderids` (`id`, `userid`, `orderid`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 4),
(5, 1, 6),
(6, 1, 7),
(7, 1, 8),
(8, 1, 9),
(9, 1, 10),
(10, 1, 11),
(11, 1, 12),
(12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amt` int(11) NOT NULL,
  `msg` varchar(200) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `payment_id` varchar(200) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `amt`, `msg`, `type`, `payment_id`, `added_on`) VALUES
(1, 1, 2000, 'Added', 'in', '20211127111212800110168869403195129', '2021-11-27 03:15:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_cart`
--
ALTER TABLE `dish_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_details`
--
ALTER TABLE `dish_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userorderids`
--
ALTER TABLE `userorderids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dish_cart`
--
ALTER TABLE `dish_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dish_details`
--
ALTER TABLE `dish_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userorderids`
--
ALTER TABLE `userorderids`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
