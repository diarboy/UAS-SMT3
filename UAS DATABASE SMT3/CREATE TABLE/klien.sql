CREATE TABLE klien (
    id_klien INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemohon VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    alamat_pemohon TEXT,
    nama_perusahaan VARCHAR(255),
    kegiatan_usaha VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP
);
