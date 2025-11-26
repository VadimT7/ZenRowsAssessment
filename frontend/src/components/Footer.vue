<script setup>
// Footer component matching the design
// Dark background with company info, status, and social links
</script>

<template>
  <footer class="bg-zenrows-dark text-white">
    <div class="max-w-7xl mx-auto px-6 py-10">
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <!-- Company info -->
        <div class="max-w-sm">
          <div class="flex items-center gap-2 mb-3">
            <div class="w-5 h-5 bg-gray-600 rounded-full"></div>
            <span class="font-medium">navlogo</span>
          </div>
          <p class="text-sm text-gray-400 leading-relaxed">
            Web scraping API handles all anti-bot bypass for you with rotating proxies, headless browsers and more.
          </p>
        </div>
        
        <!-- Review badges -->
        <div class="flex items-center gap-6">
          <div class="text-center">
            <div class="flex items-center gap-1 mb-1">
              <span class="text-sm font-medium text-blue-400">✓</span>
              <span class="text-sm font-medium">Capterra</span>
            </div>
            <div class="flex gap-0.5">
              <span class="text-yellow-400 text-sm">★★★★★</span>
            </div>
          </div>
          <div class="text-center">
            <div class="flex items-center gap-1 mb-1">
              <span class="text-sm font-medium text-orange-400">G</span>
              <span class="text-sm font-medium">G2</span>
            </div>
            <div class="flex gap-0.5">
              <span class="text-yellow-400 text-sm">★★★★★</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bottom bar -->
    <div class="border-t border-gray-800">
      <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
          <span class="w-2 h-2 bg-green-500 rounded-full"></span>
          <span class="text-sm text-gray-400">All services are online</span>
        </div>
        <p class="text-sm text-gray-500">© 2024 Navlogo. All rights reserved.</p>
        <div class="flex items-center gap-4">
          <a href="#" class="text-gray-400 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

