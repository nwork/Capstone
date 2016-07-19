-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2016 at 06:16 PM
-- Server version: 5.5.49-0+deb8u1
-- PHP Version: 5.6.20-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `childdaycare`
--

-- --------------------------------------------------------

--
-- Table structure for table `childinfo`
--

CREATE TABLE IF NOT EXISTS `childinfo` (
`child_IDX` int(11) NOT NULL,
  `fName` varchar(16) NOT NULL,
  `lName` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `parent_idx` int(11) NOT NULL,
  `daykey` int(11) NOT NULL,
  `medical` varchar(45) NOT NULL,
  `parentinfo_parent_index1` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `childinfo`
--

INSERT INTO `childinfo` (`child_IDX`, `fName`, `lName`, `age`, `parent_idx`, `daykey`, `medical`, `parentinfo_parent_index1`) VALUES
(1, 'Timmy', 'Jones', 6, 1, 0, '', 1),
(10, 'Timmy', 'Jones', 6, 1, 10, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE IF NOT EXISTS `day` (
`daykey` int(11) NOT NULL,
  `month` varchar(12) NOT NULL,
  `day` int(11) NOT NULL,
  `childinfo_child_IDX` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`daykey`, `month`, `day`, `childinfo_child_IDX`) VALUES
(1, '05', 4, 10),
(10, '05', 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `medical`
--

CREATE TABLE IF NOT EXISTS `medical` (
  `child_IDX` int(11) NOT NULL,
  `allergies` varchar(45) NOT NULL,
  `vaccines` varchar(45) NOT NULL,
  `childinfo_child_IDX` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medical`
--

INSERT INTO `medical` (`child_IDX`, `allergies`, `vaccines`, `childinfo_child_IDX`) VALUES
(10, 'penecillin', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `parentinfo`
--

CREATE TABLE IF NOT EXISTS `parentinfo` (
`parent_index` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lName` varchar(30) NOT NULL,
  `phonenumber` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parentinfo`
--

INSERT INTO `parentinfo` (`parent_index`, `firstName`, `lName`, `phonenumber`) VALUES
(1, 'John', 'Jones', '4175551212');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `childinfo`
--
ALTER TABLE `childinfo`
 ADD PRIMARY KEY (`child_IDX`,`parentinfo_parent_index1`), ADD UNIQUE KEY `child_IDX_UNIQUE` (`child_IDX`), ADD KEY `fk_childinfo_parentinfo1_idx` (`parentinfo_parent_index1`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
 ADD PRIMARY KEY (`daykey`,`childinfo_child_IDX`), ADD KEY `fk_Day_childinfo1_idx` (`childinfo_child_IDX`);

--
-- Indexes for table `medical`
--
ALTER TABLE `medical`
 ADD PRIMARY KEY (`child_IDX`,`childinfo_child_IDX`), ADD KEY `fk_medical_childinfo1_idx` (`childinfo_child_IDX`);

--
-- Indexes for table `parentinfo`
--
ALTER TABLE `parentinfo`
 ADD PRIMARY KEY (`parent_index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `childinfo`
--
ALTER TABLE `childinfo`
MODIFY `child_IDX` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
MODIFY `daykey` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `parentinfo`
--
ALTER TABLE `parentinfo`
MODIFY `parent_index` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `childinfo`
--
ALTER TABLE `childinfo`
ADD CONSTRAINT `fk_childinfo_parentinfo1` FOREIGN KEY (`parentinfo_parent_index1`) REFERENCES `parentinfo` (`parent_index`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `day`
--
ALTER TABLE `day`
ADD CONSTRAINT `fk_Day_childinfo1` FOREIGN KEY (`childinfo_child_IDX`) REFERENCES `childinfo` (`child_IDX`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `medical`
--
ALTER TABLE `medical`
ADD CONSTRAINT `fk_medical_childinfo1` FOREIGN KEY (`childinfo_child_IDX`) REFERENCES `childinfo` (`child_IDX`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
