-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 09:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `unitStreetNum` varchar(20) NOT NULL,
  `Address1` varchar(255) NOT NULL,
  `Address2` varchar(255) DEFAULT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Zip` varchar(10) DEFAULT NULL,
  `phoneNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`companyID`, `name`, `unitStreetNum`, `Address1`, `Address2`, `Country`, `City`, `State`, `Zip`, `phoneNumber`) VALUES
(1, 'Feel Good Inc.', '1', 'Demon Days Way', NULL, 'New Zealand', 'Christchurch', NULL, '7615', '6411111');

-- --------------------------------------------------------

--
-- Table structure for table `internallevel`
--

CREATE TABLE `internallevel` (
  `ID` int(2) NOT NULL,
  `levelName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internallevel`
--

INSERT INTO `internallevel` (`ID`, `levelName`) VALUES
(1, 'Viewer'),
(2, 'Low Admin'),
(3, 'Full Admin');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internallogin`
--

INSERT INTO `internallogin` (`internalID`, `firstName`, `lastName`, `email`, `phone`, `password`, `intLevel`, `active`) VALUES
(1, 'Web', 'Master', 'webmaster@skillforge.com', '64111111', '$2y$10$Y8FkFjWlSehvNyuC3AqZWuELI8f.ie6OFY08Kr6Oimxybz.rsYj1a', 3, 1),
(2, 'Andrew', 'Grant', 'andrew@skillforge.com', '6411', '$2y$10$qCtTvgAO4VQU32xwZmSgiuGr8N3CzgkeNDz5XZRVtZm3t.yMKFWeK', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `mediaType` enum('audio','image','video','pdf','none') NOT NULL,
  `mediaPath` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `questionID`, `mediaType`, `mediaPath`, `createdAt`) VALUES
(1, 8, 'audio', 'uploads/media/IMG_3986.png', '2024-05-25 09:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptor` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `companyID`, `title`, `descriptor`, `thumbnail`, `createdAt`) VALUES
(6, 1, 'Sample', 'Sample', '', '2024-05-26 22:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `moduleId` int(11) NOT NULL,
  `questionText` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestdemo`
--

INSERT INTO `requestdemo` (`requestID`, `firstName`, `lastName`, `email`, `phone`, `country`, `company`, `contacted`, `contactID`) VALUES
(1, 'Andrew', 'Grant', 'andosgee@gmail.com', '641111', 'New Zealand', 'Andrew inc', 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `internallevel`
--
ALTER TABLE `internallevel`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `internallogin`
--
ALTER TABLE `internallogin`
  MODIFY `internalID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requestdemo`
--
ALTER TABLE `requestdemo`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
