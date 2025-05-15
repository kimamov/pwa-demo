<script setup lang="ts">
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';

interface T3CePlugin extends T3CeBaseProps {
    data?: Array
}

const props = withDefaults(defineProps<T3CePlugin>(), {})
console.log({props})
</script>

<template>
    <h1>skygate test</h1>
    <h2>{{ uid }}</h2>
    <h2>{{ header }}</h2>
    <h3>{{ data.test }}</h3>
</template>

<style scoped>

</style>
