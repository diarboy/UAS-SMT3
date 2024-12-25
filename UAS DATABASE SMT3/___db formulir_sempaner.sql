-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for formulir_sempaner
CREATE DATABASE IF NOT EXISTS `formulir_sempaner` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `formulir_sempaner`;

-- Dumping structure for table formulir_sempaner.akun_klien
CREATE TABLE IF NOT EXISTS `akun_klien` (
  `id_akun` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('klien','pelanggan') DEFAULT 'klien',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_akun`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.akun_klien: ~6 rows (approximately)
REPLACE INTO `akun_klien` (`id_akun`, `username`, `email`, `password`, `role`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'ahmad_faizal', 'ahmad@example.com', '$2b$12$2fZI6u8bdUR0G6IYlxZtBu5p0d/AjylRpZX4g8UpY.hVddUow7jmS', 'klien', '2024-12-25 10:00:00', '2024-12-01 08:00:00', '2024-12-25 16:18:17'),
	(2, 'budi_santoso', 'budi@example.com', '$2b$12$8JPOXfhBfr0oSg97WGiXfeDAh44Zel0lpd7bu7ZFP93JlSfoQblX2', 'klien', '2024-12-23 14:30:00', '2024-12-02 09:30:00', '2024-12-25 16:18:17'),
	(3, 'citra_dewi', 'citra@example.com', '$2b$12$h8xZf9gsglZOuw5NrhJ3tuF1YNcd4R8tacUQfPOl8zUlwD5XhxjFS', 'klien', NULL, '2024-12-03 10:30:00', '2024-12-25 16:18:17'),
	(4, 'dewi_ayu', 'dewi@example.com', '$2b$12$3dsxfYFiQfwtOcmTwLvhzHuocY9qg1P64D9uUwSO8.1YHDiF4YquG', 'klien', '2024-12-22 18:45:00', '2024-12-04 11:00:00', '2024-12-25 16:18:17'),
	(5, 'eko_prasetyo', 'eko@example.com', '$2b$12$kPf5R5q1n1qeeLP8J1tsrK9tLrV3rNJx9Jz31E6g.YZdX8O1lZTS6', 'klien', NULL, '2024-12-05 14:15:00', '2024-12-25 16:18:17'),
	(6, 'bagasdwi', 'bagasdwi@example.com', 'passwordbagas102', 'klien', NULL, '2024-12-05 14:15:00', NULL);

-- Dumping structure for table formulir_sempaner.daftar_pegawai
CREATE TABLE IF NOT EXISTS `daftar_pegawai` (
  `id_pegawai` int NOT NULL AUTO_INCREMENT,
  `nama_pegawai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pegawai`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.daftar_pegawai: ~3 rows (approximately)
REPLACE INTO `daftar_pegawai` (`id_pegawai`, `nama_pegawai`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Admin1', 'admin1@example.com', 'admin', 'Aktif', '2024-11-01 09:00:00', NULL),
	(2, 'Manager1', 'manager1@example.com', 'manager', 'Aktif', '2024-11-02 10:30:00', NULL),
	(3, 'Staff1', 'staff1@example.com', 'staff', 'Aktif', '2024-11-03 11:45:00', NULL);

-- Dumping structure for table formulir_sempaner.daftar_transaksi
CREATE TABLE IF NOT EXISTS `daftar_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_klien` int NOT NULL,
  `id_layanan` int NOT NULL,
  `harga_total` decimal(10,2) NOT NULL,
  `status` enum('Pending','Dalam Proses','Selesai','Dibatalkan') DEFAULT 'Pending',
  `status_pembayaran` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  `nomor_invoice` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_transaksi`),
  UNIQUE KEY `nomor_invoice` (`nomor_invoice`),
  KEY `id_klien` (`id_klien`),
  KEY `id_layanan` (`id_layanan`),
  CONSTRAINT `daftar_transaksi_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`),
  CONSTRAINT `daftar_transaksi_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.daftar_transaksi: ~10 rows (approximately)
REPLACE INTO `daftar_transaksi` (`id_transaksi`, `id_klien`, `id_layanan`, `harga_total`, `status`, `status_pembayaran`, `nomor_invoice`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 50000000.00, 'Selesai', 'Belum Lunas', 'INV001', '2024-12-25 15:48:53', '2024-12-25 16:28:01'),
	(2, 1, 2, 15000000.00, 'Dalam Proses', 'Lunas', 'INV002', '2024-12-25 15:48:53', NULL),
	(3, 2, 1, 50000000.00, 'Selesai', 'Lunas', 'INV003', '2024-12-25 15:48:53', NULL),
	(4, 2, 2, 15000000.00, 'Pending', 'Belum Lunas', 'INV004', '2024-12-25 15:48:53', NULL),
	(5, 3, 1, 50000000.00, 'Dalam Proses', 'Belum Lunas', 'INV005', '2024-12-25 15:48:53', NULL),
	(6, 3, 2, 15000000.00, 'Selesai', 'Lunas', 'INV006', '2024-12-25 15:48:53', NULL),
	(7, 4, 1, 50000000.00, 'Pending', 'Belum Lunas', 'INV007', '2024-12-25 15:48:53', NULL),
	(8, 4, 2, 15000000.00, 'Dalam Proses', 'Belum Lunas', 'INV008', '2024-12-25 15:48:53', NULL),
	(9, 5, 1, 50000000.00, 'Selesai', 'Lunas', 'INV009', '2024-12-25 15:48:53', NULL),
	(10, 5, 2, 15000000.00, 'Pending', 'Belum Lunas', 'INV010', '2024-12-25 15:48:53', NULL);

-- Dumping structure for table formulir_sempaner.dokumen
CREATE TABLE IF NOT EXISTS `dokumen` (
  `id_dokumen` int NOT NULL AUTO_INCREMENT,
  `id_klien` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `jenis_dokumen` varchar(50) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_dokumen` enum('Pending','Validasi') DEFAULT 'Pending',
  PRIMARY KEY (`id_dokumen`),
  KEY `id_klien` (`id_klien`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`),
  CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `daftar_transaksi` (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.dokumen: ~6 rows (approximately)
REPLACE INTO `dokumen` (`id_dokumen`, `id_klien`, `id_transaksi`, `jenis_dokumen`, `file_path`, `uploaded_at`, `status_dokumen`) VALUES
	(1, 1, 1, 'Dokumen Legalitas PT CJE', '/path/to/legalitas1.pdf', '2024-12-25 15:51:48', 'Validasi'),
	(2, 1, 2, 'IMB Lama PT CJE', '/path/to/pgb.pdf', '2024-12-25 15:51:48', 'Validasi'),
	(3, 2, 3, 'Dokumen Legalitas', '/path/to/legalitas2.pdf', '2024-12-25 15:51:48', 'Validasi'),
	(4, 2, 4, 'SLF SEMPANER', '/path/to/slf.pdf', '2024-12-25 15:51:48', 'Pending'),
	(5, 3, 5, 'Dokumen Legalitas', '/path/to/legalitas3.pdf', '2024-12-25 15:51:48', 'Pending'),
	(6, 3, 6, 'SLF PT Ciayumajakuning', '/path/to/slf.pdf', '2024-12-25 15:51:48', 'Validasi');

-- Dumping structure for table formulir_sempaner.klien
CREATE TABLE IF NOT EXISTS `klien` (
  `id_klien` int NOT NULL AUTO_INCREMENT,
  `nama_pemohon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat_pemohon` text,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `kegiatan_usaha` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_klien`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `fk_email_akun_klien` FOREIGN KEY (`email`) REFERENCES `akun_klien` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.klien: ~6 rows (approximately)
REPLACE INTO `klien` (`id_klien`, `nama_pemohon`, `email`, `no_hp`, `alamat_pemohon`, `nama_perusahaan`, `kegiatan_usaha`, `created_at`, `updated_at`) VALUES
	(1, 'Ahmad Faizal', 'ahmad@example.com', '081234567890', 'Jl. Merdeka No. 10', 'CV Sukses Mandiri', 'Perdagangan Umum', '2024-12-25 15:44:08', NULL),
	(2, 'Budi Santoso', 'budi@example.com', '081298765432', 'Jl. Diponegoro No. 15', 'PT Karya Jaya', 'Jasa Konstruksi', '2024-12-25 15:44:08', NULL),
	(3, 'Citra Dewi', 'citra@example.com', '081212345678', 'Jl. Gatot Subroto No. 20', NULL, 'Konsultan Keuangan', '2024-12-25 15:44:08', NULL),
	(4, 'Dewi Ayu', 'dewi@example.com', '081332211445', 'Jl. Sudirman No. 25', 'UD Sejahtera', 'Toko Kelontong', '2024-12-25 15:44:08', NULL),
	(5, 'Eko Prasetyo', 'eko@example.com', '081177889900', 'Jl. Ahmad Yani No. 30', NULL, 'Freelancer IT', '2024-12-25 15:44:08', NULL),
	(6, 'Bagas Dwi', 'bagasdwi@example.com', '081177889900', 'Jl. Ahmad Yani No. 30', NULL, 'Freelancer IT', '2024-12-25 17:15:11', NULL);

-- Dumping structure for table formulir_sempaner.layanan
CREATE TABLE IF NOT EXISTS `layanan` (
  `id_layanan` int NOT NULL AUTO_INCREMENT,
  `jenis_layanan` varchar(255) NOT NULL,
  `detail_usaha` text,
  `harga` decimal(10,2) NOT NULL,
  `lama_proses` int DEFAULT NULL COMMENT 'In days',
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_layanan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.layanan: ~2 rows (approximately)
REPLACE INTO `layanan` (`id_layanan`, `jenis_layanan`, `detail_usaha`, `harga`, `lama_proses`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Persetujuan Bangunan Gedung', 'PBG Pertashop Panawuan', 50000000.00, 30, 'Aktif', '2024-12-25 15:48:00', NULL),
	(2, 'Sertifikat Laik Fungsi', 'SLF Pertashop Panawuan', 75000000.00, 15, 'Aktif', '2024-12-25 15:48:00', NULL);

-- Dumping structure for table formulir_sempaner.notifikasi
CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id_notifikasi` int NOT NULL AUTO_INCREMENT,
  `id_klien` int NOT NULL,
  `isi_pesan` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_notifikasi`),
  KEY `id_klien` (`id_klien`),
  CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.notifikasi: ~1 rows (approximately)
REPLACE INTO `notifikasi` (`id_notifikasi`, `id_klien`, `isi_pesan`, `created_at`) VALUES
	(1, 1, 'Status transaksi Anda dengan nomor faktur INV001 telah berubah menjadi Selesai.', '2024-12-25 16:28:01');

-- Dumping structure for table formulir_sempaner.pesan
CREATE TABLE IF NOT EXISTS `pesan` (
  `id_pesan` int NOT NULL AUTO_INCREMENT,
  `nama_pemohon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `isi_pesan` text NOT NULL,
  `status` enum('Baru','Dalam Proses','Selesai') DEFAULT 'Baru',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.pesan: ~5 rows (approximately)
REPLACE INTO `pesan` (`id_pesan`, `nama_pemohon`, `email`, `no_hp`, `isi_pesan`, `status`, `created_at`) VALUES
	(1, 'Ahmad Faizal', 'ahmad@example.com', '081234567890', 'Saya ingin menanyakan status permohonan izin usaha saya yang sedang diproses.', 'Baru', '2024-12-25 10:15:00'),
	(2, 'Budi Santoso', 'budi@example.com', '081298765432', 'Apakah ada dokumen yang harus saya lengkapi untuk pengajuan izin konstruksi?', 'Baru', '2024-12-24 14:30:00'),
	(3, 'Citra Dewi', 'citra@example.com', '081212345678', 'Mohon informasinya mengenai jenis layanan yang bisa saya ajukan untuk usaha konsultan keuangan.', 'Dalam Proses', '2024-12-23 09:00:00'),
	(4, 'Dewi Ayu', 'dewi@example.com', '081332211445', 'Tolong informasikan prosedur pendaftaran untuk izin usaha toko kelontong.', 'Selesai', '2024-12-22 16:45:00'),
	(5, 'Eko Prasetyo', 'eko@example.com', '081177889900', 'Apakah ada syarat khusus untuk mengajukan izin untuk freelancer di bidang IT?', 'Baru', '2024-12-21 18:00:00');

-- Dumping structure for table formulir_sempaner.proses_permohonan
CREATE TABLE IF NOT EXISTS `proses_permohonan` (
  `id_permohonan` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `status` enum('Menunggu Evaluasi','Diproses','Selesai') NOT NULL,
  `catatan` text,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_permohonan`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `proses_permohonan_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `daftar_transaksi` (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table formulir_sempaner.proses_permohonan: ~1 rows (approximately)
REPLACE INTO `proses_permohonan` (`id_permohonan`, `id_transaksi`, `status`, `catatan`, `updated_at`) VALUES
	(1, 1, 'Diproses', 'Dokumen telah diterima.', '2024-12-25 15:58:59');

-- Dumping structure for view formulir_sempaner.transaksi_belum_lunas
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `transaksi_belum_lunas` (
	`id_transaksi` INT(10) NOT NULL,
	`nama_pemohon` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`jenis_layanan` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`harga_total` DECIMAL(10,2) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for procedure formulir_sempaner.isi_proses_permohonan
DELIMITER //
CREATE PROCEDURE `isi_proses_permohonan`(
    IN p_id_transaksi INT,
    IN p_status ENUM('Menunggu Evaluasi', 'Diproses', 'Selesai'),
    IN p_catatan TEXT
)
BEGIN
    -- Insert data into proses_permohonan table
    INSERT INTO proses_permohonan (id_transaksi, status, catatan)
    VALUES (p_id_transaksi, p_status, p_catatan);

    -- Optional: Confirm successful insertion
    SELECT 'Data berhasil dimasukkan ke tabel proses_permohonan.' AS result;
END//
DELIMITER ;

-- Dumping structure for trigger formulir_sempaner.notifikasi_perubahan_status
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `notifikasi_perubahan_status` AFTER UPDATE ON `daftar_transaksi` FOR EACH ROW BEGIN

    IF NEW.status <> OLD.status THEN
        
        INSERT INTO notifikasi (id_klien, isi_pesan, created_at)
        VALUES (
            NEW.id_klien,
            CONCAT('Status transaksi Anda dengan nomor faktur ', NEW.nomor_invoice, 
                   ' telah berubah menjadi ', NEW.status, '.'),
            NOW()
        );
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger formulir_sempaner.update_dokumen_setelah_transaksi
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_dokumen_setelah_transaksi` AFTER UPDATE ON `daftar_transaksi` FOR EACH ROW BEGIN

    IF NEW.status = 'Selesai' AND OLD.status <> 'Selesai' THEN
        
        UPDATE dokumen
        SET status_dokumen = 'Validasi'
        WHERE id_transaksi = NEW.id_transaksi;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for view formulir_sempaner.transaksi_belum_lunas
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `transaksi_belum_lunas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `transaksi_belum_lunas` AS select `daftar_transaksi`.`id_transaksi` AS `id_transaksi`,`klien`.`nama_pemohon` AS `nama_pemohon`,`layanan`.`jenis_layanan` AS `jenis_layanan`,`daftar_transaksi`.`harga_total` AS `harga_total` from ((`daftar_transaksi` join `klien` on((`daftar_transaksi`.`id_klien` = `klien`.`id_klien`))) join `layanan` on((`daftar_transaksi`.`id_layanan` = `layanan`.`id_layanan`))) where (`daftar_transaksi`.`status_pembayaran` = 'Belum Lunas');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
