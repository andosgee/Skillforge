-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 01:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillforge`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `companyID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`companyID`, `name`, `address`) VALUES
(1, 'Feel Good Inc.', '1 Demon Days Way, Christchurch, 7615, New Zealand');

-- --------------------------------------------------------

--
-- Table structure for table `internallevel`
--

CREATE TABLE `internallevel` (
  `ID` int(2) NOT NULL,
  `levelName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `internallogin`
--

CREATE TABLE `internallogin` (
  `internalID` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `intLevel` int(2) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internallogin`
--

INSERT INTO `internallogin` (`internalID`, `firstName`, `lastName`, `email`, `phone`, `password`, `intLevel`, `active`) VALUES
(1, 'Web', 'Master', 'webmaster@skillforge.com', '64111111', '$2y$10$Y8FkFjWlSehvNyuC3AqZWuELI8f.ie6OFY08Kr6Oimxybz.rsYj1a', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requestdemo`
--

CREATE TABLE `requestdemo` (
  `requestID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(56) NOT NULL,
  `company` varchar(100) NOT NULL,
  `contacted` int(1) DEFAULT NULL,
  `contactID` int(2) DEFAULT NULL COMMENT 'Link to ID from internal login'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requestdemo`
--

INSERT INTO `requestdemo` (`requestID`, `firstName`, `lastName`, `email`, `phone`, `country`, `company`, `contacted`, `contactID`) VALUES
(0, 'Andrew', 'Grant', 'andosgee@gmail.com', '641111', 'New Zealand', 'Andrew inc', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `userID` int(5) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone` int(20) NOT NULL,
  `level` int(2) NOT NULL,
  `active` int(1) NOT NULL,
  `companyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`userID`, `firstName`, `lastName`, `email`, `phone`, `level`, `active`, `companyID`) VALUES
(1, 'Damon', 'Albarn', 'damon@feelgoodinc.com', 642115898, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE `userlevel` (
  `levelID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `levelName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`levelID`, `companyID`, `levelName`) VALUES
(1, 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `loginID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`loginID`, `userID`, `password`) VALUES
(1, 1, '$2y$10$M/v6iT.JubaftLiX9vKl9OBmHzGHjIbbck5shWB86xrRIiXWx0O1K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `internallevel`
--
ALTER TABLE `internallevel`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `internallogin`
--
ALTER TABLE `internallogin`
  ADD PRIMARY KEY (`internalID`);

--
-- Indexes for table `requestdemo`
--
ALTER TABLE `requestdemo`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`levelID`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`loginID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `internallevel`
--
ALTER TABLE `internallevel`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internallogin`
--
ALTER TABLE `internallogin`
  MODIFY `internalID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userlevel`
--
ALTER TABLE `userlevel`
  MODIFY `levelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `loginID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
