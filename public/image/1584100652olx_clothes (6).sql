-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 09, 2020 at 05:28 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olx_clothes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'Jigu Bhikadiya', 'jenijivani8@gmail.com', '$2y$10$/vdDbknA4x1aa5nwJ8Jkput3aDweZSbeNtnWZMMVSAFotl522vggm', '1583397051IMG-20200206-WA0013.jpg', '2020-01-06 11:36:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `c_name`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Summer Wear', 'Active', '2020-01-02 07:16:39', '2020-01-02 07:16:39'),
(8, 'Winter Wear', 'Active', '2020-01-02 07:15:33', '2020-01-02 07:15:33'),
(11, 'Western Wear', 'Active', '2020-01-03 12:17:46', NULL),
(12, 'Wedding Wear', 'Active', '2020-01-03 12:17:46', NULL),
(25, 'Party Wear', 'Active', '2020-01-08 12:25:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

DROP TABLE IF EXISTS `contactus`;
CREATE TABLE IF NOT EXISTS `contactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Reena', 'patelreena172@gmail.com', '6359867410', 'hello', '2020-03-07 08:08:39', NULL),
(2, 'Radhi Dhameliya', 'dhameliyaruhi@gmail.com', NULL, 'hello good morning', '2020-03-07 08:09:33', NULL),
(5, 'Jigu Bhikadiya', 'jenijivani8@gmail.com', '9836453620', 'huuuuu', '2020-03-07 11:18:17', NULL),
(10, 'Patel Reena', 'patelreena172@gmail.com', '9865471230', 'your product is really very nice', '2020-03-09 04:55:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delete_message`
--

DROP TABLE IF EXISTS `delete_message`;
CREATE TABLE IF NOT EXISTS `delete_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `files` varchar(500) DEFAULT NULL,
  `sellerread_status` varchar(50) NOT NULL,
  `buyerread_status` varchar(50) NOT NULL,
  `sellerfavourite_status` varchar(50) DEFAULT NULL,
  `buyerfavourite_status` varchar(50) DEFAULT NULL,
  `sellerimportant_status` varchar(50) DEFAULT NULL,
  `buyerimportant_status` varchar(50) DEFAULT NULL,
  `draft_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delete_message`
--

INSERT INTO `delete_message` (`id`, `msg_id`, `sender_id`, `receiver_id`, `message`, `files`, `sellerread_status`, `buyerread_status`, `sellerfavourite_status`, `buyerfavourite_status`, `sellerimportant_status`, `buyerimportant_status`, `draft_status`, `created_at`, `updated_at`) VALUES
(108, 55, 99, 100, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, 'Success', '2020-03-03 04:47:27', NULL),
(107, 56, 100, 99, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, 'Success', '2020-03-03 04:47:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `files` varchar(500) DEFAULT NULL,
  `sellerread_status` varchar(50) DEFAULT NULL,
  `buyerread_status` varchar(50) DEFAULT NULL,
  `sellerfavourite_status` varchar(50) DEFAULT NULL,
  `buyerfavourite_status` varchar(50) DEFAULT NULL,
  `sellerimportant_status` varchar(255) DEFAULT NULL,
  `buyerimportant_status` varchar(255) DEFAULT NULL,
  `draft_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `product_id`, `sender_id`, `receiver_id`, `message`, `files`, `sellerread_status`, `buyerread_status`, `sellerfavourite_status`, `buyerfavourite_status`, `sellerimportant_status`, `buyerimportant_status`, `draft_status`, `created_at`, `updated_at`) VALUES
