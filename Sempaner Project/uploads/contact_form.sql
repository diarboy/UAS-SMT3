-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2024 at 06:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Ardi Syah', 'stukies@ymail.com', 'Test1', 'Hallo!', '2024-12-19 15:13:39'),
(3, 'Dimas', 'dimas@gmail.com', 'Test 2', 'Haloo!', '2024-12-19 15:22:47'),
(4, 'Fuad', 'fuad@x.com', 'Test 3', 'Yuuh', '2024-12-19 15:33:27'),
(5, 'Bagus', 'b@gmail.com', 'Test 4', 'Hallo', '2024-12-19 15:42:15'),
(6, 'Ardi', 'di@gmail.com', 'Test 12', 'Okeeeee', '2024-12-19 16:00:00'),
(7, 'Azis', 'azis@gmail.com', 'Haloo', 'Apa kabar?', '2024-12-19 16:03:09'),
(8, 'Jaisy', 'jaisy@gmail.com', 'Test 14', 'hallooo', '2024-12-19 16:15:07'),
(10, 'Echo', 'echo@gmail.com', 'Tempag', 'Hoyee', '2024-12-19 16:29:28'),
(11, 'Jasjus', 'js@gmail.com', 'Test 30', 'Okkeeee', '2024-12-19 16:36:20'),
(12, 'COOOK', 'COK@GMAIL.COM', 'ASKJAKS', 'KAJAFASB', '2024-12-19 16:42:21'),
(13, 'CUK', 'CUK@FMAS.COM', 'AKSJAS', '12121314', '2024-12-19 16:46:38'),
(14, 'DSWJ', 'DS@GMAIL.COM', 'OYESS', 'OH NOOOO', '2024-12-19 16:57:34'),
(15, 'aboy', 'aboy@x.com', 'kasasl', 'kai1212', '2024-12-19 17:02:40'),
(16, 'diar', 'diar@gmail.com', 'koko', 'kau', '2024-12-19 17:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_layanan`
--

CREATE TABLE `pengajuan_layanan` (
  `id` int NOT NULL,
  `nama_pemohon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `alamat_usaha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_layanan` varchar(100) NOT NULL,
  `detail_usaha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_bangunan` varchar(100) NOT NULL,
  `batas_waktu` varchar(100) DEFAULT NULL,
  `dokumen_persyaratan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dokumen_gambar` varchar(255) DEFAULT NULL,
  `dokumen_lainnya` varchar(255) DEFAULT NULL,
  `status_pengajuan` varchar(50) DEFAULT 'Menunggu Evaluasi',
  `tanggal_pengajuan` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan_layanan`
--

INSERT INTO `pengajuan_layanan` (`id`, `nama_pemohon`, `nik`, `no_hp`, `nama_perusahaan`, `alamat_usaha`, `jenis_layanan`, `detail_usaha`, `jenis_bangunan`, `batas_waktu`, `dokumen_persyaratan`, `dokumen_gambar`, `dokumen_lainnya`, `status_pengajuan`, `tanggal_pengajuan`) VALUES
(1, 'ard', 'ardi@x.com', '09891291020', 'ardi', '', 'NIB', 'adada', 'Perumahan', '1', 'uploads/', 'uploads/', 'uploads/', 'Menunggu Evaluasi', '2024-12-21 12:22:56'),
(2, 'aridias', 'ar@gmail.com', '0859102910290', 'lalalalala', '', 'NIB', 'adad', 'Perumahan', '1', 'uploads/', 'uploads/', 'uploads/', 'Menunggu Evaluasi', '2024-12-21 12:24:55'),
(3, 'aku', 'ada@gmail.com', '0819891209', 'ardi', '', 'NIB', 'ad', 'Perumahan', '1', 'uploads/', 'uploads/', 'uploads/', 'Menunggu Evaluasi', '2024-12-21 12:25:52'),
(4, 'ardi', 'ardi@gmail.comm', '09129812090', 'alkrlakr', '', 'NIB', 'adadadadad', 'Perumahan', '1', 'uploads/', 'uploads/', 'uploads/', 'Menunggu Evaluasi', '2024-12-21 12:27:08'),
(5, 'aku', 'ada@gmail.com', '0819891209', 'ardi', '', 'NIB', 'ad', 'Perumahan', '1', '', '', '', 'Menunggu Evaluasi', '2024-12-21 12:29:01'),
(6, '', '', '', '090219019201', '', 'NIB', '', 'Hunian', '', '', '', '', 'Menunggu Evaluasi', '2024-12-21 12:43:53'),
(7, '', '', '', '091021299', '', 'NIB', '', 'Hunian', '', '', '', '', 'Menunggu Evaluasi', '2024-12-21 12:44:21'),
(8, '', '', '', '091021299', '', 'NIB', '', 'Hunian', '', '', '', '', 'Menunggu Evaluasi', '2024-12-21 12:55:05'),
(9, '', '', '', '091021299', '', 'NIB', '', 'Hunian', '', '', '', '', 'Menunggu Evaluasi', '2024-12-21 12:56:16'),
(10, '', '', '', 'bali', '', 'NIB', '', 'Hunian', NULL, '', '', '', 'Menunggu Evaluasi', '2024-12-21 13:06:44'),
(11, 'Bali', '3281033000000010', '0857219091029', 'bali', 'bali', 'NIB', 'bali', 'Hunian', NULL, '', '', '', 'Menunggu Evaluasi', '2024-12-21 13:11:31'),
(12, 'Bali', '3281033000000010', '0857219091029', 'bali', 'bali', 'NIB', 'bali', 'Hunian', NULL, '', '', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:12:12'),
(13, 'Bali', '3281033000000010', '0857219091029', 'bali', 'bali', 'NIB', 'bali', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:17:06'),
(14, 'Bali', '3281033000000010', '0857219091029', 'bali', 'bali', 'PBG', 'bali', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:21:15'),
(15, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, '', '', '', 'Menunggu Evaluasi', '2024-12-21 13:23:31'),
(16, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:25:43'),
(17, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:26:53'),
(18, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:27:16'),
(19, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:27:37'),
(20, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:30:04'),
(21, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:30:12'),
(22, 'Dari bali', '3271929909092010', '0859129019201', '12121029', '0901290192012', 'Izin Usaha', 'Perizinan', 'Hunian', NULL, 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'uploads/UAS MK Pemweb.pdf', 'Menunggu Evaluasi', '2024-12-21 13:33:47'),
(23, 'logout', '1291029012012019', '0901210291029', '090192019201929', '010291029', 'NIB', '0', 'Hunian', NULL, '', '', '', 'Menunggu Evaluasi', '2024-12-22 09:40:41'),
(24, 'logut', '9201921029102910', '0901491930912', '0912901291029', '9019209120192091', 'NIB', '01920192091209102', 'Hunian', NULL, '', '', '', 'Menunggu Evaluasi', '2024-12-22 09:43:30'),
(25, 'testlagi', '3019201209120120', '0910390192019', '9102910291029', '9109201920192012', 'NIB', '023029438758375', 'Hunian', NULL, '', '', '', 'Menunggu Evaluasi', '2024-12-22 09:45:49'),
(26, 'Sayang', '3812901920190291', '0090192091291', '091021029102', '0019201290120129', 'NIB', 'asasasas', 'Hunian', NULL, 'uploads/starter-page.html', '', '', 'Menunggu Evaluasi', '2024-12-22 13:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_klien`
--

CREATE TABLE `pesan_klien` (
  `id` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `nama_klien` varchar(255) NOT NULL,
  `email_klien` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `username`, `password`, `email`, `create_at`) VALUES
(1, 'test1', '$2y$10$/SWfVEtS1KnqDWtc.0V4CemISqnSbkpBviVllNpT/iC/mGrxw0mJG', 'test1@x.com', '2024-12-20 20:42:33'),
(2, 'ard', '$2y$10$m9d./TZC2WLjSVA7AwCiTepl9ipEfHkFUXys4NNDEUd6BG5sCEE/m', 'ardi@123.com', '2024-12-20 21:12:37'),
(3, 'admin', '$2y$10$wjBPRK4hP0OxNO0ttk9mfevtqP7DP8cd.wFZWpRa8A/7Ms2IgUY9m', 'admin@x.com', '2024-12-20 22:28:14'),
(4, 'yogi', '$2y$10$Tkf40E5CP0xax5WCAZs4zuJa6RE/vHJI3kNnEh4mNFIKAn6/wQitq', 'yogi@gmail.com', '2024-12-22 11:59:35'),
(5, 'admin123', '$2y$10$P2CKYe/SN3rtAxdF8ZpmI.rIG/TWJpLVWCCgdOl76vDruRgP7VIBW', 'admin@gmail.com', '2024-12-22 12:09:29'),
(6, 'sayang', '$2y$10$2le7jSHfIUuN6iAdP4Dhf.x/FZGqHMLLfdZjH1rburzFEn0iiqtN2', 'sayang@gmail.com', '2024-12-22 12:19:15'),
(7, 'ardi@gmail.com', '$2y$10$20Y9MaOze2WVXXVp.tAC5uqiKHHnrlw.gCUPeGLqUXtWYiF0QrkmG', 'ardibukan@gmail.com', '2024-12-22 12:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('klien','admin') NOT NULL,
  `tanggal_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `tanggal_daftar`) VALUES
(1, 'ardi', 'ardi@gmail.com', '$2y$10$2IwZ/xgiOaJq7vj3qji6luaDVjIfpg.J9LcZX.DEpoQElIqJdIuIm', 'klien', '2024-12-21 01:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_pemohon` int NOT NULL,
  `nm_pemohon` varchar(230) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(230) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_layanan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id_pemohon`, `nm_pemohon`, `nik`, `email`, `no_hp`, `jenis_layanan`) VALUES
(19, 'Jaidin', '3212091029019201', 'idin@gmail.com', '0812819289128', 'PBG'),
(22, 'pbg', '120192019039013', 'ardibukan@live.cm', '0958128129912', 'PBG'),
(23, 'slf', '12019209120', 'ardibukan@12712.com', '08591829192', 'SLF'),
(24, 'Udah Sore', '3210912010291201', '', '0857491020121', 'NIB'),
(25, 'pengajuan', '1301201290192019', '', '0801290129012', 'PBG'),
(26, 'coba1', '1222222222222222', '', '0913189120120', 'NIB'),
(27, 'aaaaaaaaaaaaa', '0122222222222222', 'aa@gmaill.com', '0899999999999', 'NIB'),
(28, 'Sayang', '3019201920192019', '09012@0sdada09.com', '0095091092910', 'PBG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_layanan`
--
ALTER TABLE `pengajuan_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_klien`
--
ALTER TABLE `pesan_klien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengajuan` (`id_pengajuan`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_pemohon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengajuan_layanan`
--
ALTER TABLE `pengajuan_layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pesan_klien`
--
ALTER TABLE `pesan_klien`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_pemohon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
