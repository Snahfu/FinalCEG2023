-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 10:08 AM
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
(1, 'Washer', 'Motor;Pipe;Tube', 1),
(2, 'Grater', 'Motor;Blade;Gear', 2),
(3, 'Cutter', 'Blade;Motor;Skirtboard', 2),
(4, 'Ball Mill', 'Gauge;Cylinder;Gear', 2),
(5, 'Roll Crusher', 'Frame;Gear;Culinder', 2),
(6, 'Cone Crusher', 'Screw;Frame;Motor', 2),
(7, 'Coconut Hydraulic Press Machine', 'Pipe;Gauge;Piston', 3),
(8, 'Bingkai Roll', 'Cylinder;Pipe;Frame', 3),
(9, 'Screw Press', 'Screw;Gear;Motor', 3),
(10, 'Bench Frame', 'Frame;Gear;Screw', 3),
(11, 'Decanter', 'Screw;Frame;', 4),
(12, 'Distillation Column', 'Column;Condenser;Reboiler', 4),
(13, 'Extraction Column', 'Klem;Condenser;Selang', 4),
(14, 'Rotary Drum Filter', 'Pipe;Blade;Drum', 4),
(15, 'Ribbon Blenders', 'Motor;Gear;Cover', 5),
(16, 'Mixer', 'Motor;Nozzle;Gear', 5),
(17, 'High Viscosity Batch Mixing', 'Screw;Stirrer;Motor', 5),
(18, 'Double Planetary Mixing', 'Bowl;Beater;Handle', 5),
(19, 'Tray Dryer', 'Tray Plate;Fan Heater;Roller', 6),
(20, 'Spray Dryer', 'Chamber;Fan Heater;Pipe', 6),
(21, 'Rotary Dryer', 'Fan Heater;Gear;Exhaust System', 6),
(22, 'Flash Dryer', 'Blade;Cyllinder;Tower Cap', 6),
(23, 'Fluidized Bed Dryer', 'Blower;Chamber;Cyclone', 6),
(24, 'Pump', 'Cylinder;Nozzle;Impeller', 7),
(25, 'Belt Conveyor', 'Roller;Motor;Skirtboard', 7),
(26, 'Screw Conveyor', 'Screw;Cover;Motor', 7),
(27, 'Bucket Elevator', 'Bucket;Inlet;Motor', 7),
(28, 'Compressor', 'Motor ;Gauge;Frame', 7),
(29, 'Silo', 'Cylinder;Pipe;Cover', 8),
(30, 'Drum Storage', 'Handle;Cover;Cylinder', 8),
(31, 'Tank Storage', 'Cover;Pipe;Gauge', 8),
(32, 'Hopper', 'Blower;Cover;Cylinder', 8),
(33, 'Intermediate Bulk Container (IBC)', 'Katup;Cover;Frame', 8),
(34, 'Medium Bulk Storage', 'Frame;Handle;Cover', 8),
(35, 'Packager', 'Roller;Blade;Skirtboard', 9),
(36, 'Air Heater', 'Pipe;Motor;Katup', 10);

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
(10, 'Maltodekstrin', 1, 10),
(11, 'Washer', 3, 11),
(12, 'Grater', 3, 11),
(13, 'Cutter', 3, 11),
(14, 'Ball Mill', 3, 11),
(15, 'Roll Crusher', 3, 11),
(16, 'Cone Crusher', 3, 11),
(17, 'Coconut Hydraulic Press Machine', 3, 11),
(18, 'Bingkai Roll', 3, 11),
(19, 'Screw Press', 3, 11),
(20, 'Bench Frame', 3, 11),
(21, 'Decanter', 3, 11),
(22, 'Distillation Column', 3, 11),
(23, 'Extraction Column', 3, 11),
(24, 'Rotary Drum Filter', 3, 11),
(25, 'Ribbon Blenders', 3, 11),
(26, 'Mixer', 3, 11),
(27, 'High Viscosity Batch Mixing', 3, 11),
(28, 'Double Planetary Mixing', 3, 11),
(29, 'Tray Dryer', 3, 11),
(30, 'Spray Dryer', 3, 11),
(31, 'Rotary Dryer', 3, 11),
(32, 'Flash Dryer', 3, 11),
(33, 'Fluidized Bed Dryer', 3, 11),
(34, 'Pump', 3, 11),
(35, 'Belt Conveyor', 3, 11),
(36, 'Screw Conveyor', 3, 11),
(37, 'Bucket Elevator', 3, 11),
(38, 'Compressor', 3, 11),
(39, 'Silo', 3, 11),
(40, 'Drum Storage', 3, 11),
(41, 'Tank Storage', 3, 11),
(42, 'Hopper', 3, 11),
(43, 'Intermediate Bulk Container (IBC)', 3, 11),
(44, 'Medium Bulk Storage', 3, 11),
(45, 'Packager', 3, 11),
(46, 'Air Heater', 3, 11),
(47, 'Washer', 3, 12),
(48, 'Grater', 3, 12),
(49, 'Cutter', 3, 12),
(50, 'Ball Mill', 3, 12),
(51, 'Roll Crusher', 3, 12),
(52, 'Cone Crusher', 3, 12),
(53, 'Coconut Hydraulic Press Machine', 3, 12),
(54, 'Bingkai Roll', 3, 12),
(55, 'Screw Press', 3, 12),
(56, 'Bench Frame', 3, 12),
(57, 'Decanter', 3, 12),
(58, 'Distillation Column', 3, 12),
(59, 'Extraction Column', 3, 12),
(60, 'Rotary Drum Filter', 3, 12),
(61, 'Ribbon Blenders', 3, 12),
(62, 'Mixer', 3, 12),
(63, 'High Viscosity Batch Mixing', 3, 12),
(64, 'Double Planetary Mixing', 3, 12),
(65, 'Tray Dryer', 3, 12),
(66, 'Spray Dryer', 3, 12),
(67, 'Rotary Dryer', 3, 12),
(68, 'Flash Dryer', 3, 12),
(69, 'Fluidized Bed Dryer', 3, 12),
(70, 'Pump', 3, 12),
(71, 'Belt Conveyor', 3, 12),
(72, 'Screw Conveyor', 3, 12),
(73, 'Bucket Elevator', 3, 12),
(74, 'Compressor', 3, 12),
(75, 'Silo', 3, 12),
(76, 'Drum Storage', 3, 12),
(77, 'Tank Storage', 3, 12),
(78, 'Hopper', 3, 12),
(79, 'Intermediate Bulk Container (IBC)', 3, 12),
(80, 'Medium Bulk Storage', 3, 12),
(81, 'Packager', 3, 12),
(82, 'Air Heater', 3, 12),
(83, 'Washer', 3, 13),
(84, 'Grater', 3, 13),
(85, 'Cutter', 3, 13),
(86, 'Ball Mill', 3, 13),
(87, 'Roll Crusher', 3, 13),
(88, 'Cone Crusher', 3, 13),
(89, 'Coconut Hydraulic Press Machine', 3, 13),
(90, 'Bingkai Roll', 3, 13),
(91, 'Screw Press', 3, 13),
(92, 'Bench Frame', 3, 13),
(93, 'Decanter', 3, 13),
(94, 'Distillation Column', 3, 13),
(95, 'Extraction Column', 3, 13),
(96, 'Rotary Drum Filter', 3, 13),
(97, 'Ribbon Blenders', 3, 13),
(98, 'Mixer', 3, 13),
(99, 'High Viscosity Batch Mixing', 3, 13),
(100, 'Double Planetary Mixing', 3, 13),
(101, 'Tray Dryer', 3, 13),
(102, 'Spray Dryer', 3, 13),
(103, 'Rotary Dryer', 3, 13),
(104, 'Flash Dryer', 3, 13),
(105, 'Fluidized Bed Dryer', 3, 13),
(106, 'Pump', 3, 13),
(107, 'Belt Conveyor', 3, 13),
(108, 'Screw Conveyor', 3, 13),
(109, 'Bucket Elevator', 3, 13),
(110, 'Compressor', 3, 13),
(111, 'Silo', 3, 13),
(112, 'Drum Storage', 3, 13),
(113, 'Tank Storage', 3, 13),
(114, 'Hopper', 3, 13),
(115, 'Intermediate Bulk Container (IBC)', 3, 13),
(116, 'Medium Bulk Storage', 3, 13),
(117, 'Packager', 3, 13),
(118, 'Air Heater', 3, 13);

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
(9, 'Pengemas'),
(10, 'Pemanas');

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
(1, 'Daging Kelapa', 200, 50, 40, 1, 'biasa'),
(2, 'Air', 200, 30, 20, 1, 'biasa'),
(3, 'Natrium Kaseinat ', 200, 75, 60, 1, 'biasa'),
(4, 'Daging Kelapa', 2, 35, 0, 1, 'flash sale 1'),
(5, 'Natrium Kaseinat', 2, 60, 0, 1, 'flash sale 1'),
(6, 'Daging Kelapa', 2, 35, 0, 1, 'flash sale 2'),
(7, 'Natrium Kaseinat', 2, 60, 0, 1, 'flash sale 2'),
(8, 'Daging Kelapa', 2, 35, 0, 1, 'flash sale 3'),
(9, 'Natrium Kaseinat', 2, 60, 0, 1, 'flash sale 3');

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
(1, 'Motor', 200, 100, 85, 'biasa'),
(2, 'Pipe', 200, 50, 40, 'biasa'),
(3, 'Tube', 200, 35, 30, 'biasa'),
(4, 'Blade', 200, 75, 60, 'biasa'),
(5, 'Gear', 200, 45, 35, 'biasa'),
(6, 'Gauge', 200, 65, 55, 'biasa'),
(7, 'Piston', 200, 70, 60, 'biasa'),
(8, 'Cylinder', 200, 60, 50, 'biasa'),
(9, 'Frame', 200, 55, 45, 'biasa'),
(10, 'Screw', 200, 75, 60, 'biasa'),
(11, 'Glass', 200, 55, 45, 'biasa'),
(12, 'Katup', 200, 30, 25, 'biasa'),
(13, 'Column', 200, 40, 30, 'biasa'),
(14, 'Condenser', 200, 50, 40, 'biasa'),
(15, 'Reboiler', 200, 80, 65, 'biasa'),
(16, 'Klem', 200, 60, 50, 'biasa'),
(17, 'Selang', 200, 35, 30, 'biasa'),
(18, 'Drum', 200, 65, 55, 'biasa'),
(19, 'Cover', 200, 25, 20, 'biasa'),
(20, 'Nozzle', 200, 40, 35, 'biasa'),
(21, 'Stirrer', 200, 40, 35, 'biasa'),
(22, 'Bowl', 200, 25, 20, 'biasa'),
(23, 'Beater', 200, 30, 25, 'biasa'),
(24, 'Handle', 200, 45, 35, 'biasa'),
(25, 'Tray Plate', 200, 55, 45, 'biasa'),
(26, 'Heater', 200, 65, 55, 'biasa'),
(27, 'Roller', 200, 50, 40, 'biasa'),
(28, 'Chamber', 200, 85, 70, 'biasa'),
(29, 'Exhaust System', 200, 50, 40, 'biasa'),
(30, 'Tower Cap', 200, 35, 30, 'biasa'),
(31, 'Blower', 200, 65, 55, 'biasa'),
(32, 'Cyclone', 200, 25, 20, 'biasa'),
(33, 'Impeller', 200, 35, 30, 'biasa'),
(34, 'Skirtboard', 200, 25, 20, 'biasa'),
(35, 'Bucket', 200, 35, 30, 'biasa'),
(36, 'Inlet', 200, 30, 25, 'biasa'),
(37, 'Board', 200, 30, 25, 'biasa'),
(38, 'Hinge', 200, 60, 50, 'biasa'),
(39, 'Cooler', 200, 90, 75, 'biasa'),
(40, 'Termometer', 200, 85, 70, 'biasa'),
(41, 'Vent', 200, 95, 80, 'biasa'),
(42, 'Motor', 2, 80, 0, 'flash sale 1'),
(43, 'Blade', 2, 55, 0, 'flash sale 1'),
(44, 'Gauge', 2, 45, 0, 'flash sale 1'),
(45, 'Piston', 2, 50, 0, 'flash sale 1'),
(46, 'Cylinder', 2, 40, 0, 'flash sale 1'),
(47, 'Frame', 2, 35, 0, 'flash sale 1'),
(48, 'Screw', 2, 55, 0, 'flash sale 1'),
(49, 'Glass', 2, 35, 0, 'flash sale 1'),
(50, 'Reboiler', 2, 60, 0, 'flash sale 1'),
(51, 'Klem', 2, 40, 0, 'flash sale 1'),
(52, 'Drum', 2, 45, 0, 'flash sale 1'),
(53, 'Tray Plate', 2, 35, 0, 'flash sale 1'),
(54, 'Heater', 2, 45, 0, 'flash sale 1'),
(55, 'Chamber', 2, 65, 0, 'flash sale 1'),
(56, 'Blower', 2, 45, 0, 'flash sale 1'),
(57, 'Motor', 2, 80, 0, 'flash sale 2'),
(58, 'Blade', 2, 55, 0, 'flash sale 2'),
(59, 'Gauge', 2, 45, 0, 'flash sale 2'),
(60, 'Piston', 2, 50, 0, 'flash sale 2'),
(61, 'Cylinder', 2, 40, 0, 'flash sale 2'),
(62, 'Frame', 2, 35, 0, 'flash sale 2'),
(63, 'Screw', 2, 55, 0, 'flash sale 2'),
(64, 'Glass', 2, 35, 0, 'flash sale 2'),
(65, 'Reboiler', 2, 60, 0, 'flash sale 2'),
(66, 'Klem', 2, 40, 0, 'flash sale 2'),
(67, 'Drum', 2, 45, 0, 'flash sale 2'),
(68, 'Tray Plate', 2, 35, 0, 'flash sale 2'),
(69, 'Heater', 2, 45, 0, 'flash sale 2'),
(70, 'Chamber', 2, 65, 0, 'flash sale 2'),
(71, 'Blower', 2, 45, 0, 'flash sale 2'),
(72, 'Motor', 2, 80, 0, 'flash sale 3'),
(73, 'Blade', 2, 55, 0, 'flash sale 3'),
(74, 'Gauge', 2, 45, 0, 'flash sale 3'),
(75, 'Piston', 2, 50, 0, 'flash sale 3'),
(76, 'Cylinder', 2, 40, 0, 'flash sale 3'),
(77, 'Frame', 2, 35, 0, 'flash sale 3'),
(78, 'Screw', 2, 55, 0, 'flash sale 3'),
(79, 'Glass', 2, 35, 0, 'flash sale 3'),
(80, 'Reboiler', 2, 60, 0, 'flash sale 3'),
(81, 'Klem', 2, 40, 0, 'flash sale 3'),
(82, 'Drum', 2, 45, 0, 'flash sale 3'),
(83, 'Tray Plate', 2, 35, 0, 'flash sale 3'),
(84, 'Heater', 2, 45, 0, 'flash sale 3'),
(85, 'Chamber', 2, 65, 0, 'flash sale 3'),
(86, 'Blower', 2, 45, 0, 'flash sale 3');

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
(12, 'User 42', '1000000'),
(13, 'User 52', '1000000');

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
(1, 'pengeringan', 'pengeringan@gmail.com', NULL, '$2y$10$k3y7LlxYBA9lYv8H8.z86uXx0/TXjDMGFRYMhdxNe8o5BdTfBwb1a', NULL, '2023-04-15 07:14:48', '2023-04-15 00:14:48', NULL, 'Tool'),
(2, 'pencampuran', 'pencampuran@gmail.com', NULL, '$2y$10$2sMM97EGQrgv0XDW7bH1EuUePF5Mzb/yrf7IwnKckUmu81ZqBEJke', NULL, '2023-04-15 07:36:35', '2023-04-15 00:36:35', NULL, 'Tool'),
(3, 'pengangkut', 'pengangkut@gmail.com', NULL, '$2y$10$KX8uKKT7s.KoQAD8qnXFg.3gZwwLvlyYfDPOKJC/tqb.ZKaiWVKG2', NULL, '2023-04-15 07:36:52', '2023-04-15 00:36:52', NULL, 'Tool'),
(4, 'pengecil ukuran', 'pengecilukuran@gmail.com', NULL, '$2y$10$p3XH/a5aHkilGfTtUWsTfumq4VqcZiFjZBWYw4Gydyyh8rMwx5RIm', NULL, '2023-04-15 07:11:26', '2023-04-14 23:45:36', NULL, 'Tool'),
(5, 'pengepresan', 'pengepresan@gmail.com', NULL, '$2y$10$lT/Y9EVleDrknEouLpPQn.mo.yVPIhsHxgE/pG5Gw9qnYlREHtiXC', NULL, '2023-04-15 07:11:26', '2023-04-14 23:46:14', NULL, 'Tool'),
(6, 'penyimpanan', 'penyimpanan@gmail.com', NULL, '$2y$10$3HpHVjCFf1O4PnNhtBcqPu0jLgTueS/AkSdl0zh3ESrMQYC0gwcB2', NULL, '2023-04-15 07:11:26', '2023-04-14 23:46:47', NULL, 'Tool'),
(7, 'air', 'air@gmail.com', NULL, '$2y$10$M6KdM3N8hzTKCh4CLWGnDe6YhOD04REXCjbN3DZtzzJrPxuiUvE.y', NULL, '2023-04-15 07:12:39', '2023-04-14 23:48:06', NULL, 'Ingredient'),
(8, 'daging kelapa', 'dagingkelapa@gmail.com', NULL, '$2y$10$FiI/MRNi.rNS9r2gX6Jzie8d6XL8d8FJBJFCfkMuCzIeCuxCX58jO', NULL, '2023-04-15 07:12:39', '2023-04-14 23:52:45', NULL, 'Ingredient'),
(9, 'natrium kaseinat', 'natriumkaseinat@gmail.com', NULL, '$2y$10$5hQpqEZRhxsxcAtdWmzC8.F6XAgwQ.057BFUhPwnjGZzt7IufnXWe', NULL, '2023-04-15 07:12:39', '2023-04-14 23:53:16', NULL, 'Ingredient'),
(10, 'store bahan1', 'bahan1@gmail.com', NULL, '$2y$10$p4zFHATbdDE0UCV9feRCeOn.O.PyXkPr25.5XmHD4qR1Kx7cVov3m', NULL, '2023-04-15 07:12:56', '2023-04-14 23:53:56', NULL, 'AdminBahan'),
(11, 'store bahan2', 'bahan2@gmail.com', NULL, '$2y$10$xDSGfjNv/zRkUXFQmW49D.aiYAXccAuk.Lj8lriSp4wIB6IVeGuNi', NULL, '2023-04-15 07:13:01', '2023-04-14 23:57:22', NULL, 'AdminBahan'),
(12, 'store downgrade1', 'downgrade1@gmail.com', NULL, '$2y$10$17EOyJI1LHsoc/yvoQo/HON.ElQMr7kQkA/HK/BrVxmIe5dAvfLqa', NULL, '2023-04-15 07:13:06', '2023-04-14 23:58:57', NULL, 'AdminDowngrade'),
(13, 'store downgrade2', 'downgrade2@gmail.com', NULL, '$2y$10$Tt9xRcd3V/x4paUqIjR1xu8iqzIxMPznm/FI2NKXsmlzo20yqZL06', NULL, '2023-04-15 07:13:11', '2023-04-15 00:07:31', NULL, 'AdminDowngrade'),
(14, 'dnc1', 'dnc1@gmail.com', NULL, '$2y$10$pc9u/cBXvnKQiEAwLKRke.BJ.fAUF9A1marrQfgbWJHf/Z2LN3nmS', NULL, '2023-04-15 07:13:18', '2023-04-15 00:07:59', NULL, 'DnC'),
(15, 'dnc2', 'dnc@gmail.com', NULL, '$2y$10$KEiVMflTfANI/Z10Dd6wF.figlN5Ddzs6ccpNJXgzfvubz10jDU4q', NULL, '2023-04-15 07:13:22', '2023-04-15 00:08:18', NULL, 'DnC'),
(16, 'hint', 'hint@gmail.com', NULL, '$2y$10$/buDB4ZkLjS9GAEfvpq3GOFbqBjaLS4hona2dOW99GLHWyImKHI3.', NULL, '2023-04-15 07:13:31', '2023-04-15 00:09:00', NULL, 'AdminHint'),
(17, 'bonus1', 'bonus1@gmail.com', NULL, '$2y$10$eDuPK7f.SnZ9lRiAfnjueO9E7o3EiM9WKSslcM4GWa3mjfJbgDr7y', NULL, '2023-04-15 07:13:38', '2023-04-15 00:09:29', NULL, 'Bonus'),
(18, 'bonus2', 'bonus2@gmail.com', NULL, '$2y$10$i5NSAydv1o4QNePyD50l7.uvZwKsE8Rqb7KsrBZG2T.8zN6X4.uYS', NULL, '2023-04-15 07:13:41', '2023-04-15 00:09:50', NULL, 'Bonus'),
(19, 'consultant', 'consultant@gmail.com', NULL, '$2y$10$es0RHGcx/6MXLmk3uNjs8OTHSpFx8G5Mk4PfmSbnfUUDpQ8ksWViu', NULL, '2023-04-15 07:13:48', '2023-04-15 00:10:13', NULL, 'Consultant'),
(20, 'dummytools', 'dummytools@gmail.com', NULL, '$2y$10$rQ5d80riRjHzOnlzgctB8eCrpaDRyMSeKNBbNlj2YnpyXU5e7iLve', NULL, '2023-04-15 07:59:34', '2023-04-15 00:47:26', NULL, NULL),
(21, 'dummyingredient', 'dummyingredient@gmail.com', NULL, '$2y$10$8/NpH7c8qRDyjX6xEd.uqO.QnMehrJxOwkOwSWIjYvH1IfKIQHLd2', NULL, '2023-04-15 07:59:42', '2023-04-15 00:52:28', NULL, NULL),
(22, 'dummybahan', 'dummystorebahan@gmail.com', NULL, '$2y$10$8DcJwGmRFcESDWt.uD16L.1AuKNELK6fUK8WXLFzuoZE1anVcwT..', NULL, '2023-04-15 07:59:47', '2023-04-15 00:54:30', NULL, NULL),
(30, 'dummydowngrade', 'dummystoredowngrade@gmail.com', NULL, '$2y$10$QpuxjYckR0cleb6iOvbFseCVlidXD8dkd0gcXVWhVLatFezmYRoEO', NULL, '2023-04-15 07:59:52', '2023-04-15 00:56:51', NULL, NULL),
(31, 'dummydnc', 'dummydnc@gmail.com', NULL, '$2y$10$6dbNVDPHjxl7LqCWuStWHu68bXFGEHu2PyU4nSc1gEdx8BjrmaeGy', NULL, '2023-04-15 07:59:55', '2023-04-15 00:58:37', NULL, NULL),
(32, 'dummyhint', 'dummyhint@gmail.com', NULL, '$2y$10$P9VpgfLKKZQGpPVUq.BxPeqIDkXq3fnS5KyPAfc0tV8hJMS1XbxiO', NULL, '2023-04-15 07:59:59', '2023-04-15 00:58:57', NULL, NULL),
(33, 'dummybonus', 'dummybonus@gmail.com', NULL, '$2y$10$x7vMgmebe5FnjPgArGfRk.ygUkS4oiFlp1CR/Mhn33vc2Ur63b6Zq', NULL, '2023-04-15 01:00:29', '2023-04-15 01:00:29', NULL, NULL),
(34, 'dummyconsultant', 'dummyconsultant@gmail.com', NULL, '$2y$10$tDVGWyMhEcKQJXS8Qeju8eDIoe1zQsTHUyeiPaViWUmoKvMUaOGqK', NULL, '2023-04-15 01:01:49', '2023-04-15 01:01:49', NULL, NULL),
(45, 'user37', 'user37@gmail.com', NULL, '$2y$10$1T56y.nwPog52kUjEHS0MezPbNbw5aQIdPnQM7LPP2g.Ajib60sQe', NULL, '2023-04-15 08:07:15', '2023-04-15 01:03:09', NULL, NULL),
(46, 'user39', 'user39@gmail.com', NULL, '$2y$10$1z7LFg175AnZxYSw8hvT1.jr5oU6nVUG38z3eSrGyGn.vCj5imU62', NULL, '2023-04-15 08:07:15', '2023-04-15 01:03:55', NULL, NULL),
(47, 'user45', 'user45@gmail.com', NULL, '$2y$10$7qX8R9QVtzK8tVmZ/Z4c3.35oUqPVfaAXn3XvrbRZmXZvi9JYqSmS', NULL, '2023-04-15 08:07:15', '2023-04-15 01:05:47', NULL, NULL),
(48, 'user50', 'user50@gmail.com', NULL, '$2y$10$//kLQTAPnc2cAFI3co09X.wL9.hiobBiSBt.yAf3UUUs35wj22Ifu', NULL, '2023-04-15 08:07:15', '2023-04-15 01:06:06', NULL, NULL),
(49, 'user94', 'user94@gmail.com', NULL, '$2y$10$IFIkacSwgy39gmR1lcHioejlCssWZos2NLNqdGB5kkQWnAejRYubC', NULL, '2023-04-15 08:07:15', '2023-04-15 01:06:25', NULL, NULL);

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
  MODIFY `idalat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `idinventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `jenis_alat`
--
ALTER TABLE `jenis_alat`
  MODIFY `idjenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `idteams` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
