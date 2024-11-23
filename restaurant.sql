-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 01:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `itemName`, `price`, `image`, `quantity`, `catName`, `email`, `total_price`) VALUES
(1, 'French Fries', 760, 'fries.jpg', 1, 'Appetizer', 'asna@gmail.com', '760'),
(2, 'BBQ Chicken Pizza', 1000, 'bbq-pizza.jpg', 1, 'Pizza', 'zidnan@gmail.com', '1000'),
(3, 'Strawberry Mocktail', 550, 'strawberry-drink.png', 2, 'Beverage', 'zidnan@gmail.com', '1100');

-- --------------------------------------------------------

--
-- Table structure for table `menucategory`
--

CREATE TABLE `menucategory` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menucategory`
--

INSERT INTO `menucategory` (`catId`, `catName`, `dateCreated`) VALUES
(14, 'Pork', '2024-10-28 22:03:17'),
(15, 'Beef', '2024-10-28 22:03:42'),
(16, 'Chicken', '2024-10-28 22:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE `menuitem` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` enum('Available','Unavailable','','') NOT NULL DEFAULT 'Available',
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime NOT NULL,
  `is_popular` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`itemId`, `itemName`, `catName`, `price`, `status`, `description`, `image`, `dateCreated`, `updatedDate`, `is_popular`) VALUES
