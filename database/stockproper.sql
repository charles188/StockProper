-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 09:41 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockproper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `fullname`, `username`, `password`, `created_at`) VALUES
(2, 'Stewart Mart', 'stewart4', 'stewart', '2021-08-08 15:53:57'),
(3, 'Kit Greg', 'kit4', 'kit', '2021-08-08 15:54:10'),
(4, 'Ines Vanness', 'ines4', 'ines', '2021-08-08 15:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluationid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `evaluationsid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `total_retail` bigint(50) NOT NULL,
  `total_cost` bigint(50) NOT NULL,
  `keeping_cost` int(11) NOT NULL,
  `ordering_cost` int(11) NOT NULL,
  `estimated_profit` int(11) NOT NULL,
  `average_sales` double NOT NULL,
  `std_dev_sales` double NOT NULL,
  `percent_dev` double NOT NULL,
  `chance` double NOT NULL,
  `method` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluationid`, `userid`, `evaluationsid`, `productid`, `product_name`, `cost_price`, `order_qty`, `total_retail`, `total_cost`, `keeping_cost`, `ordering_cost`, `estimated_profit`, `average_sales`, `std_dev_sales`, `percent_dev`, `chance`, `method`, `created_at`) VALUES
(21, 4, 5, 8, 'Lemon & Pepper Pork Loin Steaks', 2, 76, 312, 114, 34, 1, 162, 62, 10.08, 16.26, 22.58, 'minmax', '2021-08-09 03:26:51'),
(22, 4, 5, 9, 'White Sandwich Thins', 1, 40, 140, 40, 12, 1, 87, 36.83, 10.72, 29.11, 8.61, 'minmax', '2021-08-09 03:26:51'),
(23, 4, 5, 10, 'Hexagonal Wire Shelf', 3, 16, 96, 48, 9, 1, 37, 9.67, 3.56, 36.81, 65.46, 'minmax', '2021-08-09 03:26:51'),
(24, 4, 5, 11, 'Kenwood Hand Blender', 26, 15, 810, 390, 78, 3, 339, 12.17, 3.43, 28.18, 23.25, 'minmax', '2021-08-09 03:26:51'),
(25, 4, 5, 12, 'Rainbow and Unicorn Printed Pyjamas', 15, 54, 2376, 810, 202, 2, 1361, 42.83, 8.89, 20.76, 26.08, 'minmax', '2021-08-09 03:26:51'),
(26, 4, 5, 7, 'Woman Shorts Crop Tops ', 14, 100, 9200, 1400, 350, 2, 7448, 79.33, 13.94, 17.57, 26.06, 'replenish', '2021-08-09 03:26:51'),
(27, 4, 5, 8, 'Lemon & Pepper Pork Loin Steaks', 2, 76, 312, 114, 34, 1, 162, 62, 10.08, 16.26, 22.58, 'replenish', '2021-08-09 03:26:51'),
(28, 4, 5, 9, 'White Sandwich Thins', 1, 40, 140, 40, 12, 1, 87, 36.83, 10.72, 29.11, 8.61, 'replenish', '2021-08-09 03:26:51'),
(29, 4, 5, 10, 'Hexagonal Wire Shelf', 3, 16, 96, 48, 9, 1, 37, 9.67, 3.56, 36.81, 65.46, 'replenish', '2021-08-09 03:26:51'),
(30, 4, 5, 11, 'Kenwood Hand Blender', 26, 15, 810, 390, 78, 3, 339, 12.17, 3.43, 28.18, 23.25, 'replenish', '2021-08-09 03:26:51'),
(31, 4, 5, 12, 'Rainbow and Unicorn Printed Pyjamas', 15, 54, 2376, 810, 202, 2, 1361, 42.83, 8.89, 20.76, 26.08, 'replenish', '2021-08-09 03:26:51'),
(32, 4, 6, 8, 'Lemon & Pepper Pork Loin Steaks', 2, 76, 312, 114, 34, 1, 162, 62, 10.08, 16.26, 22.58, 'minmax', '2021-08-10 21:47:34'),
(33, 4, 6, 10, 'Hexagonal Wire Shelf', 3, 16, 96, 48, 9, 1, 37, 9.67, 3.56, 36.81, 65.46, 'minmax', '2021-08-10 21:47:34'),
(34, 4, 6, 11, 'Kenwood Hand Blender', 26, 15, 810, 390, 78, 3, 339, 12.17, 3.43, 28.18, 23.25, 'minmax', '2021-08-10 21:47:34'),
(35, 4, 6, 12, 'Rainbow and Unicorn Printed Pyjamas', 15, 54, 2376, 810, 202, 2, 1361, 42.83, 8.89, 20.76, 26.08, 'minmax', '2021-08-10 21:47:34'),
(36, 4, 6, 13, 'SSHOUSE Summer Casual Sleeveless', 8, 20100, 440000, 160000, 40000, 2, 239998, 20408.33, 3442.44, 16.87, -1.51, 'minmax', '2021-08-10 21:47:34'),
(37, 4, 6, 7, 'Woman Shorts Crop Tops ', 14, 100, 9200, 1400, 350, 2, 7448, 79.33, 13.94, 17.57, 26.06, 'replenish', '2021-08-10 21:47:34'),
(38, 4, 6, 8, 'Lemon & Pepper Pork Loin Steaks', 2, 76, 312, 114, 34, 1, 162, 62, 10.08, 16.26, 22.58, 'replenish', '2021-08-10 21:47:34'),
(39, 4, 6, 10, 'Hexagonal Wire Shelf', 3, 16, 96, 48, 9, 1, 37, 9.67, 3.56, 36.81, 65.46, 'replenish', '2021-08-10 21:47:34'),
(40, 4, 6, 11, 'Kenwood Hand Blender', 26, 15, 810, 390, 78, 3, 339, 12.17, 3.43, 28.18, 23.25, 'replenish', '2021-08-10 21:47:34'),
(41, 4, 6, 12, 'Rainbow and Unicorn Printed Pyjamas', 15, 54, 2376, 810, 202, 2, 1361, 42.83, 8.89, 20.76, 26.08, 'replenish', '2021-08-10 21:47:34'),
(42, 4, 6, 13, 'SSHOUSE Summer Casual Sleeveless', 8, 20100, 440000, 160000, 40000, 2, 239998, 20408.33, 3442.44, 16.87, -1.51, 'replenish', '2021-08-10 21:47:34'),
(43, 4, 7, 8, 'Lemon & Pepper Pork Loin Steaks', 2, 76, 312, 114, 34, 1, 162, 62, 10.08, 16.26, 22.58, 'minmax', '2021-08-11 08:35:22'),
(44, 4, 7, 10, 'Hexagonal Wire Shelf', 3, 16, 96, 48, 9, 1, 37, 9.67, 3.56, 36.81, 65.46, 'minmax', '2021-08-11 08:35:22'),
(45, 4, 7, 11, 'Kenwood Hand Blender', 26, 15, 810, 390, 78, 3, 339, 17.17, 4.31, 25.1, -12.64, 'minmax', '2021-08-11 08:35:22'),
(46, 4, 7, 12, 'Rainbow and Unicorn Printed Pyjamas', 15, 54, 2376, 810, 202, 2, 1361, 42.83, 8.89, 20.76, 26.08, 'minmax', '2021-08-11 08:35:22'),
(47, 4, 7, 14, '2020 Nouvelle ArrivÃƒ', 8, 100, 4300, 800, 200, 5, 3295, 108.33, 26.76, 24.7, -7.69, 'minmax', '2021-08-11 08:35:22'),
(48, 4, 7, 7, 'Woman Shorts Crop Tops ', 14, 100, 9200, 1400, 350, 2, 7448, 79.33, 13.94, 17.57, 26.06, 'replenish', '2021-08-11 08:35:22'),
(49, 4, 7, 8, 'Lemon & Pepper Pork Loin Steaks', 2, 76, 312, 114, 34, 1, 162, 62, 10.08, 16.26, 22.58, 'replenish', '2021-08-11 08:35:22'),
(50, 4, 7, 10, 'Hexagonal Wire Shelf', 3, 16, 96, 48, 9, 1, 37, 9.67, 3.56, 36.81, 65.46, 'replenish', '2021-08-11 08:35:22'),
(51, 4, 7, 11, 'Kenwood Hand Blender', 26, 15, 810, 390, 78, 3, 339, 17.17, 4.31, 25.1, -12.64, 'replenish', '2021-08-11 08:35:22'),
(52, 4, 7, 12, 'Rainbow and Unicorn Printed Pyjamas', 15, 54, 2376, 810, 202, 2, 1361, 42.83, 8.89, 20.76, 26.08, 'replenish', '2021-08-11 08:35:22'),
(53, 4, 7, 14, '2020 Nouvelle ArrivÃƒ', 8, 100, 4300, 800, 200, 5, 3295, 108.33, 26.76, 24.7, -7.69, 'replenish', '2021-08-11 08:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `evaluationsid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `policy` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`evaluationsid`, `userid`, `policy`, `created_at`) VALUES
(5, 4, 'Minimum/Maximum and Replenish', '2021-08-09 03:26:51'),
(6, 4, 'Minimum/Maximum and Replenish', '2021-08-10 21:47:34'),
(7, 4, 'Minimum/Maximum and Replenish', '2021-08-11 08:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `order_policy` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderid`, `userid`, `order_policy`, `created_at`) VALUES
(18, 4, 'Replenishment', '2021-08-09 03:12:39'),
(19, 4, 'Minimum/Maximum', '2021-08-09 03:12:53'),
(20, 4, 'Minimum/Maximum', '2021-08-10 21:33:39'),
(21, 4, 'Replenishment', '2021-08-10 21:34:06'),
(22, 4, 'Minimum/Maximum', '2021-08-11 08:21:50'),
(23, 4, 'Replenishment', '2021-08-11 08:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `itemid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `category` varchar(60) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `retail_price` int(11) NOT NULL,
  `cost_price` int(14) NOT NULL,
  `order_qty` int(14) NOT NULL,
  `total_retail` bigint(50) NOT NULL,
  `total_cost` bigint(50) NOT NULL,
  `keeping_cost` int(11) NOT NULL,
  `ordering_cost` int(11) NOT NULL,
  `estimated_profit` int(11) NOT NULL,
  `lifespan` int(11) NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`itemid`, `orderid`, `product_name`, `category`, `supplier`, `retail_price`, `cost_price`, `order_qty`, `total_retail`, `total_cost`, `keeping_cost`, `ordering_cost`, `estimated_profit`, `lifespan`, `delivery_date`) VALUES
(32, 18, 'Woman Shorts Crop Tops ', 'clothing', 'Fendi', 92, 14, 100, 9200, 1400, 350, 2, 7448, 90, '2021-08-12'),
(33, 18, 'Lemon & Pepper Pork Loin Steaks', 'groceries', 'Hill Butch', 4, 2, 76, 312, 114, 34, 1, 162, 40, '2021-08-12'),
(34, 18, 'White Sandwich Thins', 'groceries', 'Hill Butch', 4, 1, 40, 140, 40, 12, 1, 87, 7, '2021-08-12'),
(35, 18, 'Hexagonal Wire Shelf', 'furnitures', 'Home Sens', 6, 3, 16, 96, 48, 9, 1, 37, 90, '2021-08-14'),
(36, 18, 'Kenwood Hand Blender', 'electronics', 'Kenwood', 54, 26, 15, 810, 390, 78, 3, 339, 90, '2021-08-14'),
(37, 18, 'Rainbow and Unicorn Printed Pyjamas', 'clothing', 'Fendi', 44, 15, 54, 2376, 810, 202, 2, 1361, 90, '2021-08-14'),
(38, 19, 'Lemon & Pepper Pork Loin Steaks', 'groceries', 'Hill Butch', 4, 2, 76, 312, 114, 34, 1, 162, 40, '2021-08-12'),
(39, 19, 'White Sandwich Thins', 'groceries', 'Hill Butch', 4, 1, 40, 140, 40, 12, 1, 87, 7, '2021-08-12'),
(40, 19, 'Hexagonal Wire Shelf', 'furnitures', 'Home Sens', 6, 3, 16, 96, 48, 9, 1, 37, 90, '2021-08-14'),
(41, 19, 'Kenwood Hand Blender', 'electronics', 'Kenwood', 54, 26, 15, 810, 390, 78, 3, 339, 90, '2021-08-14'),
(42, 19, 'Rainbow and Unicorn Printed Pyjamas', 'clothing', 'Fendi', 44, 15, 54, 2376, 810, 202, 2, 1361, 90, '2021-08-14'),
(43, 20, 'Lemon & Pepper Pork Loin Steaks', 'groceries', 'Hill Butch', 4, 2, 76, 312, 114, 34, 1, 162, 40, '2021-08-12'),
(44, 20, 'Hexagonal Wire Shelf', 'furnitures', 'Home Sens', 6, 3, 16, 96, 48, 9, 1, 37, 90, '2021-08-14'),
(45, 20, 'Kenwood Hand Blender', 'electronics', 'Kenwood', 54, 26, 15, 810, 390, 78, 3, 339, 90, '2021-08-14'),
(46, 20, 'Rainbow and Unicorn Printed Pyjamas', 'clothing', 'Fendi', 44, 15, 54, 2376, 810, 202, 2, 1361, 90, '2021-08-14'),
(47, 20, 'SSHOUSE Summer Casual Sleeveless', 'clothing', 'Dolce and Gabbana', 22, 8, 20100, 440000, 160000, 40000, 2, 239998, 90, '2021-08-15'),
(48, 21, 'Woman Shorts Crop Tops ', 'clothing', 'Fendi', 92, 14, 100, 9200, 1400, 350, 2, 7448, 90, '2021-08-12'),
(49, 21, 'Lemon & Pepper Pork Loin Steaks', 'groceries', 'Hill Butch', 4, 2, 76, 312, 114, 34, 1, 162, 40, '2021-08-12'),
(50, 21, 'Hexagonal Wire Shelf', 'furnitures', 'Home Sens', 6, 3, 16, 96, 48, 9, 1, 37, 90, '2021-08-14'),
(51, 21, 'Kenwood Hand Blender', 'electronics', 'Kenwood', 54, 26, 15, 810, 390, 78, 3, 339, 90, '2021-08-14'),
(52, 21, 'Rainbow and Unicorn Printed Pyjamas', 'clothing', 'Fendi', 44, 15, 54, 2376, 810, 202, 2, 1361, 90, '2021-08-14'),
(53, 21, 'SSHOUSE Summer Casual Sleeveless', 'clothing', 'Dolce and Gabbana', 22, 8, 20100, 440000, 160000, 40000, 2, 239998, 90, '2021-08-15'),
(54, 22, 'Lemon & Pepper Pork Loin Steaks', 'groceries', 'Hill Butch', 4, 2, 76, 312, 114, 34, 1, 162, 40, '2021-08-12'),
(55, 22, 'Hexagonal Wire Shelf', 'furnitures', 'Home Sens', 6, 3, 16, 96, 48, 9, 1, 37, 90, '2021-08-14'),
(56, 22, 'Kenwood Hand Blender', 'electronics', 'Kenwood', 54, 26, 15, 810, 390, 78, 3, 339, 90, '2021-08-14'),
(57, 22, 'Rainbow and Unicorn Printed Pyjamas', 'clothing', 'Fendi', 44, 15, 54, 2376, 810, 202, 2, 1361, 90, '2021-08-14'),
(58, 22, '2020 Nouvelle ArrivÃƒ', 'clothing', 'Dolce and Gabbana', 43, 8, 100, 4300, 800, 200, 5, 3295, 90, '2021-08-18'),
(59, 23, 'Woman Shorts Crop Tops ', 'clothing', 'Fendi', 92, 14, 100, 9200, 1400, 350, 2, 7448, 90, '2021-08-12'),
(60, 23, 'Lemon & Pepper Pork Loin Steaks', 'groceries', 'Hill Butch', 4, 2, 76, 312, 114, 34, 1, 162, 40, '2021-08-12'),
(61, 23, 'Hexagonal Wire Shelf', 'furnitures', 'Home Sens', 6, 3, 16, 96, 48, 9, 1, 37, 90, '2021-08-14'),
(62, 23, 'Kenwood Hand Blender', 'electronics', 'Kenwood', 54, 26, 15, 810, 390, 78, 3, 339, 90, '2021-08-14'),
(63, 23, 'Rainbow and Unicorn Printed Pyjamas', 'clothing', 'Fendi', 44, 15, 54, 2376, 810, 202, 2, 1361, 90, '2021-08-14'),
(64, 23, '2020 Nouvelle ArrivÃƒ', 'clothing', 'Dolce and Gabbana', 43, 8, 100, 4300, 800, 200, 5, 3295, 90, '2021-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `resetid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `approved` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`resetid`, `userid`, `email`, `password`, `approved`, `created_at`) VALUES
(6, 8, 'presh@gmail.com', 'a08e48345d23b6c048e243bd72889d40', 1, '2021-08-11 08:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `productsales`
--

CREATE TABLE `productsales` (
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `category` varchar(60) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `cost_price` int(14) NOT NULL,
  `retail_price` int(14) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `inventory_position` int(11) NOT NULL,
  `min_stock_qty` int(11) NOT NULL,
  `max_stock_qty` int(11) NOT NULL,
  `ordering_cost` int(11) NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `lifespan` int(11) NOT NULL,
  `total_cost` bigint(50) NOT NULL,
  `total_retail` bigint(50) NOT NULL,
  `category_value` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productsales`
--

INSERT INTO `productsales` (`productid`, `userid`, `product_name`, `category`, `sku`, `supplier`, `cost_price`, `retail_price`, `quantity_sold`, `inventory_position`, `min_stock_qty`, `max_stock_qty`, `ordering_cost`, `delivery_time`, `lifespan`, `total_cost`, `total_retail`, `category_value`, `created_at`) VALUES
(7, 4, 'Woman Shorts Crop Tops ', 'clothing', '002144', 'Fendi', 14, 92, 100, 40, 25, 140, 2, 3, 90, 1400, 9200, 25, '2021-08-09 02:43:25'),
(8, 4, 'Lemon & Pepper Pork Loin Steaks', 'groceries', '003232', 'Hill Butch', 2, 4, 76, 11, 15, 87, 1, 3, 40, 114, 312, 30, '2021-08-09 02:47:06'),
(10, 4, 'Hexagonal Wire Shelf', 'furnitures', '008765', 'Home Sens', 3, 6, 16, 4, 5, 20, 1, 5, 90, 48, 96, 20, '2021-08-09 02:56:26'),
(11, 4, 'Kenwood Hand Blender', 'electronics', '112546', 'Kenwood', 26, 54, 15, 5, 5, 20, 3, 5, 90, 390, 810, 20, '2021-08-09 02:58:03'),
(12, 4, 'Rainbow and Unicorn Printed Pyjamas', 'clothing', '004644', 'Fendi', 15, 44, 54, 11, 15, 65, 2, 5, 90, 810, 2376, 25, '2021-08-09 03:03:49'),
(14, 4, '2020 Nouvelle ArrivÃƒ', 'clothing', '014567', 'Dolce and Gabbana', 8, 43, 100, 50, 51, 150, 5, 7, 90, 800, 4300, 25, '2021-08-11 08:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email_address` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `business_name` varchar(60) NOT NULL,
  `business_type` varchar(90) NOT NULL,
  `business_address` varchar(225) NOT NULL,
  `postcode` varchar(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fullname`, `username`, `email_address`, `password`, `business_name`, `business_type`, `business_address`, `postcode`, `phone`, `created_at`) VALUES
(4, 'Charles Heoma', 'charles4', 'charles@gmail.com', 'a5410ee37744c574ba5790034ea08f79', 'Picks and Bucks', 'Groceries and Wears', '21 Gordorn Avenue', 'AB31 7GJ', '07778938384', '2021-08-08 15:44:50'),
(5, 'Robert Gordon', 'robert4', 'robert@gmail.com', '684c851af59965b680086b7b4896ff98', 'AfriHub', 'Electronics and Furnitures', '50 Garthdee Way', 'AB20 6XZ', '07773728293', '2021-08-08 15:47:08'),
(8, 'Presh Noble', 'presh4', 'presh@gmail.com', 'a08e48345d23b6c048e243bd72889d40', 'Afri Store', 'Wears and Groceries', '12 Gordon Avenue', 'AB22 3BA', '077778746235', '2021-08-11 08:14:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluationid`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`evaluationsid`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`resetid`);

--
-- Indexes for table `productsales`
--
ALTER TABLE `productsales`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `evaluationsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `resetid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productsales`
--
ALTER TABLE `productsales`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
