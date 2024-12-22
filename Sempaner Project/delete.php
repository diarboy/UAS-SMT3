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

// Cek apakah ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM voucher WHERE id_pemohon = $id";

    if ($koneksi->query($sql) === TRUE) {
        // Redirect ke halaman utama setelah penghapusan
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "ID tidak ditemukan!";
}

// Tutup koneksi
$koneksi->close();
?>
