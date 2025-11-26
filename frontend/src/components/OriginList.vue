<script setup>
/**
 * OriginList Component
 * 
 * Displays the list of available origins (scraping sources).
 * Only one origin can be selected at a time.
 * Selection state is managed by parent component.
 */
import SelectionCard from './SelectionCard.vue'

defineProps({
  origins: {
    type: Array,
    required: true,
  },
  selectedOrigin: {
    type: Object,
    default: null,
  },
})

defineEmits(['select'])
</script>

<template>
  <div>
    <h2 class="text-lg font-semibold text-zenrows-text mb-4">Origins</h2>
    
    <div class="space-y-3">
      <SelectionCard
        v-for="origin in origins"
        :key="origin.id"
        :item="origin"
        :is-selected="selectedOrigin?.id === origin.id"
        @select="$emit('select', $event)"
      />
    </div>
  </div>
</template>

