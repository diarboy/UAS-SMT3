DELIMITER //

CREATE TRIGGER update_dokumen_setelah_transaksi
AFTER UPDATE ON daftar_transaksi
FOR EACH ROW
BEGIN

    IF NEW.status = 'Selesai' AND OLD.status <> 'Selesai' THEN
        
        UPDATE dokumen
        SET status_dokumen = 'Validasi'
        WHERE id_transaksi = NEW.id_transaksi;
    END IF;
END;
//

DELIMITER ;
