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
  registerCard: {
    type: Function,
    default: () => {},
  },
})

defineEmits(['select'])
</script>

<template>
  <div>
    <h2 class="text-sm font-semibold uppercase tracking-widest text-zenrows-text-secondary mb-3">Origins</h2>
    
    <div class="space-y-3">
      <SelectionCard
        v-for="origin in origins"
        :key="origin.id"
        :item="origin"
        :is-selected="selectedOrigin?.id === origin.id"
        :ref="el => registerCard(origin.id, el)"
        @select="$emit('select', $event)"
      />
    </div>
  </div>
</template>

