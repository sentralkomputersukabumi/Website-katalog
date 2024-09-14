<?php
$host = 'localhost';
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda
$db = 'toko';

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>