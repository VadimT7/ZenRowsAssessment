<script setup>
// Header component for the navigation bar
// Matches the design with logo, navigation links, and CTA button
</script>

<template>
  <header class="bg-zenrows-bg border-b border-zenrows-border">
    <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-8">
        <div class="flex items-center gap-2">
          <div class="w-6 h-6 rounded-full bg-gradient-to-br from-zenrows-primary to-zenrows-selection"></div>
          <span class="font-semibold text-zenrows-text">navlogo</span>
        </div>
        
        <!-- Navigation -->
        <nav class="hidden md:flex items-center gap-6 text-sm text-zenrows-text-secondary">
          <a href="#" class="hover:text-zenrows-text transition-colors">Products</a>
          <a href="#" class="hover:text-zenrows-text transition-colors">Pricing</a>
          <a href="#" class="hover:text-zenrows-text transition-colors">Docs</a>
          <a href="#" class="hover:text-zenrows-text transition-colors">Blog</a>
        </nav>
      </div>
      
      <!-- Actions -->
      <div class="flex items-center gap-4">
        <a href="#" class="text-sm text-zenrows-text-secondary hover:text-zenrows-text transition-colors">Sign In</a>
        <button class="bg-zenrows-primary hover:bg-zenrows-primary-dark text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors shadow-card">
          Start Free Trial
        </button>
      </div>
    </div>
  </header>
</template>

