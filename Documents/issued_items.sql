-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 11:49 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issued_items`
--
ALTER TABLE `issued_items`
  ADD PRIMARY KEY (`issued_item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issued_items`
--
ALTER TABLE `issued_items`
  MODIFY `issued_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
