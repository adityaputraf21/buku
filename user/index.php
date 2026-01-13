<?php
session_start();

/* Koneksi Database */
$host = "localhost";
$user = "root";
$pass = "";
$db   = "jualbuku";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

/* Contoh session user */
if (!isset($_SESSION['nama'])) {
    $_SESSION['nama'] = ""; // bisa diganti login dinamis
}

/* INIT CART */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* TAMBAH KE CART */
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $harga = $_POST['harga'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty']++;
    } else {
        $_SESSION['cart'][$id] = [
            'judul' => $judul,
            'harga' => $harga,
            'qty' => 1
        ];
    }

    header("Location: index.php#buku");
    exit;
}

$totalCart = array_sum(array_column($_SESSION['cart'], 'qty'));

/* Ambil data buku dari database */
$result = $conn->query("SELECT * FROM buku");
$bukuList = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bukuList[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>BookStore.id | Jual Beli Buku Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white fixed w-full z-50 shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">📚 BookStore.id</h1>

            <div class="hidden md:flex gap-6 text-sm font-medium">
                <a href="#home">Home</a>
                <a href="#buku">Buku</a>
                <a href="#tentang">Tentang</a>
                <a href="#kontak">Kontak</a>
            </div>

            <div class="flex items-center gap-4">
                <!-- Cart -->
                <a href="cart.php" class="relative">
                    🛒
                    <?php if ($totalCart > 0): ?>
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                            <?= $totalCart ?>
                        </span>
                    <?php endif; ?>
                </a>

                <!-- Nama dan Logout -->
                <span class="text-sm font-medium text-gray-700">Halo, <?= $_SESSION['nama'] ?> 👋</span>
                <a href="../auth/logout.php" class="px-4 py-2 bg-red-500 text-white rounded text-sm hover:bg-red-600">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="bg-blue-600 pt-24">
        <div class="max-w-7xl mx-auto px-10 grid md:grid-cols-2 min-h-[calc(100vh-80px)]">
            <div class="flex flex-col justify-center text-white">
                <span class="bg-blue-500 px-6 py-1 rounded-full text-sm mb-5 inline-block">
                    Platform Toko Buku Online
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Temukan & Beli Buku Favoritmu
                </h1>
                <p class="text-blue-100 text-lg mb-8 max-w-xl">
                    Beli buku fisik dan digital dengan sistem cepat, aman, dan terpercaya.
                </p>
                <a href="#buku" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold w-max">
                    Jelajahi Buku
                </a>
            </div>

            <div class="hidden md:flex items-end justify-end">
                <img src="assets/img/mahasiswi.png" class="w-[480px]" alt="">
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section id="tentang" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-16">Kenapa BookStore.id?</h3>

            <div class="grid md:grid-cols-3 gap-10">
                <?php
                $fitur = [
                    ["🛒", "Mudah & Cepat", "Pembelian hanya beberapa klik."],
                    ["🔐", "Aman", "Data pengguna terlindungi."],
                    ["📦", "Update Stok", "Stok selalu diperbarui."]
                ];
                foreach ($fitur as $f):
                ?>
                    <div class="p-8 rounded-2xl shadow hover:shadow-xl transition">
                        <div class="text-3xl mb-4"><?= $f[0] ?></div>
                        <h4 class="font-semibold mb-2"><?= $f[1] ?></h4>
                        <p class="text-sm text-gray-600"><?= $f[2] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- BUKU -->
    <section id="buku" class="py-24 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-bold mb-12 text-center">Buku Populer</h3>

            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
                <?php foreach ($bukuList as $buku): ?>
                    <div class="bg-white rounded-2xl shadow overflow-hidden">
                        <img src="<?= $buku['gambar'] ?>" class="h-48 w-full object-cover">

                        <div class="p-4">
                            <h4 class="font-semibold"><?= $buku['judul'] ?></h4>
                            <p class="text-sm text-gray-500"><?= $buku['penulis'] ?></p>
                            <p class="font-bold text-blue-600 mt-2">Rp <?= number_format($buku['harga'], 0, ',', '.') ?></p>

                            <form method="POST" class="mt-4">
                                <input type="hidden" name="id" value="<?= $buku['id'] ?>">
                                <input type="hidden" name="judul" value="<?= $buku['judul'] ?>">
                                <input type="hidden" name="harga" value="<?= $buku['harga'] ?>">

                                <button name="add_to_cart"
                                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            © <?= date('Y'); ?> BookStore.id
        </div>
    </footer>

</body>

</html>