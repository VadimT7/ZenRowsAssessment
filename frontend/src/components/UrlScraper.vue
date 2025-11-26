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
  <section class="bg-white py-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <p class="text-3xl md:text-4xl font-serif font-semibold text-zenrows-text mb-4">
        Didn't see your target website?
      </p>
      <p class="text-base text-zenrows-text-secondary mb-12">
        We can scrape any website on the internet. Try it out for free!
      </p>

      <div class="max-w-3xl mx-auto text-left">
        <p class="text-xs font-semibold tracking-[0.3em] uppercase text-zenrows-text-secondary mb-3">
          URL to Scrape
        </p>
        <div class="flex flex-col md:flex-row items-stretch gap-4">
          <div class="url-gradient-border flex-1">
            <div class="bg-white rounded-[12px] px-4 py-3 md:py-4">
              <input
                v-model="url"
                type="text"
                class="w-full border-none outline-none text-[15px] font-medium text-[#6B5CFF] placeholder:text-zenrows-text-secondary/60"
                placeholder="https://example.com"
              />
            </div>
          </div>
          <button class="md:self-stretch bg-zenrows-primary hover:bg-zenrows-primary-dark text-white font-semibold px-10 py-3 rounded-xl transition-colors whitespace-nowrap shadow-card">
            Scrape URL
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

