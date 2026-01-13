<?php
session_start();

/* Koneksi Database */
$host = "localhost";
$user = "root";
$pass = "";
$db   = "jualbuku";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

/* Contoh session user */
if (!isset($_SESSION['nama'])) {
    $_SESSION['nama'] = ""; // ganti sesuai login sebenarnya
}

/* INIT CART */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* Update qty */
if (isset($_POST['update'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
    }
    header("Location: cart.php");
    exit;
}

/* Hapus item */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

/* Hitung total */
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['harga'] * $item['qty'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang | BookStore.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white fixed w-full z-50 shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">📚 BookStore.id</h1>

            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-700">Halo, <?= $_SESSION['nama'] ?> 👋</span>
                <a href="index.php" class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                    Home
                </a>
                <a href="auth/logout.php" class="px-4 py-2 bg-red-500 text-white rounded text-sm hover:bg-red-600">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="pt-28 max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-6">Keranjang Belanja</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <p class="text-gray-600">Keranjangmu masih kosong.</p>
        <?php else: ?>
            <form method="POST">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-xl shadow overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left">Buku</th>
                                <th class="py-3 px-6 text-left">Harga</th>
                                <th class="py-3 px-6 text-left">Qty</th>
                                <th class="py-3 px-6 text-left">Subtotal</th>
                                <th class="py-3 px-6 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                                <tr class="border-b">
                                    <td class="py-3 px-6"><?= $item['judul'] ?></td>
                                    <td class="py-3 px-6">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td class="py-3 px-6">
                                        <input type="number" name="qty[<?= $id ?>]" value="<?= $item['qty'] ?>" min="0" class="w-20 border rounded px-2 py-1">
                                    </td>
                                    <td class="py-3 px-6">Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.') ?></td>
                                    <td class="py-3 px-6">
                                        <a href="cart.php?hapus=<?= $id ?>" class="text-red-500 hover:underline">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <span class="font-bold text-xl">Total: Rp <?= number_format($total, 0, ',', '.') ?></span>
                    <div class="flex gap-3">
                        <button type="submit" name="update" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update Keranjang
                        </button>
                        <a href="checkout.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Checkout
                        </a>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </div>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 text-center py-12 mt-12">
        © <?= date('Y'); ?> BookStore.id
    </footer>

</body>

</html>