<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
    bodytext: string,
    header: string,
    // assets?: T3File[]
}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})
</script>

<template>
  <h1>Text</h1>
  <p>{{ $attrs }}</p>
  <p>{{ header }}</p>
  <p>{{ bodytext }}</p>
  <h2>{{uid}}</h2>
</template>

<style scoped>

</style>
