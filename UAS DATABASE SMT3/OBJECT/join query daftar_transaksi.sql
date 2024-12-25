SELECT 
    dt.id_transaksi,
    k.nama_pemohon AS nama_klien,
    l.jenis_layanan,
    dt.harga_total,
    dt.status,
    dt.status_pembayaran,
    dt.nomor_invoice,
    dt.created_at,
    dt.updated_at
FROM 
    daftar_transaksi dt
JOIN 
    klien k ON dt.id_klien = k.id_klien
JOIN 
    layanan l ON dt.id_layanan = l.id_layanan;
