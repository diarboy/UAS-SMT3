INSERT INTO `daftar_transaksi` (`id_transaksi`, `id_klien`, `id_layanan`, `harga_total`, `status`, `status_pembayaran`, `nomor_invoice`)
VALUES
(1, 1, 1, 50000000.00, 'Pending', 'Belum Lunas', 'INV001'),
(2, 1, 2, 15000000.00, 'Dalam Proses', 'Lunas', 'INV002'),
(3, 2, 1, 50000000.00, 'Selesai', 'Lunas', 'INV003'),
(4, 2, 2, 15000000.00, 'Pending', 'Belum Lunas', 'INV004'),
(5, 3, 1, 50000000.00, 'Dalam Proses', 'Belum Lunas', 'INV005'),
(6, 3, 2, 15000000.00, 'Selesai', 'Lunas', 'INV006'),
(7, 4, 1, 50000000.00, 'Pending', 'Belum Lunas', 'INV007'),
(8, 4, 2, 15000000.00, 'Dalam Proses', 'Belum Lunas', 'INV008'),
(9, 5, 1, 50000000.00, 'Selesai', 'Lunas', 'INV009'),
(10, 5, 2, 15000000.00, 'Pending', 'Belum Lunas', 'INV010');