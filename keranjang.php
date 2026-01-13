<?php
session_start();

// Hapus item jika ada request
if (isset($_GET['hapus'])) {
    $hapus_id = $_GET['hapus'];
    foreach ($_SESSION['keranjang'] as $key => $item) {
        if ($item['id'] == $hapus_id) {
            unset($_SESSION['keranjang'][$key]);
            $_SESSION['keranjang'] = array_values($_SESSION['keranjang']); // reindex
            break;
        }
    }
    header("Location: keranjang.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-20 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">🛒 Keranjang Belanja</h2>

    <?php if (empty($_SESSION['keranjang'])): ?>
        <p class="text-gray-500">Keranjang masih kosong</p>
    <?php else: ?>
        <?php $total = 0; ?>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Buku</th>
                    <th class="py-2">Harga</th>
                    <th class="py-2">Qty</th>
                    <th class="py-2">Total</th>
                    <th class="py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['keranjang'] as $item): ?>
                    <?php $subtotal = $item['harga'] * (isset($item['qty']) ? $item['qty'] : 1); ?>
                    <tr class="border-b">
                        <td class="py-2"><?= $item['judul']; ?></td>
                        <td class="py-2">Rp<?= number_format($item['harga']); ?></td>
                        <td class="py-2"><?= isset($item['qty']) ? $item['qty'] : 1; ?></td>
                        <td class="py-2 font-bold">Rp<?= number_format($subtotal); ?></td>
                        <td class="py-2">
                            <a href="?hapus=<?= $item['id']; ?>" 
                               class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php $total += $subtotal; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-6 flex justify-between items-center">
            <div class="font-bold text-lg">
                Total Keseluruhan: Rp<?= number_format($total); ?>
            </div>
            <a href="checkout.php" 
               class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
               Checkout & Bayar
            </a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
