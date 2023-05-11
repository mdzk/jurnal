-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2023 at 03:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jurnal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_berakhir` time NOT NULL,
  `status` enum('terverifikasi','pending') NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `nama`, `tanggal`, `tempat`, `penyelenggara`, `foto`, `jam_mulai`, `jam_berakhir`, `status`, `id_users`) VALUES
(3, 'Input data laporan', '2023-01-01', 'Aula Lantai 2', 'Pemerintah Kabupaten Tanggamus', '1683804579_65c36d5c8e3744ef0bd4.jpg', '00:01:00', '00:01:00', 'terverifikasi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kinerja`
--

CREATE TABLE `kinerja` (
  `id_kinerja` int(11) NOT NULL,
  `capaian` varchar(255) NOT NULL,
  `realisasi` varchar(255) NOT NULL,
  `kuantitas` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `status` enum('terverifikasi','pending') NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kinerja`
--

INSERT INTO `kinerja` (`id_kinerja`, `capaian`, `realisasi`, `kuantitas`, `point`, `status`, `id_users`) VALUES
(6, 'Membuat Laporan Harian', '8 Bulan', '3 dokumen', 20, 'terverifikasi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `tmt_jabatan` date NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `kerja_thn` int(11) NOT NULL,
  `kerja_bln` int(11) NOT NULL,
  `tmt_golongan` date NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `instansi_pendidikan` varchar(255) NOT NULL,
  `thn_lulus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `jabatan`, `tmt_jabatan`, `golongan`, `kerja_thn`, `kerja_bln`, `tmt_golongan`, `pendidikan`, `instansi_pendidikan`, `thn_lulus`) VALUES
(3, 'Muhammad Dzaky', '123231312321', 'Pengelola Keuangan', '2023-02-01', 'V/a', 2, 4, '2024-04-01', 'STRATA III', 'Universitas Indonesia', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','pimpinan','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `password`, `role`) VALUES
(2, 'Muhammad Dzaky', 'admin', '$2y$10$4UDQyhiz801cUw50KR008uHU2Cgu05OyTF8w7AzggtzGF4kKXrwy2', 'admin'),
(3, 'Staff Skretariat', 'user', '$2y$10$YcxItNHg/b.xcZ6G/38sWeIqEc.LnlWnBJGiF68oL66Mw/KyJvLK2', 'user'),
(4, 'Kasubag Umum', 'pimpinan', '$2y$10$PqQXLr7cjChaEK6L.YAykuA/0m561ZCGcSr1cnXGqMEXfLEUlYaAu', 'pimpinan'),
(6, 'Staff Kominfo', 'user1', '$2y$10$7e3t.j2L0IR9RhR7sdYuS.b92rakk.JfpEfD8kMp3le8Q3AE9UihS', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indexes for table `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id_kinerja`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id_kinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
