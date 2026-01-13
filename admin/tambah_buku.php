<?php
require "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    mysqli_query($conn, "
        INSERT INTO books (judul,penulis,harga,stok)
        VALUES (
            '$_POST[judul]',
            '$_POST[penulis]',
            $_POST[harga],
            $_POST[stok]
        )
    ");
    header("Location: buku.php");
}
?>
<form method="POST">
    <input name="judul" placeholder="Judul">
    <input name="penulis" placeholder="Penulis">
    <input name="harga" placeholder="Harga">
    <input name="stok" placeholder="Stok">
    <button>Simpan</button>
</form>