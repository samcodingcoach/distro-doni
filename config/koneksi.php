<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Informasi koneksi ke database MySQL
$host = 'localhost';
$username = 'samsu';
$password = 'samsu';
$database = 'doni-distro';

date_default_timezone_set("Asia/Makassar");

// Membuat koneksi ke database MySQL
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>