(63, 1166, 100, 99, 'hello i am reena', NULL, '1', '0', NULL, NULL, NULL, NULL, 'Success', '2020-03-05 12:33:28', NULL),
(62, 1166, 100, 99, 'hello', NULL, '0', '0', NULL, NULL, NULL, NULL, 'Success', '2020-03-05 12:03:14', NULL),
(61, NULL, 100, 103, 'hyy', NULL, '0', '0', NULL, NULL, NULL, NULL, 'Success', '2020-03-05 09:29:01', NULL),
(60, NULL, 100, 103, 'hello vasu', NULL, '0', '1', NULL, NULL, NULL, NULL, 'Success', '2020-03-03 09:38:01', NULL),
(59, NULL, 103, 100, 'hello reena', NULL, '0', '1', NULL, NULL, NULL, NULL, 'Success', '2020-03-03 09:32:51', NULL),
(50, NULL, 103, 102, 'Hiii Dhara', NULL, '0', '0', NULL, NULL, NULL, NULL, 'Success', '2020-02-28 08:52:50', NULL),
(49, NULL, 103, 100, 'Hello Reena Didi i am Vasu', NULL, '0', '1', NULL, NULL, NULL, 'Important', 'Success', '2020-02-28 08:52:28', NULL),
(48, 151, 100, 103, 'Hi Vasu I M Reena Vaghasiya', NULL, '1', '1', NULL, NULL, NULL, NULL, 'Success', '2020-02-28 08:50:36', NULL),
(52, NULL, 99, 100, 'hii Reena', NULL, '0', '1', NULL, 'Favourite', NULL, NULL, 'Success', '2020-02-28 08:53:47', NULL),
(45, 150, 102, 99, 'hello radhi i am Dhara', NULL, '1', '0', NULL, NULL, 'Important', NULL, 'Success', '2020-02-28 08:49:06', NULL),
(46, 151, 102, 103, 'hi vasu i am dhara', NULL, '1', '0', NULL, NULL, NULL, NULL, 'Success', '2020-02-28 08:49:32', NULL),
(47, 150, 100, 99, 'hello radhi i am Reena', NULL, '1', '1', 'Favourite', NULL, NULL, NULL, 'Success', '2020-02-28 08:50:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `notification` varchar(300) NOT NULL,
  `read_status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `pro_id`, `notification`, `read_status`, `created_at`, `updated_at`) VALUES
(94, 1165, 'Your Product Has been Approve', '1', '2020-03-05 05:53:35', NULL),
(93, 1166, 'Your Product Has been Approve', '1', '2020-03-05 05:46:20', NULL),
(92, 1167, 'Your Product Has been Approve', '0', '2020-03-05 05:46:16', NULL),
(91, 1164, 'Your Product Has been Decline', '0', '2020-03-04 07:45:11', NULL),
(90, 1163, 'Your Product Has been Decline', '0', '2020-03-04 06:53:51', NULL),
(89, 1162, 'Your Product Has been Decline', '0', '2020-03-04 06:48:49', NULL),
(88, 1161, 'Your Product Has been Decline', '0', '2020-03-04 06:48:48', NULL),
(87, 1160, 'Your Product Has been Decline', '0', '2020-03-04 06:48:47', NULL),
(86, 1159, 'Your Product Has been Decline', '0', '2020-03-04 06:48:47', NULL),
(85, 1158, 'Your Product Has been Decline', '0', '2020-03-04 06:48:46', NULL),
(84, 154, 'Your Product Has been Approve', '1', '2020-03-03 10:10:08', NULL),
(83, 1154, 'Your Product Has been Decline', '0', '2020-03-03 10:10:05', NULL),
(82, 151, 'Your Product Has been Decline', '1', '2020-03-03 10:09:57', NULL),
(81, 150, 'Your Product Has been Decline', '1', '2020-03-03 10:06:32', NULL),
(80, 152, 'Your Product Has been Approve', '0', '2020-03-03 10:06:28', NULL),
(79, 153, 'Your Product Has been Approve', '0', '2020-03-03 10:06:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `ptitle` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `condition_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1168 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `s_id`, `c_id`, `type`, `ptitle`, `description`, `price`, `condition_type`, `status`, `created_at`, `updated_at`) VALUES
(1167, 99, 9, 'men', 'Summer Dress', 'summer shirt', 700, 'New', 'Active', '2020-03-05 05:46:02', '2020-03-05 05:19:10'),
(1165, 99, 11, 'men', 'Western Dress', 'Men Western Dress', 500, 'Used', 'Active', '2020-03-05 05:39:32', NULL),
(1166, 99, 25, 'men', 'Party Dress', 'Men Party Dress', 500, 'Used', 'Active', '2020-03-05 05:41:19', '2020-03-05 02:45:24'),
(1157, 106, 25, 'men', 'Party Dress', 'Black Jacket and White Shirt Party Dress For Man', 800, 'Used', 'Decline', '2020-02-28 11:03:40', '2020-02-28 05:43:59'),
(1156, 106, 12, 'woman', 'Wedding Wear', 'Red Wedding Choli For Bride', 15000, 'Used', 'Active', '2020-02-28 11:01:50', '2020-02-28 05:47:29'),
(1155, 106, 11, 'woman', 'Western Dress', 'Black and White Western Dress For Woman', 800, 'New', 'Active', '2020-02-28 11:01:04', NULL),
(1154, 103, 12, 'men', 'Wedding Dress', 'Blue Wedding Shervani for Man', 1500, 'Used', 'Decline', '2020-02-28 10:59:49', '2020-03-03 05:28:48'),
(154, 103, 25, 'woman', 'party Dress', 'Red Party Wear Dress', 700, 'Used', 'Active', '2020-02-28 10:56:51', '2020-03-03 04:45:02'),
(151, 103, 8, 'men', 'Winter Dress', 'Blue  Sweater', 250, 'Used', 'Decline', '2020-02-27 11:17:41', '2020-03-03 04:39:47'),
(150, 99, 9, 'woman', 'Summer Dress', 'simple white summer Dress', 250, 'Used', 'Pendding', '2020-02-27 08:27:56', '2020-03-05 00:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `p_id`, `image`, `created_at`, `updated_at`) VALUES
(129, 1166, '1583386879party_men3.jpg', '2020-03-05 05:41:19', NULL),
(130, 1167, '1583398782summer_men3.jpg', '2020-03-05 05:46:02', '2020-03-05 08:59:42'),
(117, 1154, '1582887589wedding_men2.jpg', '2020-02-28 10:59:49', NULL),
(118, 1155, '1582887664western_woman5.jpg', '2020-02-28 11:01:04', NULL),
(119, 1156, '1582887710wedding_woman4.jpg', '2020-02-28 11:01:50', NULL),
(120, 1157, '1582887820party_men2.jpg', '2020-02-28 11:03:40', NULL),
(128, 1165, '1583386772western_men1.jpg,1583386772western_men2.png', '2020-03-05 05:39:32', NULL),
(116, 154, '1582887411party_woman4.jpg', '2020-02-28 10:56:51', NULL),
(112, 150, '1582792076summer_woman3.jpg', '2020-02-27 08:27:56', '2020-02-28 10:57:51'),
(113, 151, '1582802261winter_men3.jpg', '2020-02-27 11:17:41', '2020-02-28 10:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `StateID` int(11) NOT NULL AUTO_INCREMENT,
  `StateName` varchar(50) NOT NULL,
  PRIMARY KEY (`StateID`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateID`, `StateName`) VALUES
(1, 'ANDHRA PRADESH'),
(2, 'ASSAM'),
(3, 'ARUNACHAL PRADESH'),
(4, 'GUJRAT'),
(5, 'BIHAR'),
(6, 'HARYANA'),
(7, 'HIMACHAL PRADESH'),
(8, 'JAMMU & KASHMIR'),
(9, 'KARNATAKA'),
(10, 'KERALA'),
(11, 'MADHYA PRADESH'),
(12, 'MAHARASHTRA'),
(13, 'MANIPUR'),
(14, 'MEGHALAYA'),
(15, 'MIZORAM'),
(16, 'NAGALAND'),
(17, 'ORISSA'),
(18, 'PUNJAB'),
(19, 'RAJASTHAN'),
(20, 'SIKKIM'),
(21, 'TAMIL NADU'),
(22, 'TRIPURA'),
(23, 'UTTAR PRADESH'),
(24, 'WEST BENGAL'),
(25, 'DELHI'),
(26, 'GOA'),
(27, 'PONDICHERY'),
(28, 'LAKSHDWEEP'),
(29, 'DAMAN & DIU'),
(30, 'DADRA & NAGAR'),
(31, 'CHANDIGARH'),
(32, 'ANDAMAN & NICOBAR'),
(33, 'UTTARANCHAL'),
(34, 'JHARKHAND'),
(35, 'CHATTISGARH');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` int(11) NOT NULL,
  `remember_token` text,
  `phone` varchar(20) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `type`, `fname`, `lname`, `email`, `password`, `gender`, `address`, `city`, `state`, `remember_token`, `phone`, `profile_image`, `status`, `created_at`, `updated_at`) VALUES
(99, 'S', 'Radhi', 'Dhameliya', 'dhameliyaruhi@gmail.com', '$2y$10$g6gEY1nYtnz5suVfMOL8me0g9OylUlHK6Z.MKSjk/6yVFuZ/mOsnC', 'Female', 'Gariyadhar', 'Bhavangar', 4, '583750', '6359867410', '1582793316wedding_woman2.jpg', 'Active', '2020-02-27 08:15:37', '2020-02-27 06:43:10'),
(100, 'B', 'Reena', 'Vaghasiya', 'patelreena172@gmail.com', '$2y$10$uRmdiwGwBOqTzyM94AlpouHNjGBkVkZ9yWmcwmQrK4/jRsaNxEUHO', 'Female', 'Mota Ankadiya', 'Amreli', 4, '634239', '9685741230', '1582794183wedding_woman14.jpg', 'Active', '2020-02-27 08:18:12', '2020-02-27 06:47:40'),
(102, 'B', 'Dhara', 'Vaghasiya', 'dharapatel@gmail.com', '$2y$10$IQYickwU0HGnl13mh8PlTeEz82BDCyJUPwGHHEtdb2BSyaU6wc3PS', 'Female', 'A-35, Harikunj Near CNG Patrol Pump', 'Surat', 4, NULL, '7485966352', '1582799955western_woman3.jpg', 'Active', '2020-02-27 10:39:15', NULL),
(103, 'S', 'Vasu', 'Dhameliya', 'vasudhameliya0204@gmail.com', '$2y$10$/8Dy6UCmvlT7A4xTblTuMOzIKE7vZAC.91a4Um8TKvOIohVii9n.G', 'Male', 'Krushn Nagar', 'Gariyadhar', 4, NULL, '9836453620', '1582802129wedding_men1.jpg', 'Active', '2020-02-27 11:15:29', NULL),
(106, 'S', 'Jigu', 'Jivani', 'jenijivani8@gmail.com', '$2y$10$/vdDbknA4x1aa5nwJ8Jkput3aDweZSbeNtnWZMMVSAFotl522vggm', 'Female', 'Iscon City', 'Bhavangar', 6, NULL, '9865471230', '1582804720IMG-20200206-WA0013.jpg', 'Active', '2020-02-27 11:58:43', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
