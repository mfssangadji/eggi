-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2020 at 11:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s11_eggi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelompok`
--

CREATE TABLE `tbl_kelompok` (
  `id_kelompok` int(5) NOT NULL,
  `nama_kelompok` varchar(100) NOT NULL,
  `tanggal_registrasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kelompok`
--

INSERT INTO `tbl_kelompok` (`id_kelompok`, `nama_kelompok`, `tanggal_registrasi`) VALUES
(9, 'Python Coder', '2020-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaki`
--

CREATE TABLE `tbl_pendaki` (
  `id_pendaki` int(5) NOT NULL,
  `id_kelompok` int(5) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `umur` varchar(30) NOT NULL,
  `no_telp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendaki`
--

INSERT INTO `tbl_pendaki` (`id_pendaki`, `id_kelompok`, `nik`, `nama_lengkap`, `jenis_kelamin`, `umur`, `no_telp`) VALUES
(10, 9, '8721022409900001', 'Muh. Fadly Sangadji', 'Laki-laki', '30', '085298249823'),
(11, 9, '2123654', 'fff', 'Laki-laki', '56', '5555'),
(12, 9, '255', 'ff', 'Laki-laki', '23', '222'),
(13, 9, '266', 'grhgr', 'Laki-laki', '3233', '6232'),
(14, 9, '552', 'fff', 'Laki-laki', '23', '555'),
(15, 9, '555', 'fff', 'Laki-laki', '23', '255'),
(16, 9, '32665', 'yyrye', 'Laki-laki', '6565', '6464'),
(17, 9, '62662', 'djjdu', 'Laki-laki', '2', '233'),
(18, 9, '233', 'ftf', 'Laki-laki', '23', '23'),
(19, 9, '566', 'ggg', 'Laki-laki', '26', '255'),
(20, 9, '333', 'ttt', 'Laki-laki', '23', '66'),
(21, 9, '552', 'rr', 'Laki-laki', '52', '55'),
(22, 9, '555', 'fff', 'Laki-laki', '23', '23'),
(23, 9, '555', 'fff', 'Laki-laki', '23', '23'),
(24, 9, '233', 'ggg', 'Laki-laki', '23', '23'),
(25, 9, '155', 'nama', 'Laki-laki', '23', '08529824'),
(26, 9, '155', 'nama', 'Laki-laki', '23', '08529824'),
(27, 9, '12345', 'nam', 'Laki-laki', '23', '0852'),
(28, 9, '12345', 'nam', 'Laki-laki', '23', '0852'),
(29, 9, '12345', 'nam', 'Laki-laki', '23', '0852'),
(30, 9, '22222', 'ggg', 'Laki-laki', '233', '223'),
(31, 9, '222', 'ggg', 'Laki-laki', '23', '233'),
(32, 9, '233', 'ghg', 'Laki-laki', '855', '223'),
(33, 9, '3666', 'fgg', 'Laki-laki', '233', '23'),
(34, 9, '3322', 'yuu', 'Laki-laki', '666', '33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendakian`
--

CREATE TABLE `tbl_pendakian` (
  `id_pendakian` int(5) NOT NULL,
  `id_kelompok` int(5) NOT NULL,
  `tanggal_pendakian` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_pendakian` tinyint(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendakian`
--

INSERT INTO `tbl_pendakian` (`id_pendakian`, `id_kelompok`, `tanggal_pendakian`, `tanggal_selesai`, `status_pendakian`) VALUES
(54, 8, '2020-04-11', '2020-04-11', 2),
(55, 9, '2020-05-11', '2020-05-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_persyaratan`
--

CREATE TABLE `tbl_persyaratan` (
  `id_persyaratan` int(5) NOT NULL,
  `persyaratan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_persyaratan`
--

INSERT INTO `tbl_persyaratan` (`id_persyaratan`, `persyaratan`) VALUES
(3, 'contoh persyaratan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_kelompok`
--
ALTER TABLE `tbl_kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `tbl_pendaki`
--
ALTER TABLE `tbl_pendaki`
  ADD PRIMARY KEY (`id_pendaki`);

--
-- Indexes for table `tbl_pendakian`
--
ALTER TABLE `tbl_pendakian`
  ADD PRIMARY KEY (`id_pendakian`);

--
-- Indexes for table `tbl_persyaratan`
--
ALTER TABLE `tbl_persyaratan`
  ADD PRIMARY KEY (`id_persyaratan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_kelompok`
--
ALTER TABLE `tbl_kelompok`
  MODIFY `id_kelompok` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_pendaki`
--
ALTER TABLE `tbl_pendaki`
  MODIFY `id_pendaki` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_pendakian`
--
ALTER TABLE `tbl_pendakian`
  MODIFY `id_pendakian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_persyaratan`
--
ALTER TABLE `tbl_persyaratan`
  MODIFY `id_persyaratan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
