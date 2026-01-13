<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    mysqli_query(
        $conn,
        "INSERT INTO users (nama,email,password,role)
         VALUES ('$nama','$email','$password','$role')"
    );

    header("Location: users.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form method="POST" class="bg-white p-6 rounded-xl shadow w-full max-w-md space-y-4">
        <h2 class="text-xl font-bold">➕ Tambah User</h2>

        <input type="text" name="nama" placeholder="Nama" required class="w-full border p-2 rounded">
        <input type="email" name="email" placeholder="Email" required class="w-full border p-2 rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full border p-2 rounded">

        <select name="role" class="w-full border p-2 rounded">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button class="w-full bg-blue-600 text-white py-2 rounded">
            Simpan
        </button>

        <a href="users.php" class="block text-center text-sm text-gray-500 hover:underline">
            Batal
        </a>
    </form>

</body>

</html>