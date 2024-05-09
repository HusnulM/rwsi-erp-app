-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 11:57 AM
-- Server version: 5.5.16
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aws-eproc`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_files`
--

CREATE TABLE `t_files` (
  `object` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refdoc` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` int(11) NOT NULL,
  `filename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filetype` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdby` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdon` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_files`
--

INSERT INTO `t_files` (`object`, `refdoc`, `item`, `filename`, `filetype`, `filepath`, `createdby`, `createdon`) VALUES
('PR', '1000000004', 1, 'IMG_0003.jpg', 'jpg', './images/prfiles/IMG_0003.jpg', 'sprod', '2020-11-23'),
('PR', '1000000004', 2, 'ux-infograpic.jpg', 'jpg', './images/prfiles/ux-infograpic.jpg', 'sprod', '2020-11-23'),
('PR', '1000000004', 3, 'ic_home.png', 'png', './images/prfiles/ic_home.png', 'sprod', '2020-11-23'),
('PR', '1000000004', 4, 'ic_home.png', 'png', './images/prfiles/ic_home.png', 'sprod', '2020-11-23'),
('PR', '1000000005', 1, 'ic_home.png', 'png', './images/prfiles/ic_home.png', 'sprod', '2020-11-23'),
('PR', '1000000006', 1, 'ic_home.png', 'png', './images/prfiles/ic_home.png', 'sprod', '2020-11-23'),
('PR', '1000000007', 1, 'home.PNG', 'PNG', './images/prfiles/home.PNG', 'sprod', '2020-11-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_files`
--
ALTER TABLE `t_files`
  ADD PRIMARY KEY (`object`,`refdoc`,`item`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
