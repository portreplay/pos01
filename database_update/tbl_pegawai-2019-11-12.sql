-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 12:03 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portrepl_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `kd_pegawai` varchar(30) NOT NULL DEFAULT '0',
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `level` enum('pegawai','admin') DEFAULT 'pegawai',
  `login` int(1) DEFAULT 0,
  `tgl_daftar` date DEFAULT NULL,
  `active` int(1) DEFAULT 0,
  `role` enum('gudang','cabang','multi') DEFAULT NULL,
  `kd_pelanggan` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`kd_pegawai`, `username`, `password`, `nama`, `email`, `level`, `login`, `tgl_daftar`, `active`, `role`, `kd_pelanggan`) VALUES
('70A-D', 'gudang', '202446dd1d6028084426867365b0c7a1', 'Gudang', 'bagiangudang@gmail.com', 'pegawai', 1, '2015-04-05', 1, 'gudang', NULL),
('A001', 'admin', '27965cbf5011e70023b5d5d69f89d14a', 'Super Administrator', '', 'admin', 0, '2019-10-10', 1, 'gudang', NULL),
('C-S-003', 'cabang', '2567a5ec9705eb7ac2c984033e06189d', 'Cabang', 'cabang@gmail.com', 'pegawai', 0, '2015-05-07', 1, 'cabang', '001'),
('F400', 'fazrikp13', 'd82322213ad2d533997c9bb064d6630c', 'Fazri Kusumah Putra', 'ffffffff@mail.com', 'admin', 0, '2019-10-10', 1, 'cabang', '003'),
('F401', 'fazrikp', 'd82322213ad2d533997c9bb064d6630c', 'Fazri Kusumah Putra', 'fazrikp13@gmail.com', 'admin', 0, '2019-10-10', 1, 'gudang', NULL),
('P0001', 'toko1', '827ccb0eea8a706c4c34a16891f84e7b', 'Toko 1', 'toko1@mail.com', 'pegawai', 0, '2019-11-12', 1, 'cabang', '002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`kd_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
