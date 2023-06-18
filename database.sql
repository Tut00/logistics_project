-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2022 at 03:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project_ice321`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `ID` varchar(10) NOT NULL,
  `email` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`ID`, `email`, `password`, `Name`) VALUES
('1', 'admin@.com', 'admin', 'mohsen'),
('2', 'ad1@.com', 'admin', 'nawaf');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `C_id` varchar(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`C_id`, `Name`, `Email`, `Password`) VALUES
('1', 'mohsen', 'mohsen@gmail.com', 'password'),
('2', 'turki', 'turki@gmail.com', 'password'),
('3', 'nawaf', 'nawaf@com', 'pass10'),
('4', 'turki', 'turki1@gmail.com', 'password'),
('5', 'mohsen', 'mohsen2@gmail.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `ID` varchar(10) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Pnum` varchar(10) NOT NULL,
  `Schedule_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Package`
--

CREATE TABLE `Package` (
  `Pnum` varchar(10) NOT NULL,
  `weight` float NOT NULL,
  `Dimensions` float NOT NULL,
  `Insurance` tinyint(1) NOT NULL,
  `ID` varchar(10) NOT NULL,
  `C_id` varchar(10) NOT NULL,
  `Type` text NOT NULL DEFAULT 'Regular',
  `Status` varchar(10) NOT NULL DEFAULT 'Transit',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Package`
--

INSERT INTO `Package` (`Pnum`, `weight`, `Dimensions`, `Insurance`, `ID`, `C_id`, `Type`, `Status`, `Date`) VALUES
('P150', 17, 76, 0, '3', '1', 'Fragile', 'damaged', '2022-12-16'),
('P250', 99, 50.5, 0, '2', '3', 'Regular', 'Delivered', '0000-00-00'),
('P500', 10, 7.5, 1, '2', '2', 'Fragile', 'Transit', '2021-12-01'),
('P600', 19, 80, 1, '5', '3', 'Regular', 'Delivered', '0000-00-00'),
('P700', 77, 39, 1, '2', '1', 'damaged', 'lost', '2021-07-15'),
('P800', 10, 7.5, 1, '2', '2', 'Liquid', 'Deliverd', '2022-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `P_num` varchar(10) NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Payment`
--

INSERT INTO `Payment` (`P_num`, `Status`) VALUES
('P250', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `Recived_package`
--

CREATE TABLE `Recived_package` (
  `Pnum` varchar(10) NOT NULL,
  `Recived_due_d` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Recived_package`
--

INSERT INTO `Recived_package` (`Pnum`, `Recived_due_d`) VALUES
('P600', '2022-12-14'),
('P250', '2022-12-14'),
('P250', '2022-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `Retail`
--

CREATE TABLE `Retail` (
  `ID` varchar(10) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Address` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Retail`
--

INSERT INTO `Retail` (`ID`, `Type`, `Address`) VALUES
('1', 'Warehouse', 'Khobar'),
('2', 'Warehouse', 'Dammam'),
('3', 'Warehouse', 'Dharan'),
('4', 'Warehouse', 'Khobar'),
('5', 'Warehouse', 'Khobar');

-- --------------------------------------------------------

--
-- Table structure for table `Shipped_package`
--

CREATE TABLE `Shipped_package` (
  `Pnum` varchar(10) NOT NULL,
  `Final_delivery_d` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Store`
--

CREATE TABLE `Store` (
  `Schedule_number` varchar(10) NOT NULL,
  `ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Transport`
--

CREATE TABLE `Transport` (
  `ID` varchar(10) NOT NULL,
  `Schedule_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Transportation`
--

CREATE TABLE `Transportation` (
  `Schedule_number` varchar(10) NOT NULL,
  `Delivery_route` varchar(20) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`C_id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Pnum2` (`Pnum`),
  ADD KEY `Schedule` (`Schedule_number`);

--
-- Indexes for table `Package`
--
ALTER TABLE `Package`
  ADD PRIMARY KEY (`Pnum`),
  ADD KEY `Customer` (`C_id`),
  ADD KEY `id` (`ID`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`P_num`);

--
-- Indexes for table `Recived_package`
--
ALTER TABLE `Recived_package`
  ADD KEY `Pnum` (`Pnum`);

--
-- Indexes for table `Retail`
--
ALTER TABLE `Retail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Shipped_package`
--
ALTER TABLE `Shipped_package`
  ADD PRIMARY KEY (`Pnum`);

--
-- Indexes for table `Store`
--
ALTER TABLE `Store`
  ADD PRIMARY KEY (`Schedule_number`,`ID`),
  ADD KEY `id1` (`ID`);

--
-- Indexes for table `Transport`
--
ALTER TABLE `Transport`
  ADD PRIMARY KEY (`ID`,`Schedule_number`),
  ADD KEY `Schedule3` (`Schedule_number`);

--
-- Indexes for table `Transportation`
--
ALTER TABLE `Transportation`
  ADD PRIMARY KEY (`Schedule_number`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Location`
--
ALTER TABLE `Location`
  ADD CONSTRAINT `Pnum2` FOREIGN KEY (`Pnum`) REFERENCES `Package` (`Pnum`),
  ADD CONSTRAINT `Schedule` FOREIGN KEY (`Schedule_number`) REFERENCES `Transportation` (`Schedule_number`);

--
-- Constraints for table `Package`
--
ALTER TABLE `Package`
  ADD CONSTRAINT `Customer` FOREIGN KEY (`C_id`) REFERENCES `Customer` (`C_id`),
  ADD CONSTRAINT `id` FOREIGN KEY (`ID`) REFERENCES `Retail` (`ID`);

--
-- Constraints for table `Payment`
--
ALTER TABLE `Payment`
  ADD CONSTRAINT `P_num` FOREIGN KEY (`P_num`) REFERENCES `Package` (`Pnum`);

--
-- Constraints for table `Recived_package`
--
ALTER TABLE `Recived_package`
  ADD CONSTRAINT `Pnum` FOREIGN KEY (`Pnum`) REFERENCES `Package` (`Pnum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Shipped_package`
--
ALTER TABLE `Shipped_package`
  ADD CONSTRAINT `Pnum1` FOREIGN KEY (`Pnum`) REFERENCES `Package` (`Pnum`);

--
-- Constraints for table `Store`
--
ALTER TABLE `Store`
  ADD CONSTRAINT `Schedule2` FOREIGN KEY (`Schedule_number`) REFERENCES `Transportation` (`Schedule_number`),
  ADD CONSTRAINT `id1` FOREIGN KEY (`ID`) REFERENCES `Retail` (`ID`);

--
-- Constraints for table `Transport`
--
ALTER TABLE `Transport`
  ADD CONSTRAINT `Schedule3` FOREIGN KEY (`Schedule_number`) REFERENCES `Transportation` (`Schedule_number`),
  ADD CONSTRAINT `id2` FOREIGN KEY (`ID`) REFERENCES `Retail` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
