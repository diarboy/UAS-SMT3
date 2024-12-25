INSERT INTO `dokumen` (`id_dokumen`, `id_klien`, `id_transaksi`,
`jenis_dokumen`, `file_path`, `status_dokumen`)
VALUES
(1, 1, 1, 'Dokumen Legalitas PT CJE', '/path/to/legalitas1.pdf', 'Pending'),
(2, 1, 2, 'IMB Lama PT CJE', '/path/to/pgb.pdf', 'Validasi'),
(3, 2, 3, 'Dokumen Legalitas', '/path/to/legalitas2.pdf', 'Validasi'),
(4, 2, 4, 'SLF SEMPANER', '/path/to/slf.pdf', 'Pending'),
(5, 3, 5, 'Dokumen Legalitas', '/path/to/legalitas3.pdf', 'Pending'),
(6, 3, 6, 'SLF PT Ciayumajakuning', '/path/to/slf.pdf', 'Validasi');