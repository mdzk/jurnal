-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2023 at 08:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jurnal`
--

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` int(11) NOT NULL,
  `nama_golongan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `nama_golongan`) VALUES
(1, 'I A / Juru Muda'),
(2, 'I B / Juru Muda Tingkat 1'),
(3, 'I C / Juru'),
(4, 'I D / Juru Tingkat 1'),
(5, 'II A / Pengatur Muda'),
(6, 'II B / Pengatur Muda Tingkat 1'),
(7, 'II C / Pengatur'),
(8, 'II D / Pengatur Tingkat 1'),
(9, 'III A / Penata Muda'),
(10, 'III B / Penata Muda Tingkat 1'),
(11, 'III C / Penata'),
(12, 'III D / Penata Tingkat 1'),
(13, 'IV A / Pembina'),
(14, 'IV B / Pembina Tingkat 1'),
(15, 'IV C / Pembina Utama Muda'),
(16, '\r\nIV D / Pembina Utama Madya'),
(17, 'IV E / Pembina Utama');

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
  `status` enum('terverifikasi','admin','pimpinan','ditolak') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  `id_kinerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `nama`, `tanggal`, `tempat`, `penyelenggara`, `foto`, `jam_mulai`, `jam_berakhir`, `status`, `keterangan`, `id_users`, `id_kinerja`) VALUES
(16, 'Rapat penyusunan awal dokumen Perencanaan pembangunan', '2023-06-16', 'hahha ', 'Bapperida', '1686887416_07264eeb3d219092e5c8.jpeg', '10:49:00', '11:50:00', 'terverifikasi', NULL, 3, 14),
(17, 'Rapat awal perencanaan kegiatan musrenbang', '2023-06-23', 'Bapperida', 'Dinas Perhubungan', '1687506207_d79c2654b42068bf8d3c.jpeg', '10:32:00', '14:42:00', 'terverifikasi', NULL, 3, 16),
(18, 'Rapat penyusunan awal dokumen Perencanaan pembangunan', '2023-07-03', 'Bapperida', 'Bapperida', '1688363030_ae2a28751a054480ccbf.jpeg', '11:44:00', '12:43:00', 'terverifikasi', NULL, 3, 16);

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
  `status` enum('terverifikasi','admin','pimpinan','ditolak') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kinerja`
--

INSERT INTO `kinerja` (`id_kinerja`, `capaian`, `realisasi`, `kuantitas`, `point`, `status`, `keterangan`, `id_users`) VALUES
(14, 'Pelaksanaan Penyusunan dan Penetapan Rancangan Awal Dokumen Perencanaan Pembangunan Daerah Kabupaten/Kota', '8 Bulan', '20 Buku', 75, 'terverifikasi', NULL, 3),
(16, 'Pelaksanaan MUSRENBANG Kabupaten/Kota', '1 Bulan', '1 Berita Acara', 20, 'terverifikasi', NULL, 3),
(18, 'Membuat Laporan', '1 Bulan', '1 Laporan', 20, 'terverifikasi', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nip` varchar(18) NOT NULL,
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
(1, 'Julfiana Rizkiah F', '84939392020', 'Fungsional', '2023-07-27', '13', 10, 8, '2023-07-15', 'STRATA II', 'Universitas Lampung', '2022'),
(8, 'Feri Septiawan, SE, MM', '30040443', 'Kepala Bidang Perencanaan dan Pendanaan Daerah', '2025-07-16', '13', 20, 11, '2024-06-11', 'STRATA II', 'Universitas Lampung', '1996'),
(9, 'Siti Rahmah, S.I.Kom', '44999339', 'Kepala Bidang Pemerintahan dan Perekonomian', '2025-06-17', '12', 19, 8, '2025-06-18', 'STRATA I', 'Universitas Lampung', '1999'),
(10, 'Sonny Apriadi, SE', '2929293', 'Kepala Bidang Pengendalian dan Pembangunan', '2024-07-17', '12', 20, 16, '2024-06-14', 'STRATA I', 'Universitas Lampung', '1997'),
(11, 'Hasriansyah Siregar, SE', '748485995', 'Kepala Bidang Riset dan Inovasi Daerah', '2025-07-16', '12', 20, 10, '2025-06-17', 'STRATA I', 'Universitas Lampung', '1996');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `created`, `user_id`) VALUES
(16, 'f7ea2d9c69519a4ea1c985e587108447', '2023-08-04', 3),
(17, '77a29267debdd22af2ccb90cefd056f4', '2023-08-04', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','pimpinan','') NOT NULL,
  `nip` bigint(18) NOT NULL,
  `golongan` int(11) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `kepala` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `email`, `password`, `role`, `nip`, `golongan`, `jabatan`, `unit`, `kepala`, `picture`) VALUES
(2, 'Admin Sekertariat', 'admin@mail.com', '$2y$10$4UDQyhiz801cUw50KR008uHU2Cgu05OyTF8w7AzggtzGF4kKXrwy2', 'admin', 111111111111111111, 1, 'Admin Edit', 'Sekertariat', 'Kasubag Umum dan Kepegawaian', '1686554628_faa13db96fb61e83d413.png'),
(3, 'User, S.E', 'user@mail.com', '$2y$10$zHnJZdhd1u0cWzVkyVhYMeuHuU1RiudB1gL3UaSzSYpnnOYoz/Auy', 'user', 111111111111111112, 1, 'Pengelola Data Bidang PPD', 'Perencanaan dan Pendanaan Daerah', 'Feri Septiawan, S.E., M.M', '1686554352_cf18d0b742818240dd3d.png'),
(10, 'Pimpinan', 'pimpinan@mail.com', '$2y$10$8.11ncROyFeBuzjOh/u0gOTovR6aXmDJh0uNPHMR0u5cnRkHc5srG', 'pimpinan', 123123, 9, 'pimpinan', 'Kominfo', 'pimpinan', 'default.jpg'),
(11, 'User 2', 'user2@mail.com', '$2y$10$Rte/3Nn8CsIfS9FyRXo3V.lzP.9j878SmWHXGRkjwOO2fBHzpq6Xm', 'user', 123131, 4, 'kepala', 'bapperida', 'kominfo', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

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
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id_golongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id_kinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
