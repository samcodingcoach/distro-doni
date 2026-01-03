<?php
// Fetch distro data by executing the API script in a separate process to avoid header conflicts
$distro = null;

// Use a method that ensures the API is properly executed without interfering with the current page
$api_file_path = __DIR__ . '/../api/distro/list.php';

if (file_exists($api_file_path)) {
    // Execute the API script and capture its output
    $command = 'php ' . escapeshellarg($api_file_path);
    $api_output = shell_exec($command);

    if ($api_output !== null) {
        $data = json_decode($api_output, true);
        $distro = isset($data['data'][0]) ? $data['data'][0] : null;
    }
}

// Get category parameter from URL
$category_filter = isset($_GET['kategori']) ? $_GET['kategori'] : null;

$title_nama_distro = $distro ? $distro['nama_distro'] : 'APRIL';
$title_slogan = $distro ? $distro['slogan'] : 'Modern Fashion';

// Set page title based on category filter
$page_title = $category_filter ? htmlspecialchars(ucfirst($category_filter)) : 'All Products';
$page_description = $category_filter 
    ? "Discover our " . htmlspecialchars(ucfirst($category_filter)) . " collection designed for the modern lifestyle."
    : "Discover our latest collection designed for the modern lifestyle.";
?>
<!DOCTYPE html>
<html class="light" lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   <?php echo htmlspecialchars($title_nama_distro); ?> - <?php echo htmlspecialchars($title_slogan); ?>
  </title>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries">
  </script>
  <style type="text/tailwindcss">
   .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollable-container {
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
  </style>
  <script src="script/tailwind-config.js"></script>
<script src="script/product-modal.js"></script>
<script src="script/search.js"></script>
<script src="script/product-filter.js"></script>
 </head>
 <body class="font-display bg-background-light dark:bg-background-dark text-foreground-light dark:text-foreground-dark">
  <div class="relative flex min-h-screen w-full flex-col">

   <header class="sticky top-0 z-50 w-full border-b border-surface-light dark:border-surface-dark/50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
     <div class="flex h-16 items-center justify-between">
      <div class="flex items-center gap-8">
       <a class="flex items-center gap-2 text-foreground-light dark:text-foreground-dark" href="index.php">
        <svg class="h-6 w-6" fill="currentColor" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
         <path d="M44 4H30.6666V17.3334H17.3334V30.6666H4V44H44V4Z">
         </path>
        </svg>
        <h2 class="text-xl font-bold tracking-[-0.015em]">
            <?php echo htmlspecialchars($title_nama_distro); ?>
        </h2>
       </a>
       <!-- daftar navigasi menu diambil dari api/kategori/list.php, ambil favorit true/1 sebanyak 5-->
       <?php include 'navbar.php'; ?>
      </div>
      <div class="flex flex-1 items-center justify-end gap-2 md:gap-4">
       <div class="relative hidden sm:block w-full max-w-xs">
        <label class="relative w-full">
         <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary-light dark:text-secondary-dark">
          search
         </span>
         <input
            id="main-search-input"
            class="form-input h-10 w-full rounded-full border-none bg-surface-light dark:bg-surface-dark pl-10 pr-4 text-sm placeholder:text-secondary-light dark:placeholder:text-secondary-dark focus:outline-none focus:ring-2 focus:ring-primary/50"
            placeholder="Search"
            type="search"
         />
        </label>

        <!-- Search Results Dropdown -->
        <div id="main-search-results" class="absolute left-0 right-0 mt-2 bg-surface-light dark:bg-surface-dark rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 z-50 hidden">
            <div id="main-search-results-content" class="py-2 max-h-96 overflow-y-auto">
                <!-- Search results will be populated here -->
            </div>
        </div>
       </div>
       <div class="flex items-center gap-1 md:gap-2">
        
        
        <button class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-transparent hover:bg-surface-light dark:hover:bg-surface-dark">
         <span class="material-symbols-outlined text-2xl">
          shopping_bag
         </span>
        </button>
       </div>
      </div>
     </div>
    </div>
   </header>

   <main class="flex-grow">
    <section id="product-page-content" class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Breadcrumb -->
        <nav class="flex text-sm text-secondary-light dark:text-secondary-dark mb-6">
          <a href="index.php" class="hover:text-primary transition-colors">Home</a>
          <span class="mx-2">/</span>
          <?php if ($category_filter): ?>
            <a href="product.php" class="hover:text-primary transition-colors">All Products</a>
            <span class="mx-2">/</span>
            <span class="font-medium text-foreground-light dark:text-foreground-dark">
              <?php echo htmlspecialchars(ucfirst($category_filter)); ?>
            </span>
          <?php else: ?>
            <span class="font-medium text-foreground-light dark:text-foreground-dark">
              All Products
            </span>
          <?php endif; ?>
        </nav>

        <!-- Header + Filter -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 border-b border-surface-light dark:border-surface-dark/50 pb-6">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">
              <?php echo $page_title; ?>
            </h1>
            <p class="text-secondary-light dark:text-secondary-dark">
              <?php echo $page_description; ?>
            </p>
          </div>

          <!-- FILTER -->
          <div class="flex flex-wrap items-center gap-3">
            <span class="text-sm font-medium mr-1 hidden sm:inline-block">
              Filter by:
            </span>

            <!-- Price -->
            <div class="relative">
              <button
                type="button"
                class="filter-btn flex items-center gap-2 px-4 py-2 bg-surface-light dark:bg-surface-dark rounded-full text-sm font-medium"
                data-target="price-filter"
              >
                Price
                <span class="material-symbols-outlined text-base">expand_more</span>
              </button>

              <div
                id="price-filter"
                class="filter-menu absolute z-20 mt-2 w-48 rounded-lg bg-white dark:bg-surface-dark shadow-lg hidden"
              >
                <ul class="py-2 text-sm">
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-price="under100000">Under 100.000</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-price="100000-500000">100.000-500.000</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-price="500000-1000000">500.000-1.000.000</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-price="lowest">Lowest</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-price="highest">Highest</li>
                </ul>
              </div>
            </div>

            <!-- Size -->
            <div class="relative">
              <button
                type="button"
                class="filter-btn flex items-center gap-2 px-4 py-2 bg-surface-light dark:bg-surface-dark rounded-full text-sm font-medium"
                data-target="size-filter"
              >
                Size
                <span class="material-symbols-outlined text-base">expand_more</span>
              </button>

              <div
                id="size-filter"
                class="filter-menu absolute z-20 mt-2 w-32 rounded-lg bg-white dark:bg-surface-dark shadow-lg hidden"
              >
                <ul class="py-2 text-sm" id="size-list">
                  <!-- Sizes will be loaded dynamically from API -->
                </ul>
              </div>
            </div>

            <!-- Brand -->
            <div class="relative">
              <button
                type="button"
                class="filter-btn flex items-center gap-2 px-4 py-2 bg-surface-light dark:bg-surface-dark rounded-full text-sm font-medium"
                data-target="brand-filter"
              >
                Brand
                <span class="material-symbols-outlined text-base">expand_more</span>
              </button>

              <div
                id="brand-filter"
                class="filter-menu absolute z-20 mt-2 w-40 rounded-lg bg-white dark:bg-surface-dark shadow-lg hidden"
              >
                <ul class="py-2 text-sm" id="brand-list">
                  <!-- Brands will be loaded dynamically -->
                </ul>
              </div>
            </div>

            <div class="h-6 w-px bg-surface-dark/10 dark:bg-surface-light/10 mx-2"></div>
          </div>
        </div>

        <!-- Active Filters Display -->
        <div id="activeFilters" class="hidden mb-6 p-4 bg-surface-light dark:bg-surface-dark rounded-lg">
          <div class="flex flex-wrap items-center gap-3">
            <span class="text-sm font-medium text-secondary-light dark:text-secondary-dark">Active filters:</span>
            <div id="filterTags" class="flex flex-wrap items-center gap-2">
              <!-- Filter tags will be added here dynamically -->
            </div>
            <button id="clearAllFilters" class="text-sm text-primary hover:underline font-medium">
              Clear all
            </button>
          </div>
        </div>

        <?php include 'all-itemproduct.php'; ?>
    </section>
   </main>

   <?php include 'footer.php'; ?>
   
   <!-- Include Product Modal -->
   <?php include 'modal/product-modal.php'; ?>
   
   <a class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-lg hover:bg-green-600 transition-colors" href="#">
    <svg class="bi bi-whatsapp" fill="currentColor" height="28" viewbox="0 0 16 16" width="28" xmlns="http://www.w3.org/2000/svg">
     <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
     </path>
    </svg>
   </a>
  </div>

  <!-- Initialize product filter with PHP variables -->
  <script>
    // Set initial category filter from PHP
    if (typeof currentFilters !== 'undefined') {
        currentFilters.category = '<?php echo $category_filter ? htmlspecialchars($category_filter) : ''; ?>';
    }

      <!-- Product filter functionality moved to script/product-filter.js -->
  </script>
 </body>
</html>