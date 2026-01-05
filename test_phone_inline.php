<?php
// Fetch distro data by executing the API script in a separate process to avoid header conflicts
$distro = null;

// Use a method that ensures the API is properly executed without interfering with the current page
$api_file_path = __DIR__ . '/api/distro/list.php';

if (file_exists($api_file_path)) {
    // Execute the API script and capture its output
    $command = 'php ' . escapeshellarg($api_file_path);
    $api_output = shell_exec($command);

    if ($api_output !== null) {
        $data = json_decode($api_output, true);
        $distro = isset($data['data'][0]) ? $data['data'][0] : null;
    }
}

echo "<pre>";
echo "Distro data:\n";
print_r($distro);
echo "\nPhone number: " . ($distro ? $distro['no_telepon'] : 'NOT SET') . "\n";

if ($distro && isset($distro['no_telepon'])) {
    $convertedPhone = $distro['no_telepon'][0] === '0' ? '62' . substr($distro['no_telepon'], 1) : $distro['no_telepon'];
    echo "Converted phone: " . $convertedPhone . "\n";
}
echo "</pre>";
?>
