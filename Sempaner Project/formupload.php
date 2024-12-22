<?php
// Koneksi ke database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("<div style='color: red;'>Connection failed: " . $conn->connect_error . "</div>");
}

$message = ""; // Variabel untuk menyimpan pesan notifikasi

if (isset($_POST['submit'])) {

    // Ambil data dari POST dengan sanitasi
    $nama_pemohon = htmlspecialchars($_POST['nama_pemohon'] ?? '');
    $nik = htmlspecialchars($_POST['nik'] ?? '');
    $no_hp = htmlspecialchars($_POST['no_hp'] ?? '');
    $nama_perusahaan = htmlspecialchars($_POST['nama_perusahaan'] ?? '');
    $alamat_usaha = htmlspecialchars($_POST['alamat_usaha'] ?? '');
    $jenis_layanan = htmlspecialchars($_POST['jenis_layanan'] ?? '');
    $detail_usaha = htmlspecialchars($_POST['detail_usaha'] ?? '');
    $jenis_bangunan = htmlspecialchars($_POST['jenis_bangunan'] ?? '');

    $target_dir = "uploads/";

    // Pastikan direktori `uploads` ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Membuat direktori jika belum ada
    }

    // Fungsi untuk mengupload file
    function upload_file($file, $target_dir) {
        if (!empty($file["name"])) {
            $target_file = $target_dir . basename($file["name"]);
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_file; // Kembalikan path file yang berhasil diunggah
            }
        }
        return ''; // Jika tidak ada file atau gagal upload, kembalikan string kosong
    }

    // Proses upload file
    $dokumen_persyaratan = upload_file($_FILES["dokumen_persyaratan"], $target_dir);
    $dokumen_gambar = upload_file($_FILES["dokumen_gambar"], $target_dir);
    $dokumen_lainnya = upload_file($_FILES["dokumen_lainnya"], $target_dir);

    // Query untuk memasukkan data ke dalam database menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO pengajuan_layanan 
        (nama_pemohon, nik, no_hp, nama_perusahaan, alamat_usaha, jenis_layanan, detail_usaha, jenis_bangunan, dokumen_persyaratan, dokumen_gambar, dokumen_lainnya) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssssssssss",
        $nama_pemohon,
        $nik,
        $no_hp,
        $nama_perusahaan,
        $alamat_usaha,
        $jenis_layanan,
        $detail_usaha,
        $jenis_bangunan,
        $dokumen_persyaratan,
        $dokumen_gambar,
        $dokumen_lainnya
    );

    if ($stmt->execute()) {
        echo "<script>
                alert('Pengajuan berhasil dikirim.');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan: " . addslashes($stmt->error) . "');
                window.location.href = 'dashboard.php';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>