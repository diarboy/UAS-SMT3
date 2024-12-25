DELIMITER //

CREATE TRIGGER notifikasi_perubahan_status
AFTER UPDATE ON daftar_transaksi
FOR EACH ROW
BEGIN

    IF NEW.status <> OLD.status THEN
        
        INSERT INTO notifikasi (id_klien, isi_pesan, created_at)
        VALUES (
            NEW.id_klien,
            CONCAT('Status transaksi Anda dengan nomor faktur ', NEW.nomor_invoice, 
                   ' telah berubah menjadi ', NEW.sformulir_sempanertatus, '.'),
            NOW()
        );
    END IF;
END;
//

DELIMITER ;
