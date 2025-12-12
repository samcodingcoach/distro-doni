<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// jika preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/../../config/koneksi.php';

// baca JSON input
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    echo json_encode(['success' => false, 'message' => 'JSON tidak valid atau kosong']);
    exit;
}

// ekstrak data dengan fallback
$id_kategori   = isset($data['id_kategori']) ? (int)$data['id_kategori'] : 0;
$nama_produk   = isset($data['nama_produk']) ? trim($data['nama_produk']) : '';
$merk          = isset($data['merk']) ? trim($data['merk']) : '';
$kode_produk   = isset($data['kode_produk']) ? trim($data['kode_produk']) : '';
$deskripsi     = isset($data['deskripsi']) ? $data['deskripsi'] : '';
$harga_aktif   = isset($data['harga_aktif']) ? (float)$data['harga_aktif'] : 0.0;
$harga_coret   = isset($data['harga_coret']) ? (float)$data['harga_coret'] : 0.0;
$ukuran        = isset($data['ukuran']) ? trim($data['ukuran']) : '';
$in_stok       = !empty($data['in_stok']) ? 1 : 0;
$jumlah_stok   = isset($data['jumlah_stok']) ? (int)$data['jumlah_stok'] : 0;
$gambar1       = isset($data['gambar1']) ? trim($data['gambar1']) : '';
$gambar2       = isset($data['gambar2']) ? trim($data['gambar2']) : '';
$gambar3       = isset($data['gambar3']) ? trim($data['gambar3']) : '';
$aktif         = !empty($data['aktif']) ? 1 : 0;
$favorit       = !empty($data['favorit']) ? 1 : 0;
$id_admin      = isset($data['id_admin']) ? (int)$data['id_admin'] : 0;
$terjual       = isset($data['terjual']) ? (int)$data['terjual'] : 0;

// validasi minimal (contoh: kode_produk wajib)
if ($kode_produk === '') {
    echo json_encode(['success' => false, 'message' => 'kode_produk wajib diisi']);
    exit;
}

// cek duplikat kode_produk
$check_stmt = $conn->prepare("SELECT id_produk FROM produk WHERE kode_produk = ?");
if (!$check_stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare check gagal: ' . $conn->error]);
    exit;
}
$check_stmt->bind_param("s", $kode_produk);
$check_stmt->execute();
$result = $check_stmt->get_result();
if ($result && $result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Kode produk sudah ada']);
    $check_stmt->close();
    $conn->close();
    exit;
}
$check_stmt->close();

// siapkan INSERT (17 kolom — sesuai struktur tabel Anda)
$stmt = $conn->prepare("INSERT INTO produk (
    id_kategori, 
    nama_produk, 
    merk, 
    kode_produk, 
    deskripsi, 
    harga_aktif, 
    harga_coret, 
    ukuran, 
    in_stok, 
    jumlah_stok, 
    gambar1, 
    gambar2, 
    gambar3, 
    aktif, 
    favorit, 
    id_admin, 
    terjual
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare insert gagal: ' . $conn->error]);
    $conn->close();
    exit;
}

// tipe parameter sesuai urutan:
// i = int, s = string, d = double
$types = 'issssddsiisssiiii'; // 17 karakter, sesuai 17 kolom
$stmt->bind_param(
    $types,
    $id_kategori,   // i
    $nama_produk,   // s
    $merk,          // s
    $kode_produk,   // s
    $deskripsi,     // s
    $harga_aktif,   // d
    $harga_coret,   // d
    $ukuran,        // s
    $in_stok,       // i
    $jumlah_stok,   // i
    $gambar1,       // s
    $gambar2,       // s
    $gambar3,       // s
    $aktif,         // i
    $favorit,       // i
    $id_admin,      // i
    $terjual        // i
);

// eksekusi
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Produk berhasil ditambahkan', 'id' => $stmt->insert_id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Execute gagal: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
