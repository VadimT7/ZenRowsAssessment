<script setup>
import { ref, computed, onMounted } from 'vue'
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

// Computed property to check if save button should be enabled
const canSave = computed(() => {
  return selectedOrigin.value !== null && selectedDestination.value !== null
})

/**
 * Fetch all data from API on component mount
 */
onMounted(async () => {
  await Promise.all([
    fetchOrigins(),
    fetchDestinations(),
    fetchConfigurations()
  ])
  isLoading.value = false
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
</script>

<template>
  <div class="min-h-screen flex flex-col bg-white">
    <Header />
    
    <main class="flex-1">
      <!-- Loading state -->
      <div v-if="isLoading" class="flex items-center justify-center py-20">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-zenrows-green"></div>
      </div>

      <!-- Main content -->
      <div v-else class="max-w-6xl mx-auto px-6 py-12">
        <!-- Selection area -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 relative">
          <!-- Origins column -->
          <OriginList 
            :origins="origins" 
            :selected-origin="selectedOrigin"
            @select="handleOriginSelect"
          />

          <!-- Connection line SVG - shown when both are selected -->
          <svg 
            v-if="selectedOrigin && selectedDestination"
            class="hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-16 h-2 pointer-events-none"
            viewBox="0 0 64 8"
          >
            <line 
              x1="0" 
              y1="4" 
              x2="64" 
              y2="4" 
              stroke="#818CF8" 
              stroke-width="2"
              stroke-dasharray="4 4"
              class="connection-line"
            />
          </svg>

          <!-- Destinations column -->
          <DestinationList 
            :destinations="destinations" 
            :selected-destination="selectedDestination"
            @select="handleDestinationSelect"
          />
        </div>

        <!-- Save button -->
        <div class="flex justify-center mt-10">
          <button
            @click="saveConfiguration"
            :disabled="!canSave || isSaving"
            :class="[
              'px-8 py-3 rounded-lg font-semibold text-white transition-all duration-200',
              canSave && !isSaving
                ? 'bg-zenrows-green hover:bg-zenrows-green-hover btn-save-active cursor-pointer'
                : 'bg-zenrows-disabled cursor-not-allowed'
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
          <div class="bg-zenrows-green-light border border-zenrows-green text-zenrows-green px-4 py-3 rounded-lg text-center success-message">
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

