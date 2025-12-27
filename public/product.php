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

$title_nama_distro = $distro ? $distro['nama_distro'] : 'APRIL';
$title_slogan = $distro ? $distro['slogan'] : 'Modern Fashion';
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
       <label class="relative hidden sm:block w-full max-w-xs">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary-light dark:text-secondary-dark">
         search
        </span>
        <input class="form-input h-10 w-full rounded-full border-none bg-surface-light dark:bg-surface-dark pl-10 pr-4 text-sm placeholder:text-secondary-light dark:placeholder:text-secondary-dark focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="Search" type="search"/>
       </label>
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
    <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Breadcrumb -->
        <nav class="flex text-sm text-secondary-light dark:text-secondary-dark mb-6">
          <a href="index.php" class="hover:text-primary transition-colors">Home</a>
          <span class="mx-2">/</span>
          <span class="font-medium text-foreground-light dark:text-foreground-dark">
            All Products
          </span>
        </nav>

        <!-- Header + Filter -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 border-b border-surface-light dark:border-surface-dark/50 pb-6">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">
              All Products
            </h1>
            <p class="text-secondary-light dark:text-secondary-dark">
              Discover our latest collection designed for the modern lifestyle.
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
                <ul class="py-2 text-sm">
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-size="S">S</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-size="M">M</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-size="XL">XL</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-size="XXL">XXL</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-size="XXXL">XXXL</li>
                  <li class="px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark" data-size="Unknown">Unknown</li>
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

            <!-- Sort -->
            <select id="sort-select" class="form-select border-none bg-transparent py-2 pl-2 pr-8 text-sm font-medium focus:ring-0 cursor-pointer">
              <option value="featured">Sort by: Featured</option>
              <option value="price-low-high">Price: Low to High</option>
              <option value="price-high-low">Price: High to Low</option>
              <option value="newest">Newest</option>
            </select>
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

  <!-- FILTER SCRIPT -->
  <script>
    let allProducts = [];
    let filteredProducts = [];
    let currentFilters = {
      price: null,
      size: null,
      brand: null,
      sort: 'featured'
    };

    // Load products and brands from API
    async function loadProductsAndBrands() {
      try {
        const response = await fetch('../api/produk/list.php');
        const data = await response.json();
        
        if (data.success && data.data) {
          allProducts = data.data;
          filteredProducts = [...allProducts];
          
          // Load brands
          const brands = [...new Set(allProducts.map(product => product.merk).filter(brand => brand && brand.trim() !== ''))];
          brands.sort((a, b) => a.localeCompare(b));
          
          const brandList = document.getElementById('brand-list');
          brandList.innerHTML = '';
          
          brands.forEach(brand => {
            const li = document.createElement('li');
            li.className = 'px-4 py-2 cursor-pointer hover:bg-surface-light dark:hover:bg-background-dark';
            li.setAttribute('data-brand', brand);
            li.textContent = brand;
            brandList.appendChild(li);
          });
        }
      } catch (error) {
        console.error('Error loading products and brands:', error);
      }
    }

    // Filter products based on current filters
    function filterProducts() {
      filteredProducts = allProducts.filter(product => {
        // Price filter
        if (currentFilters.price) {
          const price = parseInt(product.harga_aktif);
          switch (currentFilters.price) {
            case 'under100000':
              if (price >= 100000) return false;
              break;
            case '100000-500000':
              if (price < 100000 || price > 500000) return false;
              break;
            case '500000-1000000':
              if (price < 500000 || price > 1000000) return false;
              break;
          }
        }

        // Size filter
        if (currentFilters.size && currentFilters.size !== 'Unknown') {
          if (!product.ukuran || !product.ukuran.toLowerCase().includes(currentFilters.size.toLowerCase())) {
            return false;
          }
        } else if (currentFilters.size === 'Unknown') {
          if (product.ukuran && product.ukuran.trim() !== '' && product.ukuran.toLowerCase() !== 'unknown') {
            return false;
          }
        }

        // Brand filter
        if (currentFilters.brand) {
          if (product.merk !== currentFilters.brand) return false;
        }

        return true;
      });

      // Apply sorting
      applySorting();
      
      // Update display
      updateProductDisplay();
      
      // Update active filters display
      updateActiveFiltersDisplay();
    }

    // Apply sorting to filtered products
    function applySorting() {
      switch (currentFilters.sort) {
        case 'price-low-high':
          filteredProducts.sort((a, b) => parseInt(a.harga_aktif) - parseInt(b.harga_aktif));
          break;
        case 'price-high-low':
          filteredProducts.sort((a, b) => parseInt(b.harga_aktif) - parseInt(a.harga_aktif));
          break;
        case 'newest':
          // Assuming products have an id where higher numbers are newer
          filteredProducts.sort((a, b) => parseInt(b.id_produk) - parseInt(a.id_produk));
          break;
        case 'lowest':
          filteredProducts.sort((a, b) => parseInt(a.harga_aktif) - parseInt(b.harga_aktif));
          break;
        case 'highest':
          filteredProducts.sort((a, b) => parseInt(b.harga_aktif) - parseInt(a.harga_aktif));
          break;
        default:
          // featured - keep original order
          break;
      }
    }

    // Update product display with filtered results and pagination
    function updateProductDisplay() {
      const grid = document.querySelector('.grid.grid-cols-2');
      if (!grid) return;

      if (filteredProducts.length === 0) {
        grid.innerHTML = '<div class="col-span-full text-center py-12"><p class="text-secondary-light dark:text-secondary-dark">No products found matching your filters.</p></div>';
        // Hide pagination when no products
        const paginationContainer = document.querySelector('.flex.justify-center.mt-12');
        if (paginationContainer) {
          paginationContainer.style.display = 'none';
        }
        return;
      }

      // Pagination setup
      const itemsPerPage = 12;
      let currentPage = 1; // Reset to page 1 when filters change
      
      // Get products for current page
      const startIndex = (currentPage - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      const currentProducts = filteredProducts.slice(startIndex, endIndex);

      // Generate product HTML
      grid.innerHTML = currentProducts.map(product => {
        const inStock = parseInt(product.jumlah_stok) > 0;
        const stockStatus = inStock 
          ? '<div class="absolute bottom-2 right-2 z-10 rounded-lg bg-green-600/50 backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">In Stock</div>'
          : '<div class="absolute bottom-2 right-2 z-10 rounded-lg bg-red-600/50 backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">Out of Stock</div>';

        const soldBadge = parseInt(product.terjual) > 0 
          ? `<div class="absolute bottom-2 left-2 z-10 rounded-lg bg-black/50 backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">${number_format(product.terjual)} sold</div>`
          : '';

        const originalPrice = parseInt(product.harga_coret) > 0 
          ? `<p class="text-sm font-normal line-through" style="color: #9a4c66;">Rp ${number_format(product.harga_coret)}</p>`
          : '';

        return `
          <div class="group flex flex-col gap-3 cursor-pointer" onclick="openProductModal(${product.id_produk})">
            <div class="relative overflow-hidden rounded-xl">
              ${soldBadge}
              ${stockStatus}
              <div class="absolute inset-0 aspect-[3/4] bg-cover bg-center transition-opacity duration-500 group-hover:opacity-0 bg-gray-200" style="background-image: url('images/${product.gambar1}');"></div>
              <div class="aspect-[3/4] bg-cover bg-center opacity-0 transition-opacity duration-500 group-hover:opacity-100 bg-gray-200" style="background-image: url('images/${product.gambar2}');"></div>
            </div>
            <div>
              <p class="text-base font-medium leading-normal">${product.nama_produk}</p>
              <div class="flex items-center gap-2">
                <p class="text-sm font-normal leading-normal text-primary" style="color: #d41152;">Rp ${number_format(product.harga_aktif)}</p>
                ${originalPrice}
              </div>
            </div>
          </div>
        `;
      }).join('');

      // Update pagination
      updatePagination(filteredProducts.length, itemsPerPage, currentPage);
    }

    // Update pagination controls
    function updatePagination(totalItems, itemsPerPage, currentPage) {
      const totalPages = Math.ceil(totalItems / itemsPerPage);
      const paginationContainer = document.querySelector('.flex.justify-center.mt-12');
      
      if (!paginationContainer || totalPages <= 1) {
        if (paginationContainer) {
          paginationContainer.style.display = 'none';
        }
        return;
      }

      paginationContainer.style.display = 'flex';
      
      let paginationHTML = '<nav class="flex items-center gap-2">';
      
      // Previous button
      if (currentPage > 1) {
        paginationHTML += `<a href="#" onclick="changePage(${currentPage - 1}); return false;" class="h-10 w-10 flex items-center justify-center rounded-full text-secondary-light dark:text-secondary-dark hover:bg-surface-light dark:hover:bg-surface-dark transition-colors">
          <span class="material-symbols-outlined">chevron_left</span>
        </a>`;
      } else {
        paginationHTML += `<button class="h-10 w-10 flex items-center justify-center rounded-full text-secondary-light/50 dark:text-secondary-dark/50" disabled>
          <span class="material-symbols-outlined">chevron_left</span>
        </button>`;
      }

      // Page numbers with ellipsis
      let startPage = Math.max(1, currentPage - 2);
      let endPage = Math.min(totalPages, currentPage + 2);
      
      if (startPage > 1) {
        paginationHTML += `<a href="#" onclick="changePage(1); return false;" class="h-10 w-10 flex items-center justify-center rounded-full text-foreground-light dark:text-foreground-dark hover:bg-surface-light dark:hover:bg-surface-dark transition-colors font-medium">1</a>`;
        if (startPage > 2) {
          paginationHTML += '<span class="px-2 text-secondary-light dark:text-secondary-dark">...</span>';
        }
      }
      
      for (let i = startPage; i <= endPage; i++) {
        if (i === currentPage) {
          paginationHTML += `<button class="h-10 w-10 flex items-center justify-center rounded-full bg-primary text-white font-medium">${i}</button>`;
        } else {
          paginationHTML += `<a href="#" onclick="changePage(${i}); return false;" class="h-10 w-10 flex items-center justify-center rounded-full text-foreground-light dark:text-foreground-dark hover:bg-surface-light dark:hover:bg-surface-dark transition-colors font-medium">${i}</a>`;
        }
      }
      
      if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
          paginationHTML += '<span class="px-2 text-secondary-light dark:text-secondary-dark">...</span>';
        }
        paginationHTML += `<a href="#" onclick="changePage(${totalPages}); return false;" class="h-10 w-10 flex items-center justify-center rounded-full text-foreground-light dark:text-foreground-dark hover:bg-surface-light dark:hover:bg-surface-dark transition-colors font-medium">${totalPages}</a>`;
      }

      // Next button
      if (currentPage < totalPages) {
        paginationHTML += `<a href="#" onclick="changePage(${currentPage + 1}); return false;" class="h-10 w-10 flex items-center justify-center rounded-full text-foreground-light dark:text-foreground-dark hover:bg-surface-light dark:hover:bg-surface-dark transition-colors">
          <span class="material-symbols-outlined">chevron_right</span>
        </a>`;
      } else {
        paginationHTML += `<button class="h-10 w-10 flex items-center justify-center rounded-full text-secondary-light/50 dark:text-secondary-dark/50" disabled>
          <span class="material-symbols-outlined">chevron_right</span>
        </button>`;
      }
      
      paginationHTML += '</nav>';
      paginationContainer.innerHTML = paginationHTML;
    }

    // Change page
    function changePage(page) {
      displayPage(page);
    }

    // Display specific page
    function displayPage(page) {
      const grid = document.querySelector('.grid.grid-cols-2');
      if (!grid) return;

      const itemsPerPage = 12;
      const startIndex = (page - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      const currentProducts = filteredProducts.slice(startIndex, endIndex);

      // Generate product HTML for this page
      grid.innerHTML = currentProducts.map(product => {
        const inStock = parseInt(product.jumlah_stok) > 0;
        const stockStatus = inStock 
          ? '<div class="absolute bottom-2 right-2 z-10 rounded-lg bg-green-600/50 backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">In Stock</div>'
          : '<div class="absolute bottom-2 right-2 z-10 rounded-lg bg-red-600/50 backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">Out of Stock</div>';

        const soldBadge = parseInt(product.terjual) > 0 
          ? `<div class="absolute bottom-2 left-2 z-10 rounded-lg bg-black/50 backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">${number_format(product.terjual)} sold</div>`
          : '';

        const originalPrice = parseInt(product.harga_coret) > 0 
          ? `<p class="text-sm font-normal line-through" style="color: #9a4c66;">Rp ${number_format(product.harga_coret)}</p>`
          : '';

        return `
          <div class="group flex flex-col gap-3 cursor-pointer" onclick="openProductModal(${product.id_produk})">
            <div class="relative overflow-hidden rounded-xl">
              ${soldBadge}
              ${stockStatus}
              <div class="absolute inset-0 aspect-[3/4] bg-cover bg-center transition-opacity duration-500 group-hover:opacity-0 bg-gray-200" style="background-image: url('images/${product.gambar1}');"></div>
              <div class="aspect-[3/4] bg-cover bg-center opacity-0 transition-opacity duration-500 group-hover:opacity-100 bg-gray-200" style="background-image: url('images/${product.gambar2}');"></div>
            </div>
            <div>
              <p class="text-base font-medium leading-normal">${product.nama_produk}</p>
              <div class="flex items-center gap-2">
                <p class="text-sm font-normal leading-normal text-primary" style="color: #d41152;">Rp ${number_format(product.harga_aktif)}</p>
                ${originalPrice}
              </div>
            </div>
          </div>
        `;
      }).join('');

      // Update pagination controls
      updatePagination(filteredProducts.length, itemsPerPage, page);
      
      // Scroll to top of products
      grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Helper function for number formatting
    function number_format(num) {
      return new Intl.NumberFormat('id-ID').format(parseInt(num) || 0);
    }

    // Update active filters display
    function updateActiveFiltersDisplay() {
      const activeFiltersDiv = document.getElementById('activeFilters');
      const filterTagsDiv = document.getElementById('filterTags');
      
      // Create array of active filters
      const activeFilters = [];
      
      if (currentFilters.price) {
        let priceLabel = '';
        switch(currentFilters.price) {
          case 'under100000':
            priceLabel = 'Price: Under 100.000';
            break;
          case '100000-500000':
            priceLabel = 'Price: 100.000-500.000';
            break;
          case '500000-1000000':
            priceLabel = 'Price: 500.000-1.000.000';
            break;
          case 'lowest':
            priceLabel = 'Price: Lowest';
            break;
          case 'highest':
            priceLabel = 'Price: Highest';
            break;
        }
        activeFilters.push({ type: 'price', label: priceLabel });
      }
      
      if (currentFilters.size && currentFilters.size !== 'Unknown') {
        activeFilters.push({ type: 'size', label: `Size: ${currentFilters.size}` });
      }
      
      if (currentFilters.brand) {
        activeFilters.push({ type: 'brand', label: `Brand: ${currentFilters.brand}` });
      }
      
      // Show/hide active filters section
      if (activeFilters.length > 0) {
        activeFiltersDiv.classList.remove('hidden');
        
        // Generate filter tags HTML
        filterTagsDiv.innerHTML = activeFilters.map(filter => `
          <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium">
            ${filter.label}
            <button class="hover:text-primary/80" onclick="removeFilter('${filter.type}')">
              <span class="material-symbols-outlined text-base">close</span>
            </button>
          </span>
        `).join('');
      } else {
        activeFiltersDiv.classList.add('hidden');
      }
    }

    // Remove specific filter
    function removeFilter(filterType) {
      currentFilters[filterType] = null;
      filterProducts();
    }

    // Clear all filters
    function clearAllFilters() {
      currentFilters = {
        price: null,
        size: null,
        brand: null,
        sort: currentFilters.sort // Keep sorting
      };
      filterProducts();
    }



    // Initialize filter interactions
    document.addEventListener('DOMContentLoaded', function() {
      loadProductsAndBrands();
      
      // Filter menu interactions
      document.addEventListener("click", function (e) {
        const buttons = document.querySelectorAll(".filter-btn");
        const menus = document.querySelectorAll(".filter-menu");

        buttons.forEach((btn) => {
          const target = document.getElementById(btn.dataset.target);

          if (btn.contains(e.target)) {
            menus.forEach((menu) => {
              if (menu !== target) menu.classList.add("hidden");
            });
            target.classList.toggle("hidden");
          }
        });

        if (![...buttons].some((btn) => btn.contains(e.target))) {
          menus.forEach((menu) => menu.classList.add("hidden"));
        }

        // Handle price filter clicks
        if (e.target.matches('[data-price]')) {
          const priceValue = e.target.getAttribute('data-price');
          currentFilters.price = currentFilters.price === priceValue ? null : priceValue;
          filterProducts();
        }

        // Handle size filter clicks
        if (e.target.matches('[data-size]')) {
          const sizeValue = e.target.getAttribute('data-size');
          currentFilters.size = currentFilters.size === sizeValue ? null : sizeValue;
          filterProducts();
        }

        // Handle brand filter clicks
        if (e.target.matches('[data-brand]')) {
          const brandValue = e.target.getAttribute('data-brand');
          currentFilters.brand = currentFilters.brand === brandValue ? null : brandValue;
          filterProducts();
        }
      });

      // Handle sort dropdown
      const sortSelect = document.getElementById('sort-select');
      if (sortSelect) {
        sortSelect.addEventListener('change', function() {
          currentFilters.sort = this.value;
          applySorting();
          updateProductDisplay();
        });
      }

      // Add clear all filters button listener
      const clearAllBtn = document.getElementById('clearAllFilters');
      if (clearAllBtn) {
        clearAllBtn.addEventListener('click', clearAllFilters);
      }
    });
  </script>
 </body>
</html>