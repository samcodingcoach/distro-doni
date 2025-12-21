<!DOCTYPE html>
<html class="light" lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
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
       <a class="flex items-center gap-2 text-foreground-light dark:text-foreground-dark" href="#">
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
    <!-- konten utama di sini -->
    <!-- hero banner section -->
        <?php
        // Fetch banner data by executing the API script in a separate process to avoid header conflicts
        $banner = null;

        // Use a method that ensures the API is properly executed without interfering with the current page
        $api_file_path = __DIR__ . '/../api/banner/list.php';

        if (file_exists($api_file_path)) {
            // Change to the API directory before executing to fix relative path issues
            $command = 'cd ' . escapeshellarg(dirname($api_file_path)) . ' && php ' . escapeshellarg(basename($api_file_path));
            $api_output = shell_exec($command);

            if ($api_output !== null) {
                $data = json_decode($api_output, true);
                $banner = isset($data['data'][0]) ? $data['data'][0] : null;
            }
        }

        $banner_judul = $banner['judul'] ?? null;
        $banner_deskripsi = $banner['deskripsi'] ?? null;
        $banner_url_gambar = $banner['url_gambar'] ?? null;
        ?>
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex min-h-[60vh] flex-col items-center justify-center gap-6 rounded-xl bg-cover bg-center bg-no-repeat p-4 text-center" data-alt="A model wearing a stylish trench coat from the new autumn collection, posing in a minimalist urban setting." style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("<?php echo htmlspecialchars($banner_url_gambar); ?>");'>
                <div class="flex flex-col gap-2">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] md:text-6xl">
                        <?php echo htmlspecialchars($banner_judul); ?>
                    </h1>
                    <h2 class="text-white text-base font-normal leading-normal md:text-lg">
                        <?php echo htmlspecialchars($banner_deskripsi); ?>
                    </h2>
                </div>
                <button class="flex h-12 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full bg-primary px-6 text-base font-bold leading-normal tracking-[0.015em] text-white transition-opacity hover:opacity-90">
                    <span class="truncate">
                        Shop Now
                    </span>
                </button>
            </div>
        </section>
    
    <!-- hero banner section -->

   <!--  section new arrival -->
        <?php
        // Fetch produk data by executing the API script in a separate process
        $produk_list = [];
        $api_file_path = __DIR__ . '/../api/produk/list.php';

        if (file_exists($api_file_path)) {
            $command = 'cd ' . escapeshellarg(dirname($api_file_path)) . ' && php ' . escapeshellarg(basename($api_file_path));
            $api_output = shell_exec($command);

            if ($api_output !== null) {
                $data = json_decode($api_output, true);
                if (isset($data['success']) && $data['success'] && isset($data['data'])) {
                    // Limit to 6 products
                    $produk_list = array_slice($data['data'], 0, 6);
                }
            }
        }
        ?>
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-foreground-light dark:text-foreground-dark text-2xl md:text-3xl font-bold leading-tight tracking-[-0.015em] mb-6">
            New Arrivals
            </h2>
            <div class="flex overflow-x-auto space-x-4 md:space-x-6 pb-4 no-scrollbar scroll-smooth scrollable-container cursor-grab active:cursor-grabbing">
                <?php if (!empty($produk_list)): ?>
                    <?php foreach ($produk_list as $produk): ?>
                        <div class="group flex flex-col gap-3 flex-shrink-0 w-[45vw] sm:w-[30vw] md:w-[22vw] lg:w-[20vw]">
                            <div class="relative overflow-hidden rounded-xl">
                                <div class="absolute bottom-2 left-2 z-10 rounded-lg bg-black/50 backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">
                                    <?php echo htmlspecialchars($produk['terjual']); ?> sold
                                </div>
                                <div class="absolute bottom-2 right-2 z-10 rounded-lg <?php echo $produk['in_stok'] == '1' ? 'bg-green-600/50' : 'bg-red-600/50'; ?> backdrop-blur-sm px-2.5 py-1 text-xs font-semibold text-white">
                                    <?php echo $produk['in_stok'] == '1' ? 'In Stock' : 'Out of Stock'; ?>
                                </div>
                                <div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover absolute inset-0 transition-opacity duration-500 ease-in-out group-hover:opacity-0" data-alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" style='background-image: url("images/<?php echo htmlspecialchars($produk['gambar1']); ?>");'>
                                </div>
                                <div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100" data-alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" style='background-image: url("<?php echo !empty($produk['gambar3']) ? 'images/' . htmlspecialchars($produk['gambar3']) : 'images/' . htmlspecialchars($produk['gambar1']); ?>");'>
                                </div>
                            </div>
                            <div>
                                <p class="text-base font-medium leading-normal">
                                    <?php echo htmlspecialchars($produk['nama_produk']); ?>
                                </p>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-normal leading-normal text-primary">
                                        IDR <?php echo number_format((int)$produk['harga_aktif'], 0, ',', '.'); ?>
                                    </p>
                                    <?php if (!empty($produk['harga_coret']) && $produk['harga_coret'] > 0): ?>
                                        <p class="text-sm font-normal leading-normal text-secondary-light dark:text-secondary-dark line-through">
                                            IDR <?php echo number_format((int)$produk['harga_coret'], 0, ',', '.'); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="flex items-center justify-center w-full py-8">
                        <p class="text-secondary-light dark:text-secondary-dark">No products available</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

   <!--  section new arrival -->

  <!--  section shop by category -->
        <?php
        // Fetch kategori data by executing the API script in a separate process
        $kategori_list = [];
        $api_file_path = __DIR__ . '/../api/kategori/list.php';

        if (file_exists($api_file_path)) {
            $command = 'cd ' . escapeshellarg(dirname($api_file_path)) . ' && php ' . escapeshellarg(basename($api_file_path));
            $api_output = shell_exec($command);

            if ($api_output !== null) {
                $data = json_decode($api_output, true);
                if (isset($data['success']) && $data['success'] && isset($data['data'])) {
                    // Filter categories: aktif=1, favorit=1, then sort by id_kategori asc and limit to 3
                    $filtered_categories = array_filter($data['data'], function($kategori) {
                        return $kategori['aktif'] == '1' && $kategori['favorit'] == '1';
                    });
                    
                    // Sort by id_kategori ascending
                    usort($filtered_categories, function($a, $b) {
                        return intval($a['id_kategori']) - intval($b['id_kategori']);
                    });
                    
                    // Limit to 3 categories
                    $kategori_list = array_slice($filtered_categories, 0, 3);
                }
            }
        }
        ?>
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-foreground-light dark:text-foreground-dark text-2xl md:text-3xl font-bold leading-tight tracking-[-0.015em] mb-6">
                Shop by Category
            </h2>

            <div class="grid grid-cols-2 gap-4 md:gap-6 lg:grid-cols-4">
                <?php if (!empty($kategori_list)): ?>
                    <?php foreach ($kategori_list as $kategori): ?>
                        <a class="group relative flex h-80 items-center justify-center overflow-hidden rounded-xl" href="#">
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-105" 
                                data-alt="<?php echo htmlspecialchars($kategori['nama_kategori']); ?>" 
                                style='background-image: url("images/<?php echo !empty($kategori['background_url']) ? htmlspecialchars($kategori['background_url']) : 'kategori.png'; ?>");'>
                            </div>
                            <div class="absolute inset-0 bg-black/30"></div>
                            <h3 class="relative text-2xl font-bold text-white">
                                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                            </h3>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

                <a class="group relative flex h-80 items-center justify-center overflow-hidden rounded-xl bg-surface-light dark:bg-surface-dark" href="#">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h3 class="relative text-2xl font-bold text-foreground-light dark:text-foreground-dark group-hover:text-white transition-colors duration-300">
                        All Category
                    </h3>
                </a>
            </div>
        </section>
       
   <!-- section shop by category -->

    <!-- best seller -->
        <?php
        // Fetch best seller products from the API
        $best_seller_list = [];
        $api_file_path = __DIR__ . '/../api/produk/list.php';

        if (file_exists($api_file_path)) {
            $command = 'cd ' . escapeshellarg(dirname($api_file_path)) . ' && php ' . escapeshellarg(basename($api_file_path));
            $api_output = shell_exec($command);

            if ($api_output !== null) {
                $data = json_decode($api_output, true);
                if (isset($data['success']) && $data['success'] && isset($data['data'])) {
                    // Filter for active products with terjual > 0, sort by terjual (sold count) descending, then limit to 4
                    $active_products = array_filter($data['data'], function($produk) {
                        return $produk['aktif'] == '1' && intval($produk['terjual']) > 0;
                    });
                    // Sort by terjual (sold count) descending
                    usort($active_products, function($a, $b) {
                        return intval($b['terjual']) - intval($a['terjual']);
                    });
                    $best_seller_list = array_slice($active_products, 0, 4);
                }
            }
        }
        ?>
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-foreground-light dark:text-foreground-dark text-2xl md:text-3xl font-bold leading-tight tracking-[-0.015em] mb-6">Best Sellers</h2>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4 md:gap-6">
                <?php if (!empty($best_seller_list)): ?>
                    <?php foreach ($best_seller_list as $produk): ?>
                        <div class="group relative overflow-hidden rounded-xl aspect-[3/4]">
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover absolute inset-0 transition-opacity duration-500 ease-in-out group-hover:opacity-0" data-alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" style='background-image: url("images/<?php echo htmlspecialchars($produk['gambar3']); ?>");'></div>
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100" data-alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" style='background-image: url("images/<?php echo htmlspecialchars($produk['gambar1']); ?>");'></div>
                            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm flex flex-col items-center justify-center p-4 text-center opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <h3 class="text-white text-lg font-bold mb-1"><?php echo htmlspecialchars($produk['nama_produk']); ?></h3>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-primary font-bold">IDR <?php echo number_format((int)$produk['harga_aktif'], 0, ',', '.'); ?></span>
                                    <span class="text-white/60 line-through text-sm">IDR <?php echo number_format((int)$produk['harga_coret'], 0, ',', '.'); ?></span>
                                </div>
                                <div class="flex flex-wrap justify-center gap-2 mb-6">
                                    <span class="bg-white/20 text-white text-xs font-semibold px-2 py-1 rounded"><?php echo htmlspecialchars($produk['terjual']); ?> sold</span>
                                    <span class="bg-<?php echo $produk['jumlah_stok'] > 0 ? 'green' : 'red'; ?>-600/80 text-white text-xs font-semibold px-2 py-1 rounded"><?php echo $produk['jumlah_stok'] > 0 ? 'In Stock' : 'Out of Stock'; ?></span>
                                </div>
                                <div class="flex flex-col gap-2 w-full max-w-[180px]">
                                    <?php if (!empty($produk['shopee_link'])): ?>
                                        <a href="<?php echo htmlspecialchars($produk['shopee_link']); ?>" class="w-full bg-[#ee4d2d] hover:bg-[#d03e1e] text-white text-sm font-bold py-2 rounded transition-colors text-center" target="_blank">Shopee</a>
                                    <?php endif; ?>
                                    <?php if (!empty($produk['tiktok_link'])): ?>
                                        <a href="<?php echo htmlspecialchars($produk['tiktok_link']); ?>" class="w-full bg-black hover:bg-gray-900 border border-white/20 text-white text-sm font-bold py-2 rounded transition-colors text-center" target="_blank">TikTok</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

    <!-- best seller -->

   </main>


   <?php include 'footer.php'; ?>
   <a class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-lg hover:bg-green-600 transition-colors" href="#">
    <svg class="bi bi-whatsapp" fill="currentColor" height="28" viewbox="0 0 16 16" width="28" xmlns="http://www.w3.org/2000/svg">
     <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
     </path>
    </svg>
   </a>
  </div>
  <script src="script/newarrival_touch.js"></script>
 </body>
</html>