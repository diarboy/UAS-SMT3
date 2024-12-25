<?php
header('Content-Type: application/json');

// Konfigurasi email tujuan
$to_email = "ardibukan77@gmail.com"; // Ganti dengan email tujuan
$subject_prefix = "Contact Form Submission"; // Subject default

// Konfigurasi koneksi database
$servername = "localhost"; // Server database
$username = "root";        // Username database
$password = "";            // Password database
$dbname = "contact_form";  // Nama database

$response = []; // Array untuk menyimpan respon

// Cek apakah data dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Validasi data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $response['status'] = 'error';
        $response['message'] = 'All fields are required!';
        echo json_encode($response);
        exit;
    }

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['status'] = 'error';
        $response['message'] = 'Invalid email format!';
        echo json_encode($response);
        exit;
    }

    // Kirim email
    $email_body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
    $email_subject = "$subject_prefix - $subject";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to_email, $email_subject, $email_body, $headers)) {
        $response['email'] = "Message sent successfully!";
    } else {
        $response['email'] = "Failed to send the message.";
        $response['status'] = 'error'; // Tambahkan status error jika email gagal
        echo json_encode($response);
        exit;
    }

    // Simpan data ke database
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        $stmt->execute();
        $response['database'] = "Data saved successfully!";
    } catch (PDOException $e) {
        $response['database'] = "Failed to save data: " . $e->getMessage();
        $response['status'] = 'error'; // Tambahkan status error jika gagal menyimpan data
        echo json_encode($response);
        exit;
    }

    // Close connection
    $conn = null;
    $response['status'] = 'success'; // Jika semua berhasil
    echo json_encode($response);
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
}
?>
