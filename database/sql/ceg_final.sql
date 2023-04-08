-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 04:13 AM
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
(3, 'Cutter', 'Pisau;Motor;Skirtboard', 2),
(4, 'Ball Mill', 'Gauge;Cylinder;Gear', 2),
(5, 'Roll Crusher', 'Frame;Gear;Culinder', 2),
(6, 'Cone Crusher', 'Screw;Frame;Motor', 2),
(7, 'Coconut Hydraulic Press Machine', 'Pipe;Gauge;Piston', 3),
(8, 'Bingkai Roll', 'Cylinder;Pipe;Frame', 3),
(9, 'Screw Press', 'Screw;Gear;Motor', 3),
(10, 'Bench Frame', 'Frame;Gear;Screw', 3),
(11, 'Corong Pemisah', 'Kaca;Katup', 4),
(12, 'Kolom Distilasi', 'Kolom;Kondensor;Reboiler', 4),
(13, 'Kolom Ekstraktor', 'Klem;Kondensor;Selang', 4),
(14, 'Rotary Drum Filter', 'Pipe;Pisau;Drum', 4),
(15, 'Ribbon Blenders', 'Motor;Gear;Cover', 5),
(16, 'Mixer', 'Motor;Nozzle;Gear', 5),
(17, 'High Viscosity Batch Mixing', 'Screw;Stirrer;Motor', 5),
(18, 'Double Planetary Mixing', 'Bowl;Beater;Handle', 5),
(19, 'Tray Dryer', 'Tray Plate;Heater;Roller', 6),
(20, 'Spray Dryer', 'Chamber;Heater;Pipe', 6),
(21, 'Rotary Dryer', 'Heater;Gear;Exhaust System', 6),
(22, 'Flash Dryer', 'Pisau;Cyllinder;Tower Cap', 6),
(23, 'Fluidized Bed Dryer', 'Blower;Chamber;Cyclone', 6),
(24, 'Pump', 'Cylinder;Nozzle;Impeller', 7),
(25, 'Belt Conveyor', 'Roller;Motor;Skirtboard', 7),
(26, 'Screw Conveyor', 'Screw;Cover;Motor', 7),
(27, 'Bucket Elevator', 'Bucket;Inlet;Motor', 7),
(28, 'Silo', 'Cylinder;Pipe;Cover', 8),
(29, 'Drum Storage', 'Handle;Cover;Cylinder', 8),
(30, 'Tank Storage', 'Cover;Pipe;Gauge', 8),
(31, 'Hopper', 'Blower;Cover;Cylinder', 8),
(32, 'Intermediate Bulk Container (IBC)', 'Katup;Cover;Frame', 8),
(33, 'Packager', 'Roller;Pisau;Skirtboard', 9);

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `idbahan` int(11) NOT NULL,
  `nama_bahan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`idbahan`, `nama_bahan`) VALUES
(1, 'Daging Kelapa'),
(2, 'Air'),
(3, 'Natrium Kaseinat'),
(4, 'Maltodekstrin');

-- --------------------------------------------------------

--
-- Table structure for table `done_playing`
--

CREATE TABLE `done_playing` (
  `iddone_playing` int(11) NOT NULL,
  `pos` varchar(45) NOT NULL,
  `teams_idteams` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hints`
--

