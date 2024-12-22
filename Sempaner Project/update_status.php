<?php
include 'koneksi.php';
$conn = $koneksi;
$success_message = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data pengajuan
    $sql = "SELECT * FROM pengajuan_layanan WHERE id = $id";
    $result = $conn->query($sql);
    $pengajuan = $result->fetch_assoc();

    if (isset($_POST['update_status'])) {
        $status = $_POST['status'];
        $sql_update = "UPDATE pengajuan_layanan SET status_pengajuan = '$status' WHERE id = $id";
        
        if ($conn->query($sql_update) === TRUE) {
            $success_message = "Status berhasil diperbarui.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Pengajuan</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5 justify-content-center">
    <div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h2>Update Status Pengajuan</h2>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Pengajuan:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Menunggu Evaluasi">Menunggu Evaluasi</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="update_status" class="btn btn-primary">Update Status</button>
                        <a href="daftar_transaksi.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast for Success Message -->
    <?php if ($success_message): ?>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $success_message; ?>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Initialize toast
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl)
        })
        toastList.forEach(function (toast) {
            toast.show()
        })
    </script>
</body>
</html>
