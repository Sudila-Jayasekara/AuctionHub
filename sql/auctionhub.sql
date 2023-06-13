-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 04:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auctionhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_category`
--

CREATE TABLE `admin_category` (
  `admin_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bidder`
--

CREATE TABLE `bidder` (
  `bidder_id` int(11) NOT NULL,
  `payment_type` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidder`
--

INSERT INTO `bidder` (`bidder_id`, `payment_type`, `user_id`) VALUES
(1, '', 1),
(2, '', 2),
(3, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `bidder_item`
--

CREATE TABLE `bidder_item` (
  `bidder_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `bid_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidder_item`
--

INSERT INTO `bidder_item` (`bidder_id`, `item_id`, `bid_value`) VALUES
(2, 6, 10000),
(2, 7, 950000),
(2, 8, 100000),
(2, 9, 1500),
(2, 10, 60000),
(3, 11, 120000),
(3, 12, 160000);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Art and Collectibles', 'This category includes paintings, sculptures, antiques, rare coins, stamps, vintage collectibles, and other valuable artistic and historical items.'),
(2, 'Jewelry and Watches', 'Auctions in this category feature a wide range of fine jewelry, luxury watches, gemstones, diamonds, and precious metals like gold and silver.'),
(3, 'Vehicles', 'This category encompasses auctions for automobiles, motorcycles, boats, recreational vehicles (RVs), and other types of vehicles, including classic cars and exotic automobiles.'),
(4, 'Electronics and Technology', 'Auctions in this category offer a variety of electronics and tech gadgets, such as smartphones, laptops, gaming consoles, cameras, audio equipment, and other cutting-edge tech products.'),
(5, 'Home and Garden', 'This category covers auctions for home furnishings, decor items, appliances, garden tools, outdoor furniture, and other items related to home improvement and gardening.'),
(6, 'Fashion and Accessories', 'Auctions in this category showcase designer clothing, shoes, handbags, accessories, luxury watches, and other fashionable items from renowned brands.'),
(7, 'Sports Memorabilia', 'This category focuses on auctions featuring sports-related collectibles, autographed memorabilia, game-worn jerseys, trading cards, and other items connected to sports history.'),
(8, 'Toys and Hobbies', 'Auctions under this category include vintage toys, action figures, board games, model trains, dolls, comic books, and other items that appeal to collectors and hobbyists.'),
(9, 'Real Estate', 'This category involves auctions for residential and commercial properties, land, vacation homes, investment properties, and other real estate assets.'),
(10, 'Charity and Fundraising', 'Auctions in this category are organized for charitable purposes, allowing people to bid on unique experiences, celebrity memorabilia, exclusive events, and other items to support worthy causes.');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `numberOf_bids` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `end_date` datetime NOT NULL,
  `is_reported` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_description`, `image`, `numberOf_bids`, `price`, `end_date`, `is_reported`, `seller_id`, `category_id`) VALUES
(6, ' 1993 Gold \"Double Eagle\" Coin', 'This auction item is a 1993 gold \"Double Eagle\" coin, which recently fetched a staggering price of $18.9 million at Sotheby\'s auction. Considered one of the world\'s most valuable coins, this exquisite piece is made of pure gold and features a captivating ', 'double_eagle.jpg', 0, 10000, '2023-06-14 19:14:00', 0, 2, 1),
(7, '1866 Liberty Head Nickel', 'The 1866 Liberty Head Nickel is a rare and highly sought-after coin in the world of numismatics. This nickel was one of the earliest minted in the United States, making it a piece of American history. It features Lady Liberty on the obverse, symbolizing f', 'rare-nickels-hero.jpg', 0, 950000, '2023-06-14 19:15:00', 0, 2, 1),
(8, '1856 British Guiana 1c Magenta', 'The British Guiana 1c Magenta is the most valuable rare stamp in the world. In 1856, The British Guiana (now the independent nation of Guyana) post office issued the initial run of 1c magenta stamps for use in newspaper circulation. When an expected shipm', 'IMG_0102-3-2.jpg', 0, 100000, '2023-06-21 19:18:00', 0, 2, 1),
(9, 'Vintage Diamond Pendant Necklace', 'This vintage diamond pendant necklace is a stunning piece of estate jewelry that exudes elegance and timeless beauty. Crafted in the Art Deco era, it features a sparkling round-cut diamond set in a delicate 14k white gold pendant. The diamond is surrounde', 'Nest_Egg-Auctions_Estate_Jewelry.jpg', 0, 1500, '2023-06-13 19:22:00', 0, 2, 2),
(10, 'Chevrolet Bel Air', 'The antique Chevrolet Bel Air is a true gem from the golden age of American automobiles. Produced in the 1950s, this iconic car showcases the distinctive chrome accents, stylish fins, and luxurious interior that epitomize the era. With its smooth ride and', 'jaguar_mark_v1200_6-sixteen_nine.jpg', 0, 60000, '2023-06-13 19:26:00', 0, 2, 3),
(11, 'Classic Volkswagen Beetle', 'The classic Volkswagen Beetle, also known as the \"Bug,\" is an iconic compact car that has charmed drivers worldwide for decades. Manufactured from the 1930s to the 2000s, this beloved vehicle features a distinctive round shape, friendly demeanor, and an a', '797eb14835b7e2e6abe53d82f4acd4c1c613f6f1.jpg', 0, 120000, '2023-06-27 19:29:00', 0, 3, 3),
(12, ' Vintage Porsche 911', 'The vintage Porsche 911 is a legendary sports car that has become an icon in the automotive world. Produced since the 1960s, this two-door coupe boasts a timeless design, powerful performance, and precision engineering. With its rear-engine layout, distin', 'photo-950x628.png', 0, 150000, '2023-06-14 00:00:00', 0, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(11) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `store_description` varchar(255) NOT NULL,
  `store_address` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `store_name`, `store_description`, `store_address`, `user_id`) VALUES
(1, 'admin 1 store', 'admin 1 store description', 'admin 1 store address', 1),
(2, 'Seller 1 store', 'seller 1 store description', 'Seller1 store address\r\n', 2),
(3, 'seller 2 store', 'seller 2 store description', 'seller 2 store address', 3);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `is_bidder` tinyint(4) NOT NULL,
  `is_seller` tinyint(4) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `dob`, `phone`, `gender`, `address`, `registration_date`, `is_bidder`, `is_seller`, `is_admin`, `password`) VALUES
