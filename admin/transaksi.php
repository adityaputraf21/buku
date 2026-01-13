<?php
session_start();
require "../config/database.php";

// Proteksi admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil data transaksi dari tabel 'transaksi'
$query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Transaksi | BookStore.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-6">📊 Data Transaksi</h2>

        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">User</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php while ($t = mysqli_fetch_assoc($query)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2 text-center"><?= $t['id']; ?></td>
                            <td class="border p-2"><?= htmlspecialchars($t['nama_user']); ?></td>
                            <td class="border p-2 font-semibold">Rp <?= number_format($t['total'], 0, ',', '.'); ?></td>
                            <td class="border p-2"><?= date("d-m-Y H:i", strtotime($t['tgl_transaksi'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center p-4 text-gray-500">Belum ada transaksi</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php" class="inline-block mt-6 text-sm text-blue-600 hover:underline">
            ← Kembali ke Dashboard
        </a>
    </div>

</body>

</html>