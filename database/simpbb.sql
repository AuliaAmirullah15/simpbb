-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2021 at 07:16 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simpbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dpa_per_bulan`
--

CREATE TABLE IF NOT EXISTS `dpa_per_bulan` (
`id_DPA` int(50) NOT NULL,
  `DPA` int(30) NOT NULL,
  `id_kategori` int(50) NOT NULL,
  `id_sub_unit` int(50) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(4) NOT NULL,
  `status_validasi` enum('belum','sudah','diajukan') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dpa_per_bulan`
--

INSERT INTO `dpa_per_bulan` (`id_DPA`, `DPA`, `id_kategori`, `id_sub_unit`, `bulan`, `tahun`, `status_validasi`) VALUES
(9, 3000000, 1, 2, '3', 2019, 'sudah'),
(10, 3000000, 2, 2, '3', 2019, 'sudah'),
(11, 3000000, 3, 2, '3', 2019, 'sudah'),
(12, 3000000, 4, 2, '3', 2019, 'sudah'),
(25, 1000000, 1, 1, '4', 2019, 'belum'),
(26, 2000000, 2, 1, '4', 2019, 'belum'),
(27, 3500000, 3, 1, '4', 2019, 'belum'),
(28, 1500000, 4, 1, '4', 2019, 'belum');

--
-- Triggers `dpa_per_bulan`
--
DELIMITER //
CREATE TRIGGER `Hapus_Permintaan_On_DPA` BEFORE DELETE ON `dpa_per_bulan`
 FOR EACH ROW BEGIN
