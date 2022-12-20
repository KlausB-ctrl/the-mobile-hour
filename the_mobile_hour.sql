-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 02:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_mobile_hour`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_info`
--

CREATE TABLE `address_info` (
  `address_info_id` int NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `address_info`
--

INSERT INTO `address_info` (`address_info_id`, `postcode`, `city`, `state`) VALUES
(1, '4551', 'Pelican Waters', 'QLD');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `customer_customer_id` int NOT NULL,
  `product_product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `changelog`
--

CREATE TABLE `changelog` (
  `changelog_id` int NOT NULL,
  `date_created` date NOT NULL,
  `date_last_modified` date NOT NULL,
  `product_product_id` int NOT NULL,
  `user_user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `changelog`
--

INSERT INTO `changelog` (`changelog_id`, `date_created`, `date_last_modified`, `product_product_id`, `user_user_id`) VALUES
(1, '2022-11-03', '2022-11-03', 1, 2),
(2, '2022-11-03', '2022-11-03', 2, 3),
(3, '2022-11-03', '2022-11-03', 3, 4),
(4, '2022-11-03', '2022-11-03', 4, 1),
(5, '2022-11-03', '2022-11-03', 5, 2),
(6, '2022-11-03', '2022-11-03', 6, 3),
(7, '2022-11-03', '2022-11-03', 7, 4),
(8, '2022-11-03', '2022-11-03', 8, 2),
(9, '2022-11-03', '2022-11-03', 9, 1),
(10, '2022-11-03', '2022-11-03', 10, 4),
(11, '2022-11-03', '2022-11-03', 11, 1),
(12, '2022-11-03', '2022-11-05', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `cust_phone` varchar(15) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_password` varchar(255) NOT NULL,
  `cust_apartment_number` int DEFAULT NULL,
  `cust_address` varchar(45) NOT NULL,
  `address_info_address_info_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `cust_phone`, `cust_email`, `cust_password`, `cust_apartment_number`, `cust_address`, `address_info_address_info_id`) VALUES
(1, 'Ryan', 'Jackson', '0422 057 040', 'ryanantjackson@gmail.com', 'f03e134df319e807eebce502a4366596a200b743798093fc4f0fd9ef75442ff6', NULL, '6 Olympic Lane', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `feature_id` int NOT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `dimensions` varchar(100) DEFAULT NULL,
  `OS` varchar(100) DEFAULT NULL,
  `screensize` varchar(100) DEFAULT NULL,
  `resolution` varchar(10) DEFAULT NULL,
  `CPU` varchar(100) DEFAULT NULL,
  `RAM` varchar(100) DEFAULT NULL,
  `storage` varchar(100) DEFAULT NULL,
  `battery` varchar(100) DEFAULT NULL,
  `rear_camera` varchar(255) DEFAULT NULL,
  `front_camera` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`feature_id`, `weight`, `dimensions`, `OS`, `screensize`, `resolution`, `CPU`, `RAM`, `storage`, `battery`, `rear_camera`, `front_camera`) VALUES
(1, '90.1g', '124.7 x 51.0 x 13.7 mm', 'Other', '2.4 inches', '240x320', 'Unisoc T117', '64MB', '128MB', '1150 mAh', '0.3MP', ''),
(2, '148g', '145.6 x 68.2 x 7.9 mm', 'Android 9.0 (Pie)', '5.5 inches', '1080x2160', 'Octa-core (4x2.5 GHz Kryo 385 Gold & 4x1.6 GHz Kryo 385 Silver)', '4GB', '64GB', '2915 mAh', '8.0MP', '12.0MP'),
(3, '181g', '163.7 x 76.1 x 7.6 mm', 'Android 12', '6.7 inches', '1080x2400', 'Octa-core (4x2.4 GHz Kryo 670 & 4x1.8 GHz Kryo 670)\r\n', '6GB', '128GB', '5000 mAh', '108 MP, 12 MP, 5.0 MP Dual', '32MP'),
(4, '191g', '164.4 x 75.7 x 8.4 mm\r\n', 'Android 11', '6.59 inches', '1080x2412', 'Octa-core (4x2.4 GHz Kryo 265 Gold & 4x1.9 GHz Kryo 265 Silver)\r\n', '8GB', '128GB', '5000 mAh', '50MP, 2.0MP', '16MP'),
(5, '240g', '160.7 x 77.6 x 7.85 mm', 'iOS 16', '6.7 inches', '1290x2796', 'A16 Bionic', '6GB', '128GB', '4352 mAh', '48MP Main, 12MP Ultra Wide, 12MP 2x Telephoto, 12MP x3 Telephoto', '12MP TrueDepth'),
(6, '210g', '163.9 x 75.9 x 8.9 mm', 'Android 12, upgradable to Android 13', '6.7 inches', '1440x3120', 'Octa-core (2x2.80 GHz Cortex-X1 & 2x2.25 GHz Cortex-A76 & 4x1.80 GHz Cortex-A55)', '12GB', '128GB', '5003 mAh', '50 MP Octa PD Quad Bayer Wide, 48MP Telephoto', '11.1MP');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturer_id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `name`) VALUES
(1, 'Nokia'),
(2, 'Google'),
(3, 'Samsung'),
(4, 'OPPO'),
(5, 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int NOT NULL,
  `order_date` date NOT NULL,
  `order_delivery_date` date DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `customer_customer_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int NOT NULL,
  `price_sold` int NOT NULL,
  `order_order_id` int NOT NULL,
  `product_product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_model` varchar(255) NOT NULL,
  `manufacturer_manufacturer_id` int NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock_on_hand` int NOT NULL,
  `quantity_sold` int NOT NULL,
  `product_description` mediumtext NOT NULL,
  `product_main_image` varchar(255) NOT NULL,
  `feature_feature_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_model`, `manufacturer_manufacturer_id`, `price`, `stock_on_hand`, `quantity_sold`, `product_description`, `product_main_image`, `feature_feature_id`) VALUES
