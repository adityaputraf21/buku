<?php
session_start();

// Kalau mau, di sini nanti bisa proses pembayaran dengan gateway
// Sementara cuma hapus keranjang dan tampil pesan sukses
if (!empty($_SESSION['keranjang'])) {
    $total = 0;
    foreach ($_SESSION['keranjang'] as $item) {
        $total += $item['harga'] * (isset($item['qty']) ? $item['qty'] : 1);
    }
    // Hapus semua keranjang setelah checkout
    $_SESSION['keranjang'] = [];
} else {
    $total = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-20 bg-white p-6 rounded shadow text-center">
    <h1 class="text-2xl font-bold mb-4">✅ Checkout Sukses</h1>

    <?php if ($total > 0): ?>
        <p class="mb-4">Total pembayaran Anda: <span class="font-bold">Rp<?= number_format($total); ?></span></p>
        <p>Terima kasih telah membeli buku di BookStore.id!</p>
    <?php else: ?>
        <p class="text-gray-500">Keranjang Anda kosong.</p>
    <?php endif; ?>

    <a href="index.php" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Kembali ke Beranda
    </a>
</div>

</body>
</html>
