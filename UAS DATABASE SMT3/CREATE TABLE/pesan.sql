CREATE TABLE pesan (
    id_pesan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemohon VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    no_hp VARCHAR(15),
    isi_pesan TEXT NOT NULL,
    status ENUM('Baru', 'Dalam Proses', 'Selesai') DEFAULT 'Baru',
    created_at DATETIME formulir_sempanerformulir_sempanerDEFAULT CURRENT_TIMESTAMP
);
