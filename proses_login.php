<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "nungsomanang";
$dbname = "users_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query untuk memeriksa username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password (belum hashing, untuk demo)
        if ($password == $row['password']) {
            $_SESSION['username'] = $username; // Set sesi login
            header("Location: home.php"); // Redirect ke halaman utama
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='login.html';</script>";
    }
}

$conn->close();
?>
