-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2024 at 07:10 AM
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
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'Admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 'Amirul', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(47, 1, 1, 'Chicken Fried Rice', 5, 1, 'Chicken Fried Rice-Photoroom.png-Photoroom.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'Farid', 'farid@gmail.com', '0178651249', 'How to order?'),
(2, 2, 'Nurul', 'nurul@gmail.com', '0146587923', 'I want to suggest you new menu that you can add in your menu, which is fried noodle');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(20) NOT NULL DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `order_status`) VALUES
(1, 1, 'Amirul Hafiz', '0132580711', 'amirulhafiz@gmail.com', 'Cash On Delivery', '25-02, Shamelin Star, Taman Shamelin Perkasa, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia', 'Lamb Chop (25 x 1) - Cookies (10 x 1) - Ice Lemon (5 x 1) - ', 40, '2024-04-17', 'Processing'),
(2, 3, 'Akmal', '0148567891', 'akmal@gmail.com', 'E-Wallet', '22, Kampung Baru, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia', 'French Fries (10 x 1) - Ice Cream (10 x 1) - ', 20, '2024-04-17', 'Completed'),
(3, 2, 'Fadhil', '0198546321', 'fadhilamin@gmail.com', 'Paypal', '10, Sky Resident, Shamelin, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia', 'Burger (10 x 2) - Strawberry Smoothies (8 x 1) - Strawberry Cake (8 x 1) - ', 36, '2024-04-17', 'Completed'),
(4, 3, 'Akmal', '0148567891', 'akmal@gmail.com', 'E-Wallet', '22, Kampung Baru, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia', 'Hotdog (5 x 1) - Nugget (10 x 1) - ', 15, '2024-04-17', 'Processing'),
(5, 2, 'Fadhil', '0198546321', 'fadhilamin@gmail.com', 'Paypal', '10, Sky Resident, Shamelin, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia', 'Cake (10 x 1) - Strawberry Cake (8 x 1) - Ice Cream (10 x 1) - ', 28, '2024-04-17', 'Processing'),
(6, 1, 'Amirul Hafiz', '0132580711', 'amirulhafiz@gmail.com', 'Cash On Delivery', '25-02, Shamelin Star, Taman Shamelin Perkasa, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia', 'Chicken Chop (15 x 1) - Orange Juices (8 x 1) - ', 23, '2024-04-17', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'Chicken Fried Rice', 'Main dish', 5, 'Chicken Fried Rice-Photoroom.png-Photoroom.png'),
(2, 'Chicken Rice', 'Main dish', 10, 'Chicken Rice.png'),
(3, 'Chicken Chop', 'Main dish', 15, 'Chicken chop.png'),
(4, 'Lamb Chop', 'Main dish', 25, 'dish-4.png'),
(5, 'Burger', 'Fast food', 10, 'burger-1.png'),
(6, 'French Fries', 'Fast food', 10, 'fries-Photoroom.png-Photoroom.png'),
(7, 'Nugget', 'Fast food', 10, 'nugget-Photoroom.png-Photoroom.png'),
(8, 'Hotdog', 'Fast food', 5, 'hotdog-Photoroom.png-Photoroom.png'),
(9, 'Cookies', 'Desserts', 10, 'cookies-Photoroom.png-Photoroom.png'),
(10, 'Muffin', 'Desserts', 5, 'muffin-Photoroom.png-Photoroom.png'),
(11, 'Cake', 'Desserts', 10, 'dessert-2.png'),
(12, 'Ice Cream', 'Desserts', 10, 'dessert-5.png'),
(13, 'Strawberry Smoothies', 'Drinks', 8, 'dessert-1.png'),
(14, 'Ice Lemon', 'Drinks', 5, 'drink-3.png'),
(15, 'Coffee', 'Drinks', 5, 'coffee-Photoroom.png-Photoroom.png'),
(16, 'Orange Juices', 'Drinks', 8, 'drink-1.png'),
(17, 'Strawberry Cake', 'Desserts', 8, 'dessert-6.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'Amirul Hafiz', 'amirulhafiz@gmail.com', '0132580711', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '25-02, Shamelin Star, Taman Shamelin Perkasa, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia'),
(2, 'Fadhil Amin', 'fadhilamin@gmail.com', '0198546321', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '10, Sky Resident, Shamelin, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia'),
(3, 'Akmal', 'akmal@gmail.com', '0148567891', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '22, Kampung Baru, 56100, Kuala Lumpur, Kuala Lumpur, Malaysia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
