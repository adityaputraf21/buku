<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    mysqli_query(
        $conn,
        "UPDATE users SET
         nama='$nama',
         email='$email',
         role='$role'
         WHERE id='$id'"
    );

    header("Location: users.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form method="POST" class="bg-white p-6 rounded-xl shadow w-full max-w-md space-y-4">
        <h2 class="text-xl font-bold">✏️ Edit User</h2>

        <input type="text" name="nama" value="<?= $user['nama']; ?>" required class="w-full border p-2 rounded">
        <input type="email" name="email" value="<?= $user['email']; ?>" required class="w-full border p-2 rounded">

        <select name="role" class="w-full border p-2 rounded">
            <option value="user" <?= $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>

        <button class="w-full bg-blue-600 text-white py-2 rounded">
            Update
        </button>

        <a href="users.php" class="block text-center text-sm text-gray-500 hover:underline">
            Batal
        </a>
    </form>

</body>

</html>