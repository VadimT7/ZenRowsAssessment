<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch, nextTick } from 'vue'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import OriginList from './components/OriginList.vue'
import DestinationList from './components/DestinationList.vue'
import ConfigurationList from './components/ConfigurationList.vue'
import UrlScraper from './components/UrlScraper.vue'

// API base URL from environment or default to localhost
const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000'

// State management
const origins = ref([])
const destinations = ref([])
const configurations = ref([])
const selectedOrigin = ref(null)
const selectedDestination = ref(null)
const isLoading = ref(true)
const isSaving = ref(false)
const successMessage = ref('')
const errorMessage = ref('')
const selectionAreaRef = ref(null)
const selectionAreaSize = ref({ width: 0, height: 0 })
const connectionPath = ref('')
const connectionAnchors = ref({ start: null, end: null })

const originCardRefs = new Map()
const destinationCardRefs = new Map()

// Computed property to check if save button should be enabled
const canSave = computed(() => {
  return selectedOrigin.value !== null && selectedDestination.value !== null
})

/**
 * Fetch all data from API on component mount
 */
onMounted(async () => {
  window.addEventListener('resize', handleResize)
  await Promise.all([
    fetchOrigins(),
    fetchDestinations(),
    fetchConfigurations()
  ])
  isLoading.value = false
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', handleResize)
})

watch([selectedOrigin, selectedDestination], () => {
  nextTick(updateConnectionPath)
})

/**
 * Fetch origins from API
 */
async function fetchOrigins() {
  try {
    const response = await fetch(`${API_URL}/api/origins`)
    const data = await response.json()
    origins.value = data.data
  } catch (error) {
    console.error('Error fetching origins:', error)
    errorMessage.value = 'Failed to load origins'
  }
}

/**
 * Fetch destinations from API
 */
async function fetchDestinations() {
  try {
    const response = await fetch(`${API_URL}/api/destinations`)
    const data = await response.json()
    destinations.value = data.data
  } catch (error) {
    console.error('Error fetching destinations:', error)
    errorMessage.value = 'Failed to load destinations'
  }
}

/**
 * Fetch saved configurations from API
 */
async function fetchConfigurations() {
  try {
    const response = await fetch(`${API_URL}/api/configurations`)
    const data = await response.json()
    configurations.value = data.data
  } catch (error) {
    console.error('Error fetching configurations:', error)
    errorMessage.value = 'Failed to load configurations'
  }
}

/**
 * Handle origin selection/deselection
 * Click to select, click again to deselect
 */
function handleOriginSelect(origin) {
  if (selectedOrigin.value?.id === origin.id) {
    selectedOrigin.value = null
  } else {
    selectedOrigin.value = origin
  }
  // Clear any previous messages when selection changes
  successMessage.value = ''
  errorMessage.value = ''
}

/**
 * Handle destination selection/deselection
 * Click to select, click again to deselect
 */
function handleDestinationSelect(destination) {
  if (selectedDestination.value?.id === destination.id) {
    selectedDestination.value = null
  } else {
    selectedDestination.value = destination
  }
  // Clear any previous messages when selection changes
  successMessage.value = ''
  errorMessage.value = ''
}

/**
 * Register refs for origin/destination cards to calculate connection line
 */
function registerOriginCard(id, component) {
  if (!component) {
    originCardRefs.delete(id)
    return
  }
  originCardRefs.set(id, component)
  nextTick(updateConnectionPath)
}

function registerDestinationCard(id, component) {
  if (!component) {
    destinationCardRefs.delete(id)
    return
  }
  destinationCardRefs.set(id, component)
  nextTick(updateConnectionPath)
}

/**
 * Save the current configuration pair
 */
async function saveConfiguration() {
  if (!canSave.value || isSaving.value) return

  isSaving.value = true
  errorMessage.value = ''

  try {
    const response = await fetch(`${API_URL}/api/configurations`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        origin_id: selectedOrigin.value.id,
        destination_id: selectedDestination.value.id,
      }),
    })

    const data = await response.json()

    if (response.ok) {
      // Add new configuration to the list
      configurations.value.unshift(data.data)
      successMessage.value = data.message
      // Clear selections after successful save
      selectedOrigin.value = null
      selectedDestination.value = null
    } else {
      errorMessage.value = data.message || 'Failed to save configuration'
    }
  } catch (error) {
    console.error('Error saving configuration:', error)
    errorMessage.value = 'Failed to save configuration'
  } finally {
    isSaving.value = false
  }
}

/**
 * Delete a configuration
 */
async function deleteConfiguration(id) {
  try {
    const response = await fetch(`${API_URL}/api/configurations/${id}`, {
      method: 'DELETE',
    })

    if (response.ok) {
      configurations.value = configurations.value.filter(c => c.id !== id)
    } else {
      const data = await response.json()
      errorMessage.value = data.message || 'Failed to delete configuration'
    }
  } catch (error) {
    console.error('Error deleting configuration:', error)
    errorMessage.value = 'Failed to delete configuration'
  }
}

/**
 * Keep connection line responsive to viewport changes
 */
function handleResize() {
  nextTick(updateConnectionPath)
}

/**
 * Calculate curved path between selected origin + destination
 */
