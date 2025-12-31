<?php
// Fetch kategori data by executing the API script in a separate process to avoid header conflicts
$favorite_categories = [];
$non_favorite_categories = [];

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

                // Filter categories by favorit status
                foreach ($all_categories as $kategori) {
                    if ($kategori['favorit'] == '1' && $kategori['aktif'] == '1') {
                        $favorite_categories[] = $kategori;
                    } elseif ($kategori['favorit'] == '0' && $kategori['aktif'] == '1') {
                        $non_favorite_categories[] = $kategori;
                    }
                }

                // Sort both arrays by name to maintain consistent ordering
                usort($favorite_categories, function($a, $b) {
                    return strcasecmp($a['nama_kategori'], $b['nama_kategori']);
                });

                usort($non_favorite_categories, function($a, $b) {
                    return strcasecmp($a['nama_kategori'], $b['nama_kategori']);
                });

                // Take only the first 5 favorite categories
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
    
    <!-- All Categories Dropdown -->
    <div class="relative group">
        <button class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors flex items-center gap-1">
            All Categories
            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        
        <?php if (!empty($non_favorite_categories)): ?>
            <div class="absolute top-full left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <div class="py-2">
                    <?php foreach ($non_favorite_categories as $kategori): ?>
                        <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="#">
                            <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>
