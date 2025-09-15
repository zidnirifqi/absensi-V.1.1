<?php
$host = "localhost";
$user = "root"; // Ganti jika username phpMyAdmin kamu berbeda
$pass = "";     // Kosongkan jika tidak ada password
$db   = "db_absensi"; // Nama database yang sudah kamu buat di phpMyAdmin

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