(1, 'admin1', '000', 'admin1@gmail.com', '1990-06-19', '0712387589', 'male', 'admin 01 address', '2023-06-11', 1, 1, 1, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'seller1', '000', 'seller1@gmail.com', '1994-05-18', '0712387583', 'female', 'seller 01 address', '2023-06-11', 1, 1, 0, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'seller2', '000', 'seller2@gmail.com', '1989-09-11', '0712347583', 'female', 'seller 01 address', '2023-06-11', 1, 1, 0, '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `watchlist_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_fk` (`user_id`);

--
-- Indexes for table `admin_category`
--
ALTER TABLE `admin_category`
  ADD PRIMARY KEY (`admin_id`,`category_id`),
  ADD KEY `admin_category_fk2` (`category_id`);

--
-- Indexes for table `bidder`
--
ALTER TABLE `bidder`
  ADD PRIMARY KEY (`bidder_id`),
  ADD KEY `bidder_fk` (`user_id`);

--
-- Indexes for table `bidder_item`
--
ALTER TABLE `bidder_item`
  ADD PRIMARY KEY (`bidder_id`,`item_id`,`bid_value`) USING BTREE,
  ADD KEY `bidder_item_fk2` (`item_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_fk1` (`seller_id`),
  ADD KEY `item_fk2` (`category_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`),
  ADD KEY `seller_fk` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transactions_fk1` (`bidder_id`),
  ADD KEY `transactions_fk2` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watchlist_id`),
  ADD KEY `watchlist_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bidder`
--
ALTER TABLE `bidder`
  MODIFY `bidder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watchlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `admin_category`
--
ALTER TABLE `admin_category`
  ADD CONSTRAINT `admin_category_fk1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `admin_category_fk2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `bidder`
--
ALTER TABLE `bidder`
  ADD CONSTRAINT `bidder_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `bidder_item`
--
ALTER TABLE `bidder_item`
  ADD CONSTRAINT `bidder_item_fk1` FOREIGN KEY (`bidder_id`) REFERENCES `bidder` (`bidder_id`),
  ADD CONSTRAINT `bidder_item_fk2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_fk1` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`),
  ADD CONSTRAINT `item_fk2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_fk1` FOREIGN KEY (`bidder_id`) REFERENCES `bidder` (`bidder_id`),
  ADD CONSTRAINT `transactions_fk2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
