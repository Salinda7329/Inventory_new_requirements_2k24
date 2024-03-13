-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 12:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Dell'),
(2, 'Asus'),
(3, 'Samsung'),
(4, 'Singer'),
(5, 'Promate');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Electrical'),
(2, 'Furniture'),
(3, 'School Items'),
(4, 'Kitchen Items');

-- --------------------------------------------------------

--
-- Table structure for table `issued_items`
--

CREATE TABLE `issued_items` (
  `issued_item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Issued_by` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Department_id` varchar(255) NOT NULL,
  `issued_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_items`
--

INSERT INTO `issued_items` (`issued_item_id`, `item_name`, `quantity`, `Issued_by`, `Department`, `Department_id`, `issued_timestamp`, `remark`) VALUES
(1, 'Singer TV', 1, '', '', '', '2023-09-11 08:01:29', 'To Udana');

--
-- Triggers `issued_items`
--
DELIMITER $$
CREATE TRIGGER `UpdateItemsRemaining` AFTER INSERT ON `issued_items` FOR EACH ROW BEGIN
  -- Decrease the quantity from the items_remaining count in the items table
  UPDATE items
  SET items_remaining = items_remaining - NEW.quantity
  WHERE item_name = NEW.item_name;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `items_remaining` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `subcategory_id`, `brand_id`, `items_remaining`) VALUES
(1, 'Dell Laptop', 1, 1, 5),
(2, 'Asus Laptop', 1, 2, 4),
(3, 'Samsung TV', 2, 3, 2),
(4, 'Singer TV', 2, 4, 3),
(5, 'Promate Pens', 5, 5, 10),
(6, 'Huwawei_phone', 1, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(1, 'Laptops', 1),
(2, 'TV', 1),
(3, 'Chairs', 2),
(4, 'Beds', 2),
(5, 'A4 Papers', 3);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_contact` varchar(255) DEFAULT NULL,
  `supplier_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_address`) VALUES
(1, 'Supplier A', 'Contact A', 'Address A'),
(2, 'Supplier B', 'Contact B', 'Address B'),
(3, 'Supplier C', 'Contact C', 'Address C'),
(4, 'Supplier D', 'Contact D', 'Address D'),
(5, 'Supplier E', 'Contact E', 'Address E');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_brand_link`
--

CREATE TABLE `supplier_brand_link` (
  `supplier_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_brand_link`
--

INSERT INTO `supplier_brand_link` (`supplier_id`, `brand_id`) VALUES
(1, 1),
(2, 3),
(3, 4),
(5, 2),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `transaction_type` enum('IN','OUT') NOT NULL,
  `quantity` int(11) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `AddItemToStock` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
    DECLARE is_in INT;
    SET is_in = (SELECT COUNT(*) FROM transactions WHERE item_id = NEW.item_id AND transaction_type = 'IN');
    
    IF is_in > 0 THEN
        UPDATE items
        SET items_remaining = items_remaining + NEW.quantity
        WHERE item_id = NEW.item_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DecreaseItemFromStock` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
    DECLARE is_out INT;
    SET is_out = (SELECT COUNT(*) FROM transactions WHERE item_id = NEW.item_id AND transaction_type = 'OUT');
    
    IF is_out > 0 THEN
        UPDATE items
        SET items_remaining = items_remaining - NEW.quantity
        WHERE item_id = NEW.item_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateTransactionTimestamp` BEFORE UPDATE ON `transactions` FOR EACH ROW BEGIN
    SET NEW.transaction_date = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `phone_number`) VALUES
(1, 'sadeera123', 'sadeera', 'perera', '0123456', 'sadeera@sibatech', '0123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_id` (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexes for table `issued_items`
--
ALTER TABLE `issued_items`
  ADD PRIMARY KEY (`issued_item_id`),
  ADD KEY `Issued_by` (`Issued_by`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `subcategory_id` (`subcategory_id`,`brand_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD UNIQUE KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `supplier_brand_link`
--
ALTER TABLE `supplier_brand_link`
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issued_items`
--
ALTER TABLE `issued_items`
  MODIFY `issued_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`subcategory_id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `supplier_brand_link`
--
ALTER TABLE `supplier_brand_link`
  ADD CONSTRAINT `supplier_brand_link_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`),
  ADD CONSTRAINT `supplier_brand_link_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
