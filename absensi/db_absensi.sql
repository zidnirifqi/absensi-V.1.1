-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 12:00 PM
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
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `jenis_absen` enum('Masuk','Keluar') NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `tanggal`, `waktu`, `jenis_absen`, `nis`, `nama`) VALUES
(12, '2025-07-19', '06:00:07', 'Masuk', '24010939', 'zidni'),
(13, '2025-07-19', '06:01:02', 'Keluar', '24010939', 'zidni'),
(21, '2025-07-21', '11:12:59', 'Masuk', '23240183', 'SITI KINASIH'),
(22, '2025-07-21', '13:07:08', 'Masuk', '0064044141', 'SHAFA AIDILA N.B'),
(23, '2025-07-21', '13:07:56', 'Masuk', '23240184', 'NUR MAYIDA'),
(24, '2025-07-21', '13:08:10', 'Masuk', '23240218', 'SISKA KARNIA PUTRI'),
(25, '2025-07-21', '13:08:25', 'Masuk', '23240185', 'SUSAN MARTIANI.M'),
(26, '2025-07-21', '13:08:39', 'Masuk', '0061476499', 'SESIL LIA RAMADHANI'),
(27, '2025-07-21', '15:02:07', 'Keluar', '23240183', 'SITI KINASIH'),
(28, '2025-07-21', '15:02:25', 'Keluar', '23240218', 'SISKA KARNIA PUTRI'),
(29, '2025-07-21', '15:04:57', 'Keluar', '0061476499', 'SESIL LIA RAMADHANI'),
(30, '2025-07-21', '15:05:27', 'Keluar', '0064044141', 'SHAFA AIDILA N.B'),
(31, '2025-07-21', '15:06:44', 'Keluar', '23240184', 'NUR MAYIDA'),
(32, '2025-07-21', '15:07:15', 'Keluar', '23240185', 'SUSAN MARTIANI.M'),
(33, '2025-07-23', '08:56:46', 'Masuk', '23240218', 'SISKA KARNIA PUTRI'),
(34, '2025-07-23', '08:59:35', 'Masuk', '23240184', 'NUR MAYIDA'),
(35, '2025-07-23', '08:59:55', 'Masuk', '23240185', 'SUSAN MARTIANI.M'),
(36, '2025-07-23', '09:00:22', 'Masuk', '0061476499', 'SESIL LIA RAMADHANI'),
(37, '2025-07-23', '09:00:42', 'Masuk', '0064044141', 'SHAFA AIDILA N.B'),
(38, '2025-07-23', '15:10:51', 'Keluar', '23240218', 'SISKA KARNIA PUTRI'),
(39, '2025-07-23', '15:11:00', 'Keluar', '23240185', 'SUSAN MARTIANI.M'),
(40, '2025-07-23', '15:11:11', 'Keluar', '23240184', 'NUR MAYIDA'),
(41, '2025-07-23', '15:11:28', 'Keluar', '0064044141', 'SHAFA AIDILA N.B'),
(42, '2025-07-23', '15:11:36', 'Keluar', '0061476499', 'SESIL LIA RAMADHANI'),
(43, '2025-07-24', '07:38:22', 'Masuk', '23240218', 'SISKA KARNIA PUTRI'),
(44, '2025-07-24', '07:38:29', 'Masuk', '23240185', 'SUSAN MARTIANI.M'),
(45, '2025-07-24', '07:38:42', 'Masuk', '23240184', 'NUR MAYIDA'),
(46, '2025-07-24', '07:38:50', 'Masuk', '23240183', 'SITI KINASIH'),
(47, '2025-07-24', '07:57:11', 'Masuk', '0061476499', 'SESIL LIA RAMADHANI'),
(48, '2025-07-24', '07:57:17', 'Masuk', '0064044141', 'SHAFA AIDILA N.B'),
(49, '2025-07-25', '07:41:45', 'Masuk', '23240218', 'SISKA KARNIA PUTRI'),
(50, '2025-07-25', '07:42:37', 'Masuk', '23240184', 'NUR MAYIDA'),
(51, '2025-07-25', '07:43:05', 'Masuk', '23240185', 'SUSAN MARTIANI.M'),
(52, '2025-07-25', '07:43:48', 'Masuk', '23240183', 'SITI KINASIH'),
(53, '2025-07-25', '07:51:23', 'Masuk', '0061476499', 'SESIL LIA RAMADHANI'),
(54, '2025-07-25', '07:52:48', 'Masuk', '0064044141', 'SHAFA AIDILA N.B'),
(55, '2025-07-25', '15:09:22', 'Keluar', '0064044141', 'SHAFA AIDILA N.B'),
(56, '2025-07-25', '15:23:36', 'Keluar', '23240184', 'NUR MAYIDA'),
(57, '2025-07-25', '15:24:04', 'Keluar', '23240218', 'SISKA KARNIA PUTRI'),
(58, '2025-07-25', '15:24:34', 'Keluar', '23240183', 'SITI KINASIH'),
(59, '2025-07-25', '15:25:02', 'Keluar', '23240185', 'SUSAN MARTIANI.M');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`) VALUES
('0061476499', 'SESIL LIA RAMADHANI'),
('0064044141', 'SHAFA AIDILA N.B'),
('23240183', 'SITI KINASIH'),
('23240184', 'NUR MAYIDA'),
('23240185', 'SUSAN MARTIANI.M'),
('23240218', 'SISKA KARNIA PUTRI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
