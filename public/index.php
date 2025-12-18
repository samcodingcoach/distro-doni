<!DOCTYPE html>
<html class="light" lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   APRIL - Modern Fashion
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
  </style>
  <script id="tailwind-config">
   tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#d41152",
            "background-light": "#f8f6f6",
            "background-dark": "#221016",
            "foreground-light": "#1b0d12",
            "foreground-dark": "#f8f6f6",
            "secondary-light": "#9a4c66",
            "secondary-dark": "#e0b8c6",
            "surface-light": "#f3e7eb",
            "surface-dark": "#3a212a"
          },
          fontFamily: {
            "display": ["Manrope", "sans-serif"]
          },
          borderRadius: {
            "DEFAULT": "0.125rem",
            "lg": "0.25rem",
            "xl": "0.5rem",
            "full": "0.75rem"
          },
        },
      },
    }
  </script>
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
         APRIL
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
   </main>
   <footer class="bg-surface-light dark:bg-surface-dark mt-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
     <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
      <div>
       <h3 class="font-bold mb-4">
        Customer Service
       </h3>
       <ul class="space-y-2 text-sm text-secondary-light dark:text-secondary-dark">
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Contact Us
         </a>
        </li>
        
       </ul>
      </div>
      <div>
       <h3 class="font-bold mb-4">
        About Us
       </h3>
       <ul class="space-y-2 text-sm text-secondary-light dark:text-secondary-dark">
       
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Careers
         </a>
        </li>
        
       </ul>
      </div>
     
      <div>
       <h3 class="font-bold mb-4">
        Follow Us
       </h3>

        <div class="flex space-x-4">
            <!-- Facebook -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="#">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.99 3.66 9.13 8.44 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99C18.34 21.13 22 16.99 22 12z"/>
                </svg>
            </a>

            <!-- Instagram -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="#">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zm-5 3.5A4.5 4.5 0 1 0 16.5 12 4.51 4.51 0 0 0 12 7.5zm0 7.4A2.9 2.9 0 1 1 14.9 12 2.9 2.9 0 0 1 12 14.9zM17.25 6.75a1.05 1.05 0 1 0 0 2.1 1.05 1.05 0 0 0 0-2.1z"/>
                </svg>
            </a>

            <!-- Twitter (X) -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="#">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.46 6c-.77.35-1.6.58-2.46.67.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.22-1.95-.55v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.94.07 4.28 4.28 0 0 0 4 2.98 8.52 8.52 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21c7.34 0 11.36-6.08 11.36-11.36 0-.17 0-.34-.01-.51.78-.57 1.45-1.28 1.99-2.09z"/>
                </svg>
            </a>

            <!-- YouTube -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="#">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.5 6.2s-.23-1.63-.94-2.35c-.9-.94-1.9-.94-2.36-.99C16.9 2.5 12 2.5 12 2.5h-.01s-4.9 0-8.2.36c-.46.05-1.46.05-2.36.99-.71.72-.94 2.35-.94 2.35S0 8.09 0 9.97v1.86c0 1.88.5 3.77.5 3.77s.23 1.63.94 2.35c.9.94 2.08.91 2.61 1.01 1.9.18 8 .36 8 .36s4.9-.01 8.2-.37c.46-.05 1.46-.05 2.36-.99.71-.72.94-2.35.94-2.35s.5-1.89.5-3.77V9.97c0-1.88-.5-3.77-.5-3.77zM9.75 14.68V7.82l6.5 3.43-6.5 3.43z"/>
                </svg>
            </a>
        </div>


      </div>
     </div>
     <div class="mt-8 border-t border-surface-dark/20 dark:border-surface-light/20 pt-8 text-center text-sm text-secondary-light dark:text-secondary-dark">
      <p>
       © 2026 APRIL. All rights reserved.
      </p>
     </div>
    </div>
   </footer>
   <a class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-lg hover:bg-green-600 transition-colors" href="#">
    <svg class="bi bi-whatsapp" fill="currentColor" height="28" viewbox="0 0 16 16" width="28" xmlns="http://www.w3.org/2000/svg">
     <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
     </path>
    </svg>
   </a>
  </div>
 </body>
</html>