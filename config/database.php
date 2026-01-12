<?php
// ================================
// KONFIGURASI DATABASE
// ================================

$host     = "localhost";
$user     = "root";
$password = "";
$database = "jualbuku";

// KONEKSI
$conn = mysqli_connect($host, $user, $password, $database);

// CEK KONEKSI
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// SET CHARSET (AMAN UNTUK UTF-8)
mysqli_set_charset($conn, "utf8mb4");
