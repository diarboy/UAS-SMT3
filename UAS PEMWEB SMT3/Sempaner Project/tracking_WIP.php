<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

$username = $_SESSION['username'];
$conn = $koneksi;
$sql = "SELECT * FROM pengajuan_layanan WHERE $username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username); // Bind parameter untuk mencegah SQL Injection
$stmt->execute();
$result = $stmt->get_result();
?>

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
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  
  <!-- DATA TABLE JS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  
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
          <li>
            <form action="logout.php" method="POST">
             <button type="submit" class="navmenu-btn">Logout</button>
            </form>
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
        <h2>Lacak Permohonan</h2>
        <div><span>Daftar</span> <span class="description-title">Transaksi</span></div>
     
    </div><!-- End Section Title -->
    <div class= "table-responsive">
    <table id="myTable" class="table table-bordered table-striped" data-aos="fade-in" style="width: 100%; margin: 20px; text-align: center; ">
        <thead class="thead-dark">
          <tr>
              <th>ID</th>
              <th>Nama Klien</th>
              <th>N.I.K</th>
              <th>No. HP</th>
              <th>Nama Perusahaan</th>
              <th>Alamat Usaha</th>
              <th>Jenis Layanan</th>
              <th>Detail Usaha</th>
              <th>Jenis Bangunan</th>
              <th>Dokumen Persyaratan</th>
              <th>Dokumen Gambar</th>
              <th>Dokumen Lainnya</th>
              <th>Tanggal Transaksi</th>
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
                      <td><?php echo htmlspecialchars($row['nik']); ?></td>
                      <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                      <td><?php echo htmlspecialchars($row['nama_perusahaan']); ?></td>
                      <td><?php echo htmlspecialchars($row['alamat_usaha']); ?></td>
                      <td><?php echo htmlspecialchars($row['jenis_layanan']); ?></td>
                      <td><?php echo htmlspecialchars($row['detail_usaha']); ?></td>
                      <td><?php echo htmlspecialchars($row['jenis_bangunan']); ?></td>
                      
                      <!-- cara download simple line tanpa ada pemeriksaan -->
                      <td><?php echo htmlspecialchars($row['dokumen_persyaratan']); ?> <a href="uploads/<?php echo htmlspecialchars($row['dokumen_persyaratan']); ?>" class="navmenu-btn" download> Download </a></td> 
                      
                      <!-- cara download validasi anti XSS -->
                      <td>
                          <?php
                          $dokumen_gambar = htmlspecialchars($row['dokumen_gambar']);
                          // Pastikan file ada dan bisa diakses
                          $filePath = "uploads/" . $dokumen_gambar;
                          if (file_exists($filePath)) {
                              echo $dokumen_gambar;
                              echo '<a href="' . $filePath . '" class="navmenu-btn" download>Download</a>';
                          } else {
                              echo 'File tidak tersedia';
                          }
                          ?>
                      </td>
                      <td>
                          <?php
                          $dokumen_lainnya = htmlspecialchars($row['dokumen_lainnya']);
                          // Pastikan file ada dan bisa diakses
                          $filePath = "uploads/" . $dokumen_lainnya;
                          if (file_exists($filePath)) {
                              echo $dokumen_lainnya;
                              echo '<a href="' . $filePath . '" class="navmenu-btn" download>Download</a>';
                          } else {
                              echo 'File tidak tersedia';
                          }
                          ?>
                      </td>
                      <td><?php echo htmlspecialchars($row['tanggal_pengajuan']); ?></td>
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
<script src="assets/vendor/aos/aos.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

<script>
$(document).ready(function () {
    $('#myTable').DataTable({
        responsive: true,
        "lengthMenu": [5, 10, 25, 50], // Pilihan jumlah baris
        "pageLength": 5,               // Default 5 baris
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(disaring dari total _MAX_ data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        },
        "dom": 'Bfrtip',  // B: Tombol, f: Pencarian, r: Pembaca pencarian, t: Tabel, i: Informasi, p: Paginasi
    });
});
</script>



</body>
</html>