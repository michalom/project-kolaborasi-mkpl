-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2018 at 07:46 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detil_hilang`
--

CREATE TABLE `detil_hilang` (
  `no_hilang` int(15) DEFAULT NULL,
  `no_peminjaman` int(15) DEFAULT NULL,
  `no_copy` int(15) DEFAULT NULL,
  `jml_hilang` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_kembali`
--

CREATE TABLE `detil_kembali` (
  `no_pengembalian` int(15) DEFAULT NULL,
  `no_copy` int(15) DEFAULT NULL,
  `ket` varchar(20) DEFAULT NULL,
  `jml_kembali` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_pinjam`
--

CREATE TABLE `detil_pinjam` (
  `no_peminjaman` int(15) DEFAULT NULL,
  `no_copy` int(15) DEFAULT NULL,
  `jml_pinjam` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `no_anggota` int(15) NOT NULL,
  `nama_anggota` varchar(30) DEFAULT NULL,
  `jabatan` varchar(10) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `no_buku` int(15) NOT NULL,
  `judul_buku` varchar(40) DEFAULT NULL,
  `pengarang` varchar(40) DEFAULT NULL,
  `penerbit` varchar(40) DEFAULT NULL,
  `thn_terbit` char(10) DEFAULT NULL,
  `thn_beli` char(10) DEFAULT NULL,
  `asal_buku` varchar(40) DEFAULT NULL,
  `eks` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_copybuku`
--

CREATE TABLE `tb_copybuku` (
  `no_copy` int(15) NOT NULL,
  `no_buku` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gantibuku`
--

CREATE TABLE `tb_gantibuku` (
  `no_ganti` int(15) NOT NULL,
  `no_hilang` int(15) DEFAULT NULL,
  `tgl_ganti` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_hilang`
--

CREATE TABLE `tb_hilang` (
  `no_hilang` int(15) NOT NULL,
  `no_peminjaman` int(10) DEFAULT NULL,
  `tgl_hilang` date DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '0 belum diganti, 1= sudah diganti '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kunjungan`
--

CREATE TABLE `tb_kunjungan` (
  `no_kunjungan` varchar(20) NOT NULL,
  `no_anggota` int(15) DEFAULT NULL,
  `ket` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `no_peminjaman` int(15) NOT NULL,
  `no_anggota` int(15) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '0 belum dikembalikan, 1= sudah dikembalikan '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `no_pengembalian` int(15) NOT NULL,
  `no_peminjaman` int(15) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detil_hilang`
--
ALTER TABLE `detil_hilang`
  ADD KEY `no_hilang` (`no_hilang`),
  ADD KEY `detil_hilang_ibfk_2` (`no_peminjaman`),
  ADD KEY `no_copy` (`no_copy`);

--
-- Indexes for table `detil_kembali`
--
ALTER TABLE `detil_kembali`
  ADD KEY `no_pengembalian` (`no_pengembalian`),
  ADD KEY `no_copy` (`no_copy`);

--
-- Indexes for table `detil_pinjam`
--
ALTER TABLE `detil_pinjam`
  ADD KEY `no_copy` (`no_copy`),
  ADD KEY `no_peminjaman` (`no_peminjaman`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`no_anggota`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`no_buku`);

--
-- Indexes for table `tb_copybuku`
--
ALTER TABLE `tb_copybuku`
  ADD PRIMARY KEY (`no_copy`),
  ADD KEY `no_buku` (`no_buku`);

--
-- Indexes for table `tb_gantibuku`
--
ALTER TABLE `tb_gantibuku`
  ADD PRIMARY KEY (`no_ganti`),
  ADD KEY `no_hilang` (`no_hilang`);

--
-- Indexes for table `tb_hilang`
--
ALTER TABLE `tb_hilang`
  ADD PRIMARY KEY (`no_hilang`),
  ADD KEY `no_peminjaman` (`no_peminjaman`);

--
-- Indexes for table `tb_kunjungan`
--
ALTER TABLE `tb_kunjungan`
  ADD PRIMARY KEY (`no_kunjungan`),
  ADD KEY `no_anggota` (`no_anggota`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`no_peminjaman`),
  ADD KEY `no_anggota` (`no_anggota`);

--
-- Indexes for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`no_pengembalian`),
  ADD KEY `no_peminjaman` (`no_peminjaman`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detil_hilang`
--
ALTER TABLE `detil_hilang`
  ADD CONSTRAINT `detil_hilang_ibfk_1` FOREIGN KEY (`no_hilang`) REFERENCES `tb_hilang` (`no_hilang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_hilang_ibfk_2` FOREIGN KEY (`no_peminjaman`) REFERENCES `tb_peminjaman` (`no_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_hilang_ibfk_3` FOREIGN KEY (`no_copy`) REFERENCES `tb_copybuku` (`no_copy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detil_kembali`
--
ALTER TABLE `detil_kembali`
  ADD CONSTRAINT `detil_kembali_ibfk_1` FOREIGN KEY (`no_pengembalian`) REFERENCES `tb_pengembalian` (`no_pengembalian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_kembali_ibfk_2` FOREIGN KEY (`no_copy`) REFERENCES `tb_copybuku` (`no_copy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detil_pinjam`
--
ALTER TABLE `detil_pinjam`
  ADD CONSTRAINT `detil_pinjam_ibfk_1` FOREIGN KEY (`no_copy`) REFERENCES `tb_copybuku` (`no_copy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detil_pinjam_ibfk_2` FOREIGN KEY (`no_peminjaman`) REFERENCES `tb_peminjaman` (`no_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_copybuku`
--
ALTER TABLE `tb_copybuku`
  ADD CONSTRAINT `tb_copybuku_ibfk_1` FOREIGN KEY (`no_buku`) REFERENCES `tb_buku` (`no_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_gantibuku`
--
ALTER TABLE `tb_gantibuku`
  ADD CONSTRAINT `tb_gantibuku_ibfk_1` FOREIGN KEY (`no_hilang`) REFERENCES `tb_hilang` (`no_hilang`);

--
-- Constraints for table `tb_hilang`
--
ALTER TABLE `tb_hilang`
  ADD CONSTRAINT `tb_hilang_ibfk_1` FOREIGN KEY (`no_peminjaman`) REFERENCES `tb_peminjaman` (`no_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kunjungan`
--
ALTER TABLE `tb_kunjungan`
  ADD CONSTRAINT `tb_kunjungan_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `tb_anggota` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `tb_anggota` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD CONSTRAINT `tb_pengembalian_ibfk_1` FOREIGN KEY (`no_peminjaman`) REFERENCES `tb_peminjaman` (`no_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
