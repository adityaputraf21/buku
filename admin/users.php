<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">👥 Kelola User</h2>
            <a href="user_add.php"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah User
            </a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Role</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($u = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td class="border p-2"><?= htmlspecialchars($u['nama']); ?></td>
                        <td class="border p-2"><?= htmlspecialchars($u['email']); ?></td>
                        <td class="border p-2"><?= $u['role']; ?></td>
                        <td class="border p-2 flex gap-2">
                            <a href="user_edit.php?id=<?= $u['id']; ?>"
                                class="text-blue-600 hover:underline">Edit</a>
                            <a href="user_delete.php?id=<?= $u['id']; ?>"
                                onclick="return confirm('Hapus user ini?')"
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