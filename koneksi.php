<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "sql313.infinityfree.com";
$username = "if0_38017939";
$password = "Bungarose04";
$db = "if0_38017939_webdailyjournal"; // nama database

// Membuat koneksi menggunakan MySQLi
$conn = new mysqli($servername, $username, $password, $db);

// Mengecek apakah ada error pada koneksi
if ($conn->connect_error) {
    // Jika ada error, hentikan script dan tampilkan pesan error
    die("Connection failed: " . $conn->connect_error);
}

// Koneksi berhasil, bisa dilanjutkan ke proses lain
// echo "Connected successfully<hr>";
?>
