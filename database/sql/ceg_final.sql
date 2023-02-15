-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 09:30 AM
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
  `nama_alat` varchar(45) NOT NULL,
  `downgrade` varchar(45) NOT NULL,
  `jenis_idjenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`idalat`, `nama_alat`, `downgrade`, `jenis_idjenis`) VALUES
(1, 'Washer', 'Motor;Pipe;Tub', 1),
(2, 'Grater', 'Motor;Pisau;Gear', 2),
(3, 'Coconut Hydraulic Press Machine', 'Pump;Gauge;Piston', 3),
(4, 'H Frame', 'Cylinder;Pipe;Frame', 3),
(5, 'Bingkai Roll', 'Frame;Gear;Screw', 3),
(6, 'Bench Frame', 'Frame;Gear;Screw', 3),
(7, 'Corong Pemisah', 'Kaca;Katup', 4),
(8, 'Kolom Distilasi', 'Kolom;Kondensor;Reboiler', 4),
(9, 'Kolom Ekstraktor', 'Klem;Kondensor;Selang', 4),
(10, 'Rotary Drum Filter', 'Pump;Pisau;Drum', 4),
(11, 'Ribbon Blenders', 'Motor;Gear;Cover', 5),
(12, 'High Shear Mixers', 'Motor;Nozzle;Gear', 5),
(13, 'High Viscosity Batch Mixing', 'Screw;Stirrer;Motor', 5),
(14, 'Double Planetary Mixing', 'Bowl;Beater;Handle', 5),
(15, 'Tray Dryer', 'Tray Plate;Heater;Roller', 6),
(16, 'Tray Dryer', 'Tray Plate;Blower;Roller', 6),
(24, 'Spray Dryer', 'Chamber;Heater;Pump', 6),
(25, 'Rotary Dryer', 'Heater;Gear;Exhaust System', 6),
(26, 'Rotary Dryer', 'Blower;Gear;Exhaust System', 6),
(27, 'Flash Dryer', 'Pisau;Cyllinder;Tower Cap', 6),
(28, 'Fluidized Bed Dryer', 'Blower;Chamber;Cyclone', 6),
(29, 'Pump', 'Cylinder;Nozzle;Impeller', 7),
(30, 'Belt Conveyor', 'Roller;Motor;Skirtboard', 7),
(31, 'Screw Conveyor', 'Screw;Cover;Motor', 7),
(32, 'Bucket Elevator', 'Bucket;Inlet;Motor', 7);

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `idbahan` int(11) NOT NULL,
  `nama_bahan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `stock_barang` int(11) NOT NULL,
  `teams_idteams` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`idinventory`, `nama_barang`, `stock_barang`, `teams_idteams`) VALUES
