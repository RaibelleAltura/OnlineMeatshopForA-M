-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 03:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `itemName`, `price`, `image`, `quantity`, `catName`, `email`, `total_price`) VALUES
(1, 'French Fries', '760', 'fries.jpg', 1, 'Appetizer', 'asna@gmail.com', '760'),
(2, 'BBQ Chicken Pizza', '1000', 'bbq-pizza.jpg', 1, 'Pizza', 'zidnan@gmail.com', '1000'),
(3, 'Strawberry Mocktail', '550', 'strawberry-drink.png', 2, 'Beverage', 'zidnan@gmail.com', '1100');

-- --------------------------------------------------------

--
-- Table structure for table `menucategory`
--

CREATE TABLE `menucategory` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `email`, `firstName`, `lastName`, `phone`, `address`, `pmode`, `payment_status`, `sub_total`, `grand_total`, `order_date`, `order_status`, `cancel_reason`, `note`) VALUES
(54, 'preethi@gmail.com', 'Preethi', 'Suresh', '9999999999', 'Galle Road', 'Cash', 'Pending', '1910.00', '2040.00', '2024-08-11 18:00:04', 'Processing', '', 'Add extra cheese'),
(55, 'zidnan@gmail.com', 'Zidnan', 'Ahamad', '2222222222', 'Kolonnawa', 'Cash', 'Pending', '7420.00', '7550.00', '2024-08-10 18:02:26', 'On the way', '', 'Please make the Burger extra spicy'),
(56, 'zidnan@gmail.com', 'Mohamed', 'Muhadh', '0000000000', 'Kolonnawa', 'Takeaway', 'Successful', '1150.00', '1150.00', '2024-08-11 18:04:16', 'Completed', '', ''),
(57, 'jhon@gmail.com', 'Jhon', 'Paul', '7777777777', 'Colombo 15', 'Takeaway', 'Successful', '5720.00', '5720.00', '2024-08-08 18:05:26', 'Completed', '', ''),
(58, 'zidnan@gmail.com', 'Zidnan', 'Ahamad', '4444444444', 'Colombo 12', 'Takeaway', 'Pending', '2700.00', '2700.00', '2024-08-10 20:12:14', 'Cancelled', 'Waiting time is too long.', ''),
(59, 'openligths@gmail.com', 'Raibelle', 'Altura', '0921594311', 'Brgy 1 Lipa City, Batangas', 'Takeaway', 'Successful', '2400.00', '2400.00', '2024-10-29 04:30:38', 'Completed', '', 'Contact Me'),
(60, 'openligths@gmail.com', 'Stemart', 'Tobias', '0992519812', 'Lipa Batangas', 'Cash', 'Pending', '600.00', '730.00', '2024-10-29 07:49:01', 'Pending', NULL, 'Call me abay');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `itemName`, `image`, `quantity`, `price`, `total_price`) VALUES
(122, 54, 'Garlic Bread', 'garlic-bread.avif', 1, '350', '350.00'),
(123, 54, 'French Fries', 'fries.jpg', 1, '760', '760.00'),
(124, 54, 'Cheese Pizza', 'cheese-pizza.jpg', 1, '800', '800.00'),
(125, 55, 'Dragon Fruit Mojito', 'Dragon-fruit-drink.png', 1, '760', '760.00'),
(126, 55, 'BBQ Chicken Burger', 'bbq-burger.jpeg', 3, '1900', '5700.00'),
(127, 55, 'Chicken Wing', 'chicken-wing.avif', 2, '480', '960.00'),
(128, 56, 'Garlic Bread', 'garlic-bread.avif', 1, '350', '350.00'),
(129, 56, 'Cheese Pizza', 'cheese-pizza.jpg', 1, '800', '800.00'),
(130, 57, 'French Fries', 'fries.jpg', 2, '760', '1520.00'),
(131, 57, 'Firebird Burger', 'firebird-burger.jpeg', 2, '2100', '4200.00'),
(132, 58, 'Garlic Bread', 'garlic-bread.avif', 3, '350', '1050.00'),
(133, 58, 'Strawberry Mocktail', 'strawberry-drink.png', 3, '550', '1650.00'),
(134, 59, 'Chicken Wing', 'chicken-wing.avif', 5, '480', '2400.00'),
(135, 60, 'Pork Back Fat Skinless', 'Pork backfat Skinless.jpeg', 1, '300', '300.00'),
(136, 60, 'Beef Shank', 'beef Shank(Bulalo).webp', 1, '300', '300.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`email`, `name`, `contact`, `noOfGuests`, `reservedTime`, `reservedDate`, `reservedAt`, `status`, `reservation_id`) VALUES
('asna@gmail.com', 'Asna Assalam', '0000000000', 6, '12:00:00', '2024-07-31', '2024-07-29 15:35:05', 'Completed', 1),
('zidnan@gmail.com', 'Zidnan', '1111111111', 5, '10:00:07', '2024-08-11', '2024-08-10 18:14:55', 'Pending', 2),
('preethi@gmail.com', 'Preethi Suresh', '5555555', 2, '06:30:59', '2024-08-10', '2024-08-03 18:15:54', 'On Process', 3),
('jhon@gmail.com', 'Jhon Paul', '334455', 9, '20:45:59', '2024-08-09', '2024-08-05 18:16:38', 'Cancelled', 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstName`, `lastName`, `email`, `contact`, `role`, `password`, `createdAt`, `updatedAt`, `profile_image`) VALUES
(7, 'Raibelle', 'Altura', 'openligths@gmail.com', '09215943111', 'superadmin', 'admin123', '2024-10-29 05:01:27', '2024-10-29 05:02:55', 'Screenshot 2022-06-21 160018.png'),
(8, 'Stemart Kenji', 'Tobias', 'Stemart@gmail.com', '09215942580', 'superadmin', 'stermart123', '2024-10-29 07:56:26', '2024-10-29 07:56:26', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `firstName`, `lastName`, `contact`, `password`, `dateCreated`, `profile_image`) VALUES
('asna@gmail.com', 'Asna', 'Assalam', '3333333333', 'AsnaA', '2024-07-26 12:50:46', 'user-girl.png'),
('jhon@gmail.com', 'Jhon', 'Paul', '4444444444', 'JhonP', '2024-08-10 15:37:56', 'default.jpg'),
('openligths@gmail.com', 'Raibelle', 'Altura', '0945841233', 'raibelle123', '2024-10-29 04:29:22', 'Screenshot 2022-06-21 160018.png'),
('preethi@gmail.com', 'Preethi', 'Suresh', '2222222222', 'Preethi123', '2024-08-10 15:36:50', 'default.jpg'),
('zidnan@gmail.com', 'Zidnan', 'Ahamad', '1111111111', 'Zidnan123', '2024-07-30 12:45:21', 'user-boy.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
