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
?>

<footer class="bg-surface-light dark:bg-surface-dark mt-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
     <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
      <div>
        <h3 class="font-bold mb-4">
          Customer Service
        </h3>
        <ul class="space-y-2 text-sm text-secondary-light dark:text-secondary-dark">
          <li>
          <a class="hover:text-primary transition-colors" href="<?php echo $distro ? 'mailto:' . $distro['email'] : '#'; ?>">
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
        <!-- ganti dengan footer.php -->
        <div class="flex space-x-4">
            <!-- Facebook -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="<?php echo $distro ? 'https://www.facebook.com/' . $distro['fb'] : '#'; ?>">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.99 3.66 9.13 8.44 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99C18.34 21.13 22 16.99 22 12z"/>
                </svg>
            </a>

            <!-- Instagram -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="<?php echo $distro ? 'https://www.instagram.com/' . $distro['ig'] . '/' : '#'; ?>">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zm-5 3.5A4.5 4.5 0 1 0 16.5 12 4.51 4.51 0 0 0 12 7.5zm0 7.4A2.9 2.9 0 1 1 14.9 12 2.9 2.9 0 0 1 12 14.9zM17.25 6.75a1.05 1.05 0 1 0 0 2.1 1.05 1.05 0 0 0 0-2.1z"/>
                </svg>
            </a>

            <!-- Twitter (X) -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="<?php echo $distro ? 'https://twitter.com/' . $distro['twitter'] : '#'; ?>">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22.46 6c-.77.35-1.6.58-2.46.67.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.22-1.95-.55v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.94.07 4.28 4.28 0 0 0 4 2.98 8.52 8.52 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21c7.34 0 11.36-6.08 11.36-11.36 0-.17 0-.34-.01-.51.78-.57 1.45-1.28 1.99-2.09z"/>
                </svg>
            </a>

            <!-- YouTube -->
            <a class="text-secondary-light dark:text-secondary-dark hover:text-primary transition-colors" href="<?php echo $distro ? 'https://www.youtube.com/@' . $distro['youtube'] : '#'; ?>">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.5 6.2s-.23-1.63-.94-2.35c-.9-.94-1.9-.94-2.36-.99C16.9 2.5 12 2.5 12 2.5h-.01s-4.9 0-8.2.36c-.46.05-1.46.05-2.36.99-.71.72-.94 2.35-.94 2.35S0 8.09 0 9.97v1.86c0 1.88.5 3.77.5 3.77s.23 1.63.94 2.35c.9.94 2.08.91 2.61 1.01 1.9.18 8 .36 8 .36s4.9-.01 8.2-.37c.46-.05 1.46-.05 2.36-.99.71-.72.94-2.35.94-2.35s.5-1.89.5-3.77V9.97c0-1.88-.5-3.77-.5-3.77zM9.75 14.68V7.82l6.5 3.43-6.5 3.43z"/>
                </svg>
            </a>
        </div>
        <!-- ganti dengan footer.php -->

      </div>
     </div>
     <div class="mt-8 border-t border-surface-dark/20 dark:border-surface-light/20 pt-8 text-center text-sm text-secondary-light dark:text-secondary-dark">
      <p>
       © <?php echo date('Y') . ' ' . ($distro ? $distro['nama_distro'] : 'APRIL'); ?>. All rights reserved.
      </p>
     </div>
    </div>
   </footer>