<script setup lang="ts">
import type { NuxtError } from '#app'

const props = defineProps({
  error: Object as () => NuxtError
})

const handleError = () => clearError({ redirect: '/' })
</script>

<template>
<h1>An Error occurred</h1>
  <h2>{{error.message}}</h2>
  <h2>{{error.statusMessage}}</h2>
  <h3>{{error.statusCode}}</h3>
  <button @click="handleError" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Clear errors and go to homepage</button>
</template>

<style scoped>

</style>