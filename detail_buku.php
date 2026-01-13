<?php
session_start();

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Data semua buku
$buku = [
    1 => [
        "judul" => "Hujan",
        "penulis" => "Tere Liye",
        "tahun" => 2019,
        "deskripsi" => "Buku ini menceritakan kisah kehidupan dan persahabatan yang penuh makna...",
        "harga" => 85000,
        "gambar" => "assets/img/hujan.jpg"
    ],
    2 => [
        "judul" => "Sebuah Usaha Melupakan",
        "penulis" => "Boy Candra",
        "tahun" => 2020,
        "deskripsi" => "Kisah cinta, kehilangan, dan bagaimana kita berusaha melupakan masa lalu...",
        "harga" => 79000,
        "gambar" => "assets/img/sebuah_usaha_melupakan.jpg"
    ],
    3 => [
        "judul" => "Dilan 1990",
        "penulis" => "Pidi Baiq",
        "tahun" => 1990,
        "deskripsi" => "Cerita romantis tentang Dilan dan Milea di tahun 1990...",
        "harga" => 90000,
        "gambar" => "assets/img/dilan_1990.jpg"
    ],
    4 => [
        "judul" => "Ancika 1991",
        "penulis" => "Pidi Baiq",
        "tahun" => 1991,
        "deskripsi" => "Lanjutan kisah Dilan dengan karakter baru, Ancika, dengan konflik yang unik...",
        "harga" => 92000,
        "gambar" => "assets/img/ancika_1991.jpg"
    ],
];

// Ambil data buku sesuai ID
$item = isset($buku[$id]) ? $buku[$id] : null;

if (!$item) {
    echo "<h1>Buku tidak ditemukan!</h1>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $item['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-20 bg-white p-6 rounded shadow">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <img src="<?= $item['gambar']; ?>" class="rounded">

        <div>
            <h1 class="text-2xl font-bold"><?= $item['judul']; ?></h1>
            <p class="text-gray-600">
                <?= $item['penulis']; ?> • <?= $item['tahun']; ?>
            </p>

            <p class="mt-4"><?= $item['deskripsi']; ?></p>

            <p class="mt-4 text-xl font-bold text-blue-600">
                Rp<?= number_format($item['harga']); ?>
            </p>

            <form action="tambah_keranjang.php" method="POST" class="mt-4">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="judul" value="<?= $item['judul']; ?>">
                <input type="hidden" name="harga" value="<?= $item['harga']; ?>">
                <button class="px-6 py-2 bg-blue-600 text-white rounded">
                    Tambah ke Keranjang
                </button>
            </form>

            <a href="index.php" class="mt-4 inline-block text-blue-600 hover:underline">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

</body>
</html>
