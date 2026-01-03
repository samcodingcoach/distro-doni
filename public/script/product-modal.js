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
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }
        })
        .catch(error => {
            console.error('Error fetching product details:', error);
        });
}

function closeProductModal() {
    const modal = document.getElementById('productModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
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
    const thumbnailsContainer = document.getElementById('modalThumbnails');
    if (thumbnailsContainer) {
        const thumbnailFlex = thumbnailsContainer.querySelector('.flex');
        if (thumbnailFlex) {
            thumbnailFlex.innerHTML = '';
            
            // Add image 1 thumbnail
            const thumb1 = createThumbnail(product.gambar1, product.nama_produk, 0);
            thumbnailFlex.appendChild(thumb1);
            
            // Add image 2 thumbnail if exists
            if (product.gambar2) {
                const thumb2 = createThumbnail(product.gambar2, product.nama_produk, 1);
                thumbnailFlex.appendChild(thumb2);
            }
            
            // Add image 3 thumbnail if exists
            if (product.gambar3) {
                const thumb3 = createThumbnail(product.gambar3, product.nama_produk, 2);
                thumbnailFlex.appendChild(thumb3);
            }
        }
    }
    
    // Setup navigation buttons
    setupImageNavigation(product.nama_produk);
    
    // Update product details
    const modalBrand = document.getElementById('modalBrand');
    const modalProductName = document.getElementById('modalProductName');
    const modalPrice = document.getElementById('modalPrice');
    const modalOriginalPrice = document.getElementById('modalOriginalPrice');
    const modalStockIndicator = document.getElementById('modalStockIndicator');
    const modalStockStatus = document.getElementById('modalStockStatus');
    const modalSize = document.getElementById('modalSize');
    const modalProductCode = document.getElementById('modalProductCode');
    const modalDescription = document.getElementById('modalDescription');
    const modalShopeeLink = document.getElementById('modalShopeeLink');
    const modalTiktokLink = document.getElementById('modalTiktokLink');
    const shopLinksSection = document.getElementById('modalShopLinks');
    
    if (modalBrand) modalBrand.textContent = product.brand || 'Brand Name';
    if (modalProductName) modalProductName.textContent = product.nama_produk || 'Product Name';
    if (modalPrice) modalPrice.textContent = 'IDR ' + (product.harga_aktif ? numberFormat(product.harga_aktif) : '0');
    
    // Update original price if exists
    if (modalOriginalPrice) {
        if (product.harga_coret && product.harga_coret > 0) {
            modalOriginalPrice.textContent = 'IDR ' + numberFormat(product.harga_coret);
            modalOriginalPrice.classList.remove('hidden');
        } else {
            modalOriginalPrice.classList.add('hidden');
        }
    }
    
    // Update stock status
    if (modalStockIndicator && modalStockStatus) {
        const inStock = product.in_stok == '1';
        
        if (inStock) {
            modalStockIndicator.className = 'w-3 h-3 bg-green-500 rounded-full';
            modalStockStatus.className = 'text-green-600 dark:text-green-400 text-sm font-semibold';
            modalStockStatus.textContent = 'In Stock';
        } else {
            modalStockIndicator.className = 'w-3 h-3 bg-red-500 rounded-full';
            modalStockStatus.className = 'text-red-600 dark:text-red-400 text-sm font-semibold';
            modalStockStatus.textContent = 'Out of Stock';
        }
    }
    
    // Update size and product code
    if (modalSize) modalSize.textContent = product.ukuran || 'All Size (M-L)';
    if (modalProductCode) modalProductCode.textContent = product.kode_produk || 'PROD-' + String(product.id_produk || '001').padStart(3, '0');
    
    // Update description
    if (modalDescription) {
        modalDescription.textContent = product.deskripsi || 'Crafted from premium materials with attention to detail and quality. This piece combines style and comfort for the perfect addition to your wardrobe.';
    }
    
    // Update shop links
    const hasShopeeLink = product.shopee_link && product.shopee_link.trim() !== '';
    const hasTiktokLink = product.tiktok_link && product.tiktok_link.trim() !== '';
    
    if (modalShopeeLink) {
        if (hasShopeeLink) {
            modalShopeeLink.href = product.shopee_link;
            modalShopeeLink.classList.remove('hidden');
        } else {
            modalShopeeLink.classList.add('hidden');
        }
    }
    
    if (modalTiktokLink) {
        if (hasTiktokLink) {
            modalTiktokLink.href = product.tiktok_link;
            modalTiktokLink.classList.remove('hidden');
        } else {
            modalTiktokLink.classList.add('hidden');
        }
    }
    
    // Hide entire shop links section if both links are not available
    if (shopLinksSection) {
        if (!hasShopeeLink && !hasTiktokLink) {
            shopLinksSection.classList.add('hidden');
        } else {
            shopLinksSection.classList.remove('hidden');
        }
    }
}

function updateMainImage(index) {
    const mainImage = document.getElementById('modalMainImage');
    if (mainImage && window.currentProductImages && window.currentProductImages[index]) {
        mainImage.style.backgroundImage = `url("images/${window.currentProductImages[index]}")`;
        
        // Update thumbnail borders to match current image
        updateThumbnailSelection(index);
    }
}

function updateThumbnailSelection(activeIndex) {
    const thumbnailsContainer = document.getElementById('modalThumbnails');
    if (thumbnailsContainer) {
        const thumbnailFlex = thumbnailsContainer.querySelector('.flex');
        if (thumbnailFlex) {
            const thumbnails = thumbnailFlex.querySelectorAll('div');
            
            thumbnails.forEach((thumb) => {
                const thumbIndex = parseInt(thumb.getAttribute('data-index'));
                if (thumbIndex === activeIndex) {
                    thumb.classList.remove('border-transparent', 'hover:border-primary/50');
                    thumb.classList.add('border-primary');
                } else {
                    thumb.classList.remove('border-primary');
                    thumb.classList.add('border-transparent', 'hover:border-primary/50');
                }
            });
        }
    }
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
    
    if (newPrevBtn && window.currentProductImages && window.currentProductImages.length > 1) {
        newPrevBtn.addEventListener('click', function() {
            window.currentImageIndex = (window.currentImageIndex - 1 + window.currentProductImages.length) % window.currentProductImages.length;
            updateMainImage(window.currentImageIndex);
        });
    }
    
    if (newNextBtn && window.currentProductImages && window.currentProductImages.length > 1) {
        newNextBtn.addEventListener('click', function() {
            window.currentImageIndex = (window.currentImageIndex + 1) % window.currentProductImages.length;
            updateMainImage(window.currentImageIndex);
        });
    }
    
    // Hide navigation buttons if only one image
    if (window.currentProductImages && window.currentProductImages.length <= 1) {
        if (newPrevBtn) newPrevBtn.style.display = 'none';
        if (newNextBtn) newNextBtn.style.display = 'none';
    } else {
        if (newPrevBtn) newPrevBtn.style.display = 'block';
        if (newNextBtn) newNextBtn.style.display = 'block';
    }
}

function createThumbnail(imageName, altText, index) {
    const div = document.createElement('div');
    div.className = `flex h-full flex-1 flex-col rounded-lg border-2 ${index === 0 ? 'border-primary' : 'border-transparent hover:border-primary/50'} min-w-20 cursor-pointer`;
    div.setAttribute('data-index', index);
    
    const img = document.createElement('div');
    img.className = 'w-full bg-center bg-no-repeat aspect-square bg-cover rounded';
    img.setAttribute('data-alt', altText);
    img.style.backgroundImage = `url("images/${imageName}")`;
    
    div.appendChild(img);
    
    // Add click handler to change main image
    div.addEventListener('click', function() {
        const clickedIndex = parseInt(this.getAttribute('data-index'));
        window.currentImageIndex = clickedIndex;
        updateMainImage(clickedIndex);
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
