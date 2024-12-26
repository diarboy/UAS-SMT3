<?php
include 'koneksi.php';
session_start(); // Pastikan sesi dimulai
$error_message = "";
$conn = $koneksi;

// Pastikan pengguna telah login dan username tersedia di sesi
if (!isset($_SESSION['username'])) {
    echo "<script>
            alert('Anda harus login terlebih dahulu.');
            window.location.href = 'login.php';
          </script>";
    exit;
}

$username = $_SESSION['username'];

// Ambil id_member dari tabel tbl_member berdasarkan username
$sql = "SELECT id FROM tbl_member WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($id_member);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_hp = htmlspecialchars($_POST["no_hp"]);
    $nm_pemohon = htmlspecialchars($_POST["nm_pemohon"]);
    $nik = htmlspecialchars($_POST["nik"]);
    $email = htmlspecialchars($_POST["email"]);
    $jenis_layanan = htmlspecialchars($_POST["jenis_layanan"]);

    // Validasi input
    if (empty($no_hp)) {
        $error_message = "Nomor HP wajib diisi.";
    } elseif (!preg_match("/^\d{10,13}$/", $no_hp)) {
        $error_message = "Nomor HP tidak valid. Contoh: 0857123456789";
    }

      if (empty($error_message)) {
        // $stmt = $conn->prepare("INSERT INTO voucher (no_hp, nm_pemohon, nik, email, jenis_layanan) VALUES (?, ?, ?, ?, ?)");
        $stmt = $conn->prepare("INSERT INTO voucher (id_member, no_hp, nm_pemohon, nik, email, jenis_layanan) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Bind data ke query
        // $stmt->bind_param("sssss", $no_hp, $nm_pemohon, $nik, $email, $jenis_layanan);
        $stmt->bind_param("isssss", $id_member, $no_hp, $nm_pemohon, $nik, $email, $jenis_layanan);
        
        if ($stmt->execute()) {
            echo "<script>
                    alert('Pengajuan berhasil dikirim.');
                    window.location.href = 'dashboard.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Terjadi kesalahan: " . addslashes($stmt->error) . "');
                    window.location.href = 'voucher.php';
                  </script>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sempaner Consultant</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="form-page">

<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="Logo">
      <h1 class="sitename"><span>Sempaner</span> Karya Gemilang</h1>
    </a>
    <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="dashboard.php" class="active">Beranda</a></li>
          
          <li class="dropdown"><a href="#"><span>Formulir</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
            <li><a href="voucher.php">Pesan Voucher</a></li>
            <li><a href="form.html">Permohonan</a></li>
            <li><a href="formulir_pengajuan.html">Permohonan DB</a></li>
            </ul>
            </li>
          <li class="dropdown"><a href="#"><span>Daftar Transaksi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="dashboard.php">Riwayat</a></li>
              <li><a href="tracking.php">Lacak Permohonan</a></li>
            </ul>
            </li>
          <li><a href="logout.php">Logout</a>
            <!-- <form action= "logout.php" method="POST">
             <button type="submit" class="navmenu-btn" name="logout">Logout</button>
            </form> -->
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
  </div>
</header>

<main>
  <section class="contact-form">
    <h1>Formulir Pemesanan Voucher</h1>

    <form id="contactForm" method="POST" action="">
      <div class="form-group">
        <label for="name">Nama Pemohon</label>
        <input type="text" id="name" name="nm_pemohon" placeholder="Masukkan Nama Anda" required>
      </div>
      <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" id="nik" name="nik" placeholder="Masukkan NIK Anda" pattern="\d{16}" minlength="16" maxlength="16" required title="NIK harus terdiri dari 16 angka">
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Masukkan Email Anda" required>
      </div>
      <div class="form-group">
        <label for="no_hp">No. Handphone</label>
        <input type="tel" id="no_hp" name="no_hp" placeholder="0857-1234-56789" pattern="\d{10,13}" maxlength="13" required>
      </div>
      <div class="form-group">
        <label for="jenis_layanan">Pilih Jenis Layanan:</label>
        <select id="jenis_layanan" name="jenis_layanan" required>
          <option value="NIB">Pengurusan Nomor Induk Berusaha (NIB)</option>
          <option value="PBG">Persetujuan Bangunan Gedung (PBG)</option>
          <option value="SLF">Sertifikat Laik Fungsi (SLF)</option>
          <option value="Izin Usaha">Izin Usaha</option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
      <?php if ($error_message): ?>
      <div class="alert alert-danger mt-3"><?php echo $error_message; ?></div>
      <?php endif; ?>
    </form>
  </section>
</main>

<footer id="footer" class="footer light-background">

<div class="container">
  <div class="copyright text-center ">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">Sempaner</strong> <span>All Rights Reserved</span></p>
  </div>
  <div class="social-links d-flex justify-content-center">
    <a href=""><i class="bi bi-twitter-x"></i></a>
    <a href=""><i class="bi bi-facebook"></i></a>
    <a href=""><i class="bi bi-instagram"></i></a>
    <a href=""><i class="bi bi-linkedin"></i></a>
  </div>
  <div class="credits">
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!--=============== MAIN JS ===============-->
<script src="assets/js/main.js"></script>
<script src="assets/css/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</body>
</html>
