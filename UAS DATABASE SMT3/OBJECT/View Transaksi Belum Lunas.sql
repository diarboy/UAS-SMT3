CREATE VIEW transaksi_belum_lunas AS
SELECT daftar_transaksi.id_transaksi, klien.nama_pemohon AS nama_pemohon, 
layanan.jenis_layanan AS jenis_layanan, daftar_transaksi.harga_total
FROM daftar_transaksi
JOIN klien ON daftar_transaksi.id_klien = klien.id_klien
JOIN layanan ON daftar_transaksi.id_layanan = layanan.id_layanan
WHERE daftar_transaksi.status_pembayaran = 'Belum Lunas';
