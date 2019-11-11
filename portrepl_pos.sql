-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Okt 2019 pada 10.45
-- Versi server: 10.3.18-MariaDB-cll-lve
-- Versi PHP: 7.2.7

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
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kd_barang` varchar(25) NOT NULL,
  `nm_barang` varchar(25) NOT NULL,
  `stok` int(10) NOT NULL,
  `harga_beli` int(15) DEFAULT NULL,
  `harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`kd_barang`, `nm_barang`, `stok`, `harga_beli`, `harga`) VALUES
('BRPB12-BR', 'Bermuda Pant Brown', 210, 265000, 295000),
('JKTDNM-DB', 'Jaket Denim Trucker Dark ', 159, 259000, 429000),
('JKTDNM-LB', 'Jaket Denim Trucker Light', 200, 259000, 429000),
('JKTDNM-WB', 'Denim Trucker Washed Blue', 255, 259000, 429000),
('KMJPR- MIX', 'Kemeja', 90, 880000, 990000),
('LPCTN01BK', 'teslahi', 12, 110000, 220000),
('LPCTN01LG', 'ASAII', 6, 110000, 220000),
('LPCTN01OL', 'MLPD', 5, 120000, 220000),
('LPDENIMMAN', 'Long Pant Denim Man', 90, 120000, 130000),
('LPJGPR-1GY', 'Long Pants Jeans Grey', 119, 360000, 429000),
('LPJGPR-BB', 'Long Pant Jeans Hitam', 124, 360000, 429000),
('LPJGPR-BR', 'Long Pant Jeans Brown', 121, 360000, 429000),
('LPJGPR-CH', 'Long Pant Jeans Chocolate', 225, 360000, 429000),
('LPJGPR-KH', 'Long Pant Jeans Khaki', 200, 360000, 429000),
('PRB1901H', ' Bag', 75, 325000, 480000),
('PRH1901H', ' Hat', 74, 55000, 125000),
('PRJ1901H', 'Jacket', 150, 259000, 429000),
('PRLP1901H', 'Long Pants', 226, 159000, 225000),
('PRLS1901H', 'Shirt Long Sleeve', 55, 75000, 125000),
('PRO1901H', 'Overall', 250, 250000, 300000),
('PRSP1901H', 'Short Pants', 223, 159000, 225000),
('PRSS1901H', 'Shirt Short Sleeve', 150, 65000, 90000),
('PRSW1901H', 'Sweater', 175, 175000, 235000),
('PRTLS1901', 'T-Shirt Long Sleeve', 21, 175000, 220000),
('PRTSS1901H', 'T-Shirt Short Sleeve', 22, 125000, 150000),
('PRV1901H', 'Vest', 250, 225000, 300000),
('PRW1901', 'Wallet', 55, 265000, 325000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(1) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `owner` varchar(30) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `nama`, `alamat`, `telp`, `email`, `website`, `owner`, `desc`) VALUES
(1, 'Dira Bandung Fashion', 'Komplek Parmindo<br/>Jl. Candi Baru R.11', '0226122476', '0226122476', 'http://yusfreak.com', 'Yus Syaeful', 'Fashion Remaja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
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
  `role` enum('gudang','cabang','multi') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`kd_pegawai`, `username`, `password`, `nama`, `email`, `level`, `login`, `tgl_daftar`, `active`, `role`) VALUES
