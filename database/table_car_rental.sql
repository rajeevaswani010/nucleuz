-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2023 at 02:27 AM
-- Server version: 5.7.41-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `table_car_rental`
--
CREATE DATABASE IF NOT EXISTS `table_car_rental` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `table_car_rental`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1 : Super Admin; 2: Company Admin; 3: Staff',
  `temp_password` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_type` tinyint(1) NOT NULL DEFAULT '1',
  `mobile` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `admin`
--

TRUNCATE TABLE `admin`;
--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `company_id`, `link_id`, `email`, `admin_password`, `role`, `temp_password`, `image`, `status`, `user_type`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 0, 0, 'manoj@prozorp.com', '$2y$10$j9m/pOIsH4nW2R4DRxmwIO7GtGKj/34qC2mHUFFkfNCU3A0CILnlS', 1, 0, NULL, 1, 0, 0, '2021-06-28 10:58:03', '2022-11-14 18:41:20'),
(2, 'Manoj', 1, 1, 'manoj.spec@gmail.com', '$2y$10$ovFbaR3xKIRg7NfUUiNBlefDd50ZHhA30l4taLhukDgs4tzxT4GXm', 2, 1, NULL, 0, 0, 0, '2022-12-06 12:33:52', '2022-12-08 06:40:12'),
(4, 'Pulkit Jalani', 1, 3, 'pulkitintech@gmail.com', '$2y$10$yhv/b6Jmaters735PgV.DOpcw04WsK3Xb2ZpwfhFjII37Rs7Fj7wq', 2, 0, NULL, 0, 0, 0, '2022-12-06 12:49:41', '2022-12-17 12:21:51'),
(6, 'Varadha', 1, 5, 's.varadharajan@hotmail.com', '$2y$10$YiYOtooW4BVMBH1vIAFUr.PhPj/RanZGa17qoJfjNUFvsheaiydsu', 2, 0, 'ProfileImages/O343T2fE1vW91Nv4QhCKNykIIo4QRL89s5b99PMk.jpg', 0, 0, 0, '2022-12-06 13:20:04', '2022-12-12 07:49:42'),
(7, 'Pranav', 1, 6, 'cheersmanoj@icloud.com', '$2y$10$RIrh2/2xwtXrq08B2uMPEOeH4LFMhIcUZOpp7HssyWm1yF0ACx37y', 3, 1, NULL, 0, 0, 0, '2022-12-06 17:55:40', '2022-12-08 06:40:12'),
(8, 'Waseem', 1, 7, 'waseem@hwinfotech.com', '$2y$10$VJFbZv6uQprTa5W2udBoMOBgFNqLf6EI7ugACS4w3c8sVKnp8YjoW', 2, 0, NULL, 0, 0, 0, '2022-12-10 11:12:15', '2022-12-16 06:38:37'),
(9, 'jaipal', 0, 0, 'jaipalyadav47@gmail.com', '$2y$10$BfDS/K4ruKRh9aeyLb7Bf.nvPs8CUI7QFkpVA4JYDVe3prGs7fv5G', 1, 0, NULL, 1, 0, 0, '2022-12-27 06:05:21', '2023-01-17 08:58:20'),
(20, 'mithu', 1, 1, 'mithu@gmail.com', '$2y$10$sjuKY1OiVGpzFLkdQ80ws.6WRpYZV0MrMgOsrn2vMFkOzFafitOIe', 2, 1, NULL, 0, 0, 0, '2022-12-30 08:02:39', '2022-12-30 11:44:50'),
(21, 'hhhhh', 1, 2, 'hhhh@gmail.com', '$2y$10$IcIqmbcR3AYvWSl63bETeeXHrwdPwnoZ3NV9ufvOacXbvJNVXDBO2', 2, 1, NULL, 0, 0, 0, '2022-12-30 08:05:22', '2022-12-30 11:44:50'),
(22, 'hhhhh2', 1, 3, 'hhhh12@gmail.com', '$2y$10$uz3nsT2IBzkWKMSQwP0tfuzl12PrX617F04Pi0BJZ5dm8YX1GnHgi', 2, 1, NULL, 0, 0, 0, '2022-12-30 08:06:12', '2022-12-30 11:44:50'),
(23, 'kirmuch4522', 1, 4, 'dfgfggd14@gmail.com', '$2y$10$/jEhpYTceiIHPu24CFMrluy6.BbCJSJ.HPOPQ1Filx02I.x/YJaxu', 2, 1, NULL, 1, 1, 9999999999, '2022-12-30 08:11:02', '2022-12-30 11:13:14'),
(24, 'jaiho', 1, 5, 'jaiho@gmail.com', '$2y$10$.jvjg5GhUDVymeK.dgbufeJjB4M1IpfDS9RdMF2HW1zLh6382NByi', 2, 1, NULL, 1, 0, 8965986598, '2022-12-30 08:59:17', '2022-12-30 08:59:17'),
(25, 'Arun Sharma', 1, 6, 'arunsharma@gmail.com', '$2y$10$BfDS/K4ruKRh9aeyLb7Bf.nvPs8CUI7QFkpVA4JYDVe3prGs7fv5G', 2, 0, NULL, 1, 1, 9992297951, '2023-12-30 12:20:45', '2023-01-17 07:00:12'),
(26, 'arun yadav', 1, 7, 'arunyadav47@gmail.com', '$2y$10$RZxrV./W0s4AHww6GPWH7.l9Ps.4j0BOeWazWWACgVxQbmnknGgAW', 2, 1, NULL, 1, 1, 9865986589, '2022-12-30 12:30:23', '2022-12-30 12:30:23'),
(27, 'suspended', 1, 8, 'suspended@gmail.com', '$2y$10$OSPGqJtB.e63fhUyK7nw9.CS35EEXtP82jYut3JUzSRIrwyIGMklG', 2, 0, NULL, 1, 1, 875487487, '2022-12-31 09:12:55', '2023-01-01 03:15:03'),
(28, 'newperson', 1, 9, 'newperson@gmail.com', '$2y$10$6vET5yFNHcW91X1g9mD0XOED5H/ZYQhmMXb5x1Omk35wNuhzl0hXi', 2, 1, NULL, 1, 1, 9865986598, '2023-01-01 03:07:20', '2023-01-01 03:07:20'),
(29, 'kkr', 1, 10, 'kkr@gmail.com', '$2y$10$EqJjAb2vmQjlsoUdve8rw.OT1VcRqNwTGKS3eJUViB/XTH9tpFhLq', 2, 1, NULL, 1, 1, 9865986598, '2023-01-01 06:18:08', '2023-01-01 06:18:08'),
(30, 'jaipa yadav', 1, 1, 'jaipal@gmail.com', '$2y$10$n/wvQGwdjvVvCjxI0X39qeQsOkoZ71Y00ec0Kt/C.2qktIZreS74q', 2, 0, NULL, 1, 1, 986598698, '2023-01-01 06:55:11', '2023-01-17 09:05:34'),
(31, 'test', 1, 2, 'test47@gmail.com', '$2y$10$MD.MvrQqOQLrp29lVkzaVupNNyaR58S1nbTf95IvnYaoK/Fomm/9G', 2, 1, NULL, 1, 1, 8754875487, '2023-01-01 06:57:15', '2023-01-01 06:57:15'),
(32, 'Harshit', 1, 3, 'harshit@gmail.com', '$2y$10$9K5WeK50aqyqIl/2/J34GOJjJlxr6ds3RtgUrzPl5TvmiR7fdetxK', 2, 0, NULL, 1, 1, 9865986598, '2023-01-01 06:58:28', '2023-01-02 06:41:00'),
(33, 'Manoj', 1, 4, 'manojsoundararajan@gmail.com', '$2y$10$T5bU2kGw3U7xPtf27W1Nv.K4xnMCteEvPhIyYgFHTNsviSrwIiP6G', 2, 0, NULL, 1, 1, 123456, '2023-01-02 15:40:27', '2023-03-20 18:29:15'),
(34, 'bvvvv', 1, 5, 'hhh@gmail.com', '$2y$10$kurqg7wGlyUCG6J.uZMs4eVH/WldesWFgsZSXCx256Y9g7uRK4O7q', 3, 1, NULL, 1, 2, 875875487, '2023-01-12 15:43:08', '2023-01-12 15:43:08'),
(35, 'jaiho', 1, 2, 'jaiho120@gmail.com', '$2y$10$K8gMQ93dl1MBPyKVAHoZBuvIqz9ckWIvjLKkGDUkxlMNNjBqm0hXK', 3, 1, NULL, 1, 1, 9992297951, '2023-01-22 18:10:28', NULL),
(36, 'test', 0, 0, 'rajeevaswani010@gmail.com', '$2y$10$WJYvG6Y4l8J95uvVIoLXbeQmY29hRvbNypzQowMflcdSg8VFX9l6.', 1, 0, NULL, 1, 0, 0, '2021-06-28 10:58:03', '2023-03-20 08:39:09'),
(37, 'test_keshav', 0, 0, 'keshav10kumar@gmail.com', '$2y$10$sWKNcYT980UjGrDMWmAgdu5t02wYPiGWJZz0uS/ruYdgbbBPE/YFu', 1, 0, NULL, 1, 0, 0, '2021-06-28 10:58:03', '2023-03-20 08:46:21'),
(38, 'test_user_staff', 0, 0, 'rajeev.aswani@rediffmail.com', 'test1234', 1, 1, NULL, 1, 0, 0, '2021-06-28 10:58:03', '2023-03-20 08:45:35'),
(39, 'Pranav', 1, 6, 'msvisualtales@gmail.com', '$2y$10$LDNW565adLbdKKpQ534vfuNIN3xSw0fSNM/o7S6ulKju/weAX6lD6', 2, 0, NULL, 1, 1, 9175671234, '2023-03-21 08:21:41', '2023-03-21 08:24:26'),
(40, 'keshav', 1, 7, 'keshav1kumar@gmail.com', '$2y$10$OIaQCIlsR/f5hLoCY0C08OU990JKOOcG8VTBbizVOUroQSR3z4jwu', 2, 1, NULL, 1, 1, 1234134234, '2023-03-21 11:30:11', '2023-03-21 11:30:11'),
(41, 'Varadha', 1, 8, 'varad_777@yahoo.com', '$2y$10$0vyOtYVZzLfx0JfyUHQLZeCdZEt7jUeTxhLl5gxR89IpfNVS1p6.q', 2, 0, NULL, 1, 1, 9137482, '2023-04-21 06:28:52', '2023-04-21 06:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `car_type` varchar(255) NOT NULL,
  `tarrif_detail` varchar(255) DEFAULT NULL,
  `tarrif_amount` double DEFAULT NULL,
  `tarrif_type` varchar(255) DEFAULT NULL,
  `discount_amount` varchar(25) DEFAULT NULL,
  `additional_charges` varchar(255) NOT NULL DEFAULT '0',
  `additional_info` varchar(255) DEFAULT NULL,
  `tax_percentage` varchar(255) NOT NULL,
  `km_allocation` varchar(255) DEFAULT NULL,
  `pickup_date_time` timestamp NULL DEFAULT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `dropoff_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `payment_mode` varchar(255) NOT NULL,
  `card_details` varchar(255) DEFAULT NULL,
  `km_reading_pickup` varchar(255) DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `advance_amount` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `car_image` varchar(255) DEFAULT NULL,
  `additional_kilometers_amount` double DEFAULT NULL,
  `km_drop_time` bigint(20) DEFAULT NULL,
  `dmage` tinyint(1) NOT NULL DEFAULT '0',
  `damge_image` varchar(255) DEFAULT NULL,
  `final_amount_paid` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `booking_note` varchar(255) DEFAULT NULL,
  `license_expiry_date` date DEFAULT NULL,
  `residency_card_id` varchar(255) DEFAULT NULL,
  `drop_off_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `additional_km_reunning` double DEFAULT NULL,
  `discount_note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `bookings`
