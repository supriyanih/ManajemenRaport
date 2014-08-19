-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2014 at 02:21 
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `raport`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE IF NOT EXISTS `absen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kls` varchar(20) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `semester` int(10) NOT NULL,
  `sakit` int(10) NOT NULL,
  `ijin` int(10) NOT NULL,
  `alpha` int(10) NOT NULL,
  `lambat` int(10) NOT NULL,
  `dispensasi` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `kd_kls`, `nis`, `semester`, `sakit`, `ijin`, `alpha`, `lambat`, `dispensasi`) VALUES
(11, 'XII13-14', '10552016854', 1, 1, 1, 1, 1, 1),
(12, 'XII13-14', '10552016854', 2, 0, 0, 0, 0, 0),
(13, 'XII13-14', '2222', 1, 1, 1, 1, 1, 1),
(14, 'XII13-14', '1111111', 1, 0, 0, 0, 0, 0),
(15, 'XII13-14', '11201145511', 1, 0, 0, 0, 0, 0),
(16, 'XII13-14', '1111111', 2, 0, 0, 0, 0, 0),
(17, 'XII13-14', '11201145511', 2, 0, 0, 0, 0, 0),
(18, 'XII13-14', '2222', 2, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapel` varchar(20) NOT NULL,
  `pengajar` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `ruangan` varchar(20) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` varchar(20) NOT NULL,
  `jam_selesai` varchar(20) NOT NULL,
  `status` enum('aktif','selesai') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mapel` (`mapel`,`pengajar`,`kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `mapel`, `pengajar`, `kelas`, `jurusan`, `ruangan`, `hari`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(1, 'BHSINDO', '1055204101', 'XII13-14', 'Farmasi', 'XII/2a', 'selasa', '7:00', '8:00', 'aktif'),
(2, 'FSK0A', '1055201182', 'XII13-14', 'Farmasi', 'F 3', 'Kamis', '09:00', '10:00', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `kd_jurusan` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kd_jurusan`, `jurusan`) VALUES
('FRM', 'Farmasi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kd_kelas` varchar(20) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `thn_ajaran` varchar(20) NOT NULL,
  `wali_kelas` varchar(20) NOT NULL,
  `status` enum('aktif','selesai') NOT NULL,
  PRIMARY KEY (`kd_kelas`),
  UNIQUE KEY `wali_kelas` (`wali_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `kelas`, `thn_ajaran`, `wali_kelas`, `status`) VALUES
('XFa13', 'X Farmasi 2013-2014', '2013-2014', '1055204101', 'aktif'),
('XII13-14', 'XII/2013-2014', '2013-2014', '1055201182', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `kd_mapel` varchar(20) NOT NULL,
  `mapel` varchar(50) NOT NULL,
  `kkm` double NOT NULL,
  PRIMARY KEY (`kd_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `mapel`, `kkm`) VALUES
('BHSINDO', 'Bahasa indonesia', 70),
('FSK0A', 'Fisika', 70),
('MTK', 'matematika', 70);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` tinyint(10) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `semester` tinyint(2) NOT NULL,
  `kls` varchar(10) NOT NULL,
  `harian` double NOT NULL,
  `uts` double NOT NULL,
  `uas` double NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_jadwal`, `nis`, `semester`, `kls`, `harian`, `uts`, `uas`) VALUES
(1, 1, '10552016854', 1, 'XII13-14', 77, 77, 77),
(3, 1, '2222', 1, 'XII13-14', 99, 99, 99),
(4, 1, '10552016854', 2, 'XII13-14', 99, 99, 99),
(5, 1, '1111111', 2, 'XII13-14', 88, 88, 88),
(6, 1, '2222', 2, 'XII13-14', 77, 77, 77),
(12, 2, '1111111', 1, 'XII13-14', 77, 77, 77),
(13, 2, '11201145511', 1, 'XII13-14', 79, 79, 79),
(14, 2, '2222', 1, 'XII13-14', 75, 75, 75),
(15, 2, '10552016854', 1, 'XII13-14', 88, 88, 88);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `thn_masuk` varchar(20) NOT NULL,
  `wali_siswa` varchar(50) NOT NULL,
  `telpon_wali` varchar(15) NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `tempat`, `tgl_lahir`, `jenkel`, `kelas`, `jurusan`, `alamat`, `thn_masuk`, `wali_siswa`, `telpon_wali`) VALUES
('104422', 'ilham', 'samosir', '2014-08-11', 'L', 'XFa13', 'Farmasi', 'jl.tangerang raya', '2014', 'jaya ', '0111111111'),
('104423', 'sayadah ', 'tangerang', '2014-08-11', 'P', 'XFa13', 'Farmasi', 'jl.pelayangan cilenggang serpong', '2014', 'sanusi', '1023334499'),
('10552016854', 'ahmad wardana', 'jakarta', '2014-08-01', 'L', 'XII13-14', 'FRM', 'jl cilidug indah no 22', '2013', 'wardana', '21455541'),
('1111111', 'siti martonah', 'subang', '2014-08-01', 'P', 'XII13-14', 'Farmasi', 'pinang raya 2', '2013', 'sunaryana', '124555511'),
('11201145511', 'sanyu tohang', 'tangerang', '2014-08-07', 'L', 'XII13-14', 'Farmasi', 'jl perum 2 tangerang', '2013', 'toto suryanto', '11223111'),
('2222', 'sanusi ahmad', 'rajek', '2014-04-13', 'L', 'XII13-14', 'Farmasi', 'jl tangerang 22', '2013', 'sarboah', '2233334444');

-- --------------------------------------------------------

--
-- Table structure for table `smstr`
--

CREATE TABLE IF NOT EXISTS `smstr` (
  `id_smstr` int(11) NOT NULL AUTO_INCREMENT,
  `semester` varchar(30) NOT NULL,
  PRIMARY KEY (`id_smstr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `smstr`
--

INSERT INTO `smstr` (`id_smstr`, `semester`) VALUES
(1, 'Semester 1 ( Ganjil )'),
(2, 'Semester 2 ( Genap )');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`nip`, `nama`, `username`, `password`, `tempat`, `tgl_lahir`, `jenkel`, `jabatan`, `telpon`, `email`, `alamat`) VALUES
('1055201182', 'suhendi jaya', '1055201182', '07b54237e0092f14ad92b6ede43fad77', 'yogyakarta', '2014-07-31', 'L', 'guru', '0214557451', 'suhendi@yahoo.com', 'pondok jagung 2'),
('1055204101', 'yoyon', '1055204101', '3c03bdb4c3c5f197a8650f30af7e3032', 'jakarta', '1989-07-31', 'L', 'guru', '0214554111', 'yoyon@gmail.com', 'cipondoh grondrong'),
('123456', 'admin', '123456', 'e10adc3949ba59abbe56e057f20f883e', 'jakarta', '1990-08-11', 'L', 'admin', '100092222', 'admin@gmail.com', 'jl.pinang raya 2'),
('212', 'Super Admin', '212', '1534b76d325a8f591b52d302e7181331', 'tangerang', '2014-08-07', 'L', 'super', '021445411', 'super@gmail.com', 'Jl. KH.HasyimAshari No. 16 Pinang'),
('4444444', 'boboy', '4444444', 'dcb64c94e1b81cd1cd3eb4a73ad27d99', 'bumi ayu', '1945-07-01', 'L', 'admin', '0215544545', 'boboy@gmail.com', 'pinang jaya no 1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
