<script setup>
/**
 * ConfigurationList Component (BONUS Feature)
 * 
 * Displays all saved configuration pairs.
 * Each configuration shows the origin + destination with a delete button.
 * Supports multiple saved configurations that persist across page reloads.
 */

defineProps({
  configurations: {
    type: Array,
    required: true,
  },
})

defineEmits(['delete'])

/**
 * Get gradient background based on item color
 */
function getIconStyle(color) {
  return {
    background: `linear-gradient(135deg, ${color}15 0%, ${color}30 100%)`,
  }
}
</script>

<template>
  <div class="mt-12 pt-10 border-t border-zenrows-border">
    <div class="space-y-4">
      <div
        v-for="config in configurations"
        :key="config.id"
        class="flex items-center justify-between p-5 bg-white border border-zenrows-border rounded-2xl hover:shadow-card transition-shadow"
      >
        <div class="flex items-center gap-4 flex-1 min-w-0">
          <div class="flex items-center gap-3">
            <div 
              class="w-11 h-11 rounded-xl flex items-center justify-center"
              :style="getIconStyle(config.origin.color)"
            >
              <svg 
                class="w-6 h-6" 
                :style="{ color: config.origin.color }"
                fill="currentColor" 
                viewBox="0 0 24 24"
              >
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
              </svg>
            </div>

            <svg class="w-6 h-6 text-zenrows-selection" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
            </svg>

            <div 
              class="w-11 h-11 rounded-xl flex items-center justify-center"
              :style="getIconStyle(config.destination.color)"
            >
              <svg 
                class="w-6 h-6" 
                :style="{ color: config.destination.color }"
                fill="currentColor" 
                viewBox="0 0 24 24"
              >
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
              </svg>
            </div>
          </div>

          <div class="min-w-0">
            <h4 class="font-semibold text-zenrows-text">
              {{ config.origin.name }} + {{ config.destination.name }}
            </h4>
            <p class="text-sm text-zenrows-text-secondary truncate">
              {{ config.origin.description }}
            </p>
          </div>
        </div>

        <!-- Delete button -->
        <button
          @click="$emit('delete', config.id)"
          class="p-2 text-zenrows-text-secondary hover:text-red-500 hover:bg-red-50 rounded-full transition-colors"
          aria-label="Delete configuration"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

