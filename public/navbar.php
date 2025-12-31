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
            <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="product.php?kategori=<?php echo urlencode($kategori['nama_kategori']); ?>">
                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Fallback menu items if no favorite categories found -->

    <?php endif; ?>

    <!-- Search Input -->
    <div class="relative flex-1 max-w-md">
        <div class="relative">
            <input
                type="text"
                id="search-input"
                placeholder="Search products..."
                class="w-full px-4 py-3 pl-12 pr-12 rounded-full border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white shadow-sm"
            >
            <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <button id="clear-search" class="absolute right-4 top-3.5 h-5 w-5 text-gray-400 hidden">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Search Results Dropdown -->
        <div id="search-results" class="absolute left-0 right-0 mt-2 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 z-50 hidden">
            <div id="search-results-content" class="py-2 max-h-96 overflow-y-auto">
                <!-- Search results will be populated here -->
            </div>
        </div>
    </div>

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
                        <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="product.php?kategori=<?php echo urlencode($kategori['nama_kategori']); ?>">
                            <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>

<!-- JavaScript for search functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    const searchResultsContent = document.getElementById('search-results-content');
    const clearSearch = document.getElementById('clear-search');
    let searchTimeout;

    // Show clear button when there's text in the input
    searchInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            clearSearch.classList.remove('hidden');
        } else {
            clearSearch.classList.add('hidden');
        }

        // Debounce search requests
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch(this.value);
        }, 300);
    });

    // Clear search input
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        this.classList.add('hidden');
        searchResults.classList.add('hidden');
    });

    // Hide search results when clicking outside
    document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.classList.add('hidden');
        }
    });

    function performSearch(query) {
        if (query.length < 1) {
            searchResults.classList.add('hidden');
            return;
        }

        // Show loading state
        searchResultsContent.innerHTML = '<div class="px-4 py-2 text-gray-500 dark:text-gray-400">Searching...</div>';
        searchResults.classList.remove('hidden');

        // Make AJAX request to search API - using absolute path
        fetch('/distro/api/produk/search.php?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    displaySearchResults(data.data);
                } else {
                    searchResultsContent.innerHTML = '<div class="px-4 py-2 text-gray-500 dark:text-gray-400">No results found</div>';
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                searchResultsContent.innerHTML = '<div class="px-4 py-2 text-red-500">Error performing search</div>';
            });
    }

    function displaySearchResults(results) {
        if (results.length === 0) {
            searchResultsContent.innerHTML = '<div class="px-4 py-2 text-gray-500 dark:text-gray-400">No results found</div>';
            return;
        }

        let html = '';
        results.forEach(product => {
            html += '<a href="product.php?id=' + product.id_produk + '" class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors search-result-item border-b border-gray-100 dark:border-gray-700 last:border-b-0">' +
                    '<div class="font-medium text-gray-900 dark:text-white">' + product.nama_produk + '</div>' +
                    '<div class="text-xs text-gray-500 dark:text-gray-400 mt-1">' +
                        product.nama_kategori + ' | ' + product.merk + ' | ' + product.kode_produk + ' | Rp. ' + parseInt(product.harga_aktif).toLocaleString() +
                    '</div>' +
                    '</a>';
        });

        searchResultsContent.innerHTML = html;

        // Add event listeners to search result items
        document.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', function() {
                searchResults.classList.add('hidden');
            });
        });
    }
});
</script>
