-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2023 at 10:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `n_menu` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stand` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `code`, `n_menu`, `harga`, `stand`) VALUES
(9, 'HEX3', 'Donat', 5000, '0'),
(10, 'FEG4', 'Ikan', 4500, 'A1');

-- --------------------------------------------------------

--
-- Table structure for table `stand`
--

CREATE TABLE `stand` (
  `id` int(11) NOT NULL,
  `nomor` varchar(11) NOT NULL,
  `Pemilik` text NOT NULL,
  `Kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stand`
--

INSERT INTO `stand` (`id`, `nomor`, `Pemilik`, `Kontak`) VALUES
(8, 'A1', 'Agus', '55678');

-- --------------------------------------------------------

--
-- Table structure for table `transasksi`
--

CREATE TABLE `transasksi` (
  `id` int(11) NOT NULL,
  `id_stand` varchar(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `np` int(11) NOT NULL,
  `n_menu` text NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transasksi`
--

INSERT INTO `transasksi` (`id`, `id_stand`, `id_user`, `total`, `np`, `n_menu`, `count`) VALUES
(17, 'A1', 2, 1455, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `nama` text NOT NULL,
  `Kontak` varchar(15) NOT NULL,
  `Kelas` varchar(11) DEFAULT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` enum('Kasir','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nomor`, `nama`, `Kontak`, `Kelas`, `username`, `password`, `role`) VALUES
(1, 1, 'Admin', '23098', '0', 'admin', 'admin', 'Admin'),
(2, 2, 'user', '0', '0', 'user', 'user', 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stand`
--
ALTER TABLE `stand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor` (`nomor`);

--
-- Indexes for table `transasksi`
--
ALTER TABLE `transasksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_stand` (`id_stand`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stand`
--
ALTER TABLE `stand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transasksi`
--
ALTER TABLE `transasksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
