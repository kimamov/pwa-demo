<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-700 flex flex-col items-center justify-center p-4 font-sans">
    <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-xl p-6 sm:p-10 text-center w-full max-w-lg transform transition-all duration-500 ease-out hover:scale-105">
      <div class="mb-6">
        <img
            :src="panda"
            alt="A funny raccoon"
            class="w-40 h-40 sm:w-48 sm:h-48 mx-auto rounded-full object-cover border-4 border-slate-300 shadow-lg"
        />
      </div>

      <h1 class="text-5xl sm:text-7xl font-bold text-sky-500 mb-3">
        {{ error.statusCode }}
      </h1>

      <p class="text-xl sm:text-2xl text-slate-700 mb-2 font-semibold">
        {{ friendlyErrorMessage }}
      </p>
      <p v-if="error.message && error.message !== friendlyErrorMessage" class="text-sm text-slate-500 mb-8">
        ({{ error.message }})
      </p>
      <p v-else class="mb-8"></p> <div class="flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4">
      <button
          @click="handleGoHome"
          class="w-full sm:w-auto px-8 py-3 bg-sky-500 text-white font-semibold rounded-lg shadow-md hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-opacity-75 transition-all duration-300 ease-in-out transform hover:scale-105"
      >
        Go to Homepage
      </button>
      <button
          @click="handleGoToLogin"
          class="w-full sm:w-auto px-8 py-3 bg-emerald-500 text-white font-semibold rounded-lg shadow-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-opacity-75 transition-all duration-300 ease-in-out transform hover:scale-105"
      >
        Go to Login
      </button>
    </div>

      <!--
      <div v-if="userId" class="mt-6 text-xs text-slate-400">
        User ID: {{ userId }}
      </div>
      -->
    </div>
    <footer class="mt-8 text-center text-sm text-slate-400">
      If the issue persists, please try again later or contact support.
    </footer>
  </div>
</template>

<script setup lang="ts">
import { defineProps, computed} from 'vue';
import panda from "./images/panda.jpg";

import type { NuxtError } from '#app'

const props = defineProps({
  error: Object as () => NuxtError
})

// URL for the funny raccoon image - REPLACE THIS with your actual image URL

// Function to handle image loading errors

// Provides a more user-friendly message for common errors
const friendlyErrorMessage = computed(() => {
  switch (props.error.statusCode) {
    case 404:
      return "Oops! Page Not Found";
    case 500:
      return "Oops! Something went wrong on our end.";
    case 403:
      return "Oops! You don't have permission to see this.";
    case 401:
      return "Oops! You need to be logged in for this.";
    default:
      return "An unexpected error occurred.";
  }
});

// Nuxt utility to clear the error and redirect
// In Nuxt 3, clearError is auto-imported.
// import { clearError } from '#app'; // Not strictly needed if auto-imported

const handleGoHome = () => {
  clearError({ redirect: '/' });
};

const handleGoToLogin = () => {
  clearError({ redirect: '/login' });
};

// Example of how you might get a userId if needed for context (e.g., from a store or auth)
// const userId = ref<string | null>(null);
// onMounted(() => {
//   // Replace with your actual logic to get user ID
//   // For example, if using Pinia:
//   // const authStore = useAuthStore();
//   // userId.value = authStore.userId;
// });

</script>
