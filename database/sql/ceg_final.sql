-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 04:41 AM
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
(1, 'Pengecil Ukuran', 'https://i.ibb.co/Nn1cj9b/1-Pengecil-Ukuran.jpg'),
(2, 'Pengangkut', 'https://i.ibb.co/hLtY4dj/2-Pengangkut.jpg'),
(3, 'Pengepresan', 'https://i.ibb.co/QMXGM6k/3-Pengepressan.jpg'),
(4, 'Pengeringan', 'https://i.ibb.co/Kjbd7j8/4-Pengeringan.jpg'),
(5, 'Pencampuran 2', 'https://i.ibb.co/BrGwXd2/5-Pencampuran-2.jpg'),
(6, 'Penyimpanan', 'https://i.ibb.co/1GbfZmj/6-Penyimpanan.jpg'),
(7, 'Pencampuran 1', 'https://i.ibb.co/8YKP64X/7-Pencampuran-1.jpg');

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
(129, 'Washer', 3, 11),
(130, 'Grater', 3, 11),
(131, 'Cutter', 3, 11),
(132, 'Ball Mill', 3, 11),
(133, 'Roll Crusher', 3, 11),
(134, 'Cone Crusher', 3, 11),
(135, 'Coconut Hydraulic Press Machine', 3, 11),
(136, 'Bingkai Roll', 3, 11),
(137, 'Screw Press', 3, 11),
(138, 'Bench Frame', 3, 11),
(139, 'Decanter', 3, 11),
(140, 'Distillation Column', 3, 11),
(141, 'Extraction Column', 3, 11),
(142, 'Rotary Drum Filter', 3, 11),
(143, 'Ribbon Blenders', 3, 11),
(144, 'Mixer', 3, 11),
(145, 'High Viscosity Batch Mixing', 3, 11),
(146, 'Double Planetary Mixing', 3, 11),
(147, 'Tray Dryer', 3, 11),
(148, 'Spray Dryer', 3, 11),
(149, 'Rotary Dryer', 3, 11),
(150, 'Flash Dryer', 3, 11),
(151, 'Fluidized Bed Dryer', 3, 11),
(152, 'Pump', 3, 11),
(153, 'Belt Conveyor', 3, 11),
(154, 'Screw Conveyor', 3, 11),
(155, 'Bucket Elevator', 3, 11),
(156, 'Compressor', 3, 11),
(157, 'Silo', 3, 11),
(158, 'Drum Storage', 3, 11),
(159, 'Tank Storage', 3, 11),
(160, 'Hopper', 3, 11),
(161, 'Intermediate Bulk Container (IBC)', 3, 11),
(162, 'Medium Bulk Storage', 3, 11),
(163, 'Packager', 3, 11),
(164, 'Air Heater', 3, 11),
(165, 'Washer', 3, 12),
(166, 'Grater', 3, 12),
(167, 'Cutter', 3, 12),
(168, 'Ball Mill', 3, 12),
(169, 'Roll Crusher', 3, 12),
(170, 'Cone Crusher', 3, 12),
(171, 'Coconut Hydraulic Press Machine', 3, 12),
(172, 'Bingkai Roll', 3, 12),
(173, 'Screw Press', 3, 12),
(174, 'Bench Frame', 3, 12),
(175, 'Decanter', 3, 12),
(176, 'Distillation Column', 3, 12),
(177, 'Extraction Column', 3, 12),
(178, 'Rotary Drum Filter', 3, 12),
(179, 'Ribbon Blenders', 3, 12),
(180, 'Mixer', 3, 12),
(181, 'High Viscosity Batch Mixing', 3, 12),
(182, 'Double Planetary Mixing', 3, 12),
(183, 'Tray Dryer', 3, 12),
(184, 'Spray Dryer', 3, 12),
(185, 'Rotary Dryer', 3, 12),
(186, 'Flash Dryer', 3, 12),
(187, 'Fluidized Bed Dryer', 3, 12),
(188, 'Pump', 3, 12),
(189, 'Belt Conveyor', 3, 12),
(190, 'Screw Conveyor', 3, 12),
(191, 'Bucket Elevator', 3, 12),
(192, 'Compressor', 3, 12),
(193, 'Silo', 3, 12),
(194, 'Drum Storage', 3, 12),
(195, 'Tank Storage', 3, 12),
(196, 'Hopper', 3, 12),
(197, 'Intermediate Bulk Container (IBC)', 3, 12),
(198, 'Medium Bulk Storage', 3, 12),
(199, 'Packager', 3, 12),
(200, 'Air Heater', 3, 12),
(201, 'Washer', 3, 13),
(202, 'Grater', 3, 13),
(203, 'Cutter', 3, 13),
(204, 'Ball Mill', 3, 13),
(205, 'Roll Crusher', 3, 13),
(206, 'Cone Crusher', 3, 13),
(207, 'Coconut Hydraulic Press Machine', 3, 13),
(208, 'Bingkai Roll', 3, 13),
(209, 'Screw Press', 3, 13),
(210, 'Bench Frame', 3, 13),
(211, 'Decanter', 3, 13),
(212, 'Distillation Column', 3, 13),
(213, 'Extraction Column', 3, 13),
(214, 'Rotary Drum Filter', 3, 13),
(215, 'Ribbon Blenders', 3, 13),
(216, 'Mixer', 3, 13),
(217, 'High Viscosity Batch Mixing', 3, 13),
(218, 'Double Planetary Mixing', 3, 13),
(219, 'Tray Dryer', 3, 13),
(220, 'Spray Dryer', 3, 13),
(221, 'Rotary Dryer', 3, 13),
(222, 'Flash Dryer', 3, 13),
(223, 'Fluidized Bed Dryer', 3, 13),
(224, 'Pump', 3, 13),
(225, 'Belt Conveyor', 3, 13),
(226, 'Screw Conveyor', 3, 13),
(227, 'Bucket Elevator', 3, 13),
(228, 'Compressor', 3, 13),
(229, 'Silo', 3, 13),
(230, 'Drum Storage', 3, 13),
(231, 'Tank Storage', 3, 13),
(232, 'Hopper', 3, 13),
(233, 'Intermediate Bulk Container (IBC)', 3, 13),
(234, 'Medium Bulk Storage', 3, 13),
(235, 'Packager', 3, 13),
(236, 'Air Heater', 3, 13),
(237, 'Washer', 3, 14),
(238, 'Grater', 3, 14),
(239, 'Cutter', 3, 14),
(240, 'Ball Mill', 3, 14),
(241, 'Roll Crusher', 3, 14),
(242, 'Cone Crusher', 3, 14),
(243, 'Coconut Hydraulic Press Machine', 3, 14),
(244, 'Bingkai Roll', 3, 14),
(245, 'Screw Press', 3, 14),
(246, 'Bench Frame', 3, 14),
(247, 'Decanter', 3, 14),
(248, 'Distillation Column', 3, 14),
(249, 'Extraction Column', 3, 14),
(250, 'Rotary Drum Filter', 3, 14),
(251, 'Ribbon Blenders', 3, 14),
(252, 'Mixer', 3, 14),
(253, 'High Viscosity Batch Mixing', 3, 14),
(254, 'Double Planetary Mixing', 3, 14),
(255, 'Tray Dryer', 3, 14),
(256, 'Spray Dryer', 3, 14),
(257, 'Rotary Dryer', 3, 14),
(258, 'Flash Dryer', 3, 14),
(259, 'Fluidized Bed Dryer', 3, 14),
(260, 'Pump', 3, 14),
(261, 'Belt Conveyor', 3, 14),
(262, 'Screw Conveyor', 3, 14),
(263, 'Bucket Elevator', 3, 14),
(264, 'Compressor', 3, 14),
(265, 'Silo', 3, 14),
(266, 'Drum Storage', 3, 14),
(267, 'Tank Storage', 3, 14),
(268, 'Hopper', 3, 14),
(269, 'Intermediate Bulk Container (IBC)', 3, 14),
(270, 'Medium Bulk Storage', 3, 14),
(271, 'Packager', 3, 14),
(272, 'Air Heater', 3, 14),
(273, 'Washer', 3, 15),
(274, 'Grater', 3, 15),
(275, 'Cutter', 3, 15),
(276, 'Ball Mill', 3, 15),
(277, 'Roll Crusher', 3, 15),
(278, 'Cone Crusher', 3, 15),
(279, 'Coconut Hydraulic Press Machine', 3, 15),
(280, 'Bingkai Roll', 3, 15),
(281, 'Screw Press', 3, 15),
(282, 'Bench Frame', 3, 15),
(283, 'Decanter', 3, 15),
(284, 'Distillation Column', 3, 15),
(285, 'Extraction Column', 3, 15),
(286, 'Rotary Drum Filter', 3, 15),
(287, 'Ribbon Blenders', 3, 15),
(288, 'Mixer', 3, 15),
(289, 'High Viscosity Batch Mixing', 3, 15),
(290, 'Double Planetary Mixing', 3, 15),
(291, 'Tray Dryer', 3, 15),
(292, 'Spray Dryer', 3, 15),
(293, 'Rotary Dryer', 3, 15),
(294, 'Flash Dryer', 3, 15),
(295, 'Fluidized Bed Dryer', 3, 15),
(296, 'Pump', 3, 15),
(297, 'Belt Conveyor', 3, 15),
(298, 'Screw Conveyor', 3, 15),
(299, 'Bucket Elevator', 3, 15),
(300, 'Compressor', 3, 15),
(301, 'Silo', 3, 15),
(302, 'Drum Storage', 3, 15),
(303, 'Tank Storage', 3, 15),
(304, 'Hopper', 3, 15),
(305, 'Intermediate Bulk Container (IBC)', 3, 15),
(306, 'Medium Bulk Storage', 3, 15),
(307, 'Packager', 3, 15),
(308, 'Air Heater', 3, 15),
(309, 'Daging Kelapa', 3, 11),
(310, 'Air', 3, 11),
(311, 'Natrium Kaseinat', 3, 11),
(312, 'Daging Kelapa', 3, 12),
(313, 'Air', 3, 12),
(314, 'Natrium Kaseinat', 3, 12),
(315, 'Daging Kelapa', 3, 13),
(316, 'Air', 3, 13),
(317, 'Natrium Kaseinat', 3, 13),
(318, 'Daging Kelapa', 3, 14),
(319, 'Air', 3, 14),
(320, 'Natrium Kaseinat', 3, 14),
(321, 'Daging Kelapa', 3, 15),
(322, 'Air', 3, 15),
(323, 'Natrium Kaseinat', 3, 15);

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
(4, 'User 4', '2000'),
(5, 'User 5', '1500'),
(6, 'User 6', '1500'),
(7, 'User 7', '1500'),
(8, 'User 8', '1500'),
(9, 'User 9', '1500'),
(10, 'User 10', '1500'),
(11, 'User 37', '1000000'),
(12, 'User 39', '1000000'),
(13, 'User 45', '1000000'),
(14, 'User 50', '1000000'),
(15, 'User 94', '1000000');

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
(1, 'pengeringan', 'pengeringan@gmail.com', NULL, '$2y$10$khLxgRHgtVAGd.s4.tpd8eIFfprSSTExPAwuPNTjFxEXamW1nJFMG', 'J0dOuI6YGRi2inFBOFpMbTInL4mT9imi4yxX9RklGkuTV1IESbeDS7p05d0c', '2023-04-16 01:27:38', '2023-04-15 18:27:38', NULL, 'Tool'),
(2, 'pencampuran', 'pencampuran@gmail.com', NULL, '$2y$10$IwGtmn/i5PjB6xKXdcHFlucJYHju8490JIrwc4DgWLkYVR4Vyz3Aq', 'LOwFPSFueYqpgPwb4hYtTPgReEzsT6tpdxqYfTdXUE0boLhQ4Xl9rMLyqyca', '2023-04-16 01:28:46', '2023-04-15 18:28:46', NULL, 'Tool'),
(3, 'pengangkut', 'pengangkut@gmail.com', NULL, '$2y$10$ZGlGSmeE/PYBeEfEk9lSsOSKT0TXJrFjvfj4Hy6ftMi4F.p21B6Ru', NULL, '2023-04-16 01:27:25', '2023-04-15 18:27:25', NULL, 'Tool'),
(4, 'pengecil ukuran', 'pengecilukuran@gmail.com', NULL, '$2y$10$Z1Z43.V41pDLLoKvJDYN6eGhdcpyzAa05doM2EOR5vh6B.FFftq8K', 'b9zwsObLr2hCjdoYEcqgGlojC56ULb6C0TTnZZHs1sNgVMxOgP5tNgnwvUoD', '2023-04-16 01:27:13', '2023-04-15 18:27:13', NULL, 'Tool'),
(5, 'pengepresan', 'pengepresan@gmail.com', NULL, '$2y$10$NGp/uRrIxx/H8DcUoEZQiuQ5PMoCJdpK95RuQDixmQkJtw.wEwc42', 'qru64eIL6jJL1h1HsWlDzyzjlwz7qH3IVQmwnMQ1xcdZkYZQ8q1yrltp5jA0', '2023-04-16 01:25:53', '2023-04-15 18:25:53', NULL, 'Tool'),
(6, 'penyimpanan', 'penyimpanan@gmail.com', NULL, '$2y$10$81TYhLHa52rYD7A55LutFuZKvyCpJF0QfqV4NcvtqivkW0aU343kW', '8h7bikQrbZ4zJgLeb48bTBAHEgkqhCZUaX12e55qRKI73n5GeTQdAmNQySrM', '2023-04-16 01:42:18', '2023-04-15 18:42:18', NULL, 'Tool'),
(7, 'air', 'air@gmail.com', NULL, '$2y$10$M6KdM3N8hzTKCh4CLWGnDe6YhOD04REXCjbN3DZtzzJrPxuiUvE.y', NULL, '2023-04-15 07:12:39', '2023-04-14 23:48:06', NULL, 'Ingredient'),
(8, 'daging kelapa', 'dagingkelapa@gmail.com', NULL, '$2y$10$FiI/MRNi.rNS9r2gX6Jzie8d6XL8d8FJBJFCfkMuCzIeCuxCX58jO', NULL, '2023-04-15 07:12:39', '2023-04-14 23:52:45', NULL, 'Ingredient'),
(9, 'natrium kaseinat', 'natriumkaseinat@gmail.com', NULL, '$2y$10$NxQVqmRYSWMYV0wBV.0Dp.7fiqA2YpQ.eYSE1Fzu/79sIcw2J2JyK', NULL, '2023-04-16 01:27:57', '2023-04-15 18:27:57', NULL, 'Ingredient'),
(10, 'store bahan1', 'bahan1@gmail.com', NULL, '$2y$10$p4zFHATbdDE0UCV9feRCeOn.O.PyXkPr25.5XmHD4qR1Kx7cVov3m', NULL, '2023-04-15 07:12:56', '2023-04-14 23:53:56', NULL, 'AdminBahan'),
(11, 'store bahan2', 'bahan2@gmail.com', NULL, '$2y$10$xiqDOq4JOO1Qf1.h26.yWOzYUD95rdOPHDvpZBNYwJNlaGoPb2fMe', NULL, '2023-04-16 01:28:56', '2023-04-15 18:28:56', NULL, 'AdminBahan'),
(12, 'store downgrade1', 'downgrade1@gmail.com', NULL, '$2y$10$17EOyJI1LHsoc/yvoQo/HON.ElQMr7kQkA/HK/BrVxmIe5dAvfLqa', NULL, '2023-04-15 07:13:06', '2023-04-14 23:58:57', NULL, 'AdminDowngrade'),
(13, 'store downgrade2', 'downgrade2@gmail.com', NULL, '$2y$10$ZXgAM5hhSd5TMBmxDa61QeWj2YPGXOiA4AqUFLnjgKVfswAipBYgK', NULL, '2023-04-16 01:42:06', '2023-04-15 18:42:06', NULL, 'AdminDowngrade'),
(14, 'dnc1', 'dnc1@gmail.com', NULL, '$2y$10$XKR80/Bf3PJhfGl1VGNPXeuCaO4FOKclZLPJpXogeAU.yTvQqZiDy', NULL, '2023-04-16 01:27:38', '2023-04-15 18:27:38', NULL, 'DnC'),
(15, 'dnc2', 'dnc@gmail.com', NULL, '$2y$10$Li72oZrX8jrkK9WWGNxQM.dGt5Fm.wuBuxgfpkoBZp55nHYP5NQfu', 'bG3pquKbRuaLKQcZCvUaorUSvRF5Ef50GFK8E3rhTLYszDj13qeJ2yRqNgmR', '2023-04-16 01:42:11', '2023-04-15 18:42:11', NULL, 'DnC'),
(16, 'hint', 'hint@gmail.com', NULL, '$2y$10$/buDB4ZkLjS9GAEfvpq3GOFbqBjaLS4hona2dOW99GLHWyImKHI3.', NULL, '2023-04-15 07:13:31', '2023-04-15 00:09:00', NULL, 'AdminHint'),
(17, 'bonus1', 'bonus1@gmail.com', NULL, '$2y$10$gKWukOqnR8SSu0rgsI7PJe8cujrnGctUROnAU28whB9bd6VMbBiuy', 'EDX5VXAO73cFeRJI8IZrInhAKGsj3nq6zWTksOuPzCT4Ul6K5CAt8AL9oWYh', '2023-04-16 01:37:43', '2023-04-15 18:37:43', NULL, 'Bonus'),
(18, 'bonus2', 'bonus2@gmail.com', NULL, '$2y$10$hw.Wviri.mtuz7AYapA2FeVnVww24rBLC.PalhkIcV7RqYwB5NwKS', NULL, '2023-04-16 02:33:21', '2023-04-15 18:41:09', NULL, 'Bonus'),
(19, 'consultant', 'consultant@gmail.com', NULL, '$2y$10$es0RHGcx/6MXLmk3uNjs8OTHSpFx8G5Mk4PfmSbnfUUDpQ8ksWViu', NULL, '2023-04-15 07:13:48', '2023-04-15 00:10:13', NULL, 'Consultant'),
(20, 'dummytools', 'dummytools@gmail.com', NULL, '$2y$10$rQ5d80riRjHzOnlzgctB8eCrpaDRyMSeKNBbNlj2YnpyXU5e7iLve', NULL, '2023-04-15 08:46:03', '2023-04-15 00:47:26', NULL, 'Tool'),
(21, 'dummyingredient', 'dummyingredient@gmail.com', NULL, '$2y$10$bHsLMiAj5KPNDmN.2xw9auU6FfJS42j8kMZNmSElwqZHVCJy3snbG', NULL, '2023-04-16 01:29:28', '2023-04-15 18:29:28', NULL, 'Ingredient'),
(22, 'dummybahan', 'dummystorebahan@gmail.com', NULL, '$2y$10$8DcJwGmRFcESDWt.uD16L.1AuKNELK6fUK8WXLFzuoZE1anVcwT..', NULL, '2023-04-15 08:46:16', '2023-04-15 00:54:30', NULL, 'AdminBahan'),
(30, 'dummydowngrade', 'dummystoredowngrade@gmail.com', NULL, '$2y$10$QpuxjYckR0cleb6iOvbFseCVlidXD8dkd0gcXVWhVLatFezmYRoEO', NULL, '2023-04-15 08:46:21', '2023-04-15 00:56:51', NULL, 'AdminDowngrade'),
(31, 'dummydnc', 'dummydnc@gmail.com', NULL, '$2y$10$7Zsb06vEd7NjIA1KlfSPl.rqtD9/vePIxEBqEvP1zzIhWHeo.b3rC', NULL, '2023-04-16 01:17:46', '2023-04-15 18:17:46', NULL, 'DnC'),
(32, 'dummyhint', 'dummyhint@gmail.com', NULL, '$2y$10$P9VpgfLKKZQGpPVUq.BxPeqIDkXq3fnS5KyPAfc0tV8hJMS1XbxiO', NULL, '2023-04-15 08:46:28', '2023-04-15 00:58:57', NULL, 'AdminHint'),
(33, 'dummybonus', 'dummybonus@gmail.com', NULL, '$2y$10$x7vMgmebe5FnjPgArGfRk.ygUkS4oiFlp1CR/Mhn33vc2Ur63b6Zq', NULL, '2023-04-15 08:46:33', '2023-04-15 01:00:29', NULL, 'Bonus'),
(34, 'dummyconsultant', 'dummyconsultant@gmail.com', NULL, '$2y$10$tDVGWyMhEcKQJXS8Qeju8eDIoe1zQsTHUyeiPaViWUmoKvMUaOGqK', NULL, '2023-04-15 08:46:39', '2023-04-15 01:01:49', NULL, 'Consultant'),
(45, 'user37', 'user37@gmail.com', NULL, '$2y$10$DiBk15NN0V6gIyckYrZA6egcVyLIaucVh0.SsJg8F9xfSCl6WT/Tq', NULL, '2023-04-16 01:22:32', '2023-04-15 18:22:32', 11, 'Player'),
(46, 'user39', 'user39@gmail.com', NULL, '$2y$10$9OwLXMIvqlPrHYoHjzol0.1DA.ABsdx67WyOkqxqfiWYUoZanQLXu', NULL, '2023-04-16 02:33:26', '2023-04-15 18:23:59', 12, 'Player'),
(47, 'user45', 'user45@gmail.com', NULL, '$2y$10$7qX8R9QVtzK8tVmZ/Z4c3.35oUqPVfaAXn3XvrbRZmXZvi9JYqSmS', NULL, '2023-04-15 08:48:15', '2023-04-15 01:05:47', 13, 'Player'),
(48, 'user50', 'user50@gmail.com', NULL, '$2y$10$//kLQTAPnc2cAFI3co09X.wL9.hiobBiSBt.yAf3UUUs35wj22Ifu', NULL, '2023-04-15 14:59:04', '2023-04-15 01:06:06', 14, 'Player'),
(49, 'user94', 'user94@gmail.com', NULL, '$2y$10$IFIkacSwgy39gmR1lcHioejlCssWZos2NLNqdGB5kkQWnAejRYubC', NULL, '2023-04-15 14:59:09', '2023-04-15 01:06:25', 15, 'Player');

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
  MODIFY `idinventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

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
  MODIFY `idteams` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
