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

<!-- Product modal functionality moved to script/product-modal.js -->
