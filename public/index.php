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
          person_outline
         </span>
        </button>
        <button class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-transparent hover:bg-surface-light dark:hover:bg-surface-dark">
         <span class="material-symbols-outlined text-2xl">
          favorite_border
         </span>
        </button>
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
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          FAQ
         </a>
        </li>
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Shipping
         </a>
        </li>
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Returns
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
          Our Story
         </a>
        </li>
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Careers
         </a>
        </li>
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Press
         </a>
        </li>
       </ul>
      </div>
      <div>
       <h3 class="font-bold mb-4">
        Legal
       </h3>
       <ul class="space-y-2 text-sm text-secondary-light dark:text-secondary-dark">
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Terms of Service
         </a>
        </li>
        <li>
         <a class="hover:text-primary transition-colors" href="#">
          Privacy Policy
         </a>
        </li>
       </ul>
      </div>
      <div>
       <h3 class="font-bold mb-4">
        Follow Us
       </h3>
       <div class="flex space-x-4">
        <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="#">
         <svg class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
          <path d="M22.46 6c-.77.35-1.6.58-2.46.67.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.22-1.95-.55v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.94.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21c7.34 0 11.36-6.08 11.36-11.36 0-.17 0-.34-.01-.51.78-.57 1.45-1.28 1.99-2.09z">
          </path>
         </svg>
        </a>
        <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="#">
         <svg class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
          <path clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.477 2.926 8.27 6.953 9.524.508.094.693-.22.693-.488 0-.24-.008-.87-.012-1.708-2.84 1.23-3.44-1.18-3.44-1.18-.462-1.17-1.125-1.48-1.125-1.48-.92-.63.07-.616.07-.616 1.018.07 1.553 1.045 1.553 1.045.904 1.55 2.373 1.102 2.95.842.092-.654.354-1.102.644-1.354-2.25-.256-4.613-1.125-4.613-5.004 0-1.104.394-2.008 1.045-2.716-.104-.256-.453-1.284.1-2.678 0 0 .85-.272 2.784 1.04.808-.224 1.674-.336 2.536-.34.862.004 1.728.116 2.536.34 1.934-1.312 2.782-1.04 2.782-1.04.554 1.394.206 2.422.1 2.678.653.708 1.044 1.612 1.044 2.716 0 3.89-2.367 4.744-4.625 4.996.364.313.69.936.69 1.884 0 1.356-.012 2.45-.012 2.78 0 .27.183.586.698.486C19.078 20.266 22 16.477 22 12c0-5.523-4.477-10-10-10z" fill-rule="evenodd">
          </path>
         </svg>
        </a>
        <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="#">
         <svg class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
          <path clip-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.32 8.25c.01.12.01.24.01.37 0 3.8-2.9 8.18-8.18 8.18-1.62 0-3.13-.47-4.4-1.29.23.03.46.04.69.04 1.35 0 2.58-.46 3.57-1.23-.63-.01-1.17-.43-1.35-1-.09.02-.18.03-.28.03-.13 0-.26-.02-.38-.05.17-.34.66-.98 1.25-1.2-1.35.67-1.35.67-.66-.03-.57-.09-1.05-.33-1.44-.72.04-.63.04-.63.04.47-1.05 1.54-1.65 2.69-1.72-.05-.22-.08-.45-.08-.69 0-1.67 1.35-3.02 3.02-3.02.87 0 1.65.37 2.2.95.69-.14 1.33-.39 1.91-.73-.23.7-.7 1.3-1.32 1.68.61-.07 1.2-.23 1.73-.47-.42.6-.96 1.12-1.59 1.53z" fill-rule="evenodd">
          </path>
         </svg>
        </a>
       </div>
      </div>
     </div>
     <div class="mt-8 border-t border-surface-dark/20 dark:border-surface-light/20 pt-8 text-center text-sm text-secondary-light dark:text-secondary-dark">
      <p>
       © 2024 APRIL. All rights reserved.
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