<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
    // bodytext: string,
    // assets?: T3File[]
    header?: string
    title?: string
}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})
console.log({props})
</script>

<template>
    <h1>skygate test</h1>
    <h2>{{uid}}</h2>
    <h2>{{header}}</h2>
    <h3>{{title}}</h3>
</template>

<style scoped>

</style>
