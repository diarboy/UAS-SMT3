SELECT 
    k.nama_pemohon AS Nama_klien,
    k.email AS Email_klien,
    k.no_hp AS No_hp_klien,
    k.nama_perusahaan AS Nama_perusahaan,
    k.kegiatan_usaha AS Kegiatan_usaha,
    t.id_transaksi AS ID_Transaksi,
    t.harga_total AS Harga_Total,
    t.status AS Status_Transaksi,
    t.status_pembayaran AS Status_Pembayaran,
    t.nomor_invoice AS Nomor_Invoice,
    l.jenis_layanan AS Jenis_Layanan,
    l.detail_usaha AS Detail_Usaha,
    l.harga AS Harga_Layanan,
    l.lama_proses AS Lama_Proses,
    d.jenis_dokumen AS Jenis_Dokumen,
    d.file_path AS File_Dokumen,
    d.status_dokumen AS Status_Dokumen
FROM 
    klien k
JOIN 
    daftar_transaksi t ON k.id_klien = t.id_klien
JOIN 
    layanan l ON t.id_layanan = l.id_layanan
JOIN 
    dokumen d ON k.id_klien = d.id_klien
ORDER BY 
    k.nama_pemohon;
