-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 08:51 PM
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
-- Database: `milkdiary_collection_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmer_id` int(11) NOT NULL,
  `farmer_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmer_id`, `farmer_name`, `contact_number`, `address`) VALUES
(2, 'Jadon Sancho', '78823416', 'burund_togo'),
(3, 'dodai', '73382384', 'kirambo_burera'),
(4, 'ERIC', '', 'KIGAL'),
(5, 'Robert Willison', '72345376', 'burund_togo'),
(6, 'eric', 'mtn', 'kigali_rwanda'),
(9, 'yiiiiiiiy', '0', 'fydt'),
(10, 'afande', '98765', 'kabaguma_kirung'),
(15, 'TRTRTR', 'RTDFG', 'TYYRTYUGF'),
(16, 'dfgb', 'cvbn', 'cvbn'),
(18, 'A', '', ''),
(19, 'ert', 'er', '5tf'),
(20, 'chyujt', 'fgh', 'dfg'),
(22, 'big man', 'yt', 'rulindo'),
(24, 'eric', 'maniraguha', 'kigari_rwanda'),
(25, 'vnmhfjd', 'ettytyt', 'sfs'),
(26, '', '', ''),
(28, '', '', ''),
(29, 'eri', 'yon', 'kigl'),
(30, '', '', ''),
(31, 't', 'rt', 'kigo'),
(32, 'eric', 'mtn', 'kigali_rwanda'),
(55, 'iradukunda', '9876578', 'burund_togo'),
(56, 'maniraguha dodayi', '0787555638', 'burera  kigali');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `collection_id`, `expiration_date`, `quantity`) VALUES
(3, 2, '2024-05-02', 44),
(5, 5, '2024-04-30', 666),
(6, 8, '2024-05-02', 999),
(57, 6, '2024-04-06', 9877890);

-- --------------------------------------------------------

--
-- Table structure for table `milkcollection`
--

CREATE TABLE `milkcollection` (
  `collection_id` int(11) NOT NULL,
  `farmer_id` int(11) DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `milkcollection`
--

INSERT INTO `milkcollection` (`collection_id`, `farmer_id`, `collection_date`, `quantity`) VALUES
(2, 2, '2005-08-06', 56),
(3, 3, '2000-05-07', 33),
(5, 2, '2005-08-06', 6),
(6, 2, '2005-08-06', 56),
(7, 3, '2000-05-07', 78),
(8, 3, '2000-05-07', 78),
(43, 55, '2024-04-13', 55554);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `farmer_id` int(11) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_amount`, `payment_date`, `farmer_id`, `collection_id`) VALUES
(5, 568, '2004-09-07', 3, 6),
(11, 56, '2009-04-07', 6, 3),
(13, 567, '2009-06-05', 4, 5),
(14, 167, '2024-04-26', 9, 8),
(23, 234, '2024-04-10', 22, 43),
(24, 1233, '2024-04-09', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `report_date` date DEFAULT NULL,
  `total_milk_collacted` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `report_date`, `total_milk_collacted`) VALUES
(1, '2024-04-12', 900),
(3, '2024-04-17', 4546),
(4, '2024-05-09', 555),
(23, '2024-04-23', 675);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'ERIC', 'MANIRAGUHA', 'DODAI2001', 'maniraguha149@gmail.com', '+250782756458', '1234', '2024-04-10 19:18:42', '1', 0),
(3, 'iradukunda', 'nepo', 'one', 'irad@gmail.com', '9876543', '12345', '2024-04-10 19:23:40', '67', 0),
(5, 'one', 'two', 'dod12', 'maniraguha49@gmail.com', '0989', '5555', '2024-04-19 13:58:04', '88', 0),
(6, 'ineza', 'olivier', 'ineza123', 'ineza12@gmail.com', '0789668586', '1111', '2024-04-20 07:45:07', '767', 0),
(8, 'yuhi', 'iragena', 'iragenay', 'manyuhi@gmail.com', '0782756458', '$2y$10$8EPbs4xMTa2BJ2XG2kZAmOjT6q29/C8/Pr9VnsCiW49iolO450Q4C', '2024-04-20 08:34:11', '4545', 0),
(9, 'gena', 'kampire', 'gen123', 'kamp1@gmail.com', '0987678', '$2y$10$vnKEFCTU14/cMT6dZy.rge.bkPWmtzD8.7KanDzPMneqy/4z4T1Q2', '2024-04-20 10:08:25', '88', 0),
(10, 'alice', 'uwamariya', 'alice123', 'uwamariya@gmail.com', '654345', '$2y$10$cIFNW444bezf5iHd4Oosz.Xp3G8TdLqaDCp4rawxats0wmPks3ybm', '2024-04-26 10:57:43', '66', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- Indexes for table `milkcollection`
--
ALTER TABLE `milkcollection`
  ADD PRIMARY KEY (`collection_id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `farmer_id` (`farmer_id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `milkcollection`
--
ALTER TABLE `milkcollection`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `milkcollection` (`collection_id`);

--
-- Constraints for table `milkcollection`
--
ALTER TABLE `milkcollection`
  ADD CONSTRAINT `milkcollection_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`farmer_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`farmer_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`collection_id`) REFERENCES `milkcollection` (`collection_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
