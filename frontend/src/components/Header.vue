<script setup>
// Header component for the navigation bar
// Matches the design with logo, navigation links, and CTA button
</script>

<template>
  <header class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-8">
        <div class="flex items-center gap-2">
          <div class="w-6 h-6 bg-zenrows-green rounded-full"></div>
          <span class="font-semibold text-gray-900">navlogo</span>
        </div>
        
        <!-- Navigation -->
        <nav class="hidden md:flex items-center gap-6">
          <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Products</a>
          <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Pricing</a>
          <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Docs</a>
          <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Blog</a>
        </nav>
      </div>
      
      <!-- Actions -->
      <div class="flex items-center gap-4">
        <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Sign In</a>
        <button class="bg-zenrows-green hover:bg-zenrows-green-hover text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
          Start Free Trial
        </button>
      </div>
    </div>
  </header>
</template>

