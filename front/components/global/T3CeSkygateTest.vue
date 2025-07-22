<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
    header?: string
    title?: string
}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
  header: 'header fallback',
  title: 'title fallback'
})
</script>

<template>
    <h2>{{uid}}</h2>
    <h2>{{header}}</h2>
    <h3>{{title}}</h3>
</template>

