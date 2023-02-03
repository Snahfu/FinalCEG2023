-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2023 at 01:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ceg_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `idalat` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `jenis_idjenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`idalat`, `nama`, `jenis_idjenis`) VALUES
(1, 'Washer', 1),
(2, 'Mesin Pemarut', 2),
(3, 'Hydraulic Press Machine', 3),
(4, 'H Frame', 3),
(5, 'Bingkai Roll', 3),
(6, 'Bench Frame', 3),
(7, 'Corong Pemisah', 4),
(8, 'Kolom Distilasi', 4),
(9, 'Kolom Ekstraktor', 4),
(10, 'Rotary Drum Filter', 4),
(11, 'Ribbon Blenders', 5),
(12, 'High Shear Mixers', 5),
(13, 'High Viscosity Batch Mixing', 5),
(14, 'Double Planetary Mixing', 5),
(15, 'Tray Dryer', 6),
(16, 'Spray Dryer', 6),
(17, 'Rotary Dryer', 6),
(18, 'Flash Dryer', 6),
(19, 'Fluidized Bed Dryer', 6),
(20, 'Pump', 7),
(21, 'Belt Conveyor', 7),
(22, 'Screw Conveyor', 7),
(23, 'Bucket Elevator', 7);

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `idbahan` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `downgrade`
--

CREATE TABLE `downgrade` (
  `iddowngrade` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `alat_idalat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downgrade`
--

INSERT INTO `downgrade` (`iddowngrade`, `nama`, `alat_idalat`) VALUES
(1, 'Mesin', 1),
(2, 'Water Pump', 1),
(3, 'Tub', 1),
(4, 'Motor', 2),
(5, 'Pisau', 2),
(6, 'Gear', 2),
(7, 'Pump', 3),
(8, 'Gauge', 3),
(9, 'Piston', 3),
(10, 'Cylinder', 4),
(11, 'Pump', 4),
(12, 'Frame', 4),
(13, 'Frame', 5),
(14, 'Gear', 5),
(15, 'Screw', 5),
(16, 'Frame', 6),
(17, 'Gear', 6),
(18, 'Screw', 6),
(19, 'Kaca', 7),
(20, 'Katup', 7),
(21, 'Kolom', 8),
(22, 'Kondensor', 8),
(23, 'Reboiler', 8),
(24, 'Klem', 9),
(25, 'Kondensor', 9),
(26, 'Selang', 9),
(27, 'Pump', 10),
(28, 'Pisau', 10),
(29, 'Drum', 10),
(30, 'Motor', 11),
(31, 'Gear', 11),
(32, 'Cover', 11),
(33, 'Motor', 12),
(34, 'Nozzle', 12),
(35, 'Gear', 12),
(36, 'Screw', 13),
(37, 'Stirrer', 13),
(38, 'Motor', 13),
(39, 'Bowl', 14),
(40, 'Beater', 14),
(41, 'Handle', 14),
(42, 'Tray', 15),
(43, 'Heater/Blower', 15),
(44, 'Controller', 15),
(45, 'Chamber', 16),
(46, 'Heater', 16),
(47, 'Pump', 16),
(48, 'Heater/Blower', 17),
(49, 'Gear', 17),
(50, 'Exhaust System', 17),
(51, 'Cutter', 18),
(52, 'Cylinder', 18),
(53, 'Tower Cap', 18),
(54, 'Blower', 19),
(55, 'Chamber', 19),
(56, 'Cyclone', 19),
(57, 'Cylinder', 20),
(58, 'Nozzle', 20),
(59, 'Impeller', 20),
(60, 'Roller', 21),
(61, 'Motor', 21),
(62, 'Skirtboard', 21),
(63, 'Screw', 22),
(64, 'Cover', 22),
(65, 'Motor', 22),
(66, 'Bucket', 23),
(67, 'Inlet', 23),
(68, 'Motor', 23);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `idhistory` int(11) NOT NULL,
  `keterangan` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `teams_idteams` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `idinventory` int(11) NOT NULL,
  `nama_barang` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `teams_idteams` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `idjenis` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`idjenis`, `nama`) VALUES
(1, 'Pencucian'),
(2, 'Pemarutan'),
(3, 'Pengepresan'),
(4, 'Pendiaman dan Pemisahan'),
(5, 'Pencampuran dan Pengadukan'),
(6, 'Pengeringan'),
(7, 'Pengangkut');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `idmarket` int(11) NOT NULL,
  `jenis_market` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `market_alat`
--

CREATE TABLE `market_alat` (
  `alat_idalat` int(11) NOT NULL,
  `market_idmarket` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `market_bahan`
--

CREATE TABLE `market_bahan` (
  `bahan_idbahan` int(11) NOT NULL,
  `market_idmarket` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `market_invoice`
--

CREATE TABLE `market_invoice` (
  `teams_idteams` int(11) NOT NULL,
  `market_idmarket` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `idteams` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `koin` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inventory_idinventory` int(11) NOT NULL,
  `teams_idteams` int(11) DEFAULT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`idalat`),
  ADD KEY `fk_alat_jenis1_idx` (`jenis_idjenis`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`idbahan`);

