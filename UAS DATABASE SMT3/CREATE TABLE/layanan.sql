CREATE TABLE layanan (
    id_layanan INT AUTO_INCREMENT PRIMARY KEY,
    jenis_layanan VARCHAR(255) NOT NULL,
    detail_usaha TEXT,
    harga DECIMAL(10, 2) NOT NULL,
    lama_proses INT COMMENT 'In days',
    status ENUM('Aktif', 'Tidak Aktif') DEFAULT 'Aktif',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP
);