(1, 'Nokia 225 (4G, Keypad) - Sand', 'NOK225SAN - 9687', 1, '75', 4, 1, '<ul><li><strong>Bonus 8GB MicroSD card</strong><br>Make the most of expandable storage with a bonus 8GB MicroSD card included inside your Nokia 225 4G, so you can do more with your phone and worry less about storage.</li>\r\n<li><strong>Durable build and easy-to-press buttons</strong><br>Built for everyday life, Nokia 225 4G features a tactile keymat with easy-to-press buttons, a curved back for a comfortable feel in the hand and separate function keys for more precise typing and navigating. While, on the outside the hard-coated cover delivers a glossy and solid finish.</li>\r\n<li><strong>Long-lasting battery</strong><br>Get long-lasting and reliable battery life thanks to the removable 1150mAh battery, with up to 16 days standby time.</li>\r\n<li><strong>4G internet and HD clarity calls</strong><br>Surf the web, play games and stay up to date with friends and family on Facebook. Or better still, give them a call and enjoy crystal-clear voice calls.</li>\r\n<li><strong>Radio and MP3 player</strong><br>Take advantage of long-lasting battery life and expandable storage with the in-built MP3 Player and FM Radio. Plus, easily pair with speakers and other devices with Bluetooth 5.0.</li>\r\n<li><strong>Snake. It’s time for a new top score</strong><br>Featuring an update to the legendary Snake game to keep you entertained for days (try-and-buy games also available to download).</li>\r\n</ul>product', 'nokia/225-4g/sand/225-4g-sand.jpg', 1),
(2, 'Nokia 225 (4G, Keypad) - Blue\r\n', 'NOK225BLU - 9632', 1, '75', 5, 0, '<ul><li><strong>Bonus 8GB MicroSD card</strong><br>Make the most of expandable storage with a bonus 8GB MicroSD card included inside your Nokia 225 4G, so you can do more with your phone and worry less about storage.</li>\r\n<li><strong>Durable build and easy-to-press buttons</strong><br>Built for everyday life, Nokia 225 4G features a tactile keymat with easy-to-press buttons, a curved back for a comfortable feel in the hand and separate function keys for more precise typing and navigating. While, on the outside the hard-coated cover delivers a glossy and solid finish.</li>\r\n<li><strong>Long-lasting battery</strong><br>Get long-lasting and reliable battery life thanks to the removable 1150mAh battery, with up to 16 days standby time.</li>\r\n<li><strong>4G internet and HD clarity calls</strong><br>Surf the web, play games and stay up to date with friends and family on Facebook. Or better still, give them a call and enjoy crystal-clear voice calls.</li>\r\n<li><strong>Radio and MP3 player</strong><br>Take advantage of long-lasting battery life and expandable storage with the in-built MP3 Player and FM Radio. Plus, easily pair with speakers and other devices with Bluetooth 5.0.</li>\r\n<li><strong>Snake. It’s time for a new top score</strong><br>Featuring an update to the legendary Snake game to keep you entertained for days (try-and-buy games also available to download).</li>\r\n</ul>', 'nokia/225-4g/blue/225-4g-blue.jpg', 1),
(3, 'Nokia 225 (4G, Keypad) - Black', 'NOK225CHA - 9633', 1, '75', 7, 2, '<ul><li><strong>Bonus 16 GB MicroSD card</strong><br>Make the most of expandable storage with a bonus 16 GB MicroSD card included inside your Nokia 225 4G, so you can do more with your phone and worry less about storage.</li>\r\n<li><strong>Durable build and easy-to-press buttons</strong><br>Built for everyday life, Nokia 225 4G features a tactile keymat with easy-to-press buttons, a curved back for a comfortable feel in the hand and separate function keys for more precise typing and navigating. While, on the outside the hard-coated cover delivers a glossy and solid finish.</li>\r\n<li><strong>Long-lasting battery</strong><br>Get long-lasting and reliable battery life thanks to the removable 1150mAh battery, with up to 16 days standby time.</li>\r\n<li><strong>4G internet and HD clarity calls</strong><br>Surf the web, play games and stay up to date with friends and family on Facebook. Or better still, give them a call and enjoy crystal-clear voice calls.</li>\r\n<li><strong>Radio and MP3 player</strong><br>Take advantage of long-lasting battery life and expandable storage with the in-built MP3 Player and FM Radio. Plus, easily pair with speakers and other devices with Bluetooth 5.0.</li>\r\n<li><strong>Snake. It’s time for a new top score</strong><br>Featuring an update to the legendary Snake game to keep you entertained for days (try-and-buy games also available to download).</li>\r\n</ul>', 'nokia/225-4g/black/225-4g-black.jpg', 1),
(4, 'Google Pixel 3 (5.5\", 64GB/4GB, Global Variant) - Not Pink', 'GGLPX364PNK - 6201', 2, '300', 4, 1, '<ul><li><strong>Meet the Google Pixel 3</strong><br>Capture the perfect shot every time, get things done with the Google Assistant, enjoy a battery that lasts up to a day, and more.</li>\r\n<li><strong>A camera so good that it deserves unlimited online storage.</strong><br>Get everyone in the picture with group selfies—no selfie stick required. Snap portraits like a pro with Portrait Mode. Capture smiles, not blinks, for a great photo every time. And save all your favourite moments with unlimited online photo storage.</li>\r\n<li><strong>Charges fast. Lasts long</strong><br>Pixel 3 comes with a battery that charges fast and wirelessly (wireless charger is sold separately), and lasts up to a day. It’s even smart enough to limit battery usage for the apps you don’t use often to keep going longer.</li>\r\n<li><strong>Your Google Assistant.</strong><br>Get help from your Google Assistant: get sports scores, news, commute times, weather info and more – all with a simple squeeze, or just by using your voice</li>\r\n<li><strong>The joy of missing out.</strong><br>Disconnect from your phone when and where you want so that you can focus on time with family and friends. Set timers on apps and turn off visual notifications. Use the wind-down mode to turn the screen to greyscale and get ready for a good night\'s sleep.</li>\r\n<li><strong>Make your world come to life.</strong><br>Search what you see with Google Lens to look up clothing and home decor, copy and translate text, and identify landmarks, plants, and dogs. Play with life-like AR stickers for your photos and videos.</li>\r\n</ul>', 'google/pixel-3/pink/pixel-3-pink-front.jpg', 2),
(5, 'Samsung Galaxy A73 5G (128GB/6GB, 6.7 inches) - Grey\r\n', 'SAM-A731285G-GRY - 12386', 3, '749', 4, 1, '<ul><li><strong>Multimedia powerhouse<br></strong>Do more of everything now. Powered with the Snapdragon® 778G 5G, Galaxy A73 5G completely changes your mobile multimedia lifestyle with pro-level gaming, accelerated AI for smarter performance and premium capture experiences. When you need more, RAM Plus provides an extra virtual RAM boost.</li>\r\n<li><strong>Breathtaking is now on display<br></strong>Mesmerizing comes naturally for the FHD+ Super AMOLED Plus display. With the expansive 16.95cm (6.7\") Infinity-O Display, shots taken with the 108MP Wide-angle camera hold life-like details. You can also enjoy vivid outdoor visibility up to 800 nits while reducing blue light with the Eye Comfort Shield.</li>\r\n<li><strong>Awesome screen, super smooth scrolling<br></strong>Watch anything on your Galaxy A73 5G’s 120Hz Super AMOLED Plus display to see how silky smooth is now a viewing experience with less blur, more details, and vivid contrast.</li>\r\n<li><strong>Multi-lens for the perfect shot<br></strong>Multiple lenses for the each brilliant moment. The Galaxy A73 5G\'s high resolution 108MP Wide-angle Camera captures more light and details for unmatched clarity. Capture the crowd with the Ultra Wide Camera, customize focus with the Depth Camera and get closer to the details with the Macro Camera.</li>\r\n<li><strong>Capturing details that make all the difference<br></strong>The new high resolution 108MP sensor captures astounding details with 108MP remosaic shots and more brightness with 12MP binning shots. Enable deep-learning based Detail Enhancer for more details, use Hybrid Optic Zoom to catch far-away objects easily, and reduce noise with the Big Pixel Sensor.</li>\r\n<li><strong>Snap Lenses with Fun mode<br></strong>Express yourself in all the ways with new Snapchat Lenses updated regularly on Fun mode! Browse and try on your favorites, capture your best look, and share them with your friends.</li>\r\n<li><strong>Edit out and enjoy<br></strong>Satisfaction lies in the edit. Take out unwanted objects, strangers in the background and more with the Object eraser.</li>\r\n</ul>', 'samsung/galaxy-a73-5g/grey/galaxy-a73-5g-grey.jpg', 3),
(6, 'Samsung Galaxy A73 5G (128GB/6GB, 6.7 inches) - Mint\r\n', 'SAM-A731285G-MIN - 12387', 3, '749', 3, 0, '<ul><li><strong>Multimedia powerhouse<br></strong>Do more of everything now. Powered with the Snapdragon® 778G 5G, Galaxy A73 5G completely changes your mobile multimedia lifestyle with pro-level gaming, accelerated AI for smarter performance and premium capture experiences. When you need more, RAM Plus provides an extra virtual RAM boost.</li>\r\n<li><strong>Breathtaking is now on display<br></strong>Mesmerizing comes naturally for the FHD+ Super AMOLED Plus display. With the expansive 16.95cm (6.7\") Infinity-O Display, shots taken with the 108MP Wide-angle camera hold life-like details. You can also enjoy vivid outdoor visibility up to 800 nits while reducing blue light with the Eye Comfort Shield.</li>\r\n<li><strong>Awesome screen, super smooth scrolling<br></strong>Watch anything on your Galaxy A73 5G’s 120Hz Super AMOLED Plus display to see how silky smooth is now a viewing experience with less blur, more details, and vivid contrast.</li>\r\n<li><strong>Multi-lens for the perfect shot<br></strong>Multiple lenses for the each brilliant moment. The Galaxy A73 5G\'s high resolution 108MP Wide-angle Camera captures more light and details for unmatched clarity. Capture the crowd with the Ultra Wide Camera, customize focus with the Depth Camera and get closer to the details with the Macro Camera.</li>\r\n<li><strong>Capturing details that make all the difference<br></strong>The new high resolution 108MP sensor captures astounding details with 108MP remosaic shots and more brightness with 12MP binning shots. Enable deep-learning based Detail Enhancer for more details, use Hybrid Optic Zoom to catch far-away objects easily, and reduce noise with the Big Pixel Sensor.</li>\r\n<li><strong>Snap Lenses with Fun mode<br></strong>Express yourself in all the ways with new Snapchat Lenses updated regularly on Fun mode! Browse and try on your favorites, capture your best look, and share them with your friends.</li>\r\n<li><strong>Edit out and enjoy<br></strong>Satisfaction lies in the edit. Take out unwanted objects, strangers in the background and more with the Object eraser.</li>\r\n</ul>', 'samsung/galaxy-a73-5g/mint/galaxy-a73-5g.jpg', 3),
(7, 'Google Pixel 3 (5.5\", 12.2 MP, Global Variant) - White', 'GGLPX3CFG - 6205', 2, '300', 8, 2, '<ul><li><strong>Meet the Google Pixel 3</strong><br>Capture the perfect shot every time, get things done with the Google Assistant, enjoy a battery that lasts up to a day, and more.</li>\r\n<li><strong>A camera so good that it deserves unlimited online storage.</strong><br>Get everyone in the picture with group selfies—no selfie stick required. Snap portraits like a pro with Portrait Mode. Capture smiles, not blinks, for a great photo every time. And save all your favourite moments with unlimited online photo storage.</li>\r\n<li><strong>Charges fast. Lasts long</strong><br>Pixel 3 comes with a battery that charges fast and wirelessly (wireless charger is sold separately), and lasts up to a day. It’s even smart enough to limit battery usage for the apps you don’t use often to keep going longer.</li>\r\n<li><strong>Your Google Assistant.</strong><br>Get help from your Google Assistant: get sports scores, news, commute times, weather info and more – all with a simple squeeze, or just by using your voice</li>\r\n<li><strong>The joy of missing out.</strong><br>Disconnect from your phone when and where you want so that you can focus on time with family and friends. Set timers on apps and turn off visual notifications. Use the wind-down mode to turn the screen to greyscale and get ready for a good night\'s sleep.</li>\r\n<li><strong>Make your world come to life.</strong><br>Search what you see with Google Lens to look up clothing and home decor, copy and translate text, and identify landmarks, plants, and dogs. Play with life-like AR stickers for your photos and videos.</li>\r\n</ul>', 'google/pixel-3/white/pixel-3-white.jpg', 2),
(8, 'Google Pixel 3 (5.5\", 12.2 MP, Global Variant) - Black', 'GGLPX364BLK - 6205', 2, '300', 3, 3, '<ul><li><strong>Meet the Google Pixel 3</strong><br>Capture the perfect shot every time, get things done with the Google Assistant, enjoy a battery that lasts up to a day, and more.</li>\r\n<li><strong>A camera so good that it deserves unlimited online storage.</strong><br>Get everyone in the picture with group selfies—no selfie stick required. Snap portraits like a pro with Portrait Mode. Capture smiles, not blinks, for a great photo every time. And save all your favourite moments with unlimited online photo storage.</li>\r\n<li><strong>Charges fast. Lasts long</strong><br>Pixel 3 comes with a battery that charges fast and wirelessly (wireless charger is sold separately), and lasts up to a day. It’s even smart enough to limit battery usage for the apps you don’t use often to keep going longer.</li>\r\n<li><strong>Your Google Assistant.</strong><br>Get help from your Google Assistant: get sports scores, news, commute times, weather info and more – all with a simple squeeze, or just by using your voice</li>\r\n<li><strong>The joy of missing out.</strong><br>Disconnect from your phone when and where you want so that you can focus on time with family and friends. Set timers on apps and turn off visual notifications. Use the wind-down mode to turn the screen to greyscale and get ready for a good night\'s sleep.</li>\r\n<li><strong>Make your world come to life.</strong><br>Search what you see with Google Lens to look up clothing and home decor, copy and translate text, and identify landmarks, plants, and dogs. Play with life-like AR stickers for your photos and videos.</li>\r\n</ul>', 'google/pixel-3/black/pixel-3-black.jpg', 2),
(9, 'OPPO A96 (Dual Sim, 128GB/8GB, 6.59 inches, CPH2333AU) - Sunset Blue\r\n', 'OPP-A96-BLU - 12599', 4, '395', 6, 1, '<ul><li><strong>90Hz Colour-Rich Punch-Hole Display<br></strong>Graphics flow when slick, colour rich animations captivate and ignite.</li>\r\n<li><strong>Start With Efficiency<br></strong>With Octa-Core Processor, RAM Expansion and 128GB ROM, enjoy apps that run smooth as silk, and have lots of space to store them all.</li>\r\n<li><strong>Full Day Enjoyment<br></strong>A powerful 5000mAh battery ensures you\'ll stay connected to what matters and never miss a moment.</li>\r\n<li><strong>Subtly Sophisticated<br></strong>The thin, smooth design catches the eye, but never begs for attention. It brushes off finger marks and dirt with ease, sustaining its shiny, valuable look.</li>\r\n<li><strong>Strict Product Testing + Scratch Resistance + IPX4 Water Resistance<br></strong>A96 resists scratches and water splashes to retain its flawless look. Whatever the scenario, A96 is ready.</li>\r\n<li><strong>AI Natural Retouching<br></strong>Show off your natural beauty in every photo.</li>\r\n<li><strong>Backlit HDR Portrait<br></strong>Clear, natural shots whether backlit or facing the light.</li>\r\n<li><strong>Three-Finger Translate with Google Lens<br></strong>Customise your screenshot area and translate them just in one tap.</li>\r\n</ul>', 'oppo/a96/blue/a96-blue.jpg', 4),
(10, 'OPPO A96 (Dual Sim, 128GB/8GB, 6.59 inches, CPH2333AU) - Starry Black\r\n', 'OPP-A96-BLK - 12598', 4, '395', 5, 2, '<ul><li><strong>90Hz Colour-Rich Punch-Hole Display<br></strong>Graphics flow when slick, colour rich animations captivate and ignite.</li>\r\n<li><strong>Start With Efficiency<br></strong>With Octa-Core Processor, RAM Expansion and 128GB ROM, enjoy apps that run smooth as silk, and have lots of space to store them all.</li>\r\n<li><strong>Full Day Enjoyment<br></strong>A powerful 5000mAh battery ensures you\'ll stay connected to what matters and never miss a moment.</li>\r\n<li><strong>Subtly Sophisticated<br></strong>The thin, smooth design catches the eye, but never begs for attention. It brushes off finger marks and dirt with ease, sustaining its shiny, valuable look.</li>\r\n<li><strong>Strict Product Testing + Scratch Resistance + IPX4 Water Resistance<br></strong>A96 resists scratches and water splashes to retain its flawless look. Whatever the scenario, A96 is ready.</li>\r\n<li><strong>AI Natural Retouching<br></strong>Show off your natural beauty in every photo.</li>\r\n<li><strong>Backlit HDR Portrait<br></strong>Clear, natural shots whether backlit or facing the light.</li>\r\n<li><strong>Three-Finger Translate with Google Lens<br></strong>Customise your screenshot area and translate them just in one tap.</li>\r\n</ul>', 'oppo/a96/black/a96-black.jpg', 4),
(11, 'Apple iPhone 14 Pro Max 128GB Deep Purple Mobile Phone', 'MQ9T3ZP/A', 5, '1899', 19, 11, '<ul><li><strong>14 Pro</strong><br>A magical new way to interact with iPhone. A vital new safety feature designed to save lives. An innovative 48MP camera for mind-blowing detail. All powered by the ultimate smartphone chip.</li>\r\n<li><strong>Designed for Durability</strong><br>With Ceramic Shield, tougher than any smartphone glass. Water resistance. Surgical-grade stainless steel. 6.1\" and 6.7\" display sizes. All in four Pro colours.</li>\r\n<li><strong>Meet The New Face of iPhone</strong><br>Introducing Dynamic Island, a truly Apple innovation that\'s hardware and software and something in between. It bubbles up music, sports scores, FaceTime and so much more - all without taking you away from what you\'re doing.</li>\r\n<li><strong>Welcome to a Shapeshifting, Multitasking, Head-Turning, Game-Changing iPhone Experience</strong><br>Dynamic Island blends fun and function like never before, consolidating your notifications, alerts and activities into one interactive place. It\'s integrated throughout iOS 16 - and can work with all kinds of apps - to seamlessly surface what you need, just when you need it.</li>\r\n<li><strong>Always-On Display. Always At The Ready.</strong><br>Now your Lock Screen is always glanceable, so you don\'t even have to tap it to stay in the know. When iPhone is turned face-down or in your pocket, it goes dark to save battery life.</li>\r\n<li><strong>Your Photo. Your Font. Your Widgets. Your iPhone.</strong><br>iOS 16 lets you customise your Lock Screen in fun new ways. Layer a photo to make it pop. Track your Activity rings. And see live updates from your favourite apps.</li>\r\n</ul>', 'apple/iphone-14-pro-max/purple/iphone-14-pro-max.png', 5),
(12, 'Google Pixel 6 Pro Stormy Black 128GB (Unlocked)', 'GPIX603167', 2, '999', 14, 6, '<ul><li><strong>Google Tensor: Our first custom-built processor.</strong><br>The first processor designed by Google and made for Pixel, Google Tensor makes the new Pixel phones our most powerful yet.</li>\r\n<li><strong>The most advanced smartphone camera.</strong><br>Capture brilliant colour and vivid detail with Pixel\'s best-in-class computational photography and new pro-level lenses.</li>\r\n<li><strong>Redesigned for more powerful performance.</strong><br>With faster apps and pages, an all-day battery, and proactive help, Pixel 6 Pro delivers what you need when you need it.</li>\r\n<li><strong>Highest rated for security.</strong><br>Pixel keeps your personal data safe with the new Google Tensor chip and next-gen Titan M2™ security.</li>\r\n</ul>', 'google/pixel-6-pro/black/pixel-6-pro-black.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `product_product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `image_path`, `product_product_id`) VALUES
(1, 'nokia/225-4g/sand/225-4g-sand-front.jpg', 1),
(2, 'nokia/225-4g/sand/225-4g-sand-back.jpg', 1),
(3, 'nokia/225-4g/blue/225-4g-blue-front.jpg', 2),
(4, 'nokia/225-4g/blue/225-4g-blue-back.jpg', 2),
(5, 'nokia/225-4g/black/225-4g-black-front.jpg', 3),
(6, 'nokia/225-4g/black/225-4g-black-back.jpg', 3),
(7, 'google/pixel-3/pink/pixel-3-pink-back.jpg', 4),
(8, 'google/pixel-3/pink/pixel-3-pink-combo.jpg', 4),
(9, 'samsung/galaxy-a73-5g/grey/galaxy-a73-5g-grey-back.jpg', 5),
(10, 'samsung/galaxy-a73-5g/grey/galaxy-a73-5g-grey-angle.jpg', 5),
(11, 'samsung/galaxy-a73-5g/mint/galaxy-a73-5g-mint-back.jpg', 6),
(12, 'samsung/galaxy-a73-5g/mint/galaxy-a73-5g-mint-angle.jpg', 6),
(13, 'oppo/a96/blue/a96-blue-front.jpg', 9),
(14, 'oppo/a96/blue/a96-blue-back.jpg', 9),
(15, 'oppo/a96/blue/a96-blue-side.jpg', 9),
(16, 'oppo/a96/blue/a96-blue-bottom-top.jpg', 9),
(17, 'oppo/a96/black/a96-black-front.jpg', 10),
(18, 'oppo/a96/black/a96-black-back.jpg', 10),
(19, 'oppo/a96/black/a96-black-side.jpg', 10),
(20, 'oppo/a96/black/a96-black-bottom-top.jpg', 10),
(21, 'apple/iphone-14-pro-max/purple/iphone-14-pro-max-angle.png', 11),
(22, 'google/pixel-6-pro/black/pixel-6-pro-black-front.jpg', 12),
(23, 'google/pixel-6-pro/black/pixel-6-pro-black-back.png', 12);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `return_id` int NOT NULL,
  `return_date` date NOT NULL,
  `customer_customer_id` int NOT NULL,
  `order_order_id` int NOT NULL,
  `product_product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role_user_role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `username`, `user_password`, `user_role_user_role_id`) VALUES
(1, 'Ryan', 'Jackson', 'ryanjackson', '8c890d3d801f10f7a894ad19e47f80e8b7f69bd9660299210554d317578962fe', 1),
(2, 'Cameron', 'Hughes', 'cameronhughes', '1057a9604e04b274da5a4de0c8f4b4868d9b230989f8c8c6a28221143cc5a755', 1),
(3, 'Jane', 'Doe', 'admin', 'e0c08c2b1f538cd00a812dee98b85fb52a7473b19c019da09ce539b3719a6805', 2),
(4, 'Digby', 'Thomas', 'digbythomas', 'fb480623aa9dda77dedc48f5c94cbf35cf7c0c931015c901b8341e3de487577e', 1),
(5, 'John', 'Smith', 'johnsmith', '86989d5f201308fb507ca7e5887ade883a0beac4b2b67f7eda0f6cb5cbc187f2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `role_name`) VALUES
(2, 'Admin'),
(1, 'Admin Manager');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_detail`
--

CREATE TABLE `wishlist_detail` (
  `wishlist_detail_id` int NOT NULL,
  `customer_customer_id` int NOT NULL,
  `product_product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_info`
--
ALTER TABLE `address_info`
  ADD PRIMARY KEY (`address_info_id`),
  ADD UNIQUE KEY `address_info_id_UNIQUE` (`address_info_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD UNIQUE KEY `idcart_UNIQUE` (`cart_item_id`),
  ADD KEY `fk_cart_item_customer1_idx` (`customer_customer_id`),
  ADD KEY `fk_cart_item_product1_idx` (`product_product_id`);

--
-- Indexes for table `changelog`
--
ALTER TABLE `changelog`
  ADD PRIMARY KEY (`changelog_id`),
  ADD UNIQUE KEY `idchangelog_UNIQUE` (`changelog_id`),
  ADD KEY `fk_changelog_product1_idx` (`product_product_id`),
  ADD KEY `fk_changelog_user1_idx` (`user_user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id_UNIQUE` (`customer_id`),
  ADD UNIQUE KEY `cust_phone_UNIQUE` (`cust_phone`),
  ADD UNIQUE KEY `cust_email_UNIQUE` (`cust_email`),
  ADD KEY `fk_customer_address_info_idx` (`address_info_address_info_id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`feature_id`),
  ADD UNIQUE KEY `feature_id_UNIQUE` (`feature_id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`),
  ADD UNIQUE KEY `manufacturer_id_UNIQUE` (`manufacturer_id`) USING BTREE;

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  ADD KEY `fk_order_customer1_idx` (`customer_customer_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD UNIQUE KEY `order_detail_id_UNIQUE` (`order_detail_id`),
  ADD KEY `fk_order_detail_order1_idx` (`order_order_id`),
  ADD KEY `fk_order_detail_product1_idx` (`product_product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `idproduct_UNIQUE` (`product_id`),
  ADD KEY `fk_product_feature1_idx` (`feature_feature_id`),
  ADD KEY `fk_manufacturer1_idx` (`manufacturer_manufacturer_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`),
  ADD UNIQUE KEY `idproduct_image_UNIQUE` (`product_image_id`),
  ADD KEY `fk_product_id1_idx` (`product_product_id`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`return_id`),
  ADD UNIQUE KEY `idreturn_UNIQUE` (`return_id`),
  ADD KEY `fk_return_customer1_idx` (`customer_customer_id`),
  ADD KEY `fk_return_order1_idx` (`order_order_id`),
  ADD KEY `fk_return_product1_idx` (`product_product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_user_user_role1_idx` (`user_role_user_role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`),
  ADD UNIQUE KEY `iduser_role_UNIQUE` (`user_role_id`),
  ADD UNIQUE KEY `role_name_UNIQUE` (`role_name`);

--
-- Indexes for table `wishlist_detail`
--
ALTER TABLE `wishlist_detail`
  ADD PRIMARY KEY (`wishlist_detail_id`),
  ADD UNIQUE KEY `wishlist_detail_id_UNIQUE` (`wishlist_detail_id`),
  ADD KEY `fk_wishlist_detail_customer1_idx` (`customer_customer_id`),
  ADD KEY `fk_wishlist_detail_product1_idx` (`product_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_info`
--
ALTER TABLE `address_info`
  MODIFY `address_info_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `changelog`
--
ALTER TABLE `changelog`
  MODIFY `changelog_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `feature_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `return_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist_detail`
--
ALTER TABLE `wishlist_detail`
  MODIFY `wishlist_detail_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `fk_cart_item_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `fk_cart_item_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `changelog`
--
ALTER TABLE `changelog`
  ADD CONSTRAINT `fk_changelog_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `fk_changelog_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_address_info` FOREIGN KEY (`address_info_address_info_id`) REFERENCES `address_info` (`address_info_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_detail_order1` FOREIGN KEY (`order_order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `fk_order_detail_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_feature1` FOREIGN KEY (`feature_feature_id`) REFERENCES `feature` (`feature_id`);

--
-- Constraints for table `return`
--
ALTER TABLE `return`
  ADD CONSTRAINT `fk_return_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `fk_return_order1` FOREIGN KEY (`order_order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `fk_return_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_user_role1` FOREIGN KEY (`user_role_user_role_id`) REFERENCES `user_role` (`user_role_id`);

--
-- Constraints for table `wishlist_detail`
--
ALTER TABLE `wishlist_detail`
  ADD CONSTRAINT `fk_wishlist_detail_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `fk_wishlist_detail_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
