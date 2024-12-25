<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sempaner Consultant</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

<body class="index-page">

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename"><span>Sempaner</span> Karya Gemilang</h1>
      </a>

      <nav id="navmenu" class="navmenu">
      <ul>
          <li><a href="dashboard.php" class="active">Home</a></li>
          <li><a href="form.php">Form</a></li>
          <li><a href="tabel.php">Data Tabel</a></li>
          <li><a href="logout.php">Log Out</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header> 

  <?php
include 'koneksi.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nm_pemohon = $_POST['nm_pemohon'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jml_beli = $_POST['jml_beli'];

    // Query untuk memasukkan data ke database
    $sql = "INSERT INTO voucher (nm_pemohon, nik, email, no_hp, jml_beli) 
            VALUES ('$nm_pemohon', '$nik', '$email', '$no_hp', '$jml_beli')";

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
  <div class="container mt-1">
        <h1 class="text-center mb-3">Data Pemohon</h1>
        
        <!-- Tabel Data -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th>NIK</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Jumlah Beli</th>
                    <th>Action</th>
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
                $sql = "SELECT id_pemohon, nm_pemohon, nik, email, no_hp, jml_beli FROM voucher";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1; // Variabel untuk nomor urut
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $row["nm_pemohon"] . "</td>
                                <td>" . $row["nik"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["no_hp"] . "</td>
                                <td>" . $row["jml_beli"] . "</td>
                                <td>
                                    <a href='print.php?id=" . $row["id_pemohon"] . "' target='_blank'>Print</a> |
                                    <a href='edit.php?id=" . $row["id_pemohon"] . "'>Edit</a> | 
                                    <a href='delete.php?id=" . $row["id_pemohon"] . "'>Hapus</a>
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