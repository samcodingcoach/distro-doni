<!-- Product Modal -->
<div id="productModal" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeProductModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative flex items-center justify-center p-4 min-h-screen">
        <div class="relative flex flex-col w-full max-w-4xl h-auto max-h-[90vh] bg-background-light dark:bg-background-dark rounded-xl shadow-2xl overflow-hidden">
            
            <!-- Close Button -->
            <div class="absolute top-0 right-0 z-10 p-4">
                <button onclick="closeProductModal()" class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white transition-colors rounded-full bg-white/80 dark:bg-black/50 backdrop-blur-sm">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <div class="flex flex-col md:flex-row w-full overflow-y-auto">
                <!-- Image Section -->
                <div class="w-full md:w-1/2 p-4 sm:p-6">
                    <div class="flex flex-col gap-4">
                        <!-- Main Image -->
                        <div class="relative group">
                            <div id="modalMainImage" class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-lg" data-alt="Product Image">
                            </div>
                            <!-- Image Navigation -->
                            <button id="prevImageBtn" class="absolute top-1/2 left-2 -translate-y-1/2 p-2 bg-white/70 dark:bg-black/50 text-gray-800 dark:text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined">arrow_back_ios_new</span>
                            </button>
                            <button id="nextImageBtn" class="absolute top-1/2 right-2 -translate-y-1/2 p-2 bg-white/70 dark:bg-black/50 text-gray-800 dark:text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined">arrow_forward_ios</span>
                            </button>
                        </div>
                        
                        <!-- Thumbnail Images -->
                        <div id="modalThumbnails" class="flex overflow-x-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                            <div class="flex items-stretch gap-3">
                                <!-- Thumbnails will be dynamically added here -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Details Section -->
                <div class="w-full md:w-1/2 p-4 sm:p-6 flex flex-col">
                    <!-- Brand -->
                    <p id="modalBrand" class="text-primary dark:text-primary/90 text-sm font-medium leading-normal tracking-wide">
                        Brand Name
                    </p>
                    
                    <!-- Product Name -->
                    <div class="flex flex-wrap justify-between gap-3 pt-1 pb-3">
                        <h1 id="modalProductName" class="text-gray-900 dark:text-gray-50 text-[28px] font-bold leading-tight">
                            Product Name
                        </h1>
                    </div>
                    
                    <!-- Price -->
                    <div class="flex items-baseline gap-4 pb-4">
                        <h3 id="modalPrice" class="text-primary dark:text-primary tracking-tight text-4xl font-extrabold leading-none">
                            IDR 0
                        </h3>
                        <p id="modalOriginalPrice" class="text-gray-400 dark:text-gray-500 text-xl font-medium leading-normal line-through hidden">
                            IDR 0
                        </p>
                    </div>
                    
                    <!-- Stock Status -->
                    <div class="flex items-center gap-2 mb-6">
                        <span id="modalStockIndicator" class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <p id="modalStockStatus" class="text-green-600 dark:text-green-400 text-sm font-semibold">
                            In Stock
                        </p>
                    </div>
                    
                    <!-- Product Details Grid -->
                    <div class="grid grid-cols-2 gap-4 p-4 mb-6 rounded-lg bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Ukuran</p>
                            <p id="modalSize" class="text-gray-900 dark:text-gray-200 font-medium mt-1">All Size (M-L)</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Kode Produk</p>
                            <p id="modalProductCode" class="text-gray-900 dark:text-gray-200 font-medium mt-1">PROD-001</p>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <p id="modalDescription" class="text-gray-600 dark:text-gray-400 text-base leading-relaxed mb-8">
                        Crafted from premium materials with attention to detail and quality. This piece combines style and comfort for the perfect addition to your wardrobe.
                    </p>
                    
                    <!-- Add to Cart Button -->
                    <button class="w-full py-4 px-6 rounded-full bg-primary hover:bg-[#b00e44] text-white text-lg font-bold shadow-lg shadow-primary/25 hover:shadow-xl active:scale-[0.99] transition-all flex items-center justify-center gap-2 mb-4">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span>Add to Cart</span>
                    </button>
                    
                    <!-- Shop Links -->
                    <div id="modalShopLinks" class="mt-auto pt-6 border-t border-gray-200 dark:border-white/10">
                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wide text-xs">Shop this look on</p>
                        <div class="grid grid-cols-2 gap-3">
                            <a id="modalShopeeLink" href="#" class="flex items-center justify-center gap-2 h-12 px-4 rounded-full bg-[#ee4d2d] text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-[#d73211] transition-colors hidden" target="_blank">
                                <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                                <span>Shopee</span>
                            </a>
                            <a id="modalTiktokLink" href="#" class="flex items-center justify-center gap-2 h-12 px-4 rounded-full bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-gray-800 transition-colors hidden" target="_blank">
                                <span class="material-symbols-outlined text-[20px]">storefront</span>
                                <span>TikTok</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Modal functionality
