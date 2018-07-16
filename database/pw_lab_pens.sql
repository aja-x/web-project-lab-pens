-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2018 at 02:27 PM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw_lab_pens`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

CREATE TABLE `m_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jabatan`
--

INSERT INTO `m_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Ketua Lab'),
(2, 'Asisten Lab'),
(3, 'Teknisi Lab'),
(4, 'Anggota Lab');

-- --------------------------------------------------------

--
-- Table structure for table `m_lokasi`
--

CREATE TABLE `m_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_lokasi`
--

INSERT INTO `m_lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'Gedung D4'),
(2, 'Gedung Pascasarjana');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurnal`
--

CREATE TABLE `tb_jurnal` (
  `id_jn` varchar(30) NOT NULL,
  `id_pn` varchar(50) NOT NULL,
  `nama_jn` varchar(30) NOT NULL,
  `tglupl_jn` timestamp NULL DEFAULT NULL,
  `filetype_jn` varchar(50) NOT NULL,
  `filesize_jn` bigint(20) NOT NULL,
  `filepath_jn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lab`
--

CREATE TABLE `tb_lab` (
  `id_lab` varchar(20) NOT NULL,
  `nama_lab` varchar(30) NOT NULL,
  `id_lokasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_lab`
--

INSERT INTO `tb_lab` (`id_lab`, `nama_lab`, `id_lokasi`) VALUES
('C102', 'Sistem Informasi', 1),
('C105', 'Database', 1),
('C204', 'GIS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lab_jadwal`
--

CREATE TABLE `tb_lab_jadwal` (
  `id_lab` varchar(25) NOT NULL,
  `id_pengajar` int(11) NOT NULL,
  `semester_jw` varchar(20) NOT NULL,
  `tgl_jw` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lab_pinjam`
--

CREATE TABLE `tb_lab_pinjam` (
  `id_pjm` varchar(20) NOT NULL,
  `id_lab` varchar(25) NOT NULL,
  `peminjam_pjm` varchar(30) NOT NULL,
  `tgl_pjm` timestamp NULL DEFAULT NULL,
  `alasan_pjm` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_matakuliah`
--

CREATE TABLE `tb_matakuliah` (
  `id_matkul` varchar(20) NOT NULL,
  `nama_matkul` varchar(20) NOT NULL,
  `sks_matkul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_matakuliah`
--

INSERT INTO `tb_matakuliah` (`id_matkul`, `nama_matkul`, `sks_matkul`) VALUES
('MK-0000001', 'bbla', 88),
('MK-0000002', 'nna', 99);

-- --------------------------------------------------------

--
-- Table structure for table `tb_modulkuliah`
--

CREATE TABLE `tb_modulkuliah` (
  `id_modul` varchar(20) NOT NULL,
  `id_matkul` varchar(20) NOT NULL,
  `id_uploader` int(20) NOT NULL,
  `nama_modul` varchar(50) DEFAULT NULL,
  `tglupl_modul` timestamp NULL DEFAULT NULL,
  `filetype_modul` varchar(50) NOT NULL,
  `filesize_modul` bigint(20) NOT NULL,
  `filepath_modul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` int(20) NOT NULL,
  `nama_pg` varchar(50) NOT NULL,
  `alamat_pg` varchar(50) DEFAULT NULL,
  `tgl_lahir_pg` date DEFAULT NULL,
  `tmp_lahir_pg` varchar(50) DEFAULT NULL,
  `no_telp_pg` varchar(20) DEFAULT NULL,
  `email_pg` varchar(50) DEFAULT NULL,
  `jk_pg` enum('l','p') DEFAULT NULL,
  `id_lab` varchar(25) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `password_pg` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `nama_pg`, `alamat_pg`, `tgl_lahir_pg`, `tmp_lahir_pg`, `no_telp_pg`, `email_pg`, `jk_pg`, `id_lab`, `id_jabatan`, `password_pg`) VALUES
(2110171010, 'Ahmad Jarir', 'Lumajang', '1999-03-14', 'Lumajang', '08888821', 'ajax.soft.en@gmail.com', 'l', 'C204', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penelitian`
--

CREATE TABLE `tb_penelitian` (
  `id_pn` varchar(50) NOT NULL,
  `nama_pn` varchar(40) DEFAULT NULL,
  `tgl_mulai_pn` timestamp NULL DEFAULT NULL,
  `tgl_selesai_pn` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penelitian_anggota`
--

CREATE TABLE `tb_penelitian_anggota` (
  `id_pn` varchar(50) NOT NULL,
  `nip` int(20) NOT NULL,
  `jabatan_pn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajar`
--

CREATE TABLE `tb_pengajar` (
  `id_pengajar` int(11) NOT NULL,
  `nip` int(20) NOT NULL,
  `id_matkul` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `m_lokasi`
--
ALTER TABLE `m_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  ADD PRIMARY KEY (`id_jn`),
  ADD UNIQUE KEY `id_pn` (`id_pn`);

--
-- Indexes for table `tb_lab`
--
ALTER TABLE `tb_lab`
  ADD PRIMARY KEY (`id_lab`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `tb_lab_jadwal`
--
ALTER TABLE `tb_lab_jadwal`
  ADD PRIMARY KEY (`id_lab`),
  ADD KEY `id_pengajar` (`id_pengajar`);

--
-- Indexes for table `tb_lab_pinjam`
--
ALTER TABLE `tb_lab_pinjam`
  ADD PRIMARY KEY (`id_pjm`),
  ADD UNIQUE KEY `id_lab` (`id_lab`);

--
-- Indexes for table `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `tb_modulkuliah`
--
ALTER TABLE `tb_modulkuliah`
  ADD PRIMARY KEY (`id_modul`),
  ADD KEY `id_pengajar_idx` (`id_matkul`) USING BTREE,
  ADD KEY `id_matkul` (`id_matkul`),
  ADD KEY `id_uploader` (`id_uploader`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `email_pg` (`email_pg`),
  ADD KEY `id_lab` (`id_lab`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `password_pg` (`password_pg`);

--
-- Indexes for table `tb_penelitian`
--
ALTER TABLE `tb_penelitian`
  ADD PRIMARY KEY (`id_pn`);

--
-- Indexes for table `tb_penelitian_anggota`
--
ALTER TABLE `tb_penelitian_anggota`
  ADD PRIMARY KEY (`id_pn`,`nip`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  ADD PRIMARY KEY (`id_pengajar`),
  ADD UNIQUE KEY `nip_matkul` (`nip`,`id_matkul`) USING BTREE,
  ADD KEY `id_matkul` (`id_matkul`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_lokasi`
--
ALTER TABLE `m_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  MODIFY `id_pengajar` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_jurnal`
--
ALTER TABLE `tb_jurnal`
  ADD CONSTRAINT `tb_jurnal_ibfk_1` FOREIGN KEY (`id_pn`) REFERENCES `tb_penelitian` (`id_pn`);

--
-- Constraints for table `tb_lab`
--
ALTER TABLE `tb_lab`
  ADD CONSTRAINT `tb_lab_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `m_lokasi` (`id_lokasi`);

--
-- Constraints for table `tb_lab_jadwal`
--
ALTER TABLE `tb_lab_jadwal`
  ADD CONSTRAINT `tb_lab_jadwal_ibfk_1` FOREIGN KEY (`id_lab`) REFERENCES `tb_lab` (`id_lab`),
  ADD CONSTRAINT `tb_lab_jadwal_ibfk_3` FOREIGN KEY (`id_pengajar`) REFERENCES `tb_pengajar` (`id_pengajar`);

--
-- Constraints for table `tb_lab_pinjam`
--
ALTER TABLE `tb_lab_pinjam`
  ADD CONSTRAINT `tb_lab_pinjam_ibfk_1` FOREIGN KEY (`id_lab`) REFERENCES `tb_lab` (`id_lab`);

--
-- Constraints for table `tb_modulkuliah`
--
ALTER TABLE `tb_modulkuliah`
  ADD CONSTRAINT `tb_modulkuliah_ibfk_1` FOREIGN KEY (`id_matkul`) REFERENCES `tb_matakuliah` (`id_matkul`),
  ADD CONSTRAINT `tb_modulkuliah_ibfk_2` FOREIGN KEY (`id_uploader`) REFERENCES `tb_pegawai` (`nip`);

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_lab`) REFERENCES `tb_lab` (`id_lab`),
  ADD CONSTRAINT `tb_pegawai_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `m_jabatan` (`id_jabatan`);

--
-- Constraints for table `tb_penelitian_anggota`
--
ALTER TABLE `tb_penelitian_anggota`
  ADD CONSTRAINT `tb_penelitian_anggota_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tb_pegawai` (`nip`),
  ADD CONSTRAINT `tb_penelitian_anggota_ibfk_2` FOREIGN KEY (`id_pn`) REFERENCES `tb_penelitian` (`id_pn`);

--
-- Constraints for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  ADD CONSTRAINT `tb_pengajar_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tb_pegawai` (`nip`),
  ADD CONSTRAINT `tb_pengajar_ibfk_2` FOREIGN KEY (`id_matkul`) REFERENCES `tb_matakuliah` (`id_matkul`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
