-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2025 at 06:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db6646_050`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_664230050`
--

CREATE TABLE `tb_664230050` (
  `key` int(5) NOT NULL COMMENT 'ลำดับ',
  `std_id` varchar(9) NOT NULL COMMENT 'รหัสนักศึกษา',
  `nickname` varchar(50) NOT NULL COMMENT 'ชื่อเล่น',
  `f_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `l_name` varchar(100) NOT NULL COMMENT 'สกุล',
  `mail` varchar(100) NOT NULL COMMENT 'อีเมล',
  `tel` varchar(20) NOT NULL COMMENT 'เบอร์โทร',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'เวลาสร้าง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_664230050`
--

INSERT INTO `tb_664230050` (`key`, `std_id`, `nickname`, `f_name`, `l_name`, `mail`, `tel`, `created_at`) VALUES
(1, '664230001', '', 'first', 'last', 'first@first.com', '1111111111', '2025-08-28 03:08:50'),
(2, '664230002', '', 'two', 'two', 'two@two.com', '2222222222', '2025-08-28 03:08:50'),
(3, '664230003', '', 'three', 'three', 'three@three.com', '333333333', '2025-08-28 03:08:50'),
(4, '664230050', '', 'ณภัทร', 'กรดสุวรรณ์', 'admin@admin.com', '1111111', '2025-08-28 03:41:46'),
(5, '664230051', '', 'ณภัทรรร', 'กรดสุวรรณ์ฟหกฟ', 'admin@admin.comasda', '111111111', '2025-08-28 03:56:43'),
(6, '66545', '', '456456', '456456', '456456@asdasd.com', '5656456', '2025-08-28 04:01:23'),
(7, '66545456', '', 'ณภัทรรรgf', 'fghfghfgh', 'fghfg@ASASDasd.com', '4649646456', '2025-08-28 04:12:01'),
(8, '665454564', '', '4564564554564', '645645656456', '456456456456@asdasd.comadasd', '4566456456', '2025-08-28 04:24:58'),
(9, '4545', '', '454545', '454545', '4545dsf@asdasd.com', '45645645645', '2025-08-28 04:28:43'),
(10, '664230050', '', 'ณภัทร44', 'กรดสุวรรณ์44', 'admin@admin.com44', '111111144', '2025-08-28 04:38:48'),
(11, '664230050', '', 'ณภัทร4414', 'กรดสุวรรณ์77878', 'admin@admin.com7878', '11111117878', '2025-08-28 04:40:04'),
(12, '456456456', '', '456456456', '45645645645', '2424@adasd.commmmmm', '6456456456', '2025-08-28 04:42:42'),
(13, '664230000', 'พีช', 'หกหกด', 'หกดหกด', 'member5@member5.com', '04444444', '2025-10-02 03:36:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_664230050`
--
ALTER TABLE `tb_664230050`
  ADD PRIMARY KEY (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_664230050`
--
ALTER TABLE `tb_664230050`
  MODIFY `key` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับ', AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
