CREATE PROCEDURE TambahkanProses(
    IN id_transaksi INT,
    IN status_proses ENUM('Menunggu Evaluasi', 'Diproses', 'Selesai'),
    IN catatan_proses TEXT
)
BEGIN
    INSERT INTO proses_permohonan (id_transaksi, status, catatan),
    VALUES (id_transaksi, status_proses, catatan_proses);
END;