function openProductModal(productId) {
    // Fetch product data via AJAX
    fetch('../api/product-details.php?id=' + productId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update modal content with fetched data
                updateModalContent(data.product);
                // Show modal
                const modal = document.getElementById('productModal');
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        })
        .catch(error => {
            console.error('Error fetching product details:', error);
        });
}

function closeProductModal() {
    const modal = document.getElementById('productModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function updateModalContent(product) {
    // Store product images globally for navigation
    window.currentProductImages = [];
    
    // Add images to array
    if (product.gambar1) window.currentProductImages.push(product.gambar1);
    if (product.gambar2) window.currentProductImages.push(product.gambar2);
    if (product.gambar3) window.currentProductImages.push(product.gambar3);
    
    window.currentImageIndex = 0;
    
    // Update main image
    updateMainImage(0);
    
    // Update thumbnails
    const thumbnailsContainer = document.getElementById('modalThumbnails').querySelector('.flex');
    thumbnailsContainer.innerHTML = '';
    
    // Add image 1 thumbnail
    const thumb1 = createThumbnail(product.gambar1, product.nama_produk, true);
    thumbnailsContainer.appendChild(thumb1);
    
    // Add image 2 thumbnail if exists
    if (product.gambar2) {
        const thumb2 = createThumbnail(product.gambar2, product.nama_produk, false);
        thumbnailsContainer.appendChild(thumb2);
    }
    
    // Add image 3 thumbnail if exists
    if (product.gambar3) {
        const thumb3 = createThumbnail(product.gambar3, product.nama_produk, false);
        thumbnailsContainer.appendChild(thumb3);
    }
    
    // Setup navigation buttons
    setupImageNavigation(product.nama_produk);
    
    // Update product details
    document.getElementById('modalBrand').textContent = product.brand || 'Brand Name';
    document.getElementById('modalProductName').textContent = product.nama_produk || 'Product Name';
    document.getElementById('modalPrice').textContent = 'IDR ' + (product.harga_aktif ? numberFormat(product.harga_aktif) : '0');
    
    // Update original price if exists
    const originalPriceEl = document.getElementById('modalOriginalPrice');
    if (product.harga_coret && product.harga_coret > 0) {
        originalPriceEl.textContent = 'IDR ' + numberFormat(product.harga_coret);
        originalPriceEl.classList.remove('hidden');
    } else {
        originalPriceEl.classList.add('hidden');
    }
    
    // Update stock status
    const inStock = product.in_stok == '1';
    const stockIndicator = document.getElementById('modalStockIndicator');
    const stockStatus = document.getElementById('modalStockStatus');
    
    if (inStock) {
        stockIndicator.className = 'w-3 h-3 bg-green-500 rounded-full';
        stockStatus.className = 'text-green-600 dark:text-green-400 text-sm font-semibold';
        stockStatus.textContent = 'In Stock';
    } else {
        stockIndicator.className = 'w-3 h-3 bg-red-500 rounded-full';
        stockStatus.className = 'text-red-600 dark:text-red-400 text-sm font-semibold';
        stockStatus.textContent = 'Out of Stock';
    }
    
    // Update size and product code
    document.getElementById('modalSize').textContent = product.ukuran || 'All Size (M-L)';
    document.getElementById('modalProductCode').textContent = product.kode_produk || 'PROD-' + String(product.id_produk || '001').padStart(3, '0');
    
    // Update description
    document.getElementById('modalDescription').textContent = product.deskripsi || 'Crafted from premium materials with attention to detail and quality. This piece combines style and comfort for the perfect addition to your wardrobe.';
    
    // Update shop links
    const shopeeLink = document.getElementById('modalShopeeLink');
    const tiktokLink = document.getElementById('modalTiktokLink');
    const shopLinksSection = document.getElementById('modalShopLinks');
    
    const hasShopeeLink = product.shopee_link && product.shopee_link.trim() !== '';
    const hasTiktokLink = product.tiktok_link && product.tiktok_link.trim() !== '';
    
    if (hasShopeeLink) {
        shopeeLink.href = product.shopee_link;
        shopeeLink.classList.remove('hidden');
    } else {
        shopeeLink.classList.add('hidden');
    }
    
    if (hasTiktokLink) {
        tiktokLink.href = product.tiktok_link;
        tiktokLink.classList.remove('hidden');
    } else {
        tiktokLink.classList.add('hidden');
    }
    
    // Hide entire shop links section if both links are not available
    if (!hasShopeeLink && !hasTiktokLink) {
        shopLinksSection.classList.add('hidden');
    } else {
        shopLinksSection.classList.remove('hidden');
    }
}

function updateMainImage(index) {
    const mainImage = document.getElementById('modalMainImage');
    if (mainImage && window.currentProductImages[index]) {
        mainImage.style.backgroundImage = `url("images/${window.currentProductImages[index]}")`;
        
        // Update thumbnail borders to match current image
        updateThumbnailSelection(index);
    }
}

function updateThumbnailSelection(activeIndex) {
    const thumbnailsContainer = document.getElementById('modalThumbnails').querySelector('.flex');
    const thumbnails = thumbnailsContainer.querySelectorAll('div');
    
    thumbnails.forEach((thumb, index) => {
        if (index === activeIndex) {
            thumb.classList.remove('border-transparent', 'hover:border-primary/50');
            thumb.classList.add('border-primary');
        } else {
            thumb.classList.remove('border-primary');
            thumb.classList.add('border-transparent', 'hover:border-primary/50');
        }
    });
}

function setupImageNavigation(altText) {
    const prevBtn = document.getElementById('prevImageBtn');
    const nextBtn = document.getElementById('nextImageBtn');
    
    // Remove existing event listeners
    if (prevBtn) prevBtn.replaceWith(prevBtn.cloneNode(true));
    if (nextBtn) nextBtn.replaceWith(nextBtn.cloneNode(true));
    
    // Get fresh references
    const newPrevBtn = document.getElementById('prevImageBtn');
    const newNextBtn = document.getElementById('nextImageBtn');
    
    if (newPrevBtn && window.currentProductImages.length > 1) {
        newPrevBtn.addEventListener('click', function() {
            window.currentImageIndex = (window.currentImageIndex - 1 + window.currentProductImages.length) % window.currentProductImages.length;
            updateMainImage(window.currentImageIndex);
        });
    }
    
    if (newNextBtn && window.currentProductImages.length > 1) {
        newNextBtn.addEventListener('click', function() {
            window.currentImageIndex = (window.currentImageIndex + 1) % window.currentProductImages.length;
            updateMainImage(window.currentImageIndex);
        });
    }
    
    // Hide navigation buttons if only one image
    if (window.currentProductImages.length <= 1) {
        if (newPrevBtn) newPrevBtn.style.display = 'none';
        if (newNextBtn) newNextBtn.style.display = 'none';
    } else {
        if (newPrevBtn) newPrevBtn.style.display = 'block';
        if (newNextBtn) newNextBtn.style.display = 'block';
    }
}

function createThumbnail(imageName, altText, isActive) {
    const div = document.createElement('div');
    div.className = `flex h-full flex-1 flex-col rounded-lg border-2 ${isActive ? 'border-primary' : 'border-transparent hover:border-primary/50'} min-w-20 cursor-pointer`;
    
    const img = document.createElement('div');
    img.className = 'w-full bg-center bg-no-repeat aspect-square bg-cover rounded';
    img.setAttribute('data-alt', altText);
    img.style.backgroundImage = `url("images/${imageName}")`;
    
    div.appendChild(img);
    
    // Add click handler to change main image
    div.addEventListener('click', function() {
        // Find the index of this image in the current product images array
        const index = window.currentProductImages.indexOf(imageName);
        if (index !== -1) {
            window.currentImageIndex = index;
            updateMainImage(index);
        }
    });
    
    return div;
}

function numberFormat(num) {
    return new Intl.NumberFormat('id-ID').format(parseInt(num) || 0);
}

// Close modal on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeProductModal();
    }
});
</script>
