-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 09:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `phone_number`, `address`, `email`, `password`, `image`) VALUES
(4, 'Admin', '09111111111', NULL, 'admin1@gmail.com', '$2y$10$3i.ICgIipkY.ubTANModOug.jI/kUUNgSEPXncP9CEp3cL5lZNoE.', 'profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `start_date`, `end_date`, `subtotal`) VALUES
(64, 5, 85, 1, '2024-05-18', '2024-05-20', 15000.00),
(84, 7, 85, 1, '2024-05-21', '2024-05-25', 15000.00),
(85, 7, 1, 3, '2024-05-20', '2024-05-23', 81.00);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `picture`) VALUES
(1, 'Chairs', 'Elevate your event with our diverse selection of chairs, offering comfort and style for any occasion.', 'chair.jpg'),
(2, 'Tables', 'Discover the perfect table to anchor your event space, whether it\'s for dining, displays, or networking.', 'table.jpg'),
(3, 'Dinnerwares', 'Add a touch of elegance to your dining experience with our exquisite flatware collection.', 'furniture.jpg'),
(4, 'Flatware', 'Add a touch of elegance to your dining experience with our exquisite flatware collection.', 'furniture.jpg'),
(5, 'Linens', 'Enhance your table settings with our linens, adding elegance and sophistication to every meal.', 'linen.jpg'),
(6, 'Tent', 'Provide shelter with our tent options, ensuring your event is memorable rain or shine.', 'tent.jpg'),
(7, 'Glassware', 'Elevate your beverage service with our premium glassware, adding a touch of sophistication to every toast.', 'glassware.jpg'),
(8, 'Lights and Decorations', 'Illuminate your event with our lighting options, highlight every moment with elegance and flair.', 'lighting.jpg'),
(9, 'Services', 'Ensure seamless food presentation and service with our quality food service equipment.', 'cooking.png'),
(10, 'Package', 'Our starter package offers everything you need to kickstart your event planning journey. From essential furniture to basic lighting, it provides the foundational elements for a comfortable and memorable occasion.', 'corporatee.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `message`) VALUES
(1, 'asa', 'saas', 'admin@gmail.com', '1211114434', 'asassdas');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `confirmation` text NOT NULL DEFAULT 'Unsettled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `address`, `payment`, `price`, `name`, `note`, `phone`, `email`, `confirmation`) VALUES
(25, 6, '2024-05-19 19:09:10', 'sadas, sadas, , sadas', 'Cash On Delivery', 127.68, 'Alvan Bernal', '', '09468404678', 'alvanbernal@gmail.com', 'Unsettled'),
(26, 6, '2024-05-19 19:12:14', 'sadas, asdasd, , sadas', 'Cash On Delivery', 127.68, 'Alvan Bernal', '', '09468404678', 'alvanbernal@gmail.com', 'Unsettled'),
(27, 6, '2024-05-19 19:23:15', 'xcxvzxc, zxcvxzc, xzcvzc, xcvzxc', 'Cash On Delivery', 127.68, 'Alvan Bernal', '', '09468404678', 'alvanbernal@gmail.com', 'Paid'),
(28, 7, '2024-05-19 22:23:58', 'Legazpi, Ems, 123, 4512', 'Cash On Delivery', 1276.80, 'Amir Saberon', '', '0912344567889', 'amir1@gmail.com', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `start_date`, `end_date`, `status`, `subtotal`) VALUES
(35, 25, 3, 1, '2024-05-19', '2024-05-21', 'Pending', 38.00),
(36, 26, 2, 1, '2024-05-19', '2024-05-21', 'Pending', 38.00),
(37, 27, 2, 1, '2024-05-19', '2024-05-25', 'Pending', 114.00),
(38, 28, 1, 10, '2024-05-20', '2024-05-26', 'Delivered', 1140.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `color` varchar(250) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `dimension` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `reserve` int(11) NOT NULL DEFAULT 0,
  `used` int(11) NOT NULL DEFAULT 0,
  `image` varchar(50) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  `total_ratings` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `color`, `material`, `dimension`, `stock`, `reserve`, `used`, `image`, `counter`, `total_ratings`) VALUES
(1, 'Folding Chair', 1, 9, 'Black', 'Metal and Plastic', '18x18x36 inches', 100, -1, 41, 'foldingchair.jpg', 4, 19),
(2, 'Gold Chiavari Chair', 1, 19, 'Gold', 'Metal and Fabric', '16x16x36 inches', 100, 5, 9, 'gold_chiavari_chair.jpg', 4, 18),
(3, 'Bamboo Folding Chair', 1, 19, 'Brown', 'Bamboo', '17x17x34 inches', 50, 3, 0, 'bamboo_folding_chair.jpg', 8, 40),
(4, 'White Resin Chair', 1, 19, 'White', 'Resin', '17x17x35 inches', 80, 0, 1, 'white_resin_chair.jpg', 6, 29),
(5, 'Rustic Farm Table', 2, 89, 'Brown', 'Wood', '8x3 feet', 10, 0, 0, 'rustic_farm_table.jpg', 0, 0),
(6, 'Glass Top Table', 2, 129, 'Clear', 'Glass and Metal', '5x2.5 feet', 15, 0, 0, 'glass_top_table.jpg', 0, 0),
(7, 'Cocktail Table', 2, 59, 'White', 'Metal', '30-inch diameter', 20, 0, 0, 'cocktail_table.jpg', 0, 0),
(8, 'Round Banquet Table', 2, 89, 'Brown', 'Wood', '60-inch diameter', 10, 0, 0, 'round_banquet_table.jpg', 0, 0),
(9, 'White Dinner Plate', 3, 9, 'White', 'Ceramic', '10.5 inches', 200, 0, 0, 'white_dinner_plate.jpg', 0, 0),
(11, 'Dessert Plate', 3, 9, 'White', 'Ceramic', '6 inches', 200, 0, 0, 'dessert_plate.jpg', 0, 0),
(12, 'Charger Plate', 3, 19, 'Gold', 'Metal', '13 inches', 150, 0, 0, 'charger_plate.jpg', 0, 0),
(13, 'Bread Plate', 3, 9, 'White', 'Ceramic', '5 inches', 200, 0, 0, 'bread_plate.jpg', 0, 0),
(14, 'Bowl', 3, 9, 'White', 'Ceramic', '5 inches diameter', 200, 0, 0, 'bowl.jpg', 0, 0),
(15, 'Soup Plate', 3, 9, 'White', 'Ceramic', '9 inches diameter', 200, 0, 0, 'soup_plate.jpg', 0, 0),
(16, 'Chafing Dish', 9, 79, 'Silver', 'Stainless Steel', '8 quarts', 25, 0, 0, 'chafing_dish.jpg', 0, 0),
(17, 'Serving Tray', 9, 29, 'Silver', 'Stainless Steel', '18x12 inches', 40, 0, 0, 'serving_tray.jpg', 0, 0),
(18, 'Portable Bar', 9, 289, 'Black', 'Metal and Wood', '5x2x4 feet', 3, 0, 0, 'portable_bar.jpg', 0, 0),
(19, 'Champagne Fountain', 9, 179, 'Silver', 'Metal', '3 feet tall', 4, 0, 0, 'champagne_fountain.jpg', 0, 0),
(20, 'Cotton Candy Machine', 9, 429, 'Pink', 'Metal', 'N/A', 2, 0, 0, 'cotton_candy_machine.jpg', 0, 0),
(21, 'Popcorn Machine', 9, 509, 'Red', 'Metal and Glass', 'N/A', 3, 0, 0, 'popcorn_machine.jpg', 0, 0),
(22, 'Photo Booth', 9, 2149, 'White', 'Plastic and Metal', 'N/A', 1, 0, 0, 'photo_booth.jpg', 0, 0),
(23, 'Chocolate Fountain', 9, 719, 'Silver', 'Stainless Steel', 'N/A', 2, 0, 0, 'chocolate_fountain.jpg', 0, 0),
(24, 'Mini Photo Booth', 9, 179, 'White', 'Plastic and Metal', 'N/A', 5, 0, 0, 'photo_booth.jpg', 0, 0),
(25, 'Wine Glass', 7, 9, 'Clear', 'Glass', '12 ounces', 100, -1, 2, 'wine_glass.jpg', 1, 5),
(26, 'Champagne Flute', 7, 9, 'Clear', 'Glass', '6 ounces', 120, 0, 0, 'champagne_flute.jpg', 0, 0),
(27, 'Martini Glass', 7, 9, 'Clear', 'Glass', '10 ounces', 80, 0, 0, 'martini_glass.jpg', 0, 0),
(28, 'Water Goblet', 7, 9, 'Clear', 'Glass', '14 ounces', 120, 0, 0, 'water_goblet.jpg', 0, 0),
(29, 'Shot Glass', 7, 9, 'Clear', 'Glass', '2 ounces', 200, 0, 0, 'shot_glass.jpg', 0, 0),
(30, 'Glass Pitcher', 7, 19, 'Clear', 'Glass', '60 ounces', 50, 0, 0, 'glass_pitcher.jpg', 0, 0),
(31, 'Highball Glass', 7, 9, 'Clear', 'Glass', '12 ounces', 150, 0, 0, 'highball_glass.jpg', 0, 0),
(32, 'Tumbler Glass', 7, 9, 'Clear', 'Glass', '10 ounces', 130, 0, 0, 'tumbler_glass.jpg', 0, 0),
(33, 'Gold Flatware Set', 4, 19, 'Gold', 'Stainless Steel', 'N/A', 150, 0, 0, 'gold_flatware.jpg', 0, 0),
(34, 'Silver Flatware Set', 4, 9, 'Silver', 'Stainless Steel', 'N/A', 200, 0, 0, 'silver_flatware.jpg', 0, 0),
(35, 'Dessert Fork', 4, 9, 'Silver', 'Stainless Steel', 'N/A', 200, 0, 0, 'dessert_fork.jpg', 0, 0),
(36, 'Steak Knife', 4, 9, 'Silver', 'Stainless Steel', 'N/A', 150, 0, 0, 'steak_knife.jpg', 0, 0),
(37, 'Soup Spoon', 4, 9, 'Silver', 'Stainless Steel', 'N/A', 250, 0, 0, 'soup_spoon.jpg', 0, 0),
(38, 'Dinner Knife', 4, 9, 'Silver', 'Stainless Steel', 'N/A', 200, 0, 0, 'dinner_knife.jpg', 0, 0),
(39, 'Fish Fork', 4, 9, 'Silver', 'Stainless Steel', 'N/A', 250, 0, 0, 'fish_fork.jpg', 0, 0),
(40, 'Silk Tablecloth', 5, 49, 'Red', 'Silk', '90x132 inches', 40, 0, 0, 'silk_tablecloth.jpg', 0, 0),
(41, 'Lace Table Runner', 5, 29, 'White', 'Lace', '12x72 inches', 50, 0, 0, 'lace_table_runner.jpg', 0, 0),
(42, 'White Table Linen', 5, 29, 'White', 'Fabric', '90x132 inches', 60, 0, 0, 'white_table_linen.jpg', 0, 0),
(43, 'Black Table Linen', 5, 29, 'Black', 'Fabric', '90x132 inches', 60, 0, 0, 'black_table_linen.jpg', 0, 0),
(44, 'Round Tablecloth', 5, 29, 'Ivory', 'Polyester', '120 inches diameter', 50, 0, 0, 'round_tablecloth.jpg', 0, 0),
(45, 'Table Runner', 5, 19, 'Various', 'Fabric', '12x72 inches', 50, 0, 0, 'table_runner.jpg', 0, 0),
(46, 'Cotton Napkin', 5, 9, 'White', 'Cotton', '20x20 inches', 300, 0, 0, 'cotton_napkin.jpg', 0, 0),
(47, 'Linen Napkin', 5, 9, 'Red', 'Linen', '20x20 inches', 150, 0, 0, 'linen_napkin.jpg', 0, 0),
(48, 'Napkins', 5, 9, 'Various', 'Fabric', '20x20 inches', 200, 0, 0, 'napkins.jpg', 0, 0),
(49, 'Wedding Tent', 6, 2859, 'White', 'Canvas', '20x40 feet', 3, 0, 0, 'wedding_tent.jpg', 0, 0),
(50, 'Outdoor Tent', 6, 2149, 'White', 'Canvas', '15x30 feet', 4, 0, 0, 'outdoor_tent.jpg', 0, 0),
(51, 'Gazebo Tent', 6, 3579, 'White', 'Canvas', '20x20 feet', 2, 0, 0, 'gazebo_tent.jpg', 0, 0),
(52, 'Pop-Up Tent', 6, 1719, 'Blue', 'Polyester', '10x10 feet', 5, 0, 0, 'pop_up_tent.jpg', 0, 0),
(53, 'Frame Tent', 6, 3859, 'White', 'Canvas', '30x50 feet', 2, 0, 0, 'frame_tent.jpg', 0, 0),
(54, 'Canopy Tent', 6, 5009, 'White', 'Canvas', '40x60 feet', 1, 0, 0, 'canopy_tent.jpg', 0, 0),
(55, 'Tent Sidewalls', 6, 149, 'White', 'Canvas', '20 feet long', 10, 0, 0, 'tent_sidewalls.jpg', 0, 0),
(56, 'Luxury Portable Restroom', 6, 7149, 'White', 'Plastic and Metal', '8x6x8 feet', 1, 0, 0, 'portable_restroom.jpg', 0, 0),
(57, 'Glass Vase Centerpiece', 8, 29, 'Transparent', 'Glass', '12 inches tall', 30, 0, 0, 'glass_vase.jpg', 0, 0),
(58, 'Elegant Candelabra', 8, 49, 'Silver', 'Metal', '3 feet tall', 15, 0, 0, 'elegant_candelabra.jpg', 0, 0),
(59, 'Marquee Letters', 8, 219, 'White', 'Metal and Plastic', '2 feet tall', 26, 0, 0, 'marquee_letters.jpg', 0, 0),
(60, 'Lighted Backdrop', 8, 1149, 'White', 'Fabric and Lights', '10x8 feet', 3, 0, 0, 'lighted_backdrop.jpg', 0, 0),
(61, 'LED Uplight', 8, 49, 'Multi-color', 'Plastic', '6x6x8 inches', 50, 0, 0, 'led_uplight.jpg', 0, 0),
(62, 'Bistro Lights', 8, 59, 'Warm White', 'Plastic and Metal', '50 feet', 20, 0, 0, 'bistro_lights.jpg', 0, 0),
(63, 'String Lights', 8, 79, 'Warm White', 'Plastic and Metal', '100 feet', 25, 0, 0, 'string_lights.jpg', 0, 0),
(64, 'Crystal Chandelier', 8, 2149, 'Clear', 'Crystal and Metal', '3 feet diameter', 3, 0, 0, 'crystal_chandelier.jpg', 0, 0),
(65, 'Decorative Lantern', 8, 39, 'Black', 'Metal and Glass', '12 inches tall', 30, 0, 0, 'decorative_lantern.jpg', 0, 0),
(66, 'Fairy Lights', 8, 49, 'Warm White', 'Plastic', '50 feet', 40, 0, 0, 'fairy_lights.jpg', 0, 0),
(67, 'Disco Ball', 8, 109, 'Silver', 'Glass and Metal', '20 inches diameter', 10, 0, 0, 'disco_ball.jpg', 0, 0),
(85, 'Birthday Package', 10, 15000, 'Folding Chair - 50 per head, Rustic Farm Table - 6 tables 3600 / 120 per head, White Dinner Plate - 50 per head, Chafing Dish - 3pcs 1500 / 50 per head, Champagne Fountain - 40 per head, Wine Glass - 30 per head, Mini Photo Booth - 1200 / 40 per head', '1', '1', 5, 7, 1, 'birthday.jpg', 1, 5),
(86, 'Corporate Package', 10, 15000, 'Folding Chair - 50 per head Rustic Farm Table - 6 tables 3600 / 120 per head White Dinner Plate - 50 per head Chafing Dish - 3pcs 1500 / 50 per head Champagne Fountain - 40 per head Wine Glass - 30 per head Mini Photo Booth - 1200 / 40 per head Silve', '1', '1', 5, 0, 0, 'corporatee.jpg', 0, 0),
(87, 'Fiesta Package', 10, 17000, 'Folding Chair - 50 per head Rustic Farm Table - 6 ', '1', '1', 2, 0, 0, 'fiesta.jpg', 0, 0),
(88, 'Wedding Package', 10, 20000, 'Folding Chair - 50 per head Rustic Farm Table - 6 ', '1', '1', 2, 0, 0, 'wedding.png', 0, 0),
(90, 'Light ', 8, 120, 'Black', 'Metals', '17x17x35 inches', 100, 0, 0, 'modtracklights.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `product_id`, `name`, `email`, `rating`, `review`, `created_at`) VALUES
(11, 1, 'Amir Saberon', 'amir1@gmail.com', 5, 'nice one', '2024-05-19 14:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'profile.jpg',
  `username` varchar(100) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `password_salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `phone_number`, `address`, `email`, `password`, `image`, `username`, `gender`, `birthday`, `password_salt`) VALUES
(6, 'Alvan Bernal', '09468404678', 'Legazpi City', 'alvanbernal@gmail.com', '$2y$10$H.X9Z/X9jxmyHJmWWCvtA.5sGkFjQ.8L5GTMp66D2M37uCsdN4YZy', 'profile.jpg', '@alvan', 'Male', '2024-05-19', 'Snw9NwGcagCGRqQBiEdd1vOTYwHzAgdf7fQgrMFZ2ZA='),
(7, 'Amir Saberon', '0912344567889', 'Legazpi City', 'amir1@gmail.com', '$2y$10$LECGwVe9kC8VBhChSoZ/1Os75JVOVPSBtnfbnTQErxQrD9M5T62jm', 'profile.jpg', '@amir', 'Male', '2024-05-20', 'CtvuSoMH5SnaxWh3t0+ph9rZ4aPhoIQ0SM2MWxu4+/Q=');

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
