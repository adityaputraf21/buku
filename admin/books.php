<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$buku = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">📚 Kelola Buku</h2>
            <a href="book_add.php"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Buku
            </a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Gambar</th>
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Penulis</th>
                    <th class="border p-2">Harga</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($buku)) : ?>
                    <tr class="text-center">
                        <td class="border p-2">
                            <img src="<?= htmlspecialchars($row['gambar']); ?>"
                                alt="<?= htmlspecialchars($row['judul']); ?>"
                                class="w-20 h-24 object-cover mx-auto rounded">
                        </td>
                        <td class="border p-2"><?= htmlspecialchars($row['judul']); ?></td>
                        <td class="border p-2"><?= htmlspecialchars($row['penulis']); ?></td>
                        <td class="border p-2">Rp <?= number_format($row['harga']); ?></td>
                        <td class="border p-2 flex justify-center gap-2">
                            <a href="book_edit.php?id=<?= $row['id']; ?>"
                                class="text-blue-600 hover:underline">Edit</a>
                            <a href="book_delete.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Hapus buku ini?')"
                                class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="index.php" class="inline-block mt-6 text-sm text-gray-600 hover:underline">
            ← Kembali ke Dashboard
        </a>
    </div>

</body>

</html>