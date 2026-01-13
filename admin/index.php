<?php
session_start();
require "../config/database.php";

/* PROTEKSI ADMIN */
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

/* STATISTIK */
$totalUser = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM users")
)['total'];

$totalBuku = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM buku")
)['total'];

$totalTransaksi = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM transactions")
)['total'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | BookStore.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="font-bold text-blue-600">📚 BookStore.id (Admin)</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    Admin: <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong>
                </span>
                <a href="../auth/logout.php"
                    class="text-sm text-red-500 hover:underline">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-10">

        <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

        <!-- STATISTIK -->
        <div class="grid md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-sm text-gray-500">Total User</h3>
                <p class="text-2xl font-bold mt-2"><?= $totalUser; ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-sm text-gray-500">Total Buku</h3>
                <p class="text-2xl font-bold mt-2"><?= $totalBuku; ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-sm text-gray-500">Transaksi</h3>
                <p class="text-2xl font-bold mt-2"><?= $totalTransaksi; ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-sm text-gray-500">Status Sistem</h3>
                <p class="text-2xl font-bold mt-2 text-green-600">Online</p>
            </div>
        </div>

        <!-- MENU ADMIN -->
        <div class="grid md:grid-cols-3 gap-6">

            <a href="books.php"
                class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-lg mb-2">📚 Kelola Buku</h3>
                <p class="text-sm text-gray-600">
                    Tambah, edit, dan hapus buku
                </p>
            </a>

            <a href="users.php"
                class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-lg mb-2">👥 Kelola User</h3>
                <p class="text-sm text-gray-600">
                    Lihat dan atur akun pengguna
                </p>
            </a>

            <a href="transaksi.php"
                class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-semibold text-lg mb-2">🧾 Riwayat Transaksi</h3>
                <p class="text-sm text-gray-600">
                    Laporan & histori pembelian
                </p>
            </a>

        </div>

    </main>

</body>

</html>