CREATE TABLE `hints` (
  `idhints` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `url_hint` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hints`
--

INSERT INTO `hints` (`idhints`, `name`, `url_hint`) VALUES
(1, 'Clue 1', 'https://i.ibb.co/47LVs1c/Clue-1.jpg'),
(2, 'Clue 2', 'https://i.ibb.co/vYpp7Nj/Clue-2.jpg'),
(3, 'Clue 3', 'https://i.ibb.co/gWFqTB5/Clue-3.jpg'),
(4, 'Clue 4', 'https://i.ibb.co/xgjzYgK/Clue-4.jpg'),
(5, 'Clue 5', 'https://i.ibb.co/f98pcjp/Clue-5.jpg'),
(6, 'Clue 6', 'https://i.ibb.co/68DvGLz/Clue-6.jpg'),
(7, 'Clue 7', 'https://i.ibb.co/PjMsSr2/Clue-7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `idhistory` int(11) NOT NULL,
  `keterangan` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipe` varchar(45) NOT NULL,
  `teams_idteams` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_hints`
--

CREATE TABLE `history_hints` (
  `teams_idteams` int(11) NOT NULL,
  `hints_idhints` int(11) NOT NULL,
  `keterangan` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_koins`
--

CREATE TABLE `history_koins` (
  `idhistory_koins` int(11) NOT NULL,
  `keterangan` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jenis_pos` varchar(45) NOT NULL,
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
(1, 'Maltodekstrin', 1, 1),
(2, 'Maltodekstrin', 1, 2),
(3, 'Maltodekstrin', 1, 3),
(4, 'Maltodekstrin', 1, 4),
(5, 'Maltodekstrin', 1, 5),
(6, 'Maltodekstrin', 1, 6),
(7, 'Maltodekstrin', 1, 7),
(8, 'Maltodekstrin', 1, 8),
(9, 'Maltodekstrin', 1, 9),
(10, 'Maltodekstrin', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_alat`
--

CREATE TABLE `jenis_alat` (
  `idjenis` int(11) NOT NULL,
  `nama_jenis` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_alat`
--

INSERT INTO `jenis_alat` (`idjenis`, `nama_jenis`) VALUES
(1, 'Pencucian'),
(2, 'Pengecil Ukuran'),
(3, 'Pengepresan'),
(4, 'Pendiaman dan Pemisahan'),
(5, 'Pencampuran dan Pengadukan'),
(6, 'Pengeringan'),
(7, 'Pengangkut'),
(8, 'Alat Penyimpanan'),
(9, 'Pengemas');

-- --------------------------------------------------------

--
-- Table structure for table `market_bahan`
--

CREATE TABLE `market_bahan` (
  `idmarket_bahan` int(11) NOT NULL,
  `bahan` varchar(45) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `harga_beli` int(11) NOT NULL DEFAULT 0,
  `harga_jual` int(11) NOT NULL,
  `sesi` int(11) NOT NULL,
  `tipe` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `market_bahan`
--

INSERT INTO `market_bahan` (`idmarket_bahan`, `bahan`, `stok`, `harga_beli`, `harga_jual`, `sesi`, `tipe`) VALUES
(1, 'Daging Kelapa', 100, 50, 40, 1, 'biasa'),
(2, 'Air', 100, 30, 20, 1, 'biasa'),
(3, 'Natrium Kaseinat ', 100, 75, 60, 1, 'biasa'),
(4, 'Daging Kelapa', 1, 35, 0, 1, 'flash sale 1'),
(5, 'Natrium Kaseinat', 1, 60, 0, 1, 'flash sale 1'),
(6, 'Daging Kelapa', 1, 35, 0, 1, 'flash sale 2'),
(7, 'Natrium Kaseinat', 1, 60, 0, 1, 'flash sale 2'),
(8, 'Daging Kelapa', 1, 35, 0, 1, 'flash sale 3'),
(9, 'Natrium Kaseinat', 1, 60, 0, 1, 'flash sale 3');

-- --------------------------------------------------------

--
-- Table structure for table `market_bahan_invoice`
--

CREATE TABLE `market_bahan_invoice` (
  `market_bahan_idmarket_bahan` int(11) NOT NULL,
  `teams_idteams` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `market_downgrade`
--

CREATE TABLE `market_downgrade` (
  `idmarket_downgrade` int(11) NOT NULL,
  `downgrade` varchar(45) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `harga_beli` int(11) NOT NULL DEFAULT 0,
  `harga_jual` int(11) NOT NULL,
  `tipe` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `market_downgrade`
--

INSERT INTO `market_downgrade` (`idmarket_downgrade`, `downgrade`, `stok`, `harga_beli`, `harga_jual`, `tipe`) VALUES
(1, 'Motor', 100, 100, 85, 'biasa'),
(2, 'Pipe', 100, 50, 40, 'biasa'),
(3, 'Tub', 100, 35, 30, 'biasa'),
(4, 'Pisau', 100, 75, 60, 'biasa'),
(5, 'Gear', 100, 45, 35, 'biasa'),
(6, 'Gauge', 100, 65, 55, 'biasa'),
(7, 'Piston', 100, 70, 60, 'biasa'),
(8, 'Cylinder', 100, 60, 50, 'biasa'),
(9, 'Frame', 100, 55, 45, 'biasa'),
(10, 'Screw', 100, 75, 60, 'biasa'),
(11, 'Kaca', 100, 55, 45, 'biasa'),
(12, 'Katup', 100, 30, 25, 'biasa'),
(13, 'Kolom', 100, 40, 30, 'biasa'),
(14, 'Kondensor', 100, 50, 40, 'biasa'),
(15, 'Reboiler', 100, 80, 65, 'biasa'),
(16, 'Klem', 100, 60, 50, 'biasa'),
(17, 'Selang', 100, 35, 30, 'biasa'),
(18, 'Drum', 100, 65, 55, 'biasa'),
(19, 'Cover', 100, 25, 20, 'biasa'),
(20, 'Nozzle', 100, 40, 35, 'biasa'),
(21, 'Stirrer', 100, 40, 35, 'biasa'),
(22, 'Bowl', 100, 25, 20, 'biasa'),
(23, 'Beater', 100, 30, 25, 'biasa'),
(24, 'Handle', 100, 45, 35, 'biasa'),
(25, 'Tray Plate', 100, 55, 45, 'biasa'),
(26, 'Heater', 100, 65, 55, 'biasa'),
(27, 'Roller', 100, 50, 40, 'biasa'),
(28, 'Chamber', 100, 85, 70, 'biasa'),
(29, 'Exhaust System', 100, 50, 40, 'biasa'),
(30, 'Tower Cap', 100, 35, 30, 'biasa'),
(31, 'Blower', 100, 65, 55, 'biasa'),
(32, 'Cyclone', 100, 25, 20, 'biasa'),
(33, 'Impeller', 100, 35, 30, 'biasa'),
(34, 'Skirtboard', 100, 25, 20, 'biasa'),
(35, 'Bucket', 100, 35, 30, 'biasa'),
(36, 'Inlet', 100, 30, 25, 'biasa'),
(37, 'Board', 100, 30, 25, 'biasa'),
(38, 'Hinge', 100, 60, 50, 'biasa'),
(39, 'Cooler', 100, 90, 75, 'biasa'),
(40, 'Termometer', 100, 85, 70, 'biasa'),
(41, 'Vent', 100, 95, 80, 'biasa'),
(42, 'Motor', 1, 80, 0, 'flash sale 1'),
(43, 'Pisau', 1, 55, 0, 'flash sale 1'),
(44, 'Gauge', 1, 45, 0, 'flash sale 1'),
(45, 'Piston', 1, 50, 0, 'flash sale 1'),
(46, 'Cylinder', 1, 40, 0, 'flash sale 1'),
(47, 'Frame', 1, 35, 0, 'flash sale 1'),
(48, 'Screw', 1, 55, 0, 'flash sale 1'),
(49, 'Kaca', 1, 35, 0, 'flash sale 1'),
(50, 'Reboiler', 1, 60, 0, 'flash sale 1'),
(51, 'Klem', 1, 40, 0, 'flash sale 1'),
(52, 'Drum', 1, 45, 0, 'flash sale 1'),
(53, 'Tray Plate', 1, 35, 0, 'flash sale 1'),
(54, 'Heater', 1, 45, 0, 'flash sale 1'),
(55, 'Chamber', 1, 65, 0, 'flash sale 1'),
(56, 'Blower', 1, 45, 0, 'flash sale 1'),
(57, 'Motor', 1, 80, 0, 'flash sale 2'),
(58, 'Pisau', 1, 55, 0, 'flash sale 2'),
(59, 'Gauge', 1, 45, 0, 'flash sale 2'),
(60, 'Piston', 1, 50, 0, 'flash sale 2'),
(61, 'Cylinder', 1, 40, 0, 'flash sale 2'),
(62, 'Frame', 1, 35, 0, 'flash sale 2'),
(63, 'Screw', 1, 55, 0, 'flash sale 2'),
(64, 'Kaca', 1, 35, 0, 'flash sale 2'),
(65, 'Reboiler', 1, 60, 0, 'flash sale 2'),
(66, 'Klem', 1, 40, 0, 'flash sale 2'),
(67, 'Drum', 1, 45, 0, 'flash sale 2'),
(68, 'Tray Plate', 1, 35, 0, 'flash sale 2'),
(69, 'Heater', 1, 45, 0, 'flash sale 2'),
(70, 'Chamber', 1, 65, 0, 'flash sale 2'),
(71, 'Blower', 1, 45, 0, 'flash sale 2'),
(72, 'Motor', 1, 80, 0, 'flash sale 3'),
(73, 'Pisau', 1, 55, 0, 'flash sale 3'),
(74, 'Gauge', 1, 45, 0, 'flash sale 3'),
(75, 'Piston', 1, 50, 0, 'flash sale 3'),
(76, 'Cylinder', 1, 40, 0, 'flash sale 3'),
(77, 'Frame', 1, 35, 0, 'flash sale 3'),
(78, 'Screw', 1, 55, 0, 'flash sale 3'),
(79, 'Kaca', 1, 35, 0, 'flash sale 3'),
(80, 'Reboiler', 1, 60, 0, 'flash sale 3'),
(81, 'Klem', 1, 40, 0, 'flash sale 3'),
(82, 'Drum', 1, 45, 0, 'flash sale 3'),
(83, 'Tray Plate', 1, 35, 0, 'flash sale 3'),
(84, 'Heater', 1, 45, 0, 'flash sale 3'),
(85, 'Chamber', 1, 65, 0, 'flash sale 3'),
(86, 'Blower', 1, 45, 0, 'flash sale 3');

-- --------------------------------------------------------

--
-- Table structure for table `market_downgrade_invoice`
--

CREATE TABLE `market_downgrade_invoice` (
  `market_downgrade_idmarket_downgrade` int(11) NOT NULL,
  `teams_idteams` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
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
-- Table structure for table `sesi`
--

CREATE TABLE `sesi` (
  `idsesi` int(11) NOT NULL,
  `sesi` int(11) NOT NULL,
  `tipe` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sesi`
--

INSERT INTO `sesi` (`idsesi`, `sesi`, `tipe`) VALUES
(1, 1, 'biasa');

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
(1, 'User 1', '1500'),
(2, 'User 2', '1500'),
(3, 'User 3', '1500'),
(4, 'User 4', '1500'),
(5, 'User 5', '1500'),
(6, 'User 6', '1500'),
(7, 'User 7', '1500'),
(8, 'User 8', '1500'),
(9, 'User 9', '1500'),
(10, 'User 10', '1500'),
(11, 'User 23', '1000000'),
(12, 'User 42', '1000000');

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
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `teams_idteams` int(11) DEFAULT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `teams_idteams`, `role`) VALUES
(1, 'Pos Pengeringan', 'pengeringan@gmail.com', NULL, '$2y$10$toqTDMW.KB0ZUx4FPfDCS./HT1stMMSqwfz5h/OaGEEE4lU/xTo4y', NULL, '2023-04-01 13:15:14', '2023-04-01 06:07:17', NULL, 'Tool'),
(2, 'Pos Pencampuran', 'pencampuran@gmail.com', NULL, '$2y$10$xV4Rbr21virxyMNm8pcZSeFiFvdCavMdRq/.t/LYlB1L4BYkvoP1G', NULL, '2023-04-01 13:17:59', '2023-04-01 06:08:38', NULL, 'Tool'),
(3, 'Pos Pengangkut', 'pengangkut@gmail.com', NULL, '$2y$10$RacHghos/I9Pcauqh.O2A.QKLwz61m1lzb7/OxMmT.zVb.dYoHEFu', NULL, '2023-04-01 13:17:59', '2023-04-01 06:11:25', NULL, 'Tool'),
(4, 'Pos Pengecil Ukuran', 'pengecilUkuran@gmail.com', NULL, '$2y$10$iT1xcMcwn9UI8ro6b/TwYe6noIicNuN1pTC9QefVAvM2VH3de0xdW', NULL, '2023-04-01 13:17:59', '2023-04-01 06:11:56', NULL, 'Tool'),
(5, 'Pos Pengepresan', 'pengepresan@gmail.com', NULL, '$2y$10$FZiF6Siwz3kQE4cWbP8JduWklFilFFk5t7MXhdLnKsNSXrF0IuxbS', NULL, '2023-04-01 13:17:59', '2023-04-01 06:12:28', NULL, 'Tool'),
(6, 'Pos Penyimpanan', 'penyimpanan@gmail.com', NULL, '$2y$10$6koZdT8lqF0Uv3y.Huset.HC.YC55oh6rWu9P2Z4Wfed6Ju8C/oAi', NULL, '2023-04-01 13:17:59', '2023-04-01 06:13:11', NULL, 'Tool'),
(7, 'Pos Air', 'posair@gmail.com', NULL, '$2y$10$cBoTrecBcIBFCcnkEGnZx.MNzNqpBHIlgGSx39vai6O84.OhVbMaC', NULL, '2023-04-01 13:19:29', '2023-04-01 06:16:13', NULL, 'Ingredient'),
(8, 'Pos Daging Kelapa', 'posdagingkelapa@gmail.com', NULL, '$2y$10$PgMKUi7I0oKQ8VM8lz.GLuXSVX770MVR1tbhh3M63G9VhYBdzWM4C', NULL, '2023-04-01 13:19:29', '2023-04-01 06:16:52', NULL, 'Ingredient'),
(9, 'Pos Natrium Kaseinat', 'posnatriumkaseinat@gmail.com', NULL, '$2y$10$BCZDHLPTJhdIe4T.C7Dg4.lNXphwJU1UzWE45owMG31Hsx5HrF6hy', NULL, '2023-04-01 13:19:29', '2023-04-01 06:17:15', NULL, 'Ingredient'),
(10, 'Store Bahan', 'storebahan@gmail.com', NULL, '$2y$10$zn2xmcIL74zLofiwr4wDZu0vfXRIZw4Q.GTPQBFDGUfr6dO59zHzG', NULL, '2023-04-01 13:20:54', '2023-04-01 06:20:07', NULL, 'AdminBahan'),
(11, 'Store Downgrade', 'storedowngrade@gmail.com', NULL, '$2y$10$tHnMc3xjrIj.ls4kIWPnPO01ryznkf.nMtmPfMv0Y.fxExxwwU89O', NULL, '2023-04-01 13:21:01', '2023-04-01 06:20:41', NULL, 'AdminDowngrade'),
(12, 'dnc1', 'dnc1@gmail.com', NULL, '$2y$10$QUqElGeKjkA4Ig46tOVSCOcQc4O3XoLFETd3cEeKLCv9hZlE97FVC', NULL, '2023-04-01 13:23:30', '2023-04-01 06:22:14', NULL, 'DnC'),
(13, 'dnc2', 'dnc2@gmail.com', NULL, '$2y$10$COh.qHxskJcM0qDq1l9hIuZCmrxoITujgPu8QFki8z/k4BqcnEXTq', NULL, '2023-04-01 13:23:33', '2023-04-01 06:22:29', NULL, 'DnC'),
(14, 'Pos Hint', 'poshint@gmail.com', NULL, '$2y$10$94YkmXJ409MEc/4mLoPXCum8BAFy09Q9HD9mNyysGQvY2BqZ0nsyW', NULL, '2023-04-01 13:27:37', '2023-04-01 06:24:08', NULL, 'Hint'),
(15, 'Bonus1', 'posbonus1@gmail.com', NULL, '$2y$10$j/q/Td6KuQ2V/2oIEurR3up5umljbTfEfZUuVeOu2i7tdDP1e8rSq', NULL, '2023-04-01 14:54:03', '2023-04-01 06:25:36', NULL, 'Bonus'),
(16, 'Bonus2', 'posbonus2@gmail.com', NULL, '$2y$10$UJEdeQm7sPjCcml4RJ4qyu4b.A1M793kDOJl9QNV6wKNMQvBeP192', NULL, '2023-04-01 14:54:07', '2023-04-01 06:25:55', NULL, 'Bonus'),
(17, 'Consultant', 'consultant@gmail.com', NULL, '$2y$10$Y6g4M089OqaoQ5./50KMzexVMDzvBWME2IT7zXlF2pV8ZyJI/NOFm', NULL, '2023-04-01 14:54:00', '2023-04-01 06:26:19', NULL, 'Consultant'),
(18, 'User 1', 'user1@gmail.com', NULL, '$2y$10$BhpjTSOUzoNd22MsQYBBx.ie6.I2O2V61ipRIvrxEboMC2i/1c5Oq', NULL, '2023-04-08 01:47:22', '2023-04-01 06:27:02', 1, 'Player'),
(19, 'User 2', 'user2@gmail.com', NULL, '$2y$10$y.2LJpDOtWbR5A95audS.u34t.9SawixhnyCmBupewX1TNQkh3/bq', NULL, '2023-04-08 01:47:24', '2023-04-01 06:27:22', 2, 'Player'),
(20, 'User 3', 'user3@gmail.com', NULL, '$2y$10$V2ZC1jCybX47nORM0/eS3unh2C5VJAVQyI1KomYz15yBrQ.vwwpVm', NULL, '2023-04-08 01:47:26', '2023-04-01 06:27:50', 3, 'Player'),
(21, 'User 4', 'user4@gmail.com', NULL, '$2y$10$ey6nNaOCvCpv9mBFEEPkTutPMXOe1Z3eWHEIKZOWf1F8ulDfUS/tW', NULL, '2023-04-08 01:47:27', '2023-04-01 06:28:06', 4, 'Player'),
(22, 'User 5', 'user5@gmail.com', NULL, '$2y$10$1kKbkRwYdMMweO4WqPzmseUge9FqwEVIqa4kuEVaMutZXJJ3D8qhe', NULL, '2023-04-08 01:47:28', '2023-04-01 06:28:34', 5, 'Player'),
(23, 'User 6', 'user6@gmail.com', NULL, '$2y$10$Dl9./OAGlxPrGLnzWX9hpulaFRn3GEpig6QofFBs77TWlxQj6pOQ2', NULL, '2023-04-08 01:47:29', '2023-04-01 06:28:50', 6, 'Player'),
(24, 'User 7', 'user7@gmail.com', NULL, '$2y$10$iizBn1GrnbCQ5uXtrFu3c.PKIJo37rOVknQxG6P3rd.doJC47yZVK', NULL, '2023-04-08 01:47:31', '2023-04-01 06:29:04', 7, 'Player'),
(25, 'User 8', 'user8@gmail.com', NULL, '$2y$10$Xg/nAIEsqVxI4h8MY.3YduqJgE7Li02fIFdGqUo3fhtMQpdJYsn8e', NULL, '2023-04-08 01:47:32', '2023-04-01 06:29:22', 8, 'Player'),
(26, 'User 9', 'user9@gmail.com', NULL, '$2y$10$ozbSa.A2C1cIofN.JAcJg.anEz8HBBJxum29uad6Q3ez536yDJow6', NULL, '2023-04-08 01:47:34', '2023-04-01 06:29:34', 9, 'Player'),
(27, 'User 10', 'user10@gmail.com', NULL, '$2y$10$hVtuGYLLJ8KzQ1CXyQMr0u.pfVVs0XiOs7Cn0YDqX6beoB.SdTTO2', NULL, '2023-04-08 01:47:35', '2023-04-01 06:29:50', 10, 'Player'),
(28, 'User 23', 'user23@gmail.com', NULL, '$2y$10$HEqDfi6/qslbbbm8JHpv6ebZfQVOyAaSCOln8YDHmHMc20BjOb816', NULL, '2023-04-08 01:47:37', '2023-04-01 06:30:11', 11, 'Player'),
(29, 'User 42', 'user42@gmail.com', NULL, '$2y$10$OLIRAov1nC1zSAtXAdTxiOlLEP42JC40fr7W7kNqlY2d15pUdtabq', NULL, '2023-04-08 01:47:38', '2023-04-01 06:31:03', 12, 'Player');

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
-- Indexes for table `done_playing`
--
ALTER TABLE `done_playing`
  ADD PRIMARY KEY (`iddone_playing`),
  ADD KEY `fk_done_playing_teams1_idx` (`teams_idteams`);

--
-- Indexes for table `hints`
--
ALTER TABLE `hints`
  ADD PRIMARY KEY (`idhints`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`idhistory`),
  ADD KEY `fk_history_teams1_idx` (`teams_idteams`);

--
-- Indexes for table `history_hints`
--
ALTER TABLE `history_hints`
  ADD PRIMARY KEY (`teams_idteams`,`hints_idhints`),
  ADD KEY `fk_teams_has_hints_hints1_idx` (`hints_idhints`),
  ADD KEY `fk_teams_has_hints_teams1_idx` (`teams_idteams`);

--
-- Indexes for table `history_koins`
--
ALTER TABLE `history_koins`
  ADD PRIMARY KEY (`idhistory_koins`),
  ADD KEY `teams_idteams` (`teams_idteams`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`idinventory`),
  ADD KEY `fk_inventory_teams1_idx` (`teams_idteams`);

--
-- Indexes for table `jenis_alat`
--
ALTER TABLE `jenis_alat`
  ADD PRIMARY KEY (`idjenis`);

--
-- Indexes for table `market_bahan`
--
ALTER TABLE `market_bahan`
  ADD PRIMARY KEY (`idmarket_bahan`);

--
-- Indexes for table `market_bahan_invoice`
--
ALTER TABLE `market_bahan_invoice`
  ADD PRIMARY KEY (`market_bahan_idmarket_bahan`,`teams_idteams`),
  ADD KEY `fk_market_bahan_has_teams_teams1_idx` (`teams_idteams`),
  ADD KEY `fk_market_bahan_has_teams_market_bahan1_idx` (`market_bahan_idmarket_bahan`);

--
-- Indexes for table `market_downgrade`
--
ALTER TABLE `market_downgrade`
  ADD PRIMARY KEY (`idmarket_downgrade`);

--
-- Indexes for table `market_downgrade_invoice`
--
ALTER TABLE `market_downgrade_invoice`
  ADD PRIMARY KEY (`market_downgrade_idmarket_downgrade`,`teams_idteams`),
  ADD KEY `fk_market_downgrade_has_teams_teams1_idx` (`teams_idteams`),
  ADD KEY `fk_market_downgrade_has_teams_market_downgrade1_idx` (`market_downgrade_idmarket_downgrade`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`idsesi`);

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
  MODIFY `idalat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `idbahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `done_playing`
--
ALTER TABLE `done_playing`
  MODIFY `iddone_playing` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hints`
--
ALTER TABLE `hints`
  MODIFY `idhints` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `idhistory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_koins`
--
ALTER TABLE `history_koins`
  MODIFY `idhistory_koins` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `idinventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis_alat`
--
ALTER TABLE `jenis_alat`
  MODIFY `idjenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `market_bahan`
--
ALTER TABLE `market_bahan`
  MODIFY `idmarket_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `market_downgrade`
--
ALTER TABLE `market_downgrade`
  MODIFY `idmarket_downgrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sesi`
--
ALTER TABLE `sesi`
  MODIFY `idsesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `idteams` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `fk_alat_jenis1` FOREIGN KEY (`jenis_idjenis`) REFERENCES `jenis_alat` (`idjenis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `done_playing`
--
ALTER TABLE `done_playing`
  ADD CONSTRAINT `fk_done_playing_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `history_hints`
--
ALTER TABLE `history_hints`
  ADD CONSTRAINT `fk_teams_has_hints_hints1` FOREIGN KEY (`hints_idhints`) REFERENCES `hints` (`idhints`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teams_has_hints_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fk_inventory_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `market_bahan_invoice`
--
ALTER TABLE `market_bahan_invoice`
  ADD CONSTRAINT `fk_market_bahan_has_teams_market_bahan1` FOREIGN KEY (`market_bahan_idmarket_bahan`) REFERENCES `market_bahan` (`idmarket_bahan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_market_bahan_has_teams_teams1` FOREIGN KEY (`teams_idteams`) REFERENCES `teams` (`idteams`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `market_downgrade_invoice`
--
ALTER TABLE `market_downgrade_invoice`
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
