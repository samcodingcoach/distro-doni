<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../auth/validate_token.php';

// Require authentication for POST
$admin = requireAuth($conn);

$response = array();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    $response['success'] = false;
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
    exit;
}

$json_input = file_get_contents('php://input');
$data = json_decode($json_input, true);

if (!$data || !isset($data['nama_kategori'])) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'nama_kategori diperlukan';
    echo json_encode($response);
    exit;
}

$nama_kategori = $data['nama_kategori'];
$background_url = $data['background_url'] ?? null;
$favorit = $data['favorit'] ?? 0;
$aktif = $data['aktif'] ?? 1;

try {
    $query = "INSERT INTO kategori (nama_kategori, background_url, favorit, aktif) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii", $nama_kategori, $background_url, $favorit, $aktif);
    
    if ($stmt->execute()) {
        $id_kategori = $conn->insert_id;
        
        $response['success'] = true;
        $response['message'] = 'Kategori berhasil ditambahkan';
        $response['data'] = array(
            'id_kategori' => $id_kategori,
            'nama_kategori' => $nama_kategori,
            'background_url' => $background_url,
            'favorit' => $favorit,
            'aktif' => $aktif
        );
    } else {
        http_response_code(500);
        $response['success'] = false;
        $response['message'] = 'Gagal menambahkan kategori: ' . $conn->error;
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Error: ' . $e->getMessage();
}

$conn->close();
echo json_encode($response, JSON_PRETTY_PRINT);
?>
