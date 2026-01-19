<?php
session_start();
require "config/database.php";

// Ambil semua buku dari database
$buku = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
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
                <a href="#home" class="hover:text-blue-600">Home</a>
                <a href="#buku" class="hover:text-blue-600">Buku</a>
                <a href="#tentang" class="hover:text-blue-600">Tentang</a>
                <a href="#kontak" class="hover:text-blue-600">Kontak</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="keranjang.php" class="relative text-xl">
                    🛒
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs 
                w-5 h-5 flex items-center justify-center rounded-full">
                        <?= isset($_SESSION['keranjang']) ? count($_SESSION['keranjang']) : 0 ?>
                    </span>
                </a>

                <?php if (isset($_SESSION['nama'])): ?>
                    <span class="px-4 py-2 border rounded text-sm">
                        <?= htmlspecialchars($_SESSION['nama']); ?>
                    </span>
                    <a href="auth/logout.php" class="px-4 py-2 bg-red-500 text-white rounded text-sm">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="auth/login.php" class="px-4 py-2 border rounded text-sm">Login</a>
                    <a href="auth/register.php" class="px-4 py-2 bg-blue-600 text-white rounded text-sm">
                        Daftar
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="home" class="bg-blue-600 pt-24">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 items-center min-h-[80vh]">
            <div class="text-white">
                <span class="inline-block bg-blue-500 px-6 py-1 rounded-full text-sm mb-5">
                    Platform Toko Buku Online
                </span>
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Temukan & Beli Buku Favoritmu
                </h1>
                <p class="text-blue-100 mb-8">
                    Proses cepat, aman, dan terpercaya.
                </p>
                <button id="btnJelajahi" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold">
                    Jelajahi Buku
                </button>
            </div>

            <div class="hidden md:block">
                <img src="assets/img/mahasiswi.png" class="w-[450px] mx-auto">
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section id="tentang" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-16">Kenapa BookStore.id?</h3>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-8 rounded-xl shadow">
                    <div class="text-3xl mb-4">🛒</div>
                    <h4 class="font-semibold mb-2">Mudah & Cepat</h4>
                    <p class="text-gray-600 text-sm">Beli buku hanya beberapa klik.</p>
                </div>
                <div class="p-8 rounded-xl shadow">
                    <div class="text-3xl mb-4">🔐</div>
                    <h4 class="font-semibold mb-2">Aman</h4>
                    <p class="text-gray-600 text-sm">Data pengguna terjaga.</p>
                </div>
                <div class="p-8 rounded-xl shadow">
                    <div class="text-3xl mb-4">📦</div>
                    <h4 class="font-semibold mb-2">Stok Update</h4>
                    <p class="text-gray-600 text-sm">Stok selalu diperbarui.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- BUKU -->
    <section id="buku" class="py-24 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-bold mb-12 text-center">Buku Populer</h3>

            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
                <?php while ($row = mysqli_fetch_assoc($buku)): ?>
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <img src="<?= htmlspecialchars($row['gambar']); ?>"
                            class="h-48 w-full object-cover"
                            alt="<?= htmlspecialchars($row['judul']); ?>">

                        <div class="p-4">
                            <h4 class="font-semibold"><?= htmlspecialchars($row['judul']); ?></h4>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($row['penulis']); ?></p>
                            <p class="font-bold text-blue-600 mt-2">
                                Rp <?= number_format($row['harga']); ?>
                            </p>

                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form action="tambah_keranjang.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg text-sm">
                                        + Keranjang
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="auth/login.php"
                                    class="mt-4 block text-center bg-blue-600 text-white py-2 rounded-lg text-sm">
                                    + Keranjang (Login Dulu)
                                </a>
                            <?php endif; ?>

                            <a href="detail_buku.php?id=<?= $row['id']; ?>"
                                class="block mt-2 text-center border py-2 rounded-lg text-sm">
                                Detail
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold text-white mb-2">BookStore.id</h4>
                <p class="text-sm">Platform jual beli buku online.</p>
            </div>
            <div>
                <h4 class="font-bold text-white mb-2">Kontak</h4>
                <p class="text-sm">support@bookstore.id</p>
            </div>
            <div>
                <h4 class="font-bold text-white mb-2">Hak Cipta</h4>
                <p class="text-sm">© 2026 BookStore.id</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById("btnJelajahi").onclick = () => {
            document.getElementById("buku").scrollIntoView({
                behavior: "smooth"
            });
        };
    </script>

</body>

</html>