(37, 'Beef Tripe', 'Beef', '200', 'Available', 'Tuwalya', 'Beef Tripe.jpg', '2024-10-28 22:06:29', '2024-10-29 06:06:29', 1),
(38, 'Pork Hamleg', 'Pork', '300', 'Available', 'Ham', 'Hamleg.jfif', '2024-10-28 22:28:07', '2024-10-29 06:28:07', 1),
(39, 'Chicken Wings', 'Chicken', '200', 'Available', 'Pakpak', 'Chicken Wings.jpg', '2024-10-28 22:28:39', '2024-10-29 06:28:39', 1),
(40, 'Chicken Drumstick', 'Chicken', '200', 'Available', 'Drumstick', 'Chicken Drumstick.jfif', '2024-10-28 23:54:03', '2024-10-29 07:54:03', 0),
(41, 'Chicken Liver', 'Chicken', '200', 'Available', 'Liver', 'Chicken Liver.jfif', '2024-10-28 23:54:47', '2024-10-29 07:54:47', 0),
(42, 'Chicken Drummets', 'Chicken', '200', 'Available', 'Drummets', 'Chicken Drumettes.jpg', '2024-10-28 23:55:11', '2024-10-29 07:55:11', 0),
(43, 'Chicken Breast Fillet', 'Chicken', '200', 'Available', 'Breast Fillet', 'Chicken Breast Fillet.jpg', '2024-10-28 23:55:37', '2024-10-29 07:55:37', 0),
(44, 'Chicken MDM', 'Chicken', '200', 'Available', 'Mechanically Deboned Meat', 'CHICKEN MDM GT (not sure).jpg', '2024-10-28 23:56:28', '2024-10-29 07:56:28', 0),
(45, 'Chicken Skin', 'Chicken', '200', 'Available', 'Skin', 'Chicken Skin.jpg', '2024-10-28 23:56:46', '2024-10-29 07:56:46', 0),
(46, 'Pork Back Fat Skin', 'Pork', '300', 'Available', 'Back Fat Skin', 'Pork Backfat Skin.jfif', '2024-10-28 23:57:40', '2024-10-29 07:57:40', 0),
(47, 'Pork Back Fat Skinless', 'Pork', '300', 'Available', 'Back Fat Skinless', 'Pork backfat Skinless.jpeg', '2024-10-28 23:58:09', '2024-10-29 07:58:09', 0),
(48, 'Pork Belly Biso', 'Pork', '300', 'Available', 'Belly Biso', 'Pork Belly Biso.jpg', '2024-10-28 23:58:48', '2024-10-29 07:58:48', 0),
(49, 'Pork Belly Skin', 'Pork', '300', 'Available', 'Belly Skin', 'Pork Belly Skin.webp', '2024-10-28 23:59:09', '2024-10-29 07:59:09', 0),
(50, 'Pork Belly', 'Pork', '300', 'Available', 'Belly', 'Pork Belly.webp', '2024-10-28 23:59:36', '2024-10-29 07:59:36', 0),
(51, 'Pork Cutting Fats', 'Pork', '300', 'Available', 'Cutting Fats', 'Pork Cutting Fats (Not sure).jpeg', '2024-10-29 00:00:03', '2024-10-29 08:00:03', 0),
(52, 'Pork Ear', 'Pork', '300', 'Available', 'Ear (Tenga)', 'Pork Ear.jpg', '2024-10-29 00:00:25', '2024-10-29 08:00:25', 0),
(53, 'Pork Flower', 'Pork', '300', 'Available', 'Flower(Bulaklak)', 'PORK FLOWER.webp', '2024-10-29 00:00:50', '2024-10-29 08:00:50', 0),
(54, 'Pork Heart', 'Pork', '300', 'Available', 'Heart', 'Pork Heart.jpg', '2024-10-29 00:01:12', '2024-10-29 08:01:12', 0),
(55, 'Pork Jowls', 'Pork', '300', 'Available', 'Jowls ', 'Pork Jowl.jfif', '2024-10-29 00:01:44', '2024-10-29 08:01:44', 0),
(56, 'Pork Liver', 'Pork', '300', 'Available', 'Liver(Atay)', 'Pork Liver.jpg', '2024-10-29 00:02:13', '2024-10-29 08:02:13', 0),
(57, 'Pork Lungs', 'Pork', '300', 'Available', 'Lungs(Baga)', 'Pork Lungs.jfif', '2024-10-29 00:02:38', '2024-10-29 08:02:38', 0),
(58, 'Pork Mask', 'Pork', '300', 'Available', 'Mask(Maskara)', 'Pork Mask.jfif', '2024-10-29 00:03:01', '2024-10-29 08:03:01', 0),
(59, 'Pork Pata', 'Pork', '300', 'Available', 'Pata', 'Pork Pata.jpg', '2024-10-29 00:03:22', '2024-10-29 08:03:22', 0),
(60, 'Pork Picnic Shoulder', 'Pork', '300', 'Available', 'Picnic Shoulder', 'Pork Picnic Shoulder.png', '2024-10-29 00:04:05', '2024-10-29 08:04:05', 0),
(61, 'Pork Riblets', 'Pork', '300', 'Available', 'Riblets', 'Pork Riblets.jpg', '2024-10-29 00:04:28', '2024-10-29 08:04:28', 0),
(62, 'Pork Trimmings', 'Pork', '300', 'Available', 'Trimmings', 'Pork Trimmings.jpg', '2024-10-29 00:04:55', '2024-10-29 08:04:55', 0),
(63, 'Pork Loin', 'Pork', '300', 'Available', 'Loin(LOMO)', 'PorkLoin(LOMO).jfif', '2024-10-29 00:05:23', '2024-10-29 08:05:23', 0),
(64, 'Pork Loin(Pork Chop)', 'Pork', '300', 'Available', 'Pork Chop', 'PorkLoin(Porkchop).jpg', '2024-10-29 00:06:08', '2024-10-29 08:06:08', 0),
(65, 'Beef Shank', 'Beef', '300', 'Available', 'Shank (Bulalo)', 'beef Shank(Bulalo).webp', '2024-10-29 00:07:02', '2024-10-29 08:07:02', 0),
(66, 'Beef Forequarter', 'Beef', '300', 'Available', 'Forequarter', 'Beef Forequarter.jfif', '2024-10-29 00:07:34', '2024-10-29 08:07:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pmode` enum('Cash','Card','Takeaway','') NOT NULL DEFAULT 'Cash',
  `payment_status` enum('Pending','Successful','Rejected','') NOT NULL DEFAULT 'Pending',
  `sub_total` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` enum('Pending','Completed','Cancelled','Processing','On the way') NOT NULL DEFAULT 'Pending',
  `cancel_reason` varchar(255) DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `email`, `firstName`, `lastName`, `phone`, `address`, `pmode`, `payment_status`, `sub_total`, `grand_total`, `order_date`, `order_status`, `cancel_reason`, `note`, `proof_of_payment`) VALUES
(69, 'cyxdev24@gmail.com', 'sample1', 'sdfsd', '23123', 'asd', 'Card', 'Pending', 300.00, 430.00, '2024-11-21 12:15:34', 'Pending', '', 'sadads', '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `itemName`, `image`, `quantity`, `price`, `total_price`) VALUES
(146, 69, 'Beef Forequarter', 'Beef Forequarter.jfif', 1, 300, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `noOfGuests` int(50) NOT NULL,
  `reservedTime` time NOT NULL,
  `reservedDate` date NOT NULL,
  `reservedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','On Process','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text DEFAULT NULL,
  `review_date` date DEFAULT current_timestamp(),
  `status` enum('approved','pending','rejected') DEFAULT 'pending',
  `response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `email`, `order_id`, `rating`, `review_text`, `review_date`, `status`, `response`) VALUES
(1, 'zidnan@gmail.com', 56, 5, 'The food was absolutely delicious! I\'ll definitely be ordering again!', '2024-08-10', 'approved', 'Thank you for your feedback.'),
(2, 'jhon@gmail.com', 57, 3, '\"The burger was tasty, but it arrived a bit cold. The fries were also soggy. I hope this can be improved next time.\"', '2024-08-11', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `role` enum('superadmin','admin','delivery boy','waiter') NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstName`, `lastName`, `email`, `contact`, `role`, `password`, `createdAt`, `updatedAt`, `profile_image`) VALUES
(7, 'Raibelle', 'Altura', 'openligths@gmail.com', '09215943111', 'superadmin', 'admin123', '2024-10-29 05:01:27', '2024-10-29 05:02:55', 'Screenshot 2022-06-21 160018.png'),
(8, 'Stemart Kenji', 'Tobias', 'Stemart@gmail.com', '09215942580', 'superadmin', 'stermart123', '2024-10-29 07:56:26', '2024-10-29 07:56:26', 'default.jpg'),
(13, 'John', 'Doe', 'admin@example.com', '1234567890', 'admin', '1', '2024-11-21 11:51:25', '2024-11-21 12:07:40', '1.jpg'),
(15, 'John', 'Doe', 'admin1@example.com', '1234567890', 'admin', '1234', '2024-11-21 11:55:21', '2024-11-21 11:55:21', 'default.jpg'),
(16, 'John', 'Doe', 'john.doe@example.com', '1234567890', 'admin', 'yourpassword', '2024-11-21 12:00:54', '2024-11-21 12:00:54', 'default.jpg'),
(17, 'sample1', 'asd', 'admin2@example.com', 'sdas', 'superadmin', '$2y$10$j9fPLbmFRWJmyROoPPaSUekI0NI57a/VLqzaChvFUdL7u1gyCVmMm', '2024-11-21 12:05:31', '2024-11-21 12:05:31', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `firstName`, `lastName`, `contact`, `password`, `dateCreated`, `profile_image`) VALUES
('cyxdev24@gmail.com', 'Cyrus', 'Maylan', '0944747433', '$2y$10$36RYa3DN5Ifw3DLu/PqkmukNXzsEtIN3aqOOFNPnR6CvfEbPXEEBW', '2024-11-21 11:30:11', 'default.jpg'),
('jhon@gmail.com', 'Jhon', 'Paul', '4444444444', 'JhonP', '2024-08-10 15:37:56', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menucategory`
--
ALTER TABLE `menucategory`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `itemId` (`itemName`) USING BTREE;

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `email` (`email`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `menucategory`
--
ALTER TABLE `menucategory`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