DELETE FROM permintaan WHERE permintaan.id_DPA = OLD.id_DPA;
END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `UPDATE_diajukan` AFTER UPDATE ON `dpa_per_bulan`
 FOR EACH ROW BEGIN
	IF NEW.status_validasi = 'sudah' THEN
    	UPDATE permintaan SET status_validasi = 'diterima' WHERE id_DPA = OLD.id_DPA;
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `dpa_per_bulan_nama_kategori`
--
CREATE TABLE IF NOT EXISTS `dpa_per_bulan_nama_kategori` (
`id_DPA` int(50)
,`id_sub_unit` int(50)
,`DPA` int(30)
,`bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12')
,`tahun` int(4)
,`status_validasi` enum('belum','sudah','diajukan')
,`id_kategori` int(50)
,`nama_kategori` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `kategori_permintaan`
--

CREATE TABLE IF NOT EXISTS `kategori_permintaan` (
`id_kategori` int(50) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `status_aktifasi` enum('on','off') NOT NULL,
  `tgl_pembuatan` date NOT NULL,
  `biaya` int(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_permintaan`
--

INSERT INTO `kategori_permintaan` (`id_kategori`, `nama_kategori`, `status_aktifasi`, `tgl_pembuatan`, `biaya`) VALUES
(1, 'Bahan Minuman', 'on', '2019-06-12', 1000000),
(2, 'Biaya Keperluan Perkantoran', 'on', '2019-06-12', 2000000),
(3, 'Pemeliharaan Peralatan dan Mesin', 'on', '2019-06-12', 3500000),
(4, 'Pemeliharaan Gedung dan Bangunan', 'on', '2019-06-12', 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE IF NOT EXISTS `permintaan` (
`id_permintaan` int(50) NOT NULL,
  `id_DPA` int(50) NOT NULL,
  `permintaan` varchar(200) NOT NULL,
  `kuantitas` int(30) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_satuan` int(60) NOT NULL,
  `harga_total` int(60) NOT NULL,
  `status_validasi` enum('belum','sudah','diajukan','diterima','ditolak') NOT NULL,
  `tgl_permintaan` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `id_DPA`, `permintaan`, `kuantitas`, `satuan`, `harga_satuan`, `harga_total`, `status_validasi`, `tgl_permintaan`) VALUES
(1, 9, 'Gula', 1, 'kilogram', 10000, 10000, 'ditolak', '2019-06-12'),
(3, 9, 'Air Mineral', 10, 'Botol', 8000, 80000, 'diterima', '2019-06-12'),
(4, 9, 'Bubuk Teh', 2, 'kotak', 10000, 20000, 'diterima', '2019-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `sub_unit`
--

CREATE TABLE IF NOT EXISTS `sub_unit` (
`id_sub_unit` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `nama_sub_unit` varchar(100) NOT NULL,
  `level` enum('S1','S2','S3','Fakultas') NOT NULL,
  `status_aktif` enum('on','off') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_unit`
--

INSERT INTO `sub_unit` (`id_sub_unit`, `id_user`, `nama_sub_unit`, `level`, `status_aktif`) VALUES
(1, 2, 'Kasubbag Perlengkapan', 'Fakultas', 'on'),
(2, 3, 'Tata Usaha S1 Teknologi Informasi', 'S1', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(50) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `level`, `username`, `password`) VALUES
(1, 'Wakil Dekan II', '1', 'wakil_dekan_2', 'c2beab94414d5311c0e3674900bfa5d7'),
(2, 'Kasubbag Perlengkapan', '2', 'kasubbag_perlengkapan', '3871266f772dfeb86738128edcbea21d'),
(3, 'Tata Usaha S1 Teknologi Informasi', '3', 's1_ti', '2415d5b00d4c176b21edd91e772c71aa');

-- --------------------------------------------------------

--
-- Structure for view `dpa_per_bulan_nama_kategori`
--
DROP TABLE IF EXISTS `dpa_per_bulan_nama_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dpa_per_bulan_nama_kategori` AS select `a`.`id_DPA` AS `id_DPA`,`a`.`id_sub_unit` AS `id_sub_unit`,`a`.`DPA` AS `DPA`,`a`.`bulan` AS `bulan`,`a`.`tahun` AS `tahun`,`a`.`status_validasi` AS `status_validasi`,`a`.`id_kategori` AS `id_kategori`,`b`.`nama_kategori` AS `nama_kategori` from (`dpa_per_bulan` `a` join `kategori_permintaan` `b`) where (`a`.`id_kategori` = `b`.`id_kategori`);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dpa_per_bulan`
--
ALTER TABLE `dpa_per_bulan`
 ADD PRIMARY KEY (`id_DPA`), ADD KEY `id_sub_unit` (`id_sub_unit`) USING BTREE, ADD KEY `id_kategori` (`id_kategori`) USING BTREE;

--
-- Indexes for table `kategori_permintaan`
--
ALTER TABLE `kategori_permintaan`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
 ADD PRIMARY KEY (`id_permintaan`), ADD KEY `id_DPA` (`id_DPA`) USING BTREE;

--
-- Indexes for table `sub_unit`
--
ALTER TABLE `sub_unit`
 ADD PRIMARY KEY (`id_sub_unit`), ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dpa_per_bulan`
--
ALTER TABLE `dpa_per_bulan`
MODIFY `id_DPA` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `kategori_permintaan`
--
ALTER TABLE `kategori_permintaan`
MODIFY `id_kategori` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
MODIFY `id_permintaan` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sub_unit`
--
ALTER TABLE `sub_unit`
MODIFY `id_sub_unit` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dpa_per_bulan`
--
ALTER TABLE `dpa_per_bulan`
ADD CONSTRAINT `dpa_per_bulan_ibfk_2` FOREIGN KEY (`id_sub_unit`) REFERENCES `sub_unit` (`id_sub_unit`) ON UPDATE CASCADE,
ADD CONSTRAINT `dpa_per_bulan_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_permintaan` (`id_kategori`);

--
-- Constraints for table `permintaan`
--
ALTER TABLE `permintaan`
ADD CONSTRAINT `permintaan_ibfk_1` FOREIGN KEY (`id_DPA`) REFERENCES `dpa_per_bulan` (`id_DPA`) ON UPDATE CASCADE;

--
-- Constraints for table `sub_unit`
--
ALTER TABLE `sub_unit`
ADD CONSTRAINT `sub_unit_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
