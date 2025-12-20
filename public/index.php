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

        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-foreground-light dark:text-foreground-dark text-2xl md:text-3xl font-bold leading-tight tracking-[-0.015em] mb-6">
                Shop by Category
            </h2>

            <div class="grid grid-cols-2 gap-4 md:gap-6 lg:grid-cols-4">
                
                <a class="group relative flex h-80 items-center justify-center overflow-hidden rounded-xl" href="#">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-105" 
                        data-alt="A model wearing an elegant floral dress in a garden." 
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBfM_0NCQFLY1rDJS1m0bIz0-mUKl3x6irtMWdSOZwjhiVM9EEJSOFKghXdeQQ4Z9GcNBsHg-Ez9ZjoPJNg7zMW9tgk8Bw1YvBmedmOoLikKRxV3sbWPEGFeYFS5CDCH1ryJAlk6ko6qPEZudeXjhI03ZtCIP9s4xkrNA5-7X_o6CY0UYo2fQ6t3WyaEQIn9m1C8jccDS6BzpCCI1gQdR-dj_hAhwXbXvTvFL0wWw8ah6-D9SUfqksMod_2ZjnLSszdcAud1KE5wIM");'>
                    </div>
                    <div class="absolute inset-0 bg-black/30"></div>
                    <h3 class="relative text-2xl font-bold text-white">
                        Dresses
                    </h3>
                </a>

                <a class="group relative flex h-80 items-center justify-center overflow-hidden rounded-xl bg-surface-light dark:bg-surface-dark" href="#">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <h3 class="relative text-2xl font-bold text-foreground-light dark:text-foreground-dark group-hover:text-white transition-colors duration-300">
                        All Category
                    </h3>
                </a>
            </div>
        </section>
       
   <!-- section shop by category -->

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