<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../../config/koneksi.php';

$response = array();

try {
    $query = "SELECT
                produk.id_produk, 
                produk.nama_produk, 
                kategori.nama_kategori, 
                produk.merk, 
                produk.kode_produk, 
                produk.harga_aktif
              FROM
                produk
                INNER JOIN
                kategori
                ON 
                    produk.id_kategori = kategori.id_kategori
              WHERE produk.aktif = 1
              ORDER BY nama_produk ASC";
    
    $result = $conn->query($query);
    
    if ($result) {
        $produk_list = array();
        while ($row = $result->fetch_assoc()) {
            $produk_list[] = $row;
        }
        
        $response['success'] = true;
        $response['data'] = $produk_list;
        $response['message'] = 'Data produk berhasil diambil';
    } else {
        $response['success'] = false;
        $response['message'] = 'Query failed: ' . $conn->error;
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Error: ' . $e->getMessage();
}

$conn->close();
echo json_encode($response, JSON_PRETTY_PRINT);
?>
