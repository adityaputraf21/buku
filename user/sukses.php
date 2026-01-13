<?php
session_start();
if (!isset($_GET['transaksi_id'])) {
    header("Location: index.php");
    exit;
}
$transaksi_id = $_GET['transaksi_id'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Transaksi Berhasil | BookStore.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col items-center justify-center min-h-screen">

    <div class="bg-white p-12 rounded-xl shadow text-center">
        <h2 class="text-3xl font-bold mb-4 text-green-600">🎉 Transaksi Berhasil!</h2>
        <p class="mb-6">Terima kasih telah berbelanja di BookStore.id</p>
        <p class="mb-6 font-semibold">ID Transaksi: <?= $transaksi_id ?></p>
        <a href="index.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            Kembali ke Beranda
        </a>
    </div>

</body>

</html>