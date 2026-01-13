// Mobile Menu Functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuPanel = document.getElementById('mobile-menu-panel');
    const closeMobileMenu = document.getElementById('close-mobile-menu');
    const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
    const mobileSearchInput = document.getElementById('mobile-search-input');
    const mobileSearchResults = document.getElementById('mobile-search-results');
    const mobileSearchResultsContent = document.getElementById('mobile-search-results-content');

    // Toggle mobile menu
    function openMobileMenu() {
        mobileMenu.classList.remove('hidden');
        setTimeout(() => {
            mobileMenuPanel.classList.remove('translate-x-full');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenuFunc() {
        mobileMenuPanel.classList.add('translate-x-full');
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = '';
            // Clear search when closing
            mobileSearchInput.value = '';
            mobileSearchResults.classList.add('hidden');
        }, 300);
    }

    // Event listeners
    mobileMenuToggle.addEventListener('click', openMobileMenu);
    closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
    mobileMenuBackdrop.addEventListener('click', closeMobileMenuFunc);

    // Mobile Search Functionality
    if (mobileSearchInput) {
        let searchTimeout;

        mobileSearchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const query = e.target.value.trim();

            if (query.length < 2) {
                mobileSearchResults.classList.add('hidden');
                return;
            }

            searchTimeout = setTimeout(() => {
                performMobileSearch(query);
            }, 300);
        });

        // Close search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileSearchInput.contains(e.target) && !mobileSearchResults.contains(e.target)) {
                mobileSearchResults.classList.add('hidden');
            }
        });

        // Handle Enter key for search
        mobileSearchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const query = e.target.value.trim();
                if (query) {
                    window.location.href = `product.php?search=${encodeURIComponent(query)}`;
                }
            }
        });
    }

    // Mobile search function
    async function performMobileSearch(query) {
        try {
            const response = await fetch(`../api/produk/search.php?q=${encodeURIComponent(query)}`);
            const data = await response.json();

            if (data.success && data.data && data.data.length > 0) {
                displayMobileSearchResults(data.data, query);
            } else {
                mobileSearchResultsContent.innerHTML = `
                    <div class="px-4 py-3 text-center text-secondary-light dark:text-secondary-dark">
                        No products found for "${query}"
                    </div>
                `;
                mobileSearchResults.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Mobile search error:', error);
            mobileSearchResultsContent.innerHTML = `
                <div class="px-4 py-3 text-center text-red-500">
                    Search temporarily unavailable
                </div>
            `;
            mobileSearchResults.classList.remove('hidden');
        }
    }

    // Display mobile search results
    function displayMobileSearchResults(products, query) {
        let html = '';
        
        products.slice(0, 5).forEach(product => {
            // Use placeholder image since search API doesn't include image
            const imageUrl = '../images/placeholder.png';
            const price = parseInt(product.harga_aktif).toLocaleString('id-ID');
            
            html += `
                <a href="product.php?id=${product.id_produk}" class="block hover:bg-surface-light dark:hover:bg-surface-dark transition-colors">
                    <div class="flex items-center gap-3 p-3">
                        <div class="w-12 h-12 bg-surface-light dark:bg-surface-dark rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl text-secondary-light dark:text-secondary-dark">
                                shopping_bag
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-foreground-light dark:text-foreground-dark truncate">
                                ${product.nama_produk}
                            </p>
                            <div class="flex items-center gap-2">
                                <p class="text-sm text-primary font-semibold">
                                    IDR ${price}
                                </p>
                                <p class="text-xs text-secondary-light dark:text-secondary-dark">
                                    ${product.nama_kategori}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            `;
        });

        if (products.length > 5) {
            html += `
                <a href="product.php?search=${encodeURIComponent(query)}" class="block px-4 py-2 text-center text-sm text-primary hover:bg-surface-light dark:hover:bg-surface-dark transition-colors">
                    View all ${products.length} results
                </a>
            `;
        }

        mobileSearchResultsContent.innerHTML = html;
        mobileSearchResults.classList.remove('hidden');
    }

    // Close mobile menu when clicking on category links
    const categoryLinks = mobileMenu.querySelectorAll('nav a');
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Allow normal navigation, just close the menu after a short delay
            setTimeout(closeMobileMenuFunc, 100);
        });
    });

    // Handle escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
            closeMobileMenuFunc();
        }
    });
});
