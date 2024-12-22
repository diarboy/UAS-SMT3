<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "contact_form";

$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data pemohon berdasarkan ID
    $sql = "SELECT * FROM voucher WHERE id_pemohon = $id";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sempaner Karya Gemilang</title>
    <!-- Menambahkan Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling untuk cetak */
        @media print {
            body {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif, sans-serif;
                margin: 20px;
            }
            .print-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ddd;
            }
            .print-container h1 {
                text-align: center;
            }
            .print-container table {
                width: 100%;
                border-collapse: collapse;
            }
            .print-container table, .print-container th, .print-container td {
                border: 1px solid black;
            }
            .print-container th, .print-container td {
                padding: 8px;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="print-container">
            <h1 class="text-center mb-4">Data Pemohon</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Nama Pemohon</th>
                    <td><?php echo htmlspecialchars($row['nm_pemohon']); ?></td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td><?php echo htmlspecialchars($row['nik']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                </tr>
                <tr>
                    <th>Jenis Layanan</th>
                    <td><?php echo htmlspecialchars($row['jenis_layanan']); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        // Trigger dialog print saat halaman dimuat
        window.print();
    </script>

    <!-- Menambahkan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
