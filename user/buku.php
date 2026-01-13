<?php
session_start();
require "../config/database.php";
if (!isset($_SESSION['login'])) header("Location: ../auth/login.php");

$buku = mysqli_query($conn, "SELECT * FROM buku");
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100">
    <h2 class="text-xl font-bold mb-4">Daftar Buku</h2>
    <div class="grid grid-cols-4 gap-4">
        <?php while ($b = mysqli_fetch_assoc($buku)): ?>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold"><?= $b['judul'] ?></h3>
                <p><?= $b['penulis'] ?></p>
                <p class="text-blue-600 font-bold">Rp <?= number_format($b['harga']) ?></p>
                <a href="beli.php?id=<?= $b['id'] ?>"
                    class="block text-center bg-blue-600 text-white mt-3 py-2 rounded">Beli</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>