--

TRUNCATE TABLE `bookings`;
--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `company_id`, `staff_id`, `customer_id`, `vehicle_id`, `car_type`, `tarrif_detail`, `tarrif_amount`, `tarrif_type`, `discount_amount`, `additional_charges`, `additional_info`, `tax_percentage`, `km_allocation`, `pickup_date_time`, `pickup_location`, `dropoff_date`, `payment_mode`, `card_details`, `km_reading_pickup`, `sub_total`, `grand_total`, `advance_amount`, `created_at`, `updated_at`, `car_image`, `additional_kilometers_amount`, `km_drop_time`, `dmage`, `damge_image`, `final_amount_paid`, `status`, `booking_note`, `license_expiry_date`, `residency_card_id`, `drop_off_confirm`, `additional_km_reunning`, `discount_note`) VALUES
(1, 1, 6, 1, 4, 'Sedan', '3', 25, 'Daily', '10', '0', NULL, '5', '200', '2022-12-07 03:00:00', 'Airport Arrival Lounge', '2022-12-11 02:00:12', 'Card', NULL, '1001', 100, 93.75, 25, '2022-12-06 21:08:46', '2022-12-07 14:51:48', 'BookimngImages/0ekyPv1vOizhRhOGkKj0G4oyB5uidItjNBaMifi3.jpg', 0.05, NULL, 0, NULL, NULL, 2, NULL, '2025-07-06', '10909992', 0, NULL, NULL),
(2, 1, 6, 2, NULL, 'Sedan', '2', 140, 'Weekly', '15', '0', NULL, '5', '200', '2022-12-07 16:00:00', 'Ghala', '2022-12-21 07:00:00', 'Cash', NULL, NULL, 280, 279, NULL, '2022-12-06 21:19:22', '2022-12-06 21:19:22', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(3, 1, 6, 3, NULL, 'SUV', '4', 45, 'Daily', '0', '0', NULL, '5', '200', '2022-12-08 16:00:00', 'Muscat International Airport', '2022-12-12 07:00:00', 'Cash', NULL, NULL, 180, 189, NULL, '2022-12-06 21:28:12', '2022-12-06 21:28:12', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(4, 1, 6, 4, NULL, 'Sedan', '2', 220, 'Monthly', '50', '0', NULL, '5', '200', '2022-12-09 15:00:00', 'AZAIBA', '2023-02-07 07:00:00', 'Cash', NULL, NULL, 440, 412, NULL, '2022-12-06 21:31:07', '2022-12-06 21:31:07', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(5, 1, 6, 5, 2, 'Sedan', '2', 140, 'Weekly', '20', '0', NULL, '5', '200', '2022-12-11 16:00:00', 'Ghala', '2022-12-25 07:00:00', 'Cash', NULL, '5555', 280, 294, 0, '2022-12-06 21:36:55', '2022-12-09 02:50:51', 'BookimngImages/7gjJSIUc2bt6L4Xuet083Pbxy6Gs4oTEo76Tg46a.jpg', 0.05, NULL, 0, NULL, NULL, 2, NULL, '2023-04-20', '100090092', 0, NULL, NULL),
(6, 1, 6, 5, NULL, 'SUV', '1', 45, 'Daily', '0', '0', NULL, '5', '200', '2022-12-07 19:00:00', 'Ghala', '2022-12-08 07:00:00', 'Cash', NULL, NULL, 45, 0, NULL, '2022-12-07 14:42:03', '2022-12-09 02:49:51', NULL, 0.05, NULL, 0, NULL, NULL, 4, NULL, NULL, NULL, 0, NULL, NULL),
(7, 1, 6, 5, NULL, 'Coupe', '1', 50, 'Daily', '0', '0', NULL, '5', '200', '2022-12-07 18:43:00', 'Airport', '2022-12-08 07:00:00', 'Cash', NULL, NULL, 50, 0, NULL, '2022-12-07 14:44:01', '2022-12-09 02:45:39', NULL, 0.05, NULL, 0, NULL, NULL, 4, NULL, NULL, NULL, 0, NULL, NULL),
(8, 1, 6, 5, NULL, 'Coupe', '1', 50, 'Daily', '0', '0', NULL, '5', '200', '2022-12-08 19:00:00', 'Airport', '2022-12-09 07:00:00', 'Cash', NULL, NULL, 50, 52.5, NULL, '2022-12-07 14:49:27', '2022-12-07 14:49:27', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(9, 1, 5, 5, NULL, 'Hatchback', '1', 0, 'Daily', '0', '0', NULL, '5', '200', '2022-12-08 01:00:00', 'Airport', '2022-12-08 07:00:00', 'Cash', NULL, NULL, 0, 0, NULL, '2022-12-07 20:28:56', '2022-12-07 20:28:56', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(12, 1, 4, 5, 1, 'Sedan', '10', 25, 'Daily', '120', '0', NULL, '5', '10', '2022-12-31 19:59:00', 'test', '2022-12-07 21:45:06', 'Cash', NULL, '1000', 1130, 1186.5, 0, '2022-12-07 21:38:27', '2022-12-07 21:45:06', 'BookimngImages/zGFj4z7dmF5po3roHe6nercIvOKQyMxmicxGZ30Z.jpg', 10, 1200, 0, 'BookimngImages/SLBehvnxTaVM7sUWacuqA3Kw4WhuacJftrtfVp3M.jpg', NULL, 2, NULL, '2022-01-01', 'test', 1, 100, NULL),
(13, 1, 6, 5, 6, 'SUV', '1', 45, 'Daily', '0', '0', NULL, '5', '200', '2022-12-09 21:00:00', 'Airport', '2022-12-10 07:00:00', 'Cash', NULL, '10001', 45, 47.25, 0, '2022-12-09 16:53:06', '2022-12-09 16:55:56', 'BookimngImages/U8MnGIDXE34NLZsDaxyCYHmTcFWql1Yfbpwi53v0.jpg', 0.05, NULL, 0, NULL, NULL, 2, NULL, '2022-12-08', '10909001', 0, NULL, NULL),
(14, 1, 6, 6, 2, 'Sedan', '2', 140, 'Weekly', '15', '0', NULL, '5', '200', '2022-12-09 21:30:00', 'Ghala', '2022-12-23 07:00:00', 'Cash', NULL, '15000', 280, 294, 35, '2022-12-09 17:04:17', '2022-12-09 17:06:40', 'BookimngImages/3DaSE3S2nm1xGTJpLEZCUKNQyDdPjJ1QoNoxLaeB.jpg', 0.05, NULL, 0, NULL, NULL, 2, NULL, '2022-12-09', '10000000', 0, NULL, NULL),
(15, 1, 5, 6, NULL, 'Sedan', '1', 25, 'Daily', '0', '0', NULL, '5', '200', '2022-12-10 22:00:00', 'Airport', '2022-12-11 07:00:00', 'Cash', NULL, NULL, 25, 26.25, NULL, '2022-12-10 17:51:48', '2022-12-10 17:51:48', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(16, 1, 5, 6, NULL, 'Hatchback', '1', 0, 'Daily', '0', '0', NULL, '5', '200', '2022-12-16 19:00:00', 'dfsdgs', '2022-12-17 07:00:00', 'Cash', NULL, NULL, 0, 0, NULL, '2022-12-16 13:42:50', '2022-12-16 13:42:50', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(17, 1, 25, 7, NULL, 'Hatchback', '5', 0, 'Daily', '5', '0', NULL, '5', '5', '2023-01-01 06:30:00', 'Kurushetra', '2023-01-05 07:00:00', 'Cash', NULL, NULL, -5, -5.25, NULL, '2022-12-30 21:01:54', '2022-12-30 21:01:54', NULL, 1, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(18, 1, 25, 8, 3, 'Sedan', '2', 220, 'Monthly', '0', '0', NULL, '5', '15', '2022-12-31 02:49:00', 'Kurushetra', '2023-02-01 11:28:25', 'Cash', NULL, '15', 2595, 2724.75, 0, '2022-12-30 21:21:09', '2023-02-01 11:29:26', 'BookimngImages/Z1VjKgC9lDhknF8xI0DpJ9BuBeoJqewJaNX2vCVr.png', 1, 2200, 0, 'BookimngImages/JVbk30oaLmHaoFs2z5tKGmistcYigPjUg8c1nRgk.jpg', 2724.75, 3, NULL, '2022-12-31', '2154785487', 1, 2155, NULL),
(19, 1, 30, 8, NULL, 'SUV', '2', 245, 'Weekly', '0', '0', NULL, '5', '2000', '2023-01-26 20:04:00', 'Kurushetra', '2023-02-09 07:00:00', 'Cash', NULL, NULL, 490, 514.5, NULL, '2023-01-26 14:38:47', '2023-01-26 14:38:47', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(20, 1, 33, 9, NULL, 'SUV', '3', 45, 'Daily', '0', '0', NULL, '5', NULL, '2023-01-27 16:00:00', 'Muscat International Airport', '2023-01-30 07:00:00', 'Cash', NULL, NULL, 135, 141.75, NULL, '2023-01-26 15:43:11', '2023-01-26 15:43:11', NULL, NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(21, 1, 30, 10, NULL, 'Sedan', '2', 20, 'Daily', '2', '0', NULL, '5', '5', '2023-01-31 20:39:00', 'Kurushetra', '2023-02-02 07:00:00', 'Cash', NULL, NULL, 38, 39.9, NULL, '2023-01-31 15:11:33', '2023-01-31 15:11:33', NULL, 5, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL),
(22, 1, 30, 11, 3, 'Sedan', '1', 20, 'Daily', '0', '0', 'yes', '5', '50', '2023-02-06 06:31:00', 'Kurushetra', '2023-02-07 00:25:06', 'Cash', NULL, '50', 20, 21, 0, '2023-02-03 00:22:16', '2023-02-03 00:25:32', 'BookimngImages/YXYTvu20Y8st6BRJzjMsUJyzcvPIt4637Fad9j5F.png', 0.05, NULL, 0, NULL, NULL, 2, NULL, '2023-03-12', 'hghghh5454', 0, NULL, NULL),
(23, 1, 33, 11, 7, 'SUV', '4', 45, 'Daily', '5', '0', NULL, '5', '200', '2023-02-08 19:00:00', 'Ghala', '2023-02-12 14:46:25', 'Cash', NULL, '2200', 180, 189, 20, '2023-02-06 14:22:26', '2023-02-06 14:46:55', 'BookimngImages/EwDksCOxj1TVP98rHf40d9UWBVQs9O09iMUtbYdl.jpg', 0.05, NULL, 0, NULL, NULL, 2, NULL, '2023-02-02', '10902252', 1, NULL, NULL),
(24, 1, 33, 12, 5, 'SUV', '3', 45, 'Daily', '25', '0', NULL, '5', '200', '2023-02-10 16:06:00', 'Muscat International Airport', '2023-03-28 00:32:49', 'Cash', NULL, '10001', 5265, 5271.75, 0, '2023-02-06 15:06:23', '2023-03-28 00:33:35', 'BookimngImages/LPdTsOAqBwzL78X3i7auWzRAZjMK72pvJeAPzexm.jpg', 0.075, NULL, 0, NULL, NULL, 2, NULL, '2025-02-04', '10902252', 1, NULL, NULL),
(25, 1, 39, 12, NULL, 'Sedan', '1', 20, 'Daily', '0', '0', NULL, '5', '200', '2023-03-28 05:00:00', 'Muscat', '2023-03-28 07:00:00', 'Cash', NULL, NULL, 20, 21, NULL, '2023-03-28 00:28:15', '2023-03-28 00:28:15', NULL, 0.05, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_invites`
--

DROP TABLE IF EXISTS `booking_invites`;
CREATE TABLE `booking_invites` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 : Pending; 1: Register; 2: Finish;',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `booking_invites`
--

TRUNCATE TABLE `booking_invites`;
--
-- Dumping data for table `booking_invites`
--

INSERT INTO `booking_invites` (`id`, `company_id`, `user_id`, `customer_id`, `link`, `email`, `name`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 30, NULL, 'https://nucleuz.app/CustomerRegister/bWl0aHU0NzEyNThAZ21haWwuY29t', 'mithu471258@gmail.com', 'mithu', 0, '2023-02-01 14:51:10', '2023-02-01 14:51:10'),
(7, 1, 33, 24, 'https://nucleuz.app/CustomerRegister/cy52YXJhZGhhcmFqYW5AaG90bWFpbC5jb20=', 's.varadharajan@hotmail.com', 'Varadharajan Sowrirajan', 1, '2023-02-06 15:00:43', '2023-02-06 15:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `brands`
--

TRUNCATE TABLE `brands`;
--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Honda', '2022-09-26 19:40:53', '2022-09-26 19:42:11'),
(2, 'Hyundai', '2022-09-26 19:42:15', '2022-10-13 23:58:55'),
(3, 'Toyota', '2022-09-30 01:35:59', '2022-09-30 01:35:59'),
(4, 'AUDI', '2022-09-30 01:35:59', '2022-10-13 23:58:13'),
(5, 'MG', '2022-09-30 01:35:59', '2022-10-13 23:57:52'),
(6, 'Ford', '2022-09-30 01:35:59', '2022-09-30 01:35:59'),
(7, 'Range Rover', '2022-09-30 01:35:59', '2022-09-30 01:35:59'),
(8, 'Kia', '2022-10-08 21:57:40', '2022-10-08 21:57:40'),
(9, 'MITSUBISHI PAJERO', '2022-10-13 23:58:38', '2022-10-13 23:58:38'),
(10, 'Mercedes Benz', '2022-10-13 23:59:24', '2022-10-13 23:59:24'),
(11, 'BMW', '2022-10-13 23:59:33', '2022-10-13 23:59:33'),
(12, 'GEELY', '2022-10-14 00:00:24', '2022-10-14 00:00:24'),
(13, 'Renault', '2022-10-14 00:00:51', '2022-10-14 00:00:51'),
(14, 'Suzuki', '2022-10-14 00:01:29', '2023-01-14 19:13:21'),
(15, 'ttttttt', '2023-01-14 19:18:51', '2023-01-14 19:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL,
  `iso_2` varchar(2) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` varchar(255) NOT NULL,
  `iso_3` varchar(3) NOT NULL,
  `dotw_nationality` varchar(10) NOT NULL,
  `country_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `countries`
--

TRUNCATE TABLE `countries`;
--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `iso_2`, `name`, `phonecode`, `iso_3`, `dotw_nationality`, `country_status`) VALUES
(1, 'AF', 'Afghanistan', '93', 'AFG', '26', 1),
(2, 'AL', 'Albania', '355', 'ALB', '90', 1),
(3, 'DZ', 'Algeria', '213', 'DZA', '187', 1),
(4, 'AS', 'American Samoa', '1684', 'ASM', '34', 1),
(5, 'AD', 'Andorra', '376', 'AND', '55', 1),
(6, 'AO', 'Angola', '244', 'AGO', '200', 1),
(7, 'AI', 'Anguilla', '1264', 'AIA', '151', 1),
(8, 'AQ', 'Antarctica', '0', 'ATA', '295', 1),
(9, 'AG', 'Antigua And Barbuda', '1268', 'ATG', '137', 1),
(10, 'AR', 'Argentina', '54', 'ARG', '107', 1),
(11, 'AM', 'Armenia', '374', 'ARM', '153', 1),
(12, 'AW', 'Aruba', '297', 'ABW', '138', 1),
(13, 'AU', 'Australia', '61', 'AUS', '28', 1),
(14, 'AT', 'Austria', '43', 'AUT', '56', 1),
(15, 'AZ', 'Azerbaijan', '994', 'AZE', '154', 1),
(16, 'BS', 'Bahamas The', '1242', 'BHS', '108', 1),
(17, 'BH', 'Bahrain', '973', 'BHR', '1', 1),
(18, 'BD', 'Bangladesh', '880', 'BGD', '19', 1),
(19, 'BB', 'Barbados', '1246', 'BRB', '139', 1),
(20, 'BY', 'Belarus', '375', 'BLR', '57', 1),
(21, 'BE', 'Belgium', '32', 'BEL', '58', 1),
(22, 'BZ', 'Belize', '501', 'BLZ', '136', 1),
(23, 'BJ', 'Benin', '229', 'BEN', '201', 1),
(24, 'BM', 'Bermuda', '1441', 'BMU', '103', 1),
(25, 'BT', 'Bhutan', '975', 'BTN', '27', 1),
(26, 'BO', 'Bolivia', '591', 'BOL', '124', 1),
(27, 'BA', 'Bosnia and Herzegovina', '387', 'BIH', '59', 1),
(28, 'BW', 'Botswana', '267', 'BWA', '202', 1),
(29, 'BV', 'Bouvet Island', '0', 'BVT', '315', 1),
(30, 'BR', 'Brazil', '55', 'BRA', '109', 1),
(31, 'IO', 'British Indian Ocean Territory', '246', 'IOT', '181', 1),
(32, 'BN', 'Brunei', '673', 'BRN', '166', 1),
(33, 'BG', 'Bulgaria', '359', 'BGR', '60', 1),
(34, 'BF', 'Burkina Faso', '226', 'BFA', '203', 1),
(35, 'BI', 'Burundi', '257', 'BDI', '204', 1),
(36, 'KH', 'Cambodia', '855', 'KHM', '167', 1),
(37, 'CM', 'Cameroon', '237', 'CMR', '206', 1),
(38, 'CA', 'Canada', '1', 'CAN', '100', 1),
(39, 'CV', 'Cape Verde', '238', 'CPV', '205', 1),
(40, 'KY', 'Cayman Islands', '1345', 'CYM', '149', 1),
(41, 'CF', 'Central African Republic', '236', 'CAF', '207', 1),
(42, 'TD', 'Chad', '235', 'TCD', '208', 1),
(43, 'CL', 'Chile', '56', 'CHL', '110', 1),
(44, 'CN', 'China', '86', 'CHN', '168', 1),
(45, 'CX', 'Christmas Island', '61', 'CXR', '52', 1),
(46, 'CC', 'Cocos (Keeling) Islands', '672', 'CCK', '53', 1),
(47, 'CO', 'Colombia', '57', 'COL', '111', 1),
(48, 'KM', 'Comoros', '269', 'COM', '211', 1),
(49, 'CG', 'Republic Of The Congo', '242', 'COG', '210', 1),
(50, 'CD', 'Democratic Republic Of The Congo', '242', 'COD', '209', 1),
(51, 'CK', 'Cook Islands', '682', 'COK', '35', 1),
(52, 'CR', 'Costa Rica', '506', 'CRI', '125', 1),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', '225', '', '212', 1),
(54, 'HR', 'Croatia (Hrvatska)', '385', 'HRV', '61', 1),
(55, 'CU', 'Cuba', '53', 'CUB', '112', 1),
(56, 'CY', 'Cyprus', '357', 'CYP', '62', 1),
(57, 'CZ', 'Czech Republic', '420', 'CZE', '63', 1),
(58, 'DK', 'Denmark', '45', 'DNK', '64', 1),
(59, 'DJ', 'Djibouti', '253', 'DJI', '213', 1),
(60, 'DM', 'Dominica', '1767', 'DMA', '142', 1),
(61, 'DO', 'Dominican Republic', '1809', 'DOM', '143', 1),
(62, 'TP', 'East Timor', '670', 'TPE', '', 1),
(63, 'EC', 'Ecuador', '593', 'ECU', '114', 1),
(64, 'EG', 'Egypt', '20', 'EGY', '7', 1),
(65, 'SV', 'El Salvador', '503', 'SLV', '126', 1),
(66, 'GQ', 'Equatorial Guinea', '240', 'GNQ', '215', 1),
(67, 'ER', 'Eritrea', '291', 'ERI', '214', 1),
(68, 'EE', 'Estonia', '372', 'EST', '155', 1),
(69, 'ET', 'Ethiopia', '251', 'ETH', '198', 1),
(70, 'XA', 'External Territories of Australia', '61', '', '', 1),
(71, 'FK', 'Falkland Islands', '500', 'FLK', '150', 1),
(72, 'FO', 'Faroe Islands', '298', 'FRO', '96', 1),
(73, 'FJ', 'Fiji Islands', '679', 'FJI', '29', 1),
(74, 'FI', 'Finland', '358', 'FIN', '65', 1),
(75, 'FR', 'France', '33', 'FRA', '66', 1),
(76, 'GF', 'French Guiana', '594', 'GUF', '134', 1),
(77, 'PF', 'French Polynesia', '689', 'PYF', '30', 1),
(78, 'TF', 'French Southern Territories', '0', 'TEI', '182', 1),
(79, 'GA', 'Gabon', '241', 'GAB', '216', 1),
(80, 'GM', 'Gambia The', '220', 'GMB', '217', 1),
(81, 'GE', 'Georgia', '995', 'GEO', '156', 1),
(82, 'DE', 'Germany', '49', 'DEU', '67', 1),
(83, 'GH', 'Ghana', '233', 'GHA', '218', 1),
(84, 'GI', 'Gibraltar', '350', 'GIB', '68', 1),
(85, 'GR', 'Greece', '30', 'GRC', '69', 1),
(86, 'GL', 'Greenland', '299', 'GRL', '105', 1),
(87, 'GD', 'Grenada', '1473', 'GRD', '141', 1),
(88, 'GP', 'Guadeloupe', '590', 'GLP', '135', 1),
(89, 'GU', 'Guam', '1671', 'GUM', '46', 1),
(90, 'GT', 'Guatemala', '502', 'GTM', '127', 1),
(91, 'XU', 'Guernsey and Alderney', '44', '', '', 1),
(92, 'GN', 'Guinea', '224', 'GIN', '219', 1),
(93, 'GW', 'Guinea-Bissau', '245', 'GNB', '220', 1),
(94, 'GY', 'Guyana', '592', 'GUY', '145', 1),
(95, 'HT', 'Haiti', '509', 'HTI', '130', 1),
(96, 'HM', 'Heard and McDonald Islands', '0', 'HMD', '345', 1),
(97, 'HN', 'Honduras', '504', 'HND', '115', 1),
(98, 'HK', 'Hong Kong S.A.R.', '852', 'HKG', '169', 1),
(99, 'HU', 'Hungary', '36', 'HUN', '70', 1),
(100, 'IS', 'Iceland', '354', 'ISL', '89', 1),
(101, 'IN', 'India', '91', 'IND', '20', 1),
(102, 'ID', 'Indonesia', '62', 'IDN', '170', 1),
(103, 'IR', 'Iran', '98', 'IRN', '8', 1),
(104, 'IQ', 'Iraq', '964', 'IRQ', '16', 1),
(105, 'IE', 'Ireland', '353', 'IRL', '71', 1),
(106, 'IL', 'Israel', '972', 'ISR', '17', 1),
(107, 'IT', 'Italy', '39', 'ITA', '72', 1),
(108, 'JM', 'Jamaica', '1876', 'JAM', '116', 1),
(109, 'JP', 'Japan', '81', 'JPN', '171', 1),
(110, 'XJ', 'Jersey', '44', '', '', 1),
(111, 'JO', 'Jordan', '962', 'JOR', '9', 1),
(112, 'KZ', 'Kazakhstan', '7', 'KAZ', '157', 1),
(113, 'KE', 'Kenya', '254', 'KEN', '188', 1),
(114, 'KI', 'Kiribati', '686', 'KIR', '36', 1),
(115, 'KP', 'Korea North', '850', '', '183', 1),
(116, 'KR', 'Korea South', '82', 'KOR', '176', 1),
(117, 'KW', 'Kuwait', '965', 'KWT', '2', 1),
(118, 'KG', 'Kyrgyzstan', '996', 'KGZ', '158', 1),
(119, 'LA', 'Laos', '856', '', '172', 1),
(120, 'LV', 'Latvia', '371', 'LVA', '73', 1),
(121, 'LB', 'Lebanon', '961', 'LBN', '10', 1),
(122, 'LS', 'Lesotho', '266', 'LSO', '189', 1),
(123, 'LR', 'Liberia', '231', 'LBR', '221', 1),
(124, 'LY', 'Libya', '218', 'LBY', '190', 1),
(125, 'LI', 'Liechtenstein', '423', 'LIE', '92', 1),
(126, 'LT', 'Lithuania', '370', 'LTU', '74', 1),
(127, 'LU', 'Luxembourg', '352', 'LUX', '75', 1),
(128, 'MO', 'Macau S.A.R.', '853', 'MAC', '185', 1),
(129, 'MK', 'Macedonia', '389', 'MKD', '91', 1),
(130, 'MG', 'Madagascar', '261', 'MDG', '199', 1),
(131, 'MW', 'Malawi', '265', 'MWI', '222', 1),
(132, 'MY', 'Malaysia', '60', 'MYS', '173', 1),
(133, 'MV', 'Maldives', '960', 'MDV', '21', 1),
(134, 'ML', 'Mali', '223', 'MLI', '223', 1),
(135, 'MT', 'Malta', '356', 'MLT', '76', 1),
(136, 'XM', 'Man (Isle of)', '44', '', '', 1),
(137, 'MH', 'Marshall Islands', '692', 'MHL', '37', 1),
(138, 'MQ', 'Martinique', '596', 'MTQ', '131', 1),
(139, 'MR', 'Mauritania', '222', 'MRT', '224', 1),
(140, 'MU', 'Mauritius', '230', 'MUS', '191', 1),
(141, 'YT', 'Mayotte', '269', 'MYT', '225', 1),
(142, 'MX', 'Mexico', '52', 'MEX', '117', 1),
(143, 'FM', 'Micronesia', '691', 'FSM', '38', 1),
(144, 'MD', 'Moldova', '373', 'MDA', '159', 1),
(145, 'MC', 'Monaco', '377', 'MCO', '97', 1),
(146, 'MN', 'Mongolia', '976', 'MNG', '184', 1),
(147, 'MS', 'Montserrat', '1664', 'MSR', '152', 1),
(148, 'MA', 'Morocco', '212', 'MAR', '11', 1),
(149, 'MZ', 'Mozambique', '258', 'MOZ', '226', 1),
(150, 'MM', 'Myanmar', '95', 'MMR', '22', 1),
(151, 'NA', 'Namibia', '264', 'NAM', '227', 1),
(152, 'NR', 'Nauru', '674', 'NRU', '39', 1),
(153, 'NP', 'Nepal', '977', 'NPL', '23', 1),
(154, 'AN', 'Netherlands Antilles', '599', 'ANT', '255', 1),
(155, 'NL', 'Netherlands The', '31', 'NLD', '77', 1),
(156, 'NC', 'New Caledonia', '687', 'NCL', '40', 1),
(157, 'NZ', 'New Zealand', '64', 'NZL', '31', 1),
(158, 'NI', 'Nicaragua', '505', 'NIC', '128', 1),
(159, 'NE', 'Niger', '227', 'NER', '228', 1),
(160, 'NG', 'Nigeria', '234', 'NGA', '192', 1),
(161, 'NU', 'Niue', '683', 'NIU', '41', 1),
(162, 'NF', 'Norfolk Island', '672', 'NFK', '42', 1),
(163, 'MP', 'Northern Mariana Islands', '1670', 'MNP', '43', 1),
(164, 'NO', 'Norway', '47', 'NOR', '78', 1),
(165, 'OM', 'Oman', '968', 'OMN', '5', 1),
(166, 'PK', 'Pakistan', '92', 'PAK', '24', 1),
(167, 'PW', 'Palau', '680', 'PLW', '180', 1),
(168, 'PS', 'Palestinian Territory Occupied', '970', 'PSE', '18', 1),
(169, 'PA', 'Panama', '507', 'PAN', '129', 1),
(170, 'PG', 'Papua new Guinea', '675', 'PNG', '44', 1),
(171, 'PY', 'Paraguay', '595', 'PRY', '118', 1),
(172, 'PE', 'Peru', '51', 'PER', '119', 1),
(173, 'PH', 'Philippines', '63', 'PHL', '174', 1),
(174, 'PN', 'Pitcairn Island', '0', 'PCN', '45', 1),
(175, 'PL', 'Poland', '48', 'POL', '79', 1),
(176, 'PT', 'Portugal', '351', 'PRT', '80', 1),
(177, 'PR', 'Puerto Rico', '1787', 'PRI', '133', 1),
(178, 'QA', 'Qatar', '974', 'QAT', '3', 1),
(179, 'RE', 'Reunion', '262', 'REU', '238', 1),
(180, 'RO', 'Romania', '40', 'ROU', '81', 1),
(181, 'RU', 'Russia', '70', 'RUS', '160', 1),
(182, 'RW', 'Rwanda', '250', 'RWA', '229', 1),
(183, 'SH', 'Saint Helena', '290', 'SHN', '239', 1),
(184, 'KN', 'Saint Kitts And Nevis', '1869', 'KNA', '144', 1),
(185, 'LC', 'Saint Lucia', '1758', 'LCA', '120', 1),
(186, 'PM', 'Saint Pierre and Miquelon', '508', 'SPM', '104', 1),
(187, 'VC', 'Saint Vincent And The Grenadines', '1784', 'VCT', '147', 1),
(188, 'WS', 'Samoa', '684', 'WSM', '54', 1),
(189, 'SM', 'San Marino', '378', 'SMR', '95', 1),
(190, 'ST', 'Sao Tome and Principe', '239', 'STP', '230', 1),
(191, 'SA', 'Saudi Arabia', '966', 'SAU', '4', 1),
(192, 'SN', 'Senegal', '221', 'SEN', '231', 1),
(193, 'RS', 'Serbia', '381', 'SRB', '98', 1),
(194, 'SC', 'Seychelles', '248', 'SYC', '193', 1),
(195, 'SL', 'Sierra Leone', '232', 'SLE', '232', 1),
(196, 'SG', 'Singapore', '65', 'SGP', '175', 1),
(197, 'SK', 'Slovakia', '421', 'SVK', '82', 1),
(198, 'SI', 'Slovenia', '386', 'SVN', '83', 1),
(199, 'XG', 'Smaller Territories of the UK', '44', '', '', 1),
(200, 'SB', 'Solomon Islands', '677', 'SLB', '32', 1),
(201, 'SO', 'Somalia', '252', 'SOM', '233', 1),
(202, 'ZA', 'South Africa', '27', 'ZAF', '194', 1),
(203, 'GS', 'South Georgia', '0', 'SGS', '405', 1),
(204, 'SS', 'South Sudan', '211', '', '415', 1),
(205, 'ES', 'Spain', '34', 'ESP', '84', 1),
(206, 'LK', 'Sri Lanka', '94', 'LKA', '25', 1),
(207, 'SD', 'Sudan', '249', 'SDN', '12', 1),
(208, 'SR', 'Suriname', '597', 'SUR', '146', 1),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', '47', 'SJM', '93', 1),
(210, 'SZ', 'Swaziland', '268', 'SWZ', '234', 1),
(211, 'SE', 'Sweden', '46', 'SWE', '85', 1),
(212, 'CH', 'Switzerland', '41', 'CHE', '86', 1),
(213, 'SY', 'Syria', '963', 'SYR', '13', 1),
(214, 'TW', 'Taiwan', '886', 'TWN', '177', 1),
(215, 'TJ', 'Tajikistan', '992', 'TJK', '161', 1),
(216, 'TZ', 'Tanzania', '255', 'TZA', '195', 1),
(217, 'TH', 'Thailand', '66', 'THA', '178', 1),
(218, 'TG', 'Togo', '228', 'TGO', '235', 1),
(219, 'TK', 'Tokelau', '690', 'TKL', '47', 1),
(220, 'TO', 'Tonga', '676', 'TON', '48', 1),
(221, 'TT', 'Trinidad And Tobago', '1868', 'TTO', '140', 1),
(222, 'TN', 'Tunisia', '216', 'TUN', '14', 1),
(223, 'TR', 'Turkey', '90', 'TUR', '87', 1),
(224, 'TM', 'Turkmenistan', '7370', 'TKM', '162', 1),
(225, 'TC', 'Turks And Caicos Islands', '1649', 'TCA', '121', 1),
(226, 'TV', 'Tuvalu', '688', 'TUV', '49', 1),
(227, 'UG', 'Uganda', '256', 'UGA', '236', 1),
(228, 'UA', 'Ukraine', '380', 'UKR', '163', 1),
(229, 'AE', 'United Arab Emirates', '971', 'ARE', '6', 1),
(230, 'GB', 'United Kingdom', '44', 'GBR', '88', 1),
(231, 'US', 'United States', '1', 'USA', '102', 1),
(232, 'UM', 'United States Minor Outlying Islands', '1', 'UMI', '425', 1),
(233, 'UY', 'Uruguay', '598', 'URY', '122', 1),
(234, 'UZ', 'Uzbekistan', '998', 'UZB', '164', 1),
(235, 'VU', 'Vanuatu', '678', 'VUT', '50', 1),
(236, 'VA', 'Vatican City State (Holy See)', '39', 'VAT', '94', 1),
(237, 'VE', 'Venezuela', '58', 'VEN', '123', 1),
(238, 'VN', 'Vietnam', '84', 'VNM', '179', 1),
(239, 'VG', 'Virgin Islands (British)', '1284', '', '148', 1),
(240, 'VI', 'Virgin Islands (US)', '1340', 'VIR', '132', 1),
(241, 'WF', 'Wallis And Futuna Islands', '681', 'WLF', '51', 1),
(242, 'EH', 'Western Sahara', '212', 'ESH', '237', 1),
(243, 'YE', 'Yemen', '967', 'YEM', '15', 1),
(244, 'YU', 'Yugoslavia', '38', 'YUG', '', 1),
(245, 'ZM', 'Zambia', '260', 'ZMB', '196', 1),
(246, 'ZW', 'Zimbabwe', '263', 'ZWE', '197', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `temp_address` varchar(255) DEFAULT NULL,
  `residency_card` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) NOT NULL,
  `driving_license` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `passport_detail` varchar(255) DEFAULT NULL,
  `visa_detail` varchar(255) DEFAULT NULL,
  `mobile` varchar(30) NOT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `insurance` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `customers`
--

TRUNCATE TABLE `customers`;
--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_id`, `customer_id`, `title`, `first_name`, `middle_name`, `last_name`, `permanent_address`, `temp_address`, `residency_card`, `nationality`, `driving_license`, `gender`, `dob`, `passport_detail`, `visa_detail`, `mobile`, `country_code`, `email`, `insurance`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pr-1', 'Mr.', 'Ahmed', NULL, 'Mukhairi', 'Ghala\r\nMuscat\r\nOman', NULL, 'CustomersImages/hLnJkmEwPe0MmEQcKUiRJ1vKCQcjVmMRsqwqtLxH.jpg', 'Oman', 'CustomersImages/j9B1HCaB136wudKo4vb04QQHHBhMJdIFmGbPFMU7.pdf', 'Male', '1980-02-02', NULL, NULL, '94268524', '968', 'varad_777@yahoo.com', NULL, '2022-12-06 21:08:46', '2022-12-06 21:08:46'),
(2, 1, 'Pr-2', 'Mrs.', 'Hanan', NULL, 'Alqabil', 'Azaiba\r\nMuscat\r\nOman', NULL, 'CustomersImages/Hkcy9fmFHclGkFUKnU1d7zDXbDBnX3zdKYLN79wk.jpg', 'Oman', 'CustomersImages/n63eLpOMRwhOYkRKYzLmejGEIz0NPix2rQ4Dxswh.pdf', 'Female', '1990-01-01', NULL, NULL, '9889889', '968', 'hananq@gmail.com', NULL, '2022-12-06 21:19:22', '2022-12-06 21:19:22'),
(3, 1, 'Pr-3', 'Mr.', 'Tom', NULL, 'Alfred', 'Qurum\r\nMuscat\r\nOman', NULL, NULL, 'United Kingdom', 'CustomersImages/egnSGIsv5DD0mFiJz4qZI4WbcL5pphKPE3aNKHlJ.jpg', 'Male', '1980-04-02', 'CustomersImages/CVSCPPvtdv1VJkXw43RUFHJnmAjXUccOzAAfmspY.jpg', NULL, '22022122', '44', 'tomalfred@gmail.com', NULL, '2022-12-06 21:28:12', '2022-12-06 21:28:12'),
(4, 1, 'Pr-4', 'Mr.', 'Akbar', NULL, 'Khan', 'Azaiba Heights\r\nAl Maarid Street\r\nAzaiba\r\nMuscat\r\nOman', NULL, NULL, 'India', 'CustomersImages/UFvcPIvOsahxqfS3nHAup1zNMmONnuZPa7MfaO3g.jpg', 'Male', '1990-01-01', 'CustomersImages/64yQdgdpTfLRwqS59K8iLJuM9zivCtkRQB4Rf2d7.jpg', NULL, '9790000242', '91', 'akbar.khan@gmail.com', NULL, '2022-12-06 21:31:07', '2022-12-06 21:31:07'),
(5, 1, 'Pr-5', 'Mr.', 'Varadharajan', NULL, 'Sowrirajan', 'Azaiba\r\nMuscat\r\nOman', NULL, NULL, 'India', 'CustomersImages/qoAViEmAM0Mzbk4Fy1fjbdIVtxtOoBW3p8hGADzb.jpg', 'Male', '1990-12-10', 'CustomersImages/ipGu2qEKHi4OjDkq22LKQqTgZbGBxFxJXzfJKN1k.jpg', NULL, '+9687990990', NULL, 's.varadharajan@hotmail.com', NULL, '2022-12-06 21:36:55', '2022-12-06 21:36:55'),
(6, 1, 'Pr-6', 'Mr.', 'Jalal', NULL, 'Sheriff', 'Ghala,\r\nMuscat\r\nSultanate of Oman', NULL, NULL, 'Pakistan', 'CustomersImages/0ZgBXKDzSbJbXhj6JfRVqiy7kA321iVJwRmzf22w.jpg', 'Male', '2010-01-01', 'CustomersImages/lB9UABUN0eRl6Z33OQzouy0jL3mUE8vo2sO7nfAS.jpg', NULL, '+96898989872', NULL, 'varad_777@yahoo.com', NULL, '2022-12-09 17:04:17', '2022-12-09 17:04:17'),
(7, 1, 'Pr-7', 'Mr.', 'arun', NULL, 'sharma', 'vill. Lohar Majra, PO-Kamoda,Tehsile-Pehowa,Kurukshetra', NULL, 'CustomersImages/dGZBQEtYNXBnqJc0EHZcObimztWfT3IqFCciATPA.png', 'India', 'CustomersImages/ubGOaqE52K7VO4VJeOCsxu4JO0bPY6Ts2vXDfkIs.png', 'Male', '2019-06-01', 'CustomersImages/1p9Q273TBoEfYRvFAnpLIwQoRoY7iM7KuKzpGqsa.png', 'CustomersImages/Xfo0XuelIgcCn9btFraoLW1gMJMtDj3KdjNj15gE.png', '9992297951', '91', 'arunsharma@gmail.com', NULL, '2022-12-30 21:01:29', '2022-12-30 21:01:29'),
(8, 1, 'Pr-8', 'Mr.', 'nikhil', NULL, 'yadav', 'fdsfdsf', 'fdsfdsf', NULL, 'India', 'CustomersImages/w03gIvQ9UBhCJBGVwji7qtagqtM9UPJgoH35P0ax.png', 'Male', '2022-12-07', 'CustomersImages/0CfLhitUhZP7SmcrzYfr4u0MYcCpaRH8VSohO8zG.png', NULL, '09992297951', '91', 'nikhil@gmail.com', NULL, '2022-12-30 21:21:09', '2022-12-30 21:21:09'),
(9, 1, 'Pr-9', 'Mr.', 'Majid', NULL, 'Rawahi', 'Al Khoud\r\nSeeb\r\nMuscat', NULL, 'CustomersImages/vBVXWAM9UK7TSUgDCb0sIPxMxp1l3dFrat7CoUJb.jpg', 'Oman', 'CustomersImages/TmA3kJEHg6JaUlwANsI5O0T9Wz7w4opS4SdZzpGm.jpg', 'Male', '2000-01-01', NULL, NULL, '+9687787878', NULL, 's.varadharajan@hotmail.com', NULL, '2023-01-26 15:43:11', '2023-01-26 15:43:11'),
(10, 1, 'Pr-10', 'Mr.', 'jaipal', NULL, 'yadav', 'vill. Lohar Majra,PO-Kamoda', NULL, 'CustomersImages/D4mmXDiR6sVHSf0wPtWOQdJIsjnEs1fEWw4zQbeQ.png', 'India', 'CustomersImages/YTfVok6ipmseMjhCWZerIsJroYa7E2BiU7MQTsUq.png', 'Male', '2023-01-12', 'CustomersImages/RtBf1kP75EtubQPYlJBMUtB297Mvr560NSoJ28Uo.png', 'CustomersImages/7hxE7JXSZ4RYz3mc5kbx7U3bqqs1gV9qk3LaRE0D.png', '9992297951', '91', 'jaipalyadav147@gmail.com', NULL, '2023-01-31 15:11:33', '2023-01-31 15:11:33'),
(11, 1, 'Pr-11', 'Mr.', 'Suresh', NULL, 'Yadav', 'dddddd', 'ddddd', 'CustomersImages/NDs4ToWoDnP6VILFkmd7aosgIEijkXyl5PF4zqBC.png', 'India', 'CustomersImages/9jtuQF40OhThSu8iX5MAnz0NvpNeTkzrtKuEXxsO.png', 'Male', '2023-01-31', 'CustomersImages/B3ZPtLAEwoVIYdpRxpeaUS2Fn7qCDBjMWqDl0zHB.png', 'CustomersImages/eUwFgOTXBFBstk85Mia59avpsPwWZOUqRbBUa8Lz.png', '9865986598', '91', 'sureshyadav47@gmail.com', 'dddd', '2023-02-03 00:22:16', '2023-02-03 00:22:16'),
(12, 1, 'Pr-12', 'Mr.', 'varadha', NULL, 'rajan', '92\r\nakbar st\r\nmylapore\r\nchennai', NULL, 'CustomersImages/tkgegkMCevlinE219pIXlbGPyfMJ3wH6MwDKy1Bh.png', 'India', 'CustomersImages/AYSZ0IXAWKYknfXmBoVbkoTneSQ0HxJMbxP4Elar.jpg', 'Male', '2000-02-02', NULL, NULL, '+9188799009', NULL, 's.varadharajan@hotmail.com', NULL, '2023-02-06 15:06:23', '2023-02-06 15:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `failed_jobs`
--

TRUNCATE TABLE `failed_jobs`;
-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

DROP TABLE IF EXISTS `licenses`;
CREATE TABLE `licenses` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `conact_name` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1 : CR; 2: Visitor',
  `user_type` int(11) NOT NULL,
  `validay` int(11) NOT NULL,
  `total_employee` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `licenses`
--

TRUNCATE TABLE `licenses`;
--
-- Dumping data for table `licenses`
--

INSERT INTO `licenses` (`id`, `company_id`, `conact_name`, `mobile`, `email`, `role`, `user_type`, `validay`, `total_employee`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Manoj', '12345', 'manoj.spec@gmail.com', 1, 1, 1, 0, '2022-12-07', 1, '2022-12-06 19:33:52', '2022-12-06 19:33:52'),
(3, 1, 'Pulkit Jalani', '+49342342', 'pulkitintech@gmail.com', 1, 1, 10, 10, '2022-12-16', 1, '2022-12-06 19:49:41', '2022-12-06 19:49:41'),
(4, 1, 'Manoj Pro', '12345', 'manojsoundararajan@gmail.com', 1, 1, 2, 2, '2022-12-08', 1, '2022-12-06 20:16:52', '2022-12-06 20:16:52'),
(5, 1, 'Varadha', '79273966', 's.varadharajan@hotmail.com', 1, 1, 1, 2, '2022-12-07', 1, '2022-12-06 20:20:04', '2022-12-06 20:20:04'),
(6, 1, 'Pranav', '+96891382742', 'cheersmanoj@icloud.com', 1, 2, 1, 0, '2022-12-07', 1, '2022-12-07 00:55:40', '2022-12-07 00:55:40'),
(7, 1, 'Waseem', '12345', 'waseem@hwinfotech.com', 1, 1, 3, 0, '2022-12-13', 1, '2022-12-10 18:12:15', '2022-12-10 18:12:15'),
(8, 1, 'Mithu', '9992297951', 'mithu47@gmail.com', 1, 1, 365, 2, '2023-12-29', 1, '2022-12-29 11:32:12', '2022-12-29 11:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `ls_ip_addresses`
--

DROP TABLE IF EXISTS `ls_ip_addresses`;
CREATE TABLE `ls_ip_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `license_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `ls_ip_addresses`
--

TRUNCATE TABLE `ls_ip_addresses`;
-- --------------------------------------------------------

--
-- Table structure for table `ls_licensable_products`
--

DROP TABLE IF EXISTS `ls_licensable_products`;
CREATE TABLE `ls_licensable_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `licensable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `licensable_id` bigint(20) UNSIGNED NOT NULL,
  `license_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `ls_licensable_products`
--

TRUNCATE TABLE `ls_licensable_products`;
-- --------------------------------------------------------

--
-- Table structure for table `ls_licenses`
--

DROP TABLE IF EXISTS `ls_licenses`;
CREATE TABLE `ls_licenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `license_key` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `total_employee` int(5) NOT NULL DEFAULT '0',
  `expiration_date` datetime NOT NULL,
  `is_trial` tinyint(1) NOT NULL,
  `is_lifetime` tinyint(1) NOT NULL,
  `license_module` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `ls_licenses`
--

TRUNCATE TABLE `ls_licenses`;
--
-- Dumping data for table `ls_licenses`
--

INSERT INTO `ls_licenses` (`id`, `user_id`, `created_by`, `domain`, `license_key`, `status`, `total_employee`, `expiration_date`, `is_trial`, `is_lifetime`, `license_module`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 30, 9, 'nucleuz.app', 'bf0713fa-0ba2-4f29-88de-3cbb0e383f37', 'active', 0, '2024-01-01 06:55:11', 0, 0, 1, NULL, '2023-01-01 13:55:11', '2023-01-01 13:55:11'),
(2, 31, 9, 'nucleuz.app', 'aff35cb0-e5d1-4111-9353-1e4d68c01fb6', 'inactive', 2, '2023-09-08 06:57:15', 0, 0, 2, NULL, '2023-01-01 13:57:15', '2023-01-02 22:06:14'),
(3, 32, 9, 'nucleuz.app', 'ee640a54-7c06-46ca-a75a-096d7183c546', 'suspended', 0, '2023-01-13 12:09:16', 0, 0, 2, NULL, '2023-01-01 13:58:28', '2023-01-02 22:05:46'),
(4, 33, 1, 'nucleuz.app', '7d12c10d-7334-4b9a-b588-3c566247438b', 'active', 5, '2023-02-27 03:40:27', 0, 0, 1, NULL, '2023-01-02 22:40:27', '2023-03-21 01:24:41'),
(5, 34, 9, 'nucleuz.app', '89465a5b-859a-4c8b-a0e8-51fd19dff7b8', 'active', 2, '2023-07-31 03:43:08', 0, 0, 1, NULL, '2023-01-12 22:43:08', '2023-01-12 22:43:08'),
(6, 39, 1, 'nucleuz.app', '673d01d6-adcd-42a4-9953-5521b1ce39c5', 'active', 0, '2024-03-20 08:21:41', 0, 0, 1, NULL, '2023-03-21 15:21:41', '2023-03-21 15:21:41'),
(7, 40, 36, 'nucleuz.app', 'dd9208c2-0f05-4092-92e7-6c849ca809f5', 'active', 0, '2024-03-20 11:30:11', 0, 0, 1, NULL, '2023-03-21 18:30:11', '2023-03-21 18:30:11'),
(8, 41, 1, 'nucleuz.app', '0104560d-f3c6-4c34-bd24-a2e7f108ee45', 'active', 1, '2024-04-20 06:28:52', 0, 0, 1, NULL, '2023-04-21 13:28:52', '2023-04-21 13:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `ls_licenses120`
--

DROP TABLE IF EXISTS `ls_licenses120`;
CREATE TABLE `ls_licenses120` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `domain` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_key` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `expiration_date` datetime DEFAULT NULL,
  `is_trial` tinyint(1) NOT NULL DEFAULT '0',
  `is_lifetime` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `ls_licenses120`
--

TRUNCATE TABLE `ls_licenses120`;
-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(41, '2014_10_12_000000_create_users_table', 1),
(42, '2014_10_12_100000_create_password_resets_table', 1),
(43, '2019_08_19_000000_create_failed_jobs_table', 1),
(44, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(45, '2022_01_01_100000_create_ls_licenses_table', 1),
(46, '2022_01_01_100001_create_ls_ip_addresses_table', 1),
(47, '2022_01_01_100002_create_ls_licensable_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desp` varchar(255) NOT NULL,
  `linked_id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `notifications`
--

TRUNCATE TABLE `notifications`;
--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `desp`, `linked_id`, `module`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Customer Registration', 'Varadharajan is register from your invite link', 5, 'booking', 6, 1, '2022-12-06 21:36:55', '2022-12-06 21:37:37'),
(2, 'New Customer Registration', 'Jalal is register from your invite link', 14, 'booking', 6, 1, '2022-12-09 17:04:17', '2022-12-09 20:49:51'),
(3, 'New Customer Registration', 'Majid is register from your invite link', 20, 'booking', 33, 0, '2023-01-26 15:43:11', '2023-01-26 15:43:11'),
(4, 'New Customer Registration', 'varadha is register from your invite link', 24, 'booking', 33, 0, '2023-02-06 15:06:23', '2023-02-06 15:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `offices`
--

TRUNCATE TABLE `offices`;
--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Prozorp Rental LLC', 'Muscat, Oman', '2022-12-06 19:33:23', '2023-01-12 13:06:25'),
(2, 'test', 'test', '2023-01-12 13:06:45', '2023-01-12 13:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `personal_access_tokens`
--

TRUNCATE TABLE `personal_access_tokens`;
-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

DROP TABLE IF EXISTS `pricings`;
CREATE TABLE `pricings` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `daily_pricing` varchar(10) NOT NULL,
  `weekly_pricing` varchar(10) NOT NULL,
  `monthly_pricing` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `pricings`
--

TRUNCATE TABLE `pricings`;
--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `company_id`, `car_type`, `daily_pricing`, `weekly_pricing`, `monthly_pricing`, `created_at`, `updated_at`) VALUES
(2, 1, 'SUV', '45', '245', '350', '2022-12-06 21:00:24', '2022-12-06 21:00:24'),
(4, 1, 'Sedan', '20', '55', '185', '2023-01-24 17:16:28', '2023-01-24 17:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `products`
--

TRUNCATE TABLE `products`;
--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Car Rental', 'Car Rental module description', 'active', '2022-12-31 14:29:46', '2022-12-31 14:29:46'),
(2, 'Visitor Management', 'Visitor Management module description', 'active', '2022-12-31 14:30:40', '2022-12-31 14:30:40'),
(3, 'test120', 'test120', 'active', '2023-01-12 13:33:20', '2023-01-12 13:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `roles`
--

TRUNCATE TABLE `roles`;
--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'office,user', '2022-09-13 11:03:08', '2022-09-13 05:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `staff`
--

TRUNCATE TABLE `staff`;
--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `mobile`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'jaiho', 'jaiho120@gmail.com', '9992297951', 1, '2023-01-23 01:05:40', '2023-01-23 01:05:40'),
(2, 'mithu', 'jaiho120@gmail.com', '9992297952', 1, '2023-01-23 01:10:28', '2023-01-23 01:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `validity` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `subscriptions`
--

TRUNCATE TABLE `subscriptions`;
--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `company_id`, `validity`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-12-06', '2022-12-07', '2022-12-06 19:33:52', '2022-12-06 19:33:52'),
(2, 2, 5, '2022-12-06', '2022-12-11', '2022-12-06 19:48:06', '2022-12-06 19:48:06'),
(3, 3, 10, '2022-12-06', '2022-12-16', '2022-12-06 19:49:41', '2022-12-06 19:49:41'),
(4, 4, 2, '2022-12-06', '2022-12-08', '2022-12-06 20:16:52', '2022-12-06 20:16:52'),
(5, 5, 1, '2022-12-06', '2022-12-07', '2022-12-06 20:20:04', '2022-12-06 20:20:04'),
(6, 6, 1, '2022-12-06', '2022-12-07', '2022-12-07 00:55:40', '2022-12-07 00:55:40'),
(7, 5, 2, '2022-12-08', '2022-12-10', '2022-12-09 02:41:06', '2022-12-09 02:41:06'),
(8, 4, 3, '2022-12-09', '2022-12-12', '2022-12-09 16:46:37', '2022-12-09 16:46:37'),
(9, 7, 3, '2022-12-10', '2022-12-13', '2022-12-10 18:12:15', '2022-12-10 18:12:15'),
(10, 4, 3, '2022-12-16', '2022-12-19', '2022-12-16 13:39:15', '2022-12-16 13:39:15'),
(11, 4, 10, '2022-12-21', '2022-12-31', '2022-12-21 20:56:55', '2022-12-21 20:56:55'),
(12, 8, 365, '2022-12-29', '2023-12-29', '2022-12-29 11:32:12', '2022-12-29 11:32:12'),
(13, 4, 365, '2022-12-30', '2023-12-30', '2022-12-30 15:11:02', '2022-12-30 15:11:02'),
(14, 5, 365, '2022-12-30', '2023-12-30', '2022-12-30 15:59:17', '2022-12-30 15:59:17'),
(15, 6, 365, '2022-12-30', '2023-12-30', '2022-12-30 19:20:45', '2022-12-30 19:20:45'),
(16, 7, 50, '2022-12-30', '2023-02-18', '2022-12-30 19:30:23', '2022-12-30 19:30:23'),
(17, 8, 365, '2022-12-31', '2023-12-31', '2022-12-31 16:12:55', '2022-12-31 16:12:55'),
(18, 9, 365, '2023-01-01', '2024-01-01', '2023-01-01 10:07:20', '2023-01-01 10:07:20'),
(19, 10, 365, '2023-01-01', '2024-01-01', '2023-01-01 13:18:08', '2023-01-01 13:18:08'),
(20, 1, 365, '2023-01-01', '2024-01-01', '2023-01-01 13:55:11', '2023-01-01 13:55:11'),
(21, 2, 250, '2023-01-01', '2023-09-08', '2023-01-01 13:57:15', '2023-01-01 13:57:15'),
(22, 3, 12, '2023-01-01', '2023-01-13', '2023-01-01 13:58:28', '2023-01-01 13:58:28'),
(23, 4, 3, '2023-01-02', '2023-01-05', '2023-01-02 22:40:27', '2023-01-02 22:40:27'),
(24, 4, 5, '2023-01-06', '2023-01-11', '2023-01-06 17:42:04', '2023-01-06 17:42:04'),
(25, 4, 7, '2023-01-12', '2023-01-19', '2023-01-12 20:53:35', '2023-01-12 20:53:35'),
(26, 5, 200, '2023-01-12', '2023-07-31', '2023-01-12 22:43:08', '2023-01-12 22:43:08'),
(27, 4, 30, '2023-03-20', '2023-04-19', '2023-03-21 01:29:15', '2023-03-21 01:29:15'),
(28, 6, 365, '2023-03-21', '2024-03-20', '2023-03-21 15:21:41', '2023-03-21 15:21:41'),
(29, 7, 365, '2023-03-21', '2024-03-20', '2023-03-21 18:30:11', '2023-03-21 18:30:11'),
(30, 8, 365, '2023-04-21', '2024-04-20', '2023-04-21 13:28:52', '2023-04-21 13:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `variant` varchar(255) NOT NULL,
  `km_reading` varchar(255) NOT NULL,
  `car_image` varchar(255) DEFAULT NULL,
  `car_condition_image` varchar(255) DEFAULT NULL,
  `fuel_level_reading` varchar(255) DEFAULT NULL,
  `current_condition` varchar(255) DEFAULT NULL,
  `ac` varchar(255) DEFAULT NULL,
  `Audio` varchar(255) DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `mulkiya_details` varchar(255) NOT NULL,
  `insurance_detail` varchar(255) DEFAULT NULL,
  `chasis_no` varchar(255) NOT NULL,
  `engine_no` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `vehicles`
--

TRUNCATE TABLE `vehicles`;
--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `company_id`, `car_type`, `make`, `model`, `variant`, `km_reading`, `car_image`, `car_condition_image`, `fuel_level_reading`, `current_condition`, `ac`, `Audio`, `gps`, `mulkiya_details`, `insurance_detail`, `chasis_no`, `engine_no`, `reg_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sedan', 'Hyundai', 'Sonata', '2022', 'yes', 'VehicleImages/6VwA9Sufq8H52ANoC2d78lI4Q5gRYJdM58gWttnE.jpg', 'VehicleImages/EaXRHhXsbBOgVurzBKojtT6N5xSn8H5jGmLLoESd.jpg', '102', 'Good', 'yes', 'yes', 'yes1', 'VehicleImages/S0UGsuya3sxZiJQlmc8YpKXjjHhrnYOAVWa6HjMe.jpg', 'DI000001011', 'CH00000010101', 'EN0000010101', '21000 R', '2022-12-06 20:45:19', '2023-01-20 11:55:37'),
(2, 1, 'Sedan', 'Hyundai', 'Elantra', '2021', '201', 'VehicleImages/hMede4mCSKGFFbFSBJuMcKY6ho9ST52Yi970e9U1.jpg', 'VehicleImages/4lKr0e91xDGCs87Pj07pp65oGYAsu9ZUpLKUgBzA.jpg', '202', 'Good', 'yes', 'yes', 'No', 'VehicleImages/WH5DJg0dM0NthxlUgbg6yykUhKZ4mcrntyemukZX.jpg', 'VI00000201', 'CH000000201201', 'EN00000201201', '20100 S', '2022-12-06 20:45:19', '2022-12-06 20:55:48'),
(3, 1, 'Sedan', 'Kia', 'RIO', '2020', '301', 'VehicleImages/HGSYsXne8fT0xMcruQgkNxVnH0uDLUA232RwbyA1.jpg', 'VehicleImages/LqmLz5tTxZV6IaspeG6caWyFRiTlmhuK74akECwt.jpg', '302', 'Good', 'yes', 'yes', 'No', 'VehicleImages/20a8C6ycbZh1ILIukKCBeWdymkhfJMvtLUgcRpzS.jpg', 'OI00000301', 'CH000000301301', 'EN00000301301', '30100 T', '2022-12-06 20:45:19', '2022-12-06 20:56:16'),
(4, 1, 'Sedan', 'Kia', 'Cerato', '2021', '401', 'VehicleImages/1DzKOnBQRtcdaMCkOp35xeptR18z2X5kZirPMUWy.jpg', 'VehicleImages/y2KnFzbVfX5wbgspj4jpZyd8xyErVeL2vRnpQWEp.jpg', '402', 'Good', 'yes', 'yes', 'yes', 'VehicleImages/3uKvvAzrRnQRUFhBW2ZUjAX9JT6edTSWL2GFTdgQ.jpg', 'OI00000401', 'CH000000401401', 'EN00000401401', '40100 U', '2022-12-06 20:45:19', '2022-12-06 20:58:30'),
(5, 1, 'SUV', 'MITSUBISHI PAJERO', 'Pajero', '2021', '501', 'VehicleImages/RUldxZ955OSuuJcPr4aLpJOqaLrXGfKVl8Ef5AmZ.jpg', 'VehicleImages/lYHzEwwFmeguvruiM5oDZ8sR2MvbGuV5sKfDeXR0.jpg', '502', 'Good', 'yes', 'yes', 'yes', 'VehicleImages/KqvVxELmJR9zs4CZ9o9NJwqZENrjinag2b4SfKaJ.jpg', 'OI00000402', 'CH000000501501', 'EN00000501501', '50100 V', '2022-12-06 20:45:19', '2022-12-06 20:57:17'),
(6, 1, 'SUV', 'Hyundai', 'Tucson', '2021', '601', 'VehicleImages/MruGI3HuA7JZp4LItrGDAYblIVlmHTlxeicY0s9F.jpg', 'VehicleImages/8kWA15CFBlathIVVzB7YvLPrhSiV9KifVd04wkhf.jpg', '602', 'Good', 'yes', 'yes', 'yes', 'VehicleImages/QzObz4j9Y161DkjgF6GoLsxKW5rJlMtqW5D9iPHl.jpg', 'OI00000403', 'CH000000601601', 'EN00000601601', '60100 W', '2022-12-06 20:45:19', '2022-12-06 20:57:53'),
(7, 1, 'SUV', 'MG', 'RX8', '2021', '701', 'VehicleImages/jmIv4uKKPsKHpF6Jx6rcEKqvSw9bAmXZio6O5mBt.jpg', 'VehicleImages/pK9HXrZ9FGpgG7xEJdmNR2vwbUvnK0JgaLevapTx.jpg', '702', 'Good', 'yes', 'yes', 'yes', 'VehicleImages/DcGtK6y7laQJjk0XTRbbNBHsuoi821Wgi0DbfMaP.jpg', 'OI00000404', 'CH000000701701', 'EN00000701701', '70100 X', '2022-12-06 20:45:19', '2022-12-06 20:58:17'),
(8, 1, 'Coupe', 'BMW', 'R8', '2021', '801', 'VehicleImages/yClMcPxdaMlAVswiPrRGTVikICUClVF331hbHShP.jpg', 'VehicleImages/cma2mjEtEVdXITelrE4T20z7akgRhyw18kCj3jxD.jpg', '802', 'Good', 'yes', 'yes', 'yes', 'VehicleImages/rLjvFw3aJOwTAIoKSbRjeJNeky4MBDn5iVGNJhlS.jpg', 'OI00000405', 'CH000000801801', 'EN00000801801', '80100 Y', '2022-12-06 20:45:19', '2022-12-27 14:48:31'),
(9, 1, 'Coupe', 'AUDI', 'A5', '2021', '901', 'VehicleImages/RWp8820P2Pwi5XOzp4svh6UhCrwIOs5I29yioaEk.jpg', 'VehicleImages/aQ01wTXkaputaX5fv1QQWpGrXvwmndyWSrcrLhHx.jpg', '902', 'Good', 'yes', 'yes', 'yes', 'VehicleImages/jt3bA89quZFapzqEznMfbfKasuzt6E0LnSmCJnfT.jpg', 'OI00000406', 'CH000000901901', 'EN00000901901', '90100 Z', '2022-12-06 20:45:19', '2022-12-06 20:54:21'),
(10, 1, 'Coupe', 'Mercedes Benz', 'C Class', '2021', '110', 'VehicleImages/KM8VtxzJsPYclJMkA3ao8NotF3JHnVWPTp8UZoMk.jpg', 'VehicleImages/ZSx3adgsKoYjkvYIFCsXrSMkBaSf1OYXkhj3xMDO.jpg', '112', 'Good', 'yes', 'yes', 'yes', 'VehicleImages/Er75fxRvdSSkKYmvalNGZ5HxyDVevvwsVMLXhle4.jpg', 'OI00000407', 'CH000000110110', 'EN00000110110', '11010 A', '2022-12-06 20:45:19', '2022-12-06 20:55:00'),
(11, 1, 'SUV', 'Range Rover', '2021', 'SV', 'yes', 'VehicleImages/iKN8CUBEemiICHG0urtUxZ27zLn7w7FC7rTV66S2.jpg', NULL, 'Half', 'GOOD', NULL, 'yes', 'yes', 'VehicleImages/S23j0LTOunMOC3lEkg4eZI8tytq6qSGp08vvbqSk.jpg', NULL, 'RR01010101010', 'REN010101010', '23232 T', '2023-01-24 17:12:57', '2023-01-24 17:15:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_invites`
--
ALTER TABLE `booking_invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ls_ip_addresses`
--
ALTER TABLE `ls_ip_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ls_ip_addresses_license_id_foreign` (`license_id`);

--
-- Indexes for table `ls_licensable_products`
--
ALTER TABLE `ls_licensable_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ls_licensable_products_id_type_id_index` (`license_id`,`licensable_type`,`licensable_id`),
  ADD KEY `ls_licensable_products_licensable_type_licensable_id_index` (`licensable_type`,`licensable_id`),
  ADD KEY `ls_licensable_products_user_id_foreign` (`user_id`);

--
-- Indexes for table `ls_licenses`
--
ALTER TABLE `ls_licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ls_licenses120`
--
ALTER TABLE `ls_licenses120`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ls_licenses_license_key_unique` (`license_key`),
  ADD UNIQUE KEY `ls_licenses_domain_unique` (`domain`),
  ADD KEY `ls_licenses_user_id_foreign` (`user_id`),
  ADD KEY `ls_licenses_created_by_foreign` (`created_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `booking_invites`
--
ALTER TABLE `booking_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ls_ip_addresses`
--
ALTER TABLE `ls_ip_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ls_licensable_products`
--
ALTER TABLE `ls_licensable_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ls_licenses`
--
ALTER TABLE `ls_licenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ls_licenses120`
--
ALTER TABLE `ls_licenses120`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ls_ip_addresses`
--
ALTER TABLE `ls_ip_addresses`
  ADD CONSTRAINT `ls_ip_addresses_license_id_foreign` FOREIGN KEY (`license_id`) REFERENCES `ls_licenses120` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ls_licensable_products`
--
ALTER TABLE `ls_licensable_products`
  ADD CONSTRAINT `ls_licensable_products_license_id_foreign` FOREIGN KEY (`license_id`) REFERENCES `ls_licenses120` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ls_licensable_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ls_licenses120`
--
ALTER TABLE `ls_licenses120`
  ADD CONSTRAINT `ls_licenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ls_licenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
