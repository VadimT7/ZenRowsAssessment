<script setup>
/**
 * UrlScraper Component
 * 
 * Decorative section matching the design.
 * Shows the "Didn't see your target website?" call-to-action.
 * This is a UI-only component for design matching purposes.
 */
import { ref } from 'vue'

const url = ref('https://www.amazon.com/b/ref=dp_bc_aui_C_4?ie=UTF8')
</script>

<template>
  <section class="bg-gray-50 py-16">
    <div class="max-w-2xl mx-auto px-6 text-center">
      <h2 class="text-2xl md:text-3xl font-bold text-zenrows-text mb-3" style="font-family: Georgia, serif; font-style: italic;">
        Didn't see your target website?
      </h2>
      <p class="text-zenrows-text-secondary mb-8">
        We can scrape any website on the internet. Try it out for free!
      </p>

      <div class="max-w-lg mx-auto">
        <label class="block text-left text-sm text-zenrows-text-secondary mb-2">
          URL to Scrape
        </label>
        <div class="flex gap-3">
          <div class="flex-1 relative">
            <input
              v-model="url"
              type="text"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-zenrows-green focus:border-transparent text-sm"
              placeholder="https://example.com"
            />
            <!-- Highlight "amazon.com" in the URL -->
            <div class="absolute inset-0 pointer-events-none px-4 py-3 text-sm overflow-hidden">
              <span class="invisible">https://www.</span>
              <span class="text-zenrows-green font-medium invisible">amazon.com</span>
            </div>
          </div>
          <button class="bg-zenrows-green hover:bg-zenrows-green-hover text-white font-medium px-6 py-3 rounded-lg transition-colors whitespace-nowrap">
            Scrape URL
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

