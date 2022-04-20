-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2022 at 09:27 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `compiler`
--

-- --------------------------------------------------------

--
-- Table structure for table `addpractical`
--

DROP TABLE IF EXISTS `addpractical`;
CREATE TABLE IF NOT EXISTS `addpractical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aim` longtext NOT NULL,
  `test_case` varchar(50) NOT NULL,
  `sub_code` varchar(25) NOT NULL,
  `practical_name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addpractical`
--

INSERT INTO `addpractical` (`id`, `aim`, `test_case`, `sub_code`, `practical_name`) VALUES
(1, 'a', 'adsfs', '123', '1');

-- --------------------------------------------------------

--
-- Table structure for table `saveprogram`
--

DROP TABLE IF EXISTS `saveprogram`;
CREATE TABLE IF NOT EXISTS `saveprogram` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `file` longtext NOT NULL,
  `sub_code` varchar(50) NOT NULL,
  `student` varchar(50) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saveprogram`
--

INSERT INTO `saveprogram` (`pid`, `name`, `file`, `sub_code`, `student`) VALUES
(1, 'alskdhask', '#include <stdio.h>\nint main() {\n   // printf() displays the string inside quotation\n   printf(\"Hello, World!\");\n   return 0;\n}\n', '1', '19ce150@charusat.edu.in');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `stu_id`, `name`, `email`, `mobile`, `password`, `semester`) VALUES
(1, '19ce150', 'shital thakkar', '19ce150@charusat.edu.in', 2147483647, 'siya143', 6);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `sub_code` varchar(25) NOT NULL,
  `sub_name` varchar(25) NOT NULL,
  `fac_name` varchar(30) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`sub_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_code`, `sub_name`, `fac_name`, `semester`) VALUES
('123', 'abc', 'jaybapodra10@gmail.com', 6),
('234', 'abc', 'jaybapodra10@gmail.com', 6);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `mobile`, `password`) VALUES
(1, 'jay', 'jaybapodra10@gmail.com', 9773105503, 'jay123'),
(2, 'siya', 'siyathaccker143@gmail.com', 9824812056, 'siya143');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
