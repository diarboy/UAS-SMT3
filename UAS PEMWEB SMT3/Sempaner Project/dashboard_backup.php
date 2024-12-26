// Dashboard Awal belum menggunakan filter ID_Member dan masih menampilkan keseluruhan data (Untuk Admin)

<?php
use Phppot\Member;
include 'koneksi.php';
session_start();

// Cek jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil member_id dari tabel tbl_member berdasarkan username
$sql = "SELECT id FROM tbl_member WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($member_id);
$stmt->fetch();
$stmt->close();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nm_pemohon = $_POST['nm_pemohon'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jenis_layanan = $_POST['jenis_layanan'];

    // Query untuk memasukkan data beserta id_member
    $sql = "INSERT INTO voucher (id_member, nm_pemohon, nik, email, no_hp, jenis_layanan) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("isssss", $id_member, $nm_pemohon, $nik, $email, $no_hp, $jenis_layanan);

    // Eksekusi query dan periksa apakah berhasil
    if ($koneksi->query($sql) === TRUE) {
        // Redirect ke halaman yang sama untuk mencegah re-POST
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard Pengguna</title>
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

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading-dashboard">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h6>Anda masuk sebagai <?php echo $username; ?> </h6>
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

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Dashboard</h2>
        <div><span>Daftar</span> <span class="description-title">Permohonan</span></div>
      </div><!-- End Section Title -->

      <div class="container mt-1">

        <!-- Tabel Data -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">No HP</th>
                    <th class="text-center">Jenis Layanan</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
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

                // Query untuk mengambil data
                $sql = "SELECT id_pemohon, nm_pemohon, nik, email, no_hp, jenis_layanan FROM voucher";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1; // Variabel untuk nomor urut
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $row["nm_pemohon"] . "</td>
                                <td class='text-center'>" . $row["nik"] . "</td>
                                <td class='text-center'>" . $row["email"] . "</td>
                                <td class='text-center'>" . $row["no_hp"] . "</td>
                                <td class='text-center'>" . $row["jenis_layanan"] . "</td>
                                <td class='text-center'>
                                    <a class='select-menu' href='print.php?id=" . $row["id_pemohon"] . "' target='_blank'>Print</a> 
                                    <a class='select-menu' href='edit.php?id=" . $row["id_pemohon"] . "'>Edit</a> 
                                    <a class='delete-menu' href='delete.php?id=" . $row["id_pemohon"] . "' onclick='return confirmDelete()'>Hapus</a>

                                </td>
                            </tr>";
                        $no++; // Increment nomor urut
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </section><!-- /Dashboard Section -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Dashboard</h2>
        <div><span>Daftar</span> <span class="description-title">Permohonan</span></div>
      </div><!-- End Section Title -->

      <div class="container mt-1">

        <!-- Tabel Data -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">No HP</th>
                    <th class="text-center">Jenis Layanan</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
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

                // Query untuk mengambil data
                $sql = "SELECT id_pemohon, nm_pemohon, nik, email, no_hp, jenis_layanan FROM voucher";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1; // Variabel untuk nomor urut
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $row["nm_pemohon"] . "</td>
                                <td class='text-center'>" . $row["nik"] . "</td>
                                <td class='text-center'>" . $row["email"] . "</td>
                                <td class='text-center'>" . $row["no_hp"] . "</td>
                                <td class='text-center'>" . $row["jenis_layanan"] . "</td>
                                <td class='text-center'>
                                    <a class='select-menu' href='print.php?id=" . $row["id_pemohon"] . "' target='_blank'>Print</a> 
                                    <a class='select-menu' href='edit.php?id=" . $row["id_pemohon"] . "'>Edit</a> 
                                    <a class='delete-menu' href='delete.php?id=" . $row["id_pemohon"] . "' onclick='return confirmDelete()'>Hapus</a>

                                </td>
                            </tr>";
                        $no++; // Increment nomor urut
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </section><!-- /Dashboard Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <div><span>Butuh Bantuan?</span> <span class="description-title">Hubungi Kami</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>103A, Basecamp, Cirebon, ID 45121</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+62 857 59 200 400</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>ardibukan77@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

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
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
function confirmDelete() {
    return confirm("Apakah Anda yakin ingin menghapus data ini?");
}
</script>
</body>

</html>