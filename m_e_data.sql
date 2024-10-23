-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 07:58 AM
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
-- Database: `m_e_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `sku`, `name`, `description`, `price`, `stock`, `image`, `created_at`) VALUES
(4, '41YmI+NIzHL._SY300_SX300', 'Lenovo IdeaPad', 'Lenovo IdeaPad Slim 1 AMD Ryzen 5 5500U 15.6\" HD Thin and Light Laptop (16GB/512GB SSD/Integrated AMD Graphics/Windows 11 Home/MSO 21/1Yr ADP Free/Cloud Grey/1.61Kg)', 36990.00, 100, '41YmI+NIzHL._SY300_SX300_.jpg', '2024-10-14 10:09:44'),
(6, '41tS3gyOW1L._SX300_SY300', 'iQOO Z9s 5G', 'iQOO Z9s Pro 5G (Luxe Marble, 8Gb Ram, 128Gb Storage) | Snapdragon 7 Gen 3 Processor |120 Hz Curved Amoled Display with 4500 Nits Local Peak Brightness | 5500 Mah Battery | Ai Erase, White', 34499.00, 100, 'mobile.jpg', '2024-10-14 10:21:24'),
(7, '41tS3gyOW1L_Apple-iPhone-16-128 GB-Black', 'Apple iPhone 16 ', 'BUILT FOR APPLE INTELLIGENCE — Apple Intelligence is the personal intelligence system that helps you write, express yourself and get things done effortlessly. With groundbreaking privacy protections, it gives you peace of mind that no one else can access your data — not even Apple.', 79899.00, 100, 'apple 16 (1).jpg', '2024-10-14 10:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_form`
--

CREATE TABLE `order_form` (
  `order_form_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state_name` enum('Andaman and Nicobar Islands','Arunachal Pradesh','Assam','Bihar','Chandigarh','Chhattisgarh','Dadra and Nagar Haveli','Daman and Diu','Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand','Karnataka','Kerala','Lakshadweep','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Odisha','Puducherry','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttarakhand','Uttar Pradesh','West Bengal') NOT NULL,
  `payment_method` enum('credit Card','debit Card','UPI','net Banking','cash on Delivery') NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_form`
--

INSERT INTO `order_form` (`order_form_id`, `address`, `state_name`, `payment_method`, `user_id`) VALUES
(25, 'PLOT NO.75, VANMALI PARK RO HOUSE, NEAR PUJAN PLAZA, PUNA CANAL BRTS ROAD, YOGICHOWK', 'Gujarat', 'UPI', 1),
(26, '75,Vanmali Park Society, Yogichowk, Surat', 'Gujarat', 'debit Card', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

CREATE TABLE `order_summary` (
  `order_summary_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_form_id` int(11) DEFAULT NULL,
  `quantity` text NOT NULL,
  `total_price` decimal(50,2) NOT NULL,
  `cgst` decimal(50,2) NOT NULL,
  `sgst` decimal(50,2) NOT NULL,
  `total_with_gst` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`order_summary_id`, `user_id`, `order_form_id`, `quantity`, `total_price`, `cgst`, `sgst`, `total_with_gst`) VALUES
(14, 1, 25, '[{\"id\":\"4\",\"name\":\"Lenovo IdeaPad\",\"price\":\"36990.00\",\"description\":\"\'. $row[\'description\'].\'\",\"photo\":\" \'.$row[\'photo\'].\'\",\"quantity\":\"10\"},{\"id\":\"6\",\"name\":\"iQOO Z9s 5G\",\"price\":\"34499.00\",\"description\":null,\"photo\":null,\"quantity\":\"6\"},{\"id\":\"7\",\"name\":\"Apple iPhone 16 \",\"price\":\"79899.00\",\"description\":null,\"photo\":null,\"quantity\":\"5\"}]', 976389.00, 87875.01, 87875.01, 1152139.02),
(15, 1, 26, '[{\"id\":\"4\",\"name\":\"Lenovo IdeaPad\",\"price\":\"36990.00\",\"description\":null,\"photo\":null,\"quantity\":\"4\"},{\"id\":\"6\",\"name\":\"iQOO Z9s 5G\",\"price\":\"34499.00\",\"description\":null,\"photo\":null,\"quantity\":\"3\"},{\"id\":\"7\",\"name\":\"Apple iPhone 16 \",\"price\":\"79899.00\",\"description\":null,\"photo\":null,\"quantity\":\"3\"}]', 491154.00, 44203.86, 44203.86, 579561.72);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `pin_code` varchar(6) NOT NULL,
  `user_type` enum('Seller','Customer') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `name`, `email`, `password`, `mobile_number`, `gender`, `city_name`, `pin_code`, `user_type`, `photo`, `created_at`) VALUES
(1, 'SMITKUMAR ASHOKBHAI BALAR', 'sbalar0333@gmail.com', '123', '6355219985', 'male', 'Surat', '395011', 'Seller', 'upload/670cf7a8be4c5_IMG_0120 1212.jpg', '2024-10-09 14:15:35'),
(2, 'Jaykumar Jayeshbhai Italiya', 'jay@gmail.com', '123', '6355219985', 'male', 'Surat', '395010', 'Customer', 'upload/670cf7c055bda_CINE74798.JPG', '2024-10-10 06:39:23'),
(3, 'Pranjal Mukeshbhai Italiya', 'pranjal0333@gmail.com', '123', '1234567890', 'male', 'surat', '395010', 'Seller', 'upload/67178c62f0c79_2022_01_26_12_58_IMG_7464.JPG', '2024-10-22 11:07:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `order_form`
--
ALTER TABLE `order_form`
  ADD PRIMARY KEY (`order_form_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD PRIMARY KEY (`order_summary_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_form_id` (`order_form_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_form`
--
ALTER TABLE `order_form`
  MODIFY `order_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_summary`
--
ALTER TABLE `order_summary`
  MODIFY `order_summary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_form`
--
ALTER TABLE `order_form`
  ADD CONSTRAINT `order_form_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`);

--
-- Constraints for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD CONSTRAINT `order_summary_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`),
  ADD CONSTRAINT `order_summary_ibfk_2` FOREIGN KEY (`order_form_id`) REFERENCES `order_form` (`order_form_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
