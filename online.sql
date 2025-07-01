-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30 يونيو 2025 الساعة 01:24
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online`
--

-- --------------------------------------------------------

--
-- بنية الجدول `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`) VALUES
(7, 1, 1),
(8, 1, 3),
(9, 1, 2);

-- --------------------------------------------------------

--
-- بنية الجدول `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `emp_code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `employees`
--

INSERT INTO `employees` (`id`, `emp_code`, `name`, `password`) VALUES
(1, 'hani0', 'هاني جميل ', '$2y$10$SXJ5lrvhj0jWzmJaTvKkG.UQZ9UurTQum4pfl1k2Yznzn6ibcBYbC'),
(2, 'hani0', 'هاني جميل ', '$2y$10$2/0EAKNkjyjEeXUDWLaM1evTlq3B4oATCVlELtFt9Nuf4r/VeFw5G'),
(3, 'hani0', 'هاني جميل ', '$2y$10$aQJUOyDgP/pxkGzAr4YP0e3y.JjyumGzYtp0sHAakGxKmE6AgajJC'),
(4, 'hani0', 'هاني جميل ', '$2y$10$v/LJQWF1PIs7lmqNUjPfR.mnR2MpST7IktDOsHdGBKa6TAKGEo5mO'),
(5, 'hani0', 'هاني جميل ', '$2y$10$dfKW3XGthDHRatpvvJweUuYBY1TNIIcI8SAiOhV2S3N13Mei7qxsO'),
(6, 'hani0', 'هاني جميل ', '$2y$10$8CkTHIsFfp7YMRvrzzEeeuEpQL8zGaNbo0VB8EBVDuPg5K8HvOEHm'),
(7, 'hani0', 'هاني جميل ', '$2y$10$ymJ/opXg0h2nJIc6I7g/nuUYEuh9bJiCMcYx9xUXwnNJz4KQmm28S'),
(8, 'hani0', 'هاني جميل ', '$2y$10$PvIMIeAnBfEicljSTvtgBus7Btun2eCAELDWcAkdbO1gOBzlr7xSu'),
(9, 'سيف', 'saif0', '123'),
(10, 'saif1', 'سيف', '123');

-- --------------------------------------------------------

--
-- بنية الجدول `pro`
--

CREATE TABLE `pro` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `pro`
--

INSERT INTO `pro` (`id`, `name`, `price`, `image`, `description`, `category`) VALUES
(1, 'ماء ', '150', '13.PNG', 'مياء شملان صحية ', 'الكترونيات'),
(2, 'شاورما ', '400', '3.PNG', 'شاورما سوري', 'الكترونيات'),
(3, 'ice scream', '150', '8.PNG', 'سكريم مثلج ', 'أواني منزلية'),
(4, 'ice scream1 ', '200', '8.PNG', 'ice cream shoclat', 'ملابس أطفال'),
(5, 'برست', '4500', '21.PNG', 'حبة برستطازج', 'ملابس أطفال'),
(6, 'sss', '555', '1415594210553.jpg', 'sfsdfsdf', 'الصحة والجمال'),
(7, 'شسبشس', '124', 'RZAL5321.JPG', 'سلسيل', 'ملابس نسائية'),
(8, 'شسبشس', '124', 'RZAL5321.JPG', 'سلسيل', 'ملابس نسائية'),
(9, 'asd5', '123', '1415594210553.jpg', 'jlgj', 'الكترونيات'),
(10, 'asd5', '123', '1415594210553.jpg', 'jlgj', 'الكترونيات'),
(11, 'ad', '32', '5.PNG', 'wrtw', 'الكترونيات');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(1, 'gamal', '$2y$10$eKA231sVOTlSpUdRebPt/.CQ4jIpqJJEL1M7m2NmVDBFJnXnEubGi'),
(2, 'saif', '$2y$10$QN/KMRs95dHXSknnfVlQF.PvkciOycUPOJPZNSOKGs7YvArXzGAxa'),
(3, 'ali', '$2y$10$svnhAA0VO.qm4uzeSV7NlOdzPAO5Ow3YSPaKanpW9t0ltZTG9r8vy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro`
--
ALTER TABLE `pro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pro`
--
ALTER TABLE `pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `pro` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
