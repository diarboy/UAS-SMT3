CREATE TABLE daftar_transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_klien INT NOT NULL,
    id_layanan INT NOT NULL,
    harga_total DECIMAL(10, 2) NOT NULL,
    status ENUM('Pending', 'Dalam Proses', 'Selesai', 'Dibatalkan') DEFAULT 'Pending',
    status_pembayaran ENUM('Belum Lunas', 'Lunas') DEFAULT 'Belum Lunas',
    nomor_invoice VARCHAR(50) UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_klien) REFERENCES klien(id_klien),
    FOREIGN KEY (id_layanan) REFERENCES layanan(id_layanan)
);
