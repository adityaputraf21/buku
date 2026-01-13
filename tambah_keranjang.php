<?php
session_start();

$id     = $_POST['id'];
$judul  = $_POST['judul'];
$harga  = (int)$_POST['harga']; // pastikan angka

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// cek dulu kalau buku sama sudah ada, tambahkan qty
$found = false;
foreach ($_SESSION['keranjang'] as &$item) {
    if ($item['id'] == $id) {
        $item['qty'] += 1;
        $found = true;
        break;
    }
}
if (!$found) {
    $_SESSION['keranjang'][] = [
        'id' => $id,
        'judul' => $judul,
        'harga' => $harga,
        'qty' => 1
    ];
}

header("Location: index.php");
exit;
