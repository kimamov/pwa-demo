<script setup lang="ts">
import type { T3CeBaseProps, T3File } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
    // bodytext: string,
    // assets?: T3File[]
    content: any,
    type: any,
    data: any
}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})
</script>

<template>
   <h1>FE LOGIN PLACEHOLDER</h1>
  <h2>{{uid}}</h2>
    <pre>
    {{data}}
    </pre>
</template>

<style scoped>

</style>
