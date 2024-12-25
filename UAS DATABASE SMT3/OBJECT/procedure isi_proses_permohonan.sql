DELIMITER $$

CREATE PROCEDURE isi_proses_permohonan(
    IN p_id_transaksi INT,
    IN p_status ENUM('Menunggu Evaluasi', 'Diproses', 'Selesai'),
    IN p_catatan TEXT
)
BEGIN
    -- Insert data into proses_permohonan table
    INSERT INTO proses_permohonan (id_transaksi, status, catatan)
    VALUES (p_id_transaksi, p_status, p_catatan);

    SELECT 'Data berhasil dimasukkan ke tabel proses_permohonan.' AS result;
END $$

DELIMITER ;

CALL isi_proses_permohonan(2, 'Diproses', 'Dokumen telah diterima.');