function updateConnectionPath() {
  if (!canSave.value || !selectionAreaRef.value) {
    connectionPath.value = ''
    connectionAnchors.value = { start: null, end: null }
    return
  }

  const originComponent = originCardRefs.get(selectedOrigin.value?.id)
  const destinationComponent = destinationCardRefs.get(selectedDestination.value?.id)
  const areaRect = selectionAreaRef.value?.getBoundingClientRect()

  if (!originComponent || !destinationComponent || !areaRect) {
    connectionPath.value = ''
    connectionAnchors.value = { start: null, end: null }
    return
  }

  const originRect = originComponent.getRect?.()
  const destinationRect = destinationComponent.getRect?.()

  if (!originRect || !destinationRect) {
    connectionPath.value = ''
    connectionAnchors.value = { start: null, end: null }
    return
  }

  selectionAreaSize.value = {
    width: areaRect.width,
    height: areaRect.height,
  }

  const startX = originRect.right - areaRect.left
  const startY = originRect.top - areaRect.top + originRect.height / 2
  const endX = destinationRect.left - areaRect.left
  const endY = destinationRect.top - areaRect.top + destinationRect.height / 2
  const curveOffset = Math.min(180, Math.abs(endX - startX) * 0.6)

  connectionAnchors.value = {
    start: { x: startX, y: startY },
    end: { x: endX, y: endY },
  }

  const arrowOffset = 12
  const verticalDifference = Math.abs(endY - startY)

  if (verticalDifference < 40) {
    const controlOffset = Math.max(20, Math.abs(endX - startX) * 0.2)
    connectionPath.value = [
      `M ${startX} ${startY}`,
      `C ${startX + controlOffset} ${startY}, ${endX - arrowOffset - controlOffset} ${endY}, ${endX - arrowOffset} ${endY}`,
    ].join(' ')
    return
  }

  const cornerRadius = 20
  const midX = (startX + endX) / 2
  const verticalEntry = endY > startY ? 1 : -1

  connectionPath.value = [
    `M ${startX} ${startY}`,
    `H ${midX - cornerRadius}`,
    `Q ${midX} ${startY} ${midX} ${startY + cornerRadius * verticalEntry}`,
    `V ${endY - cornerRadius * verticalEntry}`,
    `Q ${midX} ${endY} ${midX + cornerRadius} ${endY}`,
    `H ${endX - arrowOffset}`,
  ].join(' ')
}
</script>

<template>
  <div class="min-h-screen flex flex-col bg-zenrows-bg">
    <Header />
    
    <main class="flex-1">
      <!-- Loading state -->
      <div v-if="isLoading" class="flex items-center justify-center py-20">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-zenrows-primary"></div>
      </div>

      <!-- Main content -->
      <div v-else class="max-w-6xl mx-auto px-6 py-16">
        <!-- Selection area -->
        <div
          ref="selectionAreaRef"
          class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 relative"
        >
          <!-- Origins column -->
          <OriginList 
            :origins="origins" 
            :selected-origin="selectedOrigin"
            :register-card="registerOriginCard"
            @select="handleOriginSelect"
          />

          <!-- Connection line -->
          <svg
            v-if="connectionPath"
            class="hidden lg:block absolute inset-0 pointer-events-none"
            :width="selectionAreaSize.width"
            :height="selectionAreaSize.height"
            :viewBox="`0 0 ${selectionAreaSize.width} ${selectionAreaSize.height}`"
          >
            <path
              :d="connectionPath"
              stroke="#7D6AF5"
              stroke-width="3"
              stroke-linecap="round"
              fill="none"
            />
            <circle
              v-if="connectionAnchors.start"
              :cx="connectionAnchors.start.x"
              :cy="connectionAnchors.start.y"
              r="5"
              fill="#6B5CFF"
            />
            <g v-if="connectionAnchors.end">
              <polygon
                :points="`${connectionAnchors.end.x} ${connectionAnchors.end.y}, ${connectionAnchors.end.x - 10} ${connectionAnchors.end.y - 6}, ${connectionAnchors.end.x - 10} ${connectionAnchors.end.y + 6}`"
                fill="#6B5CFF"
                stroke="#6B5CFF"
                stroke-linejoin="round"
              />
            </g>
          </svg>

          <!-- Destinations column -->
          <DestinationList 
            :destinations="destinations" 
            :selected-destination="selectedDestination"
            :register-card="registerDestinationCard"
            @select="handleDestinationSelect"
          />
        </div>

        <!-- Save button -->
        <div class="flex justify-center mt-10">
          <button
            @click="saveConfiguration"
            :disabled="!canSave || isSaving"
            :class="[
              'px-10 py-3.5 rounded-xl font-semibold text-white transition-all duration-200 shadow-md',
              canSave && !isSaving
                ? 'bg-zenrows-primary hover:bg-zenrows-primary-dark cursor-pointer'
                : 'bg-zenrows-primary-disabled opacity-70 cursor-not-allowed'
            ]"
          >
            <span v-if="isSaving">Saving...</span>
            <span v-else>Save combination</span>
          </button>
        </div>

        <!-- Success message -->
        <div 
          v-if="successMessage" 
          class="mt-6 max-w-md mx-auto"
        >
          <div class="bg-zenrows-success-light border border-zenrows-success text-zenrows-success px-5 py-3 rounded-xl text-center success-message">
            {{ successMessage }}
          </div>
        </div>

        <!-- Error message -->
        <div 
          v-if="errorMessage" 
          class="mt-6 max-w-md mx-auto"
        >
          <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-center">
            {{ errorMessage }}
          </div>
        </div>

        <!-- Saved configurations list (BONUS feature) -->
        <ConfigurationList 
          v-if="configurations.length > 0"
          :configurations="configurations"
          @delete="deleteConfiguration"
        />
      </div>

      <!-- URL Scraper section -->
      <UrlScraper />
    </main>

    <Footer />
  </div>
</template>

