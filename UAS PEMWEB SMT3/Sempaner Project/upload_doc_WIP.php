<?php
include 'koneksi.php';
session_start();

// Cek jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

$username = $_SESSION['username'];
$conn = $koneksi;
$sql = "SELECT * FROM pengajuan_layanan";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $targetDir = "uploads/";
    $fieldName = key($_FILES);

    if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == 0) {
        $fileName = basename($_FILES[$fieldName]['name']);
        $targetFilePath = $targetDir . $fileName;

        // Validasi tipe file
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = ['pdf', 'jpg', 'png'];
        if (in_array($fileType, $allowedTypes)) {
            // Pindahkan file
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFilePath)) {
                // Update database
                $sql = "UPDATE myTable SET $fieldName = '$fileName' WHERE id = $id";
                if ($conn->query($sql)) {
                    echo "Dokumen berhasil diunggah.";
                } else {
                    echo "Gagal memperbarui database.";
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            echo "Format file tidak valid.";
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }
}
?>
