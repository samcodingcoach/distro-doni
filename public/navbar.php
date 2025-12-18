<?php
// Fetch kategori data by executing the API script in a separate process to avoid header conflicts
$favorite_categories = [];

// Use a method that ensures the API is properly executed without interfering with the current page
$api_file_path = __DIR__ . '/../api/kategori/list.php';

if (file_exists($api_file_path)) {
    // Execute the API script and capture its output
    $command = 'php ' . escapeshellarg($api_file_path);
    $api_output = shell_exec($command);

    if ($api_output) {
        // Find JSON in output (skip any error/warning messages)
        $json_start = strpos($api_output, '{');
        if ($json_start !== false) {
            $json_str = substr($api_output, $json_start);
            $response_data = json_decode($json_str, true);

            if ($response_data && isset($response_data['success']) && $response_data['success'] === true) {
                $all_categories = $response_data['data'];

                // Filter for favorite and active categories only
                foreach ($all_categories as $kategori) {
                    if ($kategori['favorit'] == '1' && $kategori['aktif'] == '1') {
                        $favorite_categories[] = $kategori;
                    }
                }

                // Sort the filtered categories by name to maintain consistent ordering
                usort($favorite_categories, function($a, $b) {
                    return strcasecmp($a['nama_kategori'], $b['nama_kategori']);
                });

                // Take only the first 5 categories
                $favorite_categories = array_slice($favorite_categories, 0, 5);
            }
        }
    }
}
?>

<nav class="hidden md:flex items-center gap-8">
    <?php if (!empty($favorite_categories)): ?>
        <?php foreach ($favorite_categories as $kategori): ?>
            <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="#">
                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Fallback menu items if no favorite categories found -->
       
    <?php endif; ?>
</nav>
