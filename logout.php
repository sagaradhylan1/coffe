<?php
session_start();
session_destroy(); // Hapus semua sesi
header("Location: login.html"); // Kembali ke login
exit;
?>
