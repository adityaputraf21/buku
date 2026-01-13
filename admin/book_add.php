<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $harga   = $_POST['harga'];

    // Upload gambar jika ada
    $gambar_path = "";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $filename = time() . '_' . basename($_FILES['gambar']['name']);
        $target   = "../assets/img/" . $filename;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $gambar_path = $target;
        }
    }

    mysqli_query(
        $conn,
        "INSERT INTO buku (judul, penulis, harga, gambar)
         VALUES ('$judul','$penulis','$harga','$gambar_path')"
    );

    header("Location: books.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow w-full max-w-md space-y-4">
        <h2 class="text-xl font-bold">➕ Tambah Buku</h2>

        <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
        <input type="text" name="judul" placeholder="Judul Buku" required class="w-full border p-2 rounded">

        <label class="block text-sm font-medium text-gray-700">Penulis</label>
        <input type="text" name="penulis" placeholder="Penulis" required class="w-full border p-2 rounded">

        <label class="block text-sm font-medium text-gray-700">Harga</label>
        <input type="number" name="harga" placeholder="Harga" required class="w-full border p-2 rounded">

        <label class="block text-sm font-medium text-gray-700">Gambar Buku</label>
        <input type="file" name="gambar" class="w-full border p-2 rounded">

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Simpan
        </button>

        <a href="books.php" class="block text-center text-sm text-gray-500 hover:underline">
            Batal
        </a>
    </form>

</body>

</html>