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

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nm_pemohon = $_POST['nm_pemohon'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jenis_layanan = $_POST['jenis_layanan'];

    // Query untuk update data
    $sql = "UPDATE voucher SET 
            nm_pemohon = '$nm_pemohon', 
            nik = '$nik', 
            email = '$email', 
            no_hp = '$no_hp', 
            jenis_layanan = '$jenis_layanan'
            WHERE id_pemohon = $id";

    if ($koneksi->query($sql) === TRUE) {
        // Redirect ke halaman utama setelah update
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pemohon</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        /* Menempatkan form di tengah secara vertikal dan horizontal */
        body, html {
            height: 100%;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            width: 100%;
            max-width: 600px;  /* Lebar maksimum form */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 1px;
        }

        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 45px;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center mb-4">Edit Data<br>Pemohon</h1>

        <!-- Form Edit -->
        <form action="edit.php?id=<?php echo $row['id_pemohon']; ?>" method="POST">
            <div class="form-group">
                <label for="nm_pemohon">Nama Pemohon</label>
                <input type="text" class="form-control" id="nm_pemohon" name="nm_pemohon" value="<?php echo $row['nm_pemohon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" id="nik" name="nik" placeholder="Masukkan NIK Anda" pattern="\d{16}" minlength="16" maxlength="16" required title="NIK harus terdiri dari 16 angka">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" required>
            </div>
            <div class="form-group">
            <div class="form-group">
                <label for="jenis_layanan">Pilih Jenis Layanan:</label>
                <select id="jenis_layanan" name="jenis_layanan" required>
                <option value="NIB">Pengurusan Nomor Induk Berusaha (NIB)</option>
                <option value="PBG">Persetujuan Bangunan Gedung (PBG)</option>
                <option value="SLF">Sertifikat Laik Fungsi (SLF)</option>
                <option value="Izin Usaha">Izin Usaha</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

</body>

</html>
