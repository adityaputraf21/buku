<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM buku WHERE id='$id'");

header("Location: books.php");
exit;
