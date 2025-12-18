<?php
// Fetch kategori data from API directly using database
require_once __DIR__ . '/../config/koneksi.php';

$favorite_categories = [];

try {
    $query = "SELECT id_kategori, nama_kategori, background_url, favorit, aktif FROM kategori WHERE favorit = 1 AND aktif = 1 ORDER BY nama_kategori ASC LIMIT 5";
    $result = $conn->query($query);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $favorite_categories[] = $row;
        }
    }
} catch (Exception $e) {
    // Error handling - leave favorite_categories empty
}

$conn->close();
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
        <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="#">
            New In
        </a>
        <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="#">
            Clothing
        </a>
        <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="#">
            Bags
        </a>
        <a class="text-sm font-medium hover:text-primary dark:hover:text-primary transition-colors" href="#">
            Shoes
        </a>
        <a class="text-sm font-medium text-primary" href="#">
            Sale
        </a>
    <?php endif; ?>
</nav>
