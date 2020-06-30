-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 09:25 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carddetails`
--

CREATE TABLE `carddetails` (
  `id` int(11) NOT NULL,
  `cardName` varchar(50) NOT NULL,
  `NameOnCard` varchar(50) NOT NULL,
  `CardNumber` varchar(60) NOT NULL,
  `ExpiryDate` varchar(10) NOT NULL,
  `cvv` int(10) NOT NULL,
  `PhoneNumberForOTP` bigint(20) NOT NULL,
  `userid` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carddetails`
--

INSERT INTO `carddetails` (`id`, `cardName`, `NameOnCard`, `CardNumber`, `ExpiryDate`, `cvv`, `PhoneNumberForOTP`, `userid`) VALUES
(40, '', '', '8924 7392 8472 9899', '', 0, 0, 520),
(41, '', '', '8987 4987 2948 3794', '', 0, 0, 520),
(47, 'TEra Baaap2', 'Sachin Barpanda', '4565 4654 5465 4654', '12 / 12', 123, 7008673544, 525),
(48, 'TEra Baaap', 'Sachin2', '6565 7657 6576 5765', '12 / 12', 908, 917008673544, 525);

-- --------------------------------------------------------

--
-- Table structure for table `userscard`
--

CREATE TABLE `userscard` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Created_On` datetime NOT NULL,
  `Picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userscard`
--

INSERT INTO `userscard` (`id`, `firstName`, `lastName`, `username`, `password`, `email`, `Created_On`, `Picture`) VALUES
(517, 'Sachin', 'Barpanda', 'sam_sachin', '123456', 'sachin.barpanda@suiit.ac.in', '2020-06-29 07:37:18', 'master-image.jpg'),
(518, 'Sachin', 'Barpanda', 'sam', '', '', '2020-06-29 07:43:00', ''),
(519, 'Sachin2', 'Barpanda', 'thisIsMe', '123456', 'sachin.barpanda@suiit.ac.in', '2020-06-29 08:27:54', ''),
(520, 'Sachin', 'Barpanda', 'iio', '123456', 'sachin.barpanda@suiit.ac.in', '2020-06-29 08:44:36', ''),
(521, '', '', 'sam_sac', '123456', '', '2020-06-29 11:32:14', ''),
(522, '', '', 'lopopop', '123456', '', '2020-06-29 12:15:55', ''),
(523, 'Sachin', 'Barpanda', 'new', '123456', 'barpandasachin@gmail.com', '2020-06-29 15:02:38', ''),
(524, 'Sachin', 'Barpanda', 'Sam Kal', '1234', 'barpandasachin@gmail.com', '2020-06-30 08:40:38', 'master-image.jpg'),
(525, 'Sachin', 'Barpanda', 't_sACHIN', '123456', 'barpandasachin@gmail.com', '2020-06-30 08:47:11', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carddetails`
--
ALTER TABLE `carddetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userscard`
--
ALTER TABLE `userscard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carddetails`
--
ALTER TABLE `carddetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `userscard`
--
ALTER TABLE `userscard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
