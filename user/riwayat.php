<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_user = $_SESSION['id'];
$id_buku = intval($_GET['id']);

$buku = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM books WHERE id = $id_buku")
);

if (!$buku) {
    die("Buku tidak ditemukan");
}

if ($buku['stok'] <= 0) {
    die("Stok buku habis");
}

mysqli_query($conn, "
    INSERT INTO transactions (user_id, book_id, jumlah, total)
    VALUES (
        '$id_user',
        '$id_buku',
        1,
        '{$buku['harga']}'
    )
");
mysqli_query($conn, "
    UPDATE books SET stok = stok - 1 WHERE id = $id_buku
");

header("Location: riwayat.php");
exit;
