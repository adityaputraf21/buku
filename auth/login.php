<?php
session_start();
require "../config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // VALIDASI
    if ($email === "" || $password === "") {
        $error = "Email dan password wajib diisi";
    } else {

        // QUERY AMAN
        $stmt = mysqli_prepare($conn, "SELECT id, nama, email, password, role FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user   = mysqli_fetch_assoc($result);

        // CEK USER & PASSWORD
        if ($user && password_verify($password, $user['password'])) {

            // SET SESSION
            $_SESSION['login'] = true;
            $_SESSION['id']    = $user['id'];
            $_SESSION['nama']  = $user['nama'];
            $_SESSION['role']  = $user['role'];

            // REDIRECT SESUAI ROLE
            if ($user['role'] === 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../user/index.php");
            }
            exit;
        } else {
            $error = "Email atau password salah";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | BookStore.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden w-full max-w-4xl grid md:grid-cols-2">

        <!-- BRAND -->
        <div class="hidden md:flex flex-col justify-center bg-gradient-to-br from-blue-600 to-indigo-600 text-white p-10">
            <h1 class="text-3xl font-bold mb-4">📚 BookStore.id</h1>
            <p class="text-lg opacity-90">
                Masuk dan mulai jelajahi buku favoritmu.
            </p>
            <p class="mt-4 text-sm opacity-80">
                Platform jual beli buku online terpercaya
            </p>
        </div>

        <!-- LOGIN FORM -->
        <div class="p-8 md:p-12">
            <h2 class="text-2xl font-bold mb-6">Masuk ke Akun</h2>

            <?php if ($error): ?>
                <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" name="email" required
                        class="w-full border px-4 py-2 rounded mt-1 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="text-sm font-medium">Password</label>
                    <input type="password" name="password" required
                        class="w-full border px-4 py-2 rounded mt-1 focus:ring focus:ring-blue-200">
                </div>

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold">
                    Login
                </button>
            </form>

            <p class="text-sm text-center mt-6">
                Belum punya akun?
                <a href="register.php" class="text-blue-600 font-medium">
                    Daftar sekarang
                </a>
            </p>
        </div>

    </div>

</body>

</html>