('70A-D', 'gudang', '202446dd1d6028084426867365b0c7a1', 'Gudang', 'bagiangudang@gmail.com', 'pegawai', 1, '2015-04-05', 1, 'gudang'),
('A001', 'admin', '27965cbf5011e70023b5d5d69f89d14a', 'Super Administrator', '', 'admin', 0, '2019-10-10', 1, 'gudang'),
('C-S-003', 'cabang', '2567a5ec9705eb7ac2c984033e06189d', 'Cabang', 'cabang@gmail.com', 'pegawai', 0, '2015-05-07', 1, 'cabang'),
('F400', 'fazrikp13', 'd82322213ad2d533997c9bb064d6630c', 'Fazri Kusumah Putra', 'ffffffff@mail.com', 'admin', 0, '2019-10-10', 1, 'cabang'),
('F401', 'fazrikp', 'd82322213ad2d533997c9bb064d6630c', 'Fazri Kusumah Putra', 'fazrikp13@gmail.com', 'admin', 0, '2019-10-10', 1, 'gudang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `kd_pelanggan` varchar(5) NOT NULL,
  `nm_pelanggan` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `handphone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`kd_pelanggan`, `nm_pelanggan`, `alamat`, `email`, `telepon`, `handphone`) VALUES
('001', 'Toko Offline Port Replay', 'Offline - Bandung 1', 'bandung1@mail.com', '', ''),
('002', 'Toko Offline Port Replay', 'Offline - Bandung 2', 'bandung2@yahoo.com', '', ''),
('003', 'Toko Offline Port Replay', 'Offline - Cirebon', 'cirebon1@hotmail.com', '', ''),
('004', 'Toko Offline Port Replay', 'Offline - Malang', 'malang@mail.com', '', ''),
('005', 'Toko Online Port Replay', 'Online', 'onlineportreplay@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan_detail`
--

CREATE TABLE `tbl_penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL,
  `kd_penjualan` varchar(10) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `diskon` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penjualan_detail`
--

INSERT INTO `tbl_penjualan_detail` (`id_penjualan_detail`, `kd_penjualan`, `kd_barang`, `qty`, `harga`, `diskon`) VALUES
(7, 'T456654', 'KMJPR- MIX', 2, '990000', '0'),
(10, 'T239482', 'KMJPR- MIX', 1, '990000', '0'),
(13, 'T23453', 'LPCTN01BK', 1, '220000', '0'),
(15, 'T0091239', 'LPJGPR-BB', 1, '429000', '0'),
(18, 'T0012', 'LPJGPR-1GY', 2, '429000', '0'),
(19, 'T001232', 'BRPB12-BR', 15, '295000', '0'),
(20, 'T1231', 'PRTLS1901', 2, '220000', '0'),
(21, 'T1231', 'PRTLS1901', 2, '220000', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan_header`
--

CREATE TABLE `tbl_penjualan_header` (
  `kd_penjualan` varchar(10) NOT NULL,
  `kd_pelanggan` varchar(10) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `kd_pegawai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penjualan_header`
--

INSERT INTO `tbl_penjualan_header` (`kd_penjualan`, `kd_pelanggan`, `total_harga`, `tanggal_penjualan`, `kd_pegawai`) VALUES
('T0012', '005', '858000', '2019-10-23', 'A001'),
('T001232', '001', '4425000', '2019-10-23', 'A001'),
('T0091239', '005', '429000', '2019-10-23', 'A001'),
('T1231', '001', '440000', '2019-10-23', 'A001'),
('T23453', '004', '220000', '2019-10-23', 'A001'),
('T239482', '005', '990000', '2019-10-23', 'A001'),
('T456654', '001', '1980000', '2019-10-23', 'A001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_retur_toko`
--

CREATE TABLE `tbl_retur_toko` (
  `kd_retur` varchar(10) NOT NULL,
  `tgl_retur` date NOT NULL,
  `kd_penjualan` varchar(10) NOT NULL,
  `kd_barang` varchar(5) NOT NULL,
  `replace_kd_barang` varchar(5) NOT NULL,
  `jenis_retur` varchar(20) NOT NULL,
  `biaya` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_stok_toko`
--

CREATE TABLE `tbl_stok_toko` (
  `id_stok_barang` int(11) NOT NULL,
  `kd_pelanggan` varchar(5) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `stok` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `biaya_expedisi` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_stok_toko`
--

INSERT INTO `tbl_stok_toko` (`id_stok_barang`, `kd_pelanggan`, `kd_barang`, `stok`, `harga`, `biaya_expedisi`) VALUES
(1, '005', '02010', '28', '90000', '0'),
(2, '003', '02010', '50', '90000', '0'),
(3, '005', '01910', '2', '120000', '0'),
(4, '001', '0719LPJGPR', '1', '21', '0'),
(5, '001', '0719LPJGPR', '1', '21', '0'),
(6, '001', '0719LPJGPR', '2', '21', '0'),
(7, '001', 'KMJPR- MIX', '2', '990000', '0'),
(8, '005', '0719LPJGPR', '1', '200000', '0'),
(9, '005', '08819BRPB-', '10', '560000', '0'),
(10, '005', 'KMJPR- MIX', '1', '990000', '0'),
(11, '004', '0719LPJGPR', '1', '230000', '0'),
(12, '002', '08819BRPB1', '10', '330000', '0'),
(13, '004', 'LPCTN01BK', '1', '220000', '0'),
(14, '001', '0719LPJGPR', '25', '429000', '0'),
(15, '005', 'LPJGPR-BB', '1', '429000', '0'),
(16, '005', 'DJPARKALD0', '1', '88000', '0'),
(17, '001', '0719LPJGPR', '15', '356000', '0'),
(18, '005', 'LPJGPR-1GY', '2', '429000', '0'),
(19, '001', 'BRPB12-BR', '15', '295000', '0'),
(20, '001', 'PRTLS1901', '2', '220000', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_terjual_toko`
--

CREATE TABLE `tbl_terjual_toko` (
  `tanggal` date NOT NULL,
  `kd_penjualan` varchar(10) NOT NULL,
  `kd_pelanggan` varchar(5) NOT NULL,
  `kd_pegawai` varchar(5) NOT NULL,
  `total_harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_terjual_toko`
--

INSERT INTO `tbl_terjual_toko` (`tanggal`, `kd_penjualan`, `kd_pelanggan`, `kd_pegawai`, `total_harga`) VALUES
('2019-10-23', '2342', '001', 'A001', '440000'),
('2019-10-10', 'TN001', '005', 'F401', '270000'),
('2019-10-10', 'TN002', '005', 'F401', '180000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_terjual_toko_detail`
--

CREATE TABLE `tbl_terjual_toko_detail` (
  `kd_penjualan` varchar(10) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `diskon` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_terjual_toko_detail`
--

INSERT INTO `tbl_terjual_toko_detail` (`kd_penjualan`, `kd_barang`, `qty`, `harga`, `diskon`) VALUES
('TN001', '02010', 3, '90000', '0'),
('TN002', '02010', 2, '90000', '0'),
('2342', 'PRTLS1901', 2, '220000', '0');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indeks untuk tabel `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`kd_pegawai`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`kd_pelanggan`);

--
-- Indeks untuk tabel `tbl_penjualan_detail`
--
ALTER TABLE `tbl_penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`),
  ADD KEY `kd_barang` (`kd_barang`),
  ADD KEY `kd_penjualan` (`kd_penjualan`);

--
-- Indeks untuk tabel `tbl_penjualan_header`
--
ALTER TABLE `tbl_penjualan_header`
  ADD PRIMARY KEY (`kd_penjualan`),
  ADD KEY `kd_pegawai` (`kd_pegawai`),
  ADD KEY `kd_pelanggan` (`kd_pelanggan`);

--
-- Indeks untuk tabel `tbl_retur_toko`
--
ALTER TABLE `tbl_retur_toko`
  ADD PRIMARY KEY (`kd_retur`);

--
-- Indeks untuk tabel `tbl_stok_toko`
--
ALTER TABLE `tbl_stok_toko`
  ADD PRIMARY KEY (`id_stok_barang`);

--
-- Indeks untuk tabel `tbl_terjual_toko`
--
ALTER TABLE `tbl_terjual_toko`
  ADD PRIMARY KEY (`kd_penjualan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan_detail`
--
ALTER TABLE `tbl_penjualan_detail`
  MODIFY `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_stok_toko`
--
ALTER TABLE `tbl_stok_toko`
  MODIFY `id_stok_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