--
-- Indexes for table `downgrade`
--
ALTER TABLE `downgrade`
  ADD PRIMARY KEY (`iddowngrade`),
  ADD KEY `fk_downgrade_alat_idx` (`alat_idalat`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`idhistory`),
  ADD KEY `fk_history_teams1_idx` (`teams_idteams`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`idinventory`),
  ADD KEY `fk_inventory_teams1_idx` (`teams_idteams`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`idjenis`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`idmarket`);

--
-- Indexes for table `market_alat`
--
ALTER TABLE `market_alat`
  ADD PRIMARY KEY (`alat_idalat`,`market_idmarket`),
  ADD KEY `fk_alat_has_market_market1_idx` (`market_idmarket`),
  ADD KEY `fk_alat_has_market_alat1_idx` (`alat_idalat`);

--
-- Indexes for table `market_bahan`
--
ALTER TABLE `market_bahan`
  ADD PRIMARY KEY (`bahan_idbahan`,`market_idmarket`),
  ADD KEY `fk_bahan_has_market_market1_idx` (`market_idmarket`),
  ADD KEY `fk_bahan_has_market_bahan1_idx` (`bahan_idbahan`);

--
-- Indexes for table `market_invoice`
--
ALTER TABLE `market_invoice`
  ADD PRIMARY KEY (`teams_idteams`,`market_idmarket`),
  ADD KEY `fk_teams_has_market_market1_idx` (`market_idmarket`),
  ADD KEY `fk_teams_has_market_teams1_idx` (`teams_idteams`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`idteams`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_users_teams1_idx` (`teams_idteams`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `idalat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `idbahan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downgrade`
--
ALTER TABLE `downgrade`
  MODIFY `iddowngrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `idhistory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `idinventory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `idjenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `idmarket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `idteams` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `fk_alat_jenis1` FOREIGN KEY (`jenis_idjenis`) REFERENCES `jenis` (`idjenis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `downgrade`
--
ALTER TABLE `downgrade`
  ADD CONSTRAINT `fk_downgrade_alat` FOREIGN KEY (`alat_idalat`) REFERENCES `alat` (`idalat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fk_inventory_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `market_alat`
--
ALTER TABLE `market_alat`
  ADD CONSTRAINT `fk_alat_has_market_alat1` FOREIGN KEY (`alat_idalat`) REFERENCES `alat` (`idalat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alat_has_market_market1` FOREIGN KEY (`market_idmarket`) REFERENCES `market` (`idmarket`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `market_bahan`
--
ALTER TABLE `market_bahan`
  ADD CONSTRAINT `fk_bahan_has_market_bahan1` FOREIGN KEY (`bahan_idbahan`) REFERENCES `bahan` (`idbahan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bahan_has_market_market1` FOREIGN KEY (`market_idmarket`) REFERENCES `market` (`idmarket`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `market_invoice`
--
ALTER TABLE `market_invoice`
  ADD CONSTRAINT `fk_teams_has_market_market1` FOREIGN KEY (`market_idmarket`) REFERENCES `market` (`idmarket`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teams_has_market_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
