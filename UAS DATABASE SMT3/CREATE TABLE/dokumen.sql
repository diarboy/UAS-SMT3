CREATE TABLE dokumen (
    id_dokumen INT AUTO_INCREMENT PRIMARY KEY,
    id_klien INT NOT NULL,
    id_transaksi INT NOT NULL,
    jenis_dokumen VARCHAR(50) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_klien) REFERENCES klien(id_klien),
    FOREIGN KEY (id_transaksi) REFERENCES daftar_transaksi(id_transaksi)
);
