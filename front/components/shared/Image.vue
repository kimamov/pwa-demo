<script setup lang="ts">
const props=defineProps<{
  image: {
    publicUrl: string
  }
}>()
</script>

<template>
<div class="overflow-hidden rounded-lg border border-slate-200 shadow-sm bg-white">
  <img :src="image.publicUrl" alt="" class="block w-full object-cover">
  
</div>
</template>

<style scoped>
</style>