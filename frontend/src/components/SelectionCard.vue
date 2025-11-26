<script setup>
/**
 * SelectionCard Component
 * 
 * Reusable card component for displaying an origin or destination option.
 * Handles selection state with visual feedback (border highlight, shadow).
 * Click to select, click again to deselect.
 */

defineProps({
  item: {
    type: Object,
    required: true,
  },
  isSelected: {
    type: Boolean,
    default: false,
  },
})

defineEmits(['select'])

/**
 * Get gradient background based on item color
 * Creates a subtle gradient effect for the icon background
 */
function getIconStyle(color) {
  return {
    background: `linear-gradient(135deg, ${color}15 0%, ${color}30 100%)`,
  }
}
</script>

<template>
  <div
    @click="$emit('select', item)"
    :class="[
      'selection-card relative p-4 rounded-xl border-2 cursor-pointer transition-all duration-200',
      isSelected
        ? 'border-zenrows-selection shadow-selection bg-zenrows-selection-light/30'
        : 'border-zenrows-card-border hover:border-gray-300 hover:shadow-card bg-white'
    ]"
  >
    <div class="flex items-start gap-4">
      <!-- Icon -->
      <div 
        class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
        :style="getIconStyle(item.color)"
      >
        <!-- Dynamic icon based on item type -->
        <svg 
          class="w-6 h-6" 
          :style="{ color: item.color }"
          fill="currentColor" 
          viewBox="0 0 24 24"
        >
          <!-- Generic icon - in production, would use specific brand icons -->
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
        </svg>
      </div>

      <!-- Content -->
      <div class="flex-1 min-w-0">
        <h3 class="font-semibold text-zenrows-text text-base">
          {{ item.name }}
        </h3>
        <p class="text-sm text-zenrows-text-secondary mt-1 leading-relaxed">
          {{ item.description }}
        </p>
      </div>
    </div>

    <!-- Selection indicator (optional visual cue) -->
    <div 
      v-if="isSelected"
      class="absolute top-2 right-2 w-2 h-2 bg-zenrows-selection rounded-full"
    ></div>
  </div>
</template>