(1, 'Washer', 3, 1),
(2, 'Corong Pemisah', 10, 1),
(3, 'Screw Conveyor', 5, 1),
(4, 'Double Planetary Mixing', 7, 1),
(5, 'Motor', 1, 1),
(6, 'Pipe', 1, 1),
(7, 'Tub', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenisalat`
--

CREATE TABLE `jenisalat` (
  `idjenis` int(11) NOT NULL,
  `nama_jenis` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenisalat`
--

INSERT INTO `jenisalat` (`idjenis`, `nama_jenis`) VALUES
(1, 'Pencucian'),
(2, 'Pemarutan'),
(3, 'Pengepresan'),
(4, 'Pendiaman dan Pemisahan'),
(5, 'Pencampuran dan Pengadukan'),
(6, 'Pengeringan'),
(7, 'Pengangkut');

-- --------------------------------------------------------

--
-- Table structure for table `market_bahan`
--

CREATE TABLE `market_bahan` (
  `idmarket_bahan` int(11) NOT NULL,
  `bahan` varchar(45) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `harga beli` int(11) NOT NULL DEFAULT 0,
  `harga jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `market_bahan_has_teams`
--

CREATE TABLE `market_bahan_has_teams` (
  `market_bahan_idmarket_bahan` int(11) NOT NULL,
  `teams_idteams` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `market_downgrade`
--

CREATE TABLE `market_downgrade` (
  `idmarket_downgrade` int(11) NOT NULL,
  `downgrade` varchar(45) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `harga beli` int(11) NOT NULL DEFAULT 0,
  `harga jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `market_downgrade_has_teams`
--

CREATE TABLE `market_downgrade_has_teams` (
  `market_downgrade_idmarket_downgrade` int(11) NOT NULL,
  `teams_idteams` int(11) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `idteams` int(11) NOT NULL,
  `namaTeam` varchar(45) NOT NULL,
  `koin` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`idteams`, `namaTeam`, `koin`) VALUES
(1, 'team 1', '10000'),
(2, 'team 2', '5000'),
(3, 'team 3', '700');

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
  `teams_idteams` int(11) DEFAULT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `teams_idteams`, `role`) VALUES
(1, 'Player 1', 'player1@gmail.com', NULL, '$2y$10$jr.nKsakwUXKq9b/cOgmwu0JcsMusXxEqSeYbdk0D.wzsCA2xa.k.', NULL, '2023-02-11 20:57:07', '2023-02-11 20:57:07', 1, 'Player'),
(2, 'Player 2', 'player2@gmail.com', NULL, '$2y$10$DRPLFt2dP97FyigNeUegLe4t95aguEideCnZBcvApy3pjVtiA3RBa', NULL, '2023-02-12 02:09:22', '2023-02-12 02:09:22', 2, 'Player'),
(3, 'Player 3', 'player3@gmail.com', NULL, '$2y$10$ezOLJR7T6DY21UIbFEb67etw6u7l8adRlmzZZmsVdoVizJ6FYfX5G', NULL, '2023-02-12 02:09:40', '2023-02-12 02:09:40', 3, 'Player'),
(4, 'AdminD1', 'admind1@gmail.com', NULL, '$2y$10$NowElmKAydLPPqeYAmc2c.Oin6Uip6WRojuUTtA2q5Dzam5kac0mG', NULL, '2023-02-12 02:10:24', '2023-02-12 02:10:24', NULL, 'AdminDowngrade'),
(5, 'AdminD2', 'admind2@gmail.com', NULL, '$2y$10$4349QuFRmP8/808Qm2GZFet1yA3EiaeevoPrTsyCr7Dzy6V5vr552', NULL, '2023-02-12 02:10:53', '2023-02-12 02:10:53', NULL, 'AdminDowngrade'),
(6, 'AdminB1', 'adminb1@gmail.com', NULL, '$2y$10$uX1GSspEx5rVhnLp1gtn.umv11dPHx7VLdRtV0mzygVqletfGaP0O', NULL, '2023-02-12 02:11:11', '2023-02-12 02:11:11', NULL, 'AdminBahan'),
(7, 'AdminB2', 'adminb2@gmail.com', NULL, '$2y$10$WxqDBsKgPBLhi1hQIRoPdOQ27nbqEb4CzGuwW/lM6sS5KpNgA89wa', NULL, '2023-02-12 02:11:36', '2023-02-12 02:11:36', NULL, 'AdminBahan'),
(8, 'Tinkerer 1', 'tinkerer1@gmail.com', NULL, '$2y$10$Dl/Qomv1sWSdc3YuMBUHreY1VoHlGVFta202iJOrOkynXX0GRpWt6', NULL, '2023-02-12 02:12:24', '2023-02-12 02:12:24', NULL, 'Tinkerer'),
(9, 'Tinkerer 2', 'tinkerer2@gmail.com', NULL, '$2y$10$LXzTLCMXoz2hbxgg6iLLV.lxXxYe82azqaVU5P8L39NFetvGaWkWi', NULL, '2023-02-12 02:12:43', '2023-02-12 02:12:43', NULL, 'Tinkerer');

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
-- Indexes for table `jenisalat`
--
ALTER TABLE `jenisalat`
  ADD PRIMARY KEY (`idjenis`);

--
-- Indexes for table `market_bahan`
--
ALTER TABLE `market_bahan`
  ADD PRIMARY KEY (`idmarket_bahan`);

--
-- Indexes for table `market_bahan_has_teams`
--
ALTER TABLE `market_bahan_has_teams`
  ADD PRIMARY KEY (`market_bahan_idmarket_bahan`,`teams_idteams`),
  ADD KEY `fk_market_bahan_has_teams_teams1_idx` (`teams_idteams`),
  ADD KEY `fk_market_bahan_has_teams_market_bahan1_idx` (`market_bahan_idmarket_bahan`);

--
-- Indexes for table `market_downgrade`
--
ALTER TABLE `market_downgrade`
  ADD PRIMARY KEY (`idmarket_downgrade`);

--
-- Indexes for table `market_downgrade_has_teams`
--
ALTER TABLE `market_downgrade_has_teams`
  ADD PRIMARY KEY (`market_downgrade_idmarket_downgrade`,`teams_idteams`),
  ADD KEY `fk_market_downgrade_has_teams_teams1_idx` (`teams_idteams`),
  ADD KEY `fk_market_downgrade_has_teams_market_downgrade1_idx` (`market_downgrade_idmarket_downgrade`);

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
  MODIFY `idalat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `idbahan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `idhistory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `idinventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenisalat`
--
ALTER TABLE `jenisalat`
  MODIFY `idjenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `market_bahan`
--
ALTER TABLE `market_bahan`
  MODIFY `idmarket_bahan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `market_downgrade`
--
ALTER TABLE `market_downgrade`
  MODIFY `idmarket_downgrade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `idteams` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `fk_alat_jenis1` FOREIGN KEY (`jenis_idjenis`) REFERENCES `jenisalat` (`idjenis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `market_bahan_has_teams`
--
ALTER TABLE `market_bahan_has_teams`
  ADD CONSTRAINT `fk_market_bahan_has_teams_market_bahan1` FOREIGN KEY (`market_bahan_idmarket_bahan`) REFERENCES `market_bahan` (`idmarket_bahan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_market_bahan_has_teams_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `market_downgrade_has_teams`
--
ALTER TABLE `market_downgrade_has_teams`
  ADD CONSTRAINT `fk_market_downgrade_has_teams_market_downgrade1` FOREIGN KEY (`market_downgrade_idmarket_downgrade`) REFERENCES `market_downgrade` (`idmarket_downgrade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_market_downgrade_has_teams_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
