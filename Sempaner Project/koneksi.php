<?php
// Informasi koneksi
$host = "localhost"; // Nama host (default: localhost)
$username = "root";  // Username database (default: root)
$password = "";      // Password database
$database = "contact_form"; // Nama database

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

?>
