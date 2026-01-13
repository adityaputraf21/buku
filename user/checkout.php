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
    $_SESSION['nama'] = "Aditya"; // ganti login sebenarnya
}

/* Cek keranjang kosong */
if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}

/* Hitung total */
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['harga'] * $item['qty'];
}

/* Simpan transaksi */
if (isset($_POST['checkout'])) {
    $nama_user = $_SESSION['nama'];

    // Insert ke tabel transaksi
    $stmt = $conn->prepare("INSERT INTO transaksi (nama_user, total) VALUES (?, ?)");
    $stmt->bind_param("si", $nama_user, $total);
    $stmt->execute();
    $transaksi_id = $stmt->insert_id;

    // Insert ke detail
    $stmtDetail = $conn->prepare("INSERT INTO transaksi_detail (transaksi_id, buku_id, judul, harga, qty) VALUES (?, ?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $id => $item) {
        $stmtDetail->bind_param("iisii", $transaksi_id, $id, $item['judul'], $item['harga'], $item['qty']);
        $stmtDetail->execute();
    }

    // Kosongkan cart
    $_SESSION['cart'] = [];

    header("Location: sukses.php?transaksi_id=$transaksi_id");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout | BookStore.id</title>
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

    <div class="pt-28 max-w-2xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-6">Checkout</h2>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-semibold text-lg mb-4">Ringkasan Belanja</h3>

            <ul class="mb-4">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <li class="flex justify-between mb-2">
                        <span><?= $item['judul'] ?> x <?= $item['qty'] ?></span>
                        <span>Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="flex justify-between font-bold text-xl mb-6">
                <span>Total</span>
                <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>

            <form method="POST">
                <button name="checkout" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>

    <footer class="bg-gray-900 text-gray-300 text-center py-12 mt-12">
        © <?= date('Y'); ?> BookStore.id
    </footer>

</body>

</html>