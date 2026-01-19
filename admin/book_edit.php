<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'"));

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $harga   = $_POST['harga'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $filename = time() . '_' . basename($_FILES['gambar']['name']);
        $target = "../assets/img/" . $filename;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $gambar_sql = ", gambar='$target'";
        } else {
            $gambar_sql = "";
        }
    } else {
        $gambar_sql = "";
    }

    mysqli_query(
        $conn,
        "UPDATE buku SET
         judul='$judul',
         penulis='$penulis',
         harga='$harga'
         $gambar_sql
         WHERE id='$id'"
    );

    header("Location: books.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow w-full max-w-md space-y-4">
        <h2 class="text-xl font-bold">✏️ Edit Buku</h2>

        <label class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required class="w-full border p-2 rounded">

        <label class="block text-sm font-medium text-gray-700">Penulis</label>
        <input type="text" name="penulis" value="<?= htmlspecialchars($data['penulis']); ?>" required class="w-full border p-2 rounded">

        <label class="block text-sm font-medium text-gray-700">Harga</label>
        <input type="number" name="harga" value="<?= htmlspecialchars($data['harga']); ?>" required class="w-full border p-2 rounded">

        <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
        <?php if (!empty($data['gambar'])): ?>
            <img src="<?= htmlspecialchars($data['gambar']); ?>" alt="Gambar Buku" class="w-32 h-40 object-cover mb-2 rounded">
        <?php else: ?>
            <p class="text-gray-500 mb-2">Belum ada gambar</p>
        <?php endif; ?>

        <label class="block text-sm font-medium text-gray-700">Ganti Gambar</label>
        <input type="file" name="gambar" class="w-full border p-2 rounded">

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Update
        </button>

        <a href="books.php" class="block text-center text-sm text-gray-500 hover:underline">
            Batal
        </a>
    </form>

</body>

</html>