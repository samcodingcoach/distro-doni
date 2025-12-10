<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../auth/validate_token.php';

// Require authentication for update
$admin = requireAuth($conn);

$response = array();

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'PUT' && $method !== 'POST') {
    http_response_code(405);
    $response['success'] = false;
    $response['message'] = 'Method not allowed (use PUT or POST)';
    echo json_encode($response);
    exit;
}

$json_input = file_get_contents('php://input');
$data = json_decode($json_input, true);

if (!$data || !isset($data['id_kategori'])) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'id_kategori diperlukan';
    echo json_encode($response);
    exit;
}

if (!$data || !isset($data['nama_kategori'])) {
    http_response_code(400);
    $response['success'] = false;
    $response['message'] = 'nama_kategori diperlukan';
    echo json_encode($response);
    exit;
}

$id_kategori = $data['id_kategori'];
$nama_kategori = $data['nama_kategori'];
$background_url = $data['background_url'] ?? null;
$favorit = $data['favorit'] ?? 0;
$aktif = $data['aktif'] ?? 1;

try {
    // Check if kategori exists
    $check_query = "SELECT id_kategori FROM kategori WHERE id_kategori = ? LIMIT 1";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $id_kategori);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows === 0) {
        http_response_code(404);
        $response['success'] = false;
        $response['message'] = 'Kategori tidak ditemukan';
        echo json_encode($response);
        exit;
    }
    
    $update_query = "UPDATE kategori SET nama_kategori = ?, background_url = ?, favorit = ?, aktif = ? WHERE id_kategori = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssiii", $nama_kategori, $background_url, $favorit, $aktif, $id_kategori);
    
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Kategori berhasil diupdate';
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
        $response['message'] = 'Gagal update kategori: ' . $conn->error;
    }
    
    $stmt->close();
    $check_stmt->close();
    
} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['message'] = 'Error: ' . $e->getMessage();
}

$conn->close();
echo json_encode($response, JSON_PRETTY_PRINT);
?>
