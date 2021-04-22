-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 22, 2021 at 02:26 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `subject`, `phone`, `emailid`, `message`) VALUES
('Trial', 'testing', 2147483647, 'test@gmail.com', 'Trial message');

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `fname` varchar(10) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `purchase` date NOT NULL,
  `experience` enum('Great','Good','Okay','Poor') NOT NULL,
  `reliability` enum('Very dissatisfied','Not satisfied','Neutral','Satisfied','Very satisfied','') NOT NULL,
  `services` enum('Very dissatisfied','Not satisfied','Neutral','Satisfied','Very satisfied','') NOT NULL,
  `pricing` enum('Very dissatisfied','Not satisfied','Neutral','Satisfied','Very satisfied','') NOT NULL,
  `support` enum('Very dissatisfied','Not satisfied','Neutral','Satisfied','Very satisfied','') NOT NULL,
  `design` enum('Very dissatisfied','Not satisfied','Neutral','Satisfied','Very satisfied','') NOT NULL,
  `quality` enum('Very dissatisfied','Not satisfied','Neutral','Satisfied','Very satisfied','') NOT NULL,
  `feedback` enum('comments','suggestions','Questions','') NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feed`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `name` varchar(20) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`name`, `total`) VALUES
('user1', 774),
('user2', 1500),
('user3', 1700),
(NULL, 0),
(NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(40) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `pass`) VALUES
('mini', 'project'),
('testlab', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `image`, `price`) VALUES
(1, 'San disk Pen drive', '13.jpg', 150),
(2, 'Hard Disk', '14.jpg', 232.33),
(3, 'SD Card', '15.jpg', 24),
(4, 'Card Reader', '16.jpg', 124);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product2`
--

CREATE TABLE `tbl_product2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product2`
--

INSERT INTO `tbl_product2` (`id`, `name`, `image`, `price`) VALUES
(5, 'White mobile charger', '5.jpg', 500.00),
(6, 'Black mobile charger', '6.jpg', 550.00),
(7, 'Power bank', '7.jpg', 1125.00),
(8, 'Car charger', '8.jpg', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product3`
--

CREATE TABLE `tbl_product3` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product3`
--

INSERT INTO `tbl_product3` (`id`, `name`, `image`, `price`) VALUES
(9, 'Black headphone', '9.jpg', 500.00),
(10, 'Blue headphone', '10.png\r\n', 500.00),
(11, 'Yellow headphone', '11.jpg', 800.00),
(12, ' Dark Blue headphone', '12.jpg', 750.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product2`
--
ALTER TABLE `tbl_product2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product3`
--
ALTER TABLE `tbl_product3`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_product2`
--
ALTER TABLE `tbl_product2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_product3`
--
ALTER TABLE `tbl_product3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
