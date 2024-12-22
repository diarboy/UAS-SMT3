<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

include 'koneksi.php';
$username = $_SESSION['username'];
$conn = $koneksi;
$sql = "SELECT * FROM pengajuan_layanan";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard Admin</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="dashboard-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename"><span>Sempaner</span> Karya Gemilang</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="dashboard_admin.php" class="active">Beranda</a></li>
          <li><a href="daftar_transaksi.php">Daftar Transaksi</a></li>
          <li>
          <form action="logout.php" method="POST">
          <button type="submit" class="navmenu-btn">Logout</button>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

    <main class="main">

    <!-- Dashboard Section -->
    <section id="starter-section" class="starter-section section">

    <div class="page-title" data-aos="fade">
    <div class="heading-dashboard">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                <h6>Anda masuk sebagai <?php echo $username; ?></h6>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
        <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Dashboard</li>
        </ol>
        </div>
    </nav>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Dashboard Admin</h2>
        <div><span>Daftar</span> <span class="description-title">Pengajuan</span></div>
     
        </div><!-- End Section Title -->
<table class="table table-bordered table-striped" data-aos="fade-in" style="width: 80%; margin: auto; text-align: center; ">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nama Klien</th>
            <th>Jenis Layanan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_pemohon']); ?></td>
                    <td><?php echo htmlspecialchars($row['jenis_layanan']); ?></td>
                    <td><?php echo htmlspecialchars($row['status_pengajuan']); ?></td>
                    <td><a href="update_status.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="navmenu-btn">Update Status</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Tidak ada data tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

    </section><!-- /Dashboard Section -->

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

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>
</html>
