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
require_once __DIR__ . '/../auth/validate_token.php';

// Require authentication for POST
$admin = requireAuth($conn);

// Handle both JSON and FormData input
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
$gambar1 = $gambar2 = $gambar3 = '';

if (strpos($contentType, 'multipart/form-data') !== false) {
    // Handle FormData (file uploads)
    // Process uploaded files
    $imageFields = ['gambar1', 'gambar2', 'gambar3'];
    $uploadDir = __DIR__ . '/../../public/images/';
    
    // Debug: Check if files are being sent
    error_log("FILES array: " . print_r($_FILES, true));
    
    foreach ($imageFields as $field) {
        if (isset($_FILES[$field]) && is_array($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$field];
            
            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!in_array($file['type'], $allowedTypes)) {
                echo json_encode(['success' => false, 'message' => "Format file {$file['name']} harus JPG atau PNG"]);
                exit;
            }
            
            // Validate file size (1MB)
            if ($file['size'] > 1024 * 1024) {
                echo json_encode(['success' => false, 'message' => "Ukuran file {$file['name']} maksimal 1MB"]);
                exit;
            }
            
            // Create directory if not exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Move uploaded file (filename already includes timestamp from frontend)
            $fileName = $file['name'];
            $uploadPath = $uploadDir . $fileName;
            
            // Debug log
            error_log("Attempting to upload $field to: $uploadPath");
            error_log("Upload dir permissions: " . substr(sprintf('%o', fileperms($uploadDir)), -4));
            error_log("File temp location: " . $file['tmp_name']);
            error_log("File exists in temp: " . (file_exists($file['tmp_name']) ? 'Yes' : 'No'));
            
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                ${$field} = $fileName;
                error_log("Successfully uploaded $field as: $fileName");
                error_log("File exists after upload: " . (file_exists($uploadPath) ? 'Yes' : 'No'));
            } else {
                error_log("Failed to upload $field");
                error_log("Upload error: " . print_r(error_get_last(), true));
                echo json_encode(['success' => false, 'message' => "Gagal upload gambar $field. Periksa permission folder."]);
                exit;
            }
        } elseif (isset($_FILES[$field])) {
            // Log jika ada error upload
            $errorCode = $_FILES[$field]['error'];
            $errorMsg = '';
            switch($errorCode) {
                case UPLOAD_ERR_INI_SIZE:
                    $errorMsg = "File terlalu besar (melebihi upload_max_filesize)";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $errorMsg = "File terlalu besar (melebihi MAX_FILE_SIZE)";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $errorMsg = "File hanya terupload sebagian";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errorMsg = "Tidak ada file yang diupload";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $errorMsg = "Folder tmp tidak ada";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $errorMsg = "Tidak bisa menulis file ke disk";
                    break;
                default:
                    $errorMsg = "Error upload kode: $errorCode";
            }
            error_log("Upload error for $field: $errorMsg");
        }
    }
    
    // Extract form data
    $id_kategori   = isset($_POST['id_kategori']) ? (int)$_POST['id_kategori'] : 0;
    $nama_produk   = isset($_POST['nama_produk']) ? trim($_POST['nama_produk']) : '';
    $merk          = isset($_POST['merk']) ? trim($_POST['merk']) : '';
    $kode_produk   = isset($_POST['kode_produk']) ? trim($_POST['kode_produk']) : '';
    $deskripsi     = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $harga_aktif   = isset($_POST['harga_aktif']) ? (float)$_POST['harga_aktif'] : 0.0;
    $harga_coret   = isset($_POST['harga_coret']) ? (float)$_POST['harga_coret'] : 0.0;
    $ukuran        = isset($_POST['ukuran']) ? trim($_POST['ukuran']) : '';
    $in_stok       = !empty($_POST['in_stok']) ? 1 : 0;
    $jumlah_stok   = isset($_POST['jumlah_stok']) ? (int)$_POST['jumlah_stok'] : 0;
    $aktif         = !empty($_POST['aktif']) ? 1 : 0;
    $favorit       = !empty($_POST['favorit']) ? 1 : 0;
    $id_admin      = isset($_POST['id_admin']) ? (int)$_POST['id_admin'] : 0;
    $terjual       = isset($_POST['terjual']) ? (int)$_POST['terjual'] : 0;
    
    // Debug log for form data
    error_log("POST data received: " . print_r($_POST, true));
    error_log("FILES data received: " . print_r($_FILES, true));
    error_log("Extracted images - gambar1: $gambar1, gambar2: $gambar2, gambar3: $gambar3");
} else {
    // Handle JSON input (for backwards compatibility)
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
}

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
$sql = "INSERT INTO produk (
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
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

error_log("SQL Query: " . $sql);
error_log("Parameters: id_kategori=$id_kategori, nama_produk=$nama_produk, gambar1=$gambar1, gambar2=$gambar2, gambar3=$gambar3");

$stmt = $conn->prepare($sql);

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
