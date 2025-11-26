<script setup>
/**
 * DestinationList Component
 * 
 * Displays the list of available destinations (data export targets).
 * Only one destination can be selected at a time.
 * Selection state is managed by parent component.
 */
import SelectionCard from './SelectionCard.vue'

defineProps({
  destinations: {
    type: Array,
    required: true,
  },
  selectedDestination: {
    type: Object,
    default: null,
  },
})

defineEmits(['select'])
</script>

<template>
  <div>
    <h2 class="text-lg font-semibold text-zenrows-text mb-4">Destinations</h2>
    
    <div class="space-y-3">
      <SelectionCard
        v-for="destination in destinations"
        :key="destination.id"
        :item="destination"
        :is-selected="selectedDestination?.id === destination.id"
        @select="$emit('select', $event)"
      />
    </div>
  </div>
</template>

