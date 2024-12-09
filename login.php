<?php
session_start(); // Memulai sesi

$host = "localhost";
$user = "root"; 
$pass = "nungsomanang"; 
$dbname = "users_db";

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memproses form login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil username dan password dari form
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']); // Ambil password langsung dari input

    // Query untuk memeriksa data pengguna
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Bandingkan password langsung dengan data di database
        if ($password === $row['password']) {
            // Buat sesi login
            $_SESSION['username'] = $row['username'];

            // Arahkan ke halaman index.html
            header('Location: index.html');
            exit();
        } else {
            // Mengarahkan kembali ke halaman login dengan pesan kesalahan
            echo "<script>alert('Password salah.'); window.location.href='login.html';</script>";
        }
    } else {
        // Mengarahkan kembali ke halaman login dengan pesan kesalahan
        echo "<script>alert('Username tidak ditemukan.'); window.location.href='login.html';</script>";
    }
}

$conn->close();
?>
