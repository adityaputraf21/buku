<?php
session_start();
require "../config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = trim($_POST['nama']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($nama === "" || $email === "" || $password === "") {
        $error = "Semua field wajib diisi";
    } else {
        $cek = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Email sudah terdaftar";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query(
                $conn,
                "INSERT INTO users (nama,email,password)
                 VALUES ('$nama','$email','$hash')"
            );
            header("Location: login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar | BookStore.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden w-full max-w-4xl grid md:grid-cols-2">

        <!-- BRAND -->
        <div class="hidden md:flex flex-col justify-center bg-gradient-to-br from-indigo-600 to-purple-600 text-white p-10">
            <h1 class="text-3xl font-bold mb-4">📚 BookStore.id</h1>
            <p class="text-lg opacity-90">
                Buat akun dan mulai jual beli buku.
            </p>
        </div>

        <!-- REGISTER FORM -->
        <div class="p-8 md:p-12">
            <h2 class="text-2xl font-bold mb-6">Buat Akun Baru</h2>

            <?php if ($error): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="nama" required
                        class="w-full border px-4 py-2 rounded mt-1 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" name="email" required
                        class="w-full border px-4 py-2 rounded mt-1 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="text-sm font-medium">Password</label>
                    <input type="password" name="password" required
                        class="w-full border px-4 py-2 rounded mt-1 focus:ring focus:ring-indigo-200">
                </div>

                <button
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded font-semibold">
                    Daftar
                </button>
            </form>

            <p class="text-sm text-center mt-6">
                Sudah punya akun?
                <a href="login.php" class="text-indigo-600 font-medium">
                    Login
                </a>
            </p>
        </div>

    </div>

</body>

</html>