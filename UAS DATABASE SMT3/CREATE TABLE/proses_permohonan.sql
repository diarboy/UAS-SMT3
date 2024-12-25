CREATE TABLE proses_permohonan (
    id_permohonan INT AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT NOT NULL,
    status ENUM('Menunggu Evaluasi', 'Diproses', 'Selesai') NOT NULL,
    catatan TEXT,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_transaksi) REFERENCES daftar_transaksi(id_transaksi)
);
