<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>BookStore.id | Jual Beli Buku Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-50 text-gray-800 scroll-smooth">

    <!-- NAVBAR -->
    <nav class="bg-white shadow fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">📚 BookStore.id</h1>

            <div class="hidden md:flex gap-6 text-sm font-medium">
                <a href="#home" class="hover:text-blue-600">Home</a>
                <a href="#buku" class="hover:text-blue-600">Buku</a>
                <a href="#tentang" class="hover:text-blue-600">Tentang</a>
                <a href="#kontak" class="hover:text-blue-600">Kontak</a>
            </div>

            <div class="flex gap-2">
                <a href="auth/login.php"
                    class="px-4 py-2 border rounded hover:bg-gray-100 text-sm">
                    Login
                </a>
                <a href="auth/register.php"
                    class="px-4 py-2 bg-blue-600 text-white rounded text-sm">
                    Daftar
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="home"
        class="pt-32 pb-24 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    Temukan & Beli Buku Favoritmu<br>
                    Secara Online
                </h2>
                <p class="mt-5 text-lg opacity-90">
                    Platform jual beli buku digital & fisik dengan proses cepat,
                    aman, dan terpercaya.
                </p>

                <div class="mt-8 flex gap-4">
                    <a href="#buku"
                        class="bg-white text-blue-600 px-6 py-3 rounded font-semibold">
                        Jelajahi Buku
                    </a>
                    <a href="auth/register.php"
                        class="border border-white px-6 py-3 rounded font-semibold">
                        Mulai Sekarang
                    </a>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="bg-white/10 p-10 rounded-xl text-center">
                    <p class="text-xl font-semibold">📖 1000+ Buku</p>
                    <p class="mt-2 opacity-90">
                        Novel • Edukasi • Teknologi • Bisnis
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- FITUR -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12">Kenapa BookStore.id?</h3>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 border rounded-lg hover:shadow transition">
                    <h4 class="font-semibold text-lg mb-2">🛒 Mudah & Cepat</h4>
                    <p class="text-sm text-gray-600">
                        Proses pembelian buku hanya dalam beberapa klik.
                    </p>
                </div>

                <div class="p-6 border rounded-lg hover:shadow transition">
                    <h4 class="font-semibold text-lg mb-2">🔐 Aman</h4>
                    <p class="text-sm text-gray-600">
                        Data pengguna dan transaksi tersimpan dengan aman.
                    </p>
                </div>

                <div class="p-6 border rounded-lg hover:shadow transition">
                    <h4 class="font-semibold text-lg mb-2">📦 Update Stok</h4>
                    <p class="text-sm text-gray-600">
                        Informasi stok buku selalu diperbarui.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- BUKU POPULER -->
    <section id="buku" class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-bold mb-10 text-center">Buku Populer</h3>

            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
                        <div
                            class="h-40 bg-gray-200 rounded mb-3 flex items-center justify-center text-gray-500">
                            Cover Buku
                        </div>
                        <h4 class="font-semibold">Judul Buku <?= $i ?></h4>
                        <p class="text-sm text-gray-500">Penulis Buku</p>
                        <p class="font-bold text-blue-600 mt-2">
                            Rp 75.000
                        </p>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- CARA BELI -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12">Cara Pembelian</h3>

            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="text-4xl mb-4">🔍</div>
                    <h4 class="font-semibold">Pilih Buku</h4>
                    <p class="text-sm text-gray-600">
                        Cari buku sesuai kebutuhanmu
                    </p>
                </div>
                <div>
                    <div class="text-4xl mb-4">💳</div>
                    <h4 class="font-semibold">Pembayaran</h4>
                    <p class="text-sm text-gray-600">
                        Proses transaksi dengan mudah
                    </p>
                </div>
                <div>
                    <div class="text-4xl mb-4">📦</div>
                    <h4 class="font-semibold">Selesai</h4>
                    <p class="text-sm text-gray-600">
                        Buku siap kamu miliki
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold text-white mb-2">BookStore.id</h4>
                <p class="text-sm">
                    Platform jual beli buku online.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-white mb-2">Kontak</h4>
                <p class="text-sm">Email: support@bookstore.id</p>
                <p class="text-sm">Telp: 08xxxxxxxx</p>
            </div>
            <div>
                <h4 class="font-bold text-white mb-2">Hak Cipta</h4>
                <p class="text-sm">© 2026 BookStore.id</p>
            </div>
        </div>
    </footer>

</body> 

</html>