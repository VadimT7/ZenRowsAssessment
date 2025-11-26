<script setup>
// Footer component matching the design
// Dark background with company info, status, and social links
</script>

<template>
  <footer class="bg-zenrows-footer text-white mt-16">
    <div class="max-w-6xl mx-auto px-6 py-12">
      <div class="flex flex-col md:flex-row justify-between gap-10">
        <div class="space-y-4 max-w-md">
          <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-full bg-gradient-to-br from-zenrows-primary to-zenrows-selection"></div>
            <span class="font-semibold text-white">navlogo</span>
          </div>
          <p class="text-sm text-gray-400 leading-relaxed">
            Web scraping API handles all anti-bot bypass for you with rotating proxies, headless browsers and more.
          </p>
        </div>
        <div class="flex items-center gap-16 text-left">
          <div class="flex flex-col items-start text-left">
            <div class="flex items-center gap-1 mb-1">
              <img src="/capterra_logo.png" alt="Capterra logo" class="w-4 object-contain" />
              <span class="text-[0.55rem] font-semibold text-white leading-none">Capterra</span>
            </div>
            <p class="text-yellow-400 text-sm tracking-[0.5em] leading-none">★★★★★</p>
          </div>
          <div class="flex flex-col items-start text-left">
            <div class="flex items-center gap-1 mb-1">
              <img src="/g2_logo.png" alt="G2 logo" class="w-4 object-contain" />
              <span class="text-[0.55rem] font-semibold text-white leading-none">G2</span>
            </div>
            <p class="text-red-400 text-sm tracking-[0.5em] leading-none">★★★★★</p>
          </div>
        </div>
      </div>
    </div>

    <div class="border-t border-white/5">
      <div class="max-w-6xl mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-400">
        <div class="flex items-center gap-2">
          <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
          All services are online
        </div>
        <p>© 2024 Navlogo. All rights reserved.</p>
        <div class="flex items-center gap-4 text-gray-500">
          <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" aria-label="X (Twitter)">
            <svg class="w-5 h-5" viewBox="0 0 1200 1227" xmlns="http://www.w3.org/2000/svg">
              <path fill="currentColor" d="M714.2 519.8 1160.9 0H1027L671.8 410.6 390.4 0H0l468.4 669.6L0 1226.9h133.9l380.3-430.7 301.1 430.7H1200L714.2 519.8Zm-134.3 151-44-62.3-350.5-497h150.8l283 401.4 44 62.3 370.5 525.4h-150.8L579.9 670.8Z"/>
            </svg>
          </a>
          <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" aria-label="LinkedIn">
            <svg class="w-5 h-5" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path fill="currentColor" d="M100.3 448H7.4V148.9h92.9V448zM53.8 108.1C24.1 108.1 0 83.5 0 54.2A53.8 53.8 0 0 1 107.6 54.2c0 29.3-24.1 53.9-53.8 53.9zM447.9 448h-92.7V302.4c0-34.7-.7-79.3-48.3-79.3-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

