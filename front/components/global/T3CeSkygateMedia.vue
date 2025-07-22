<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
    header?: string
    image?: string
}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
})
</script>

<template>
    <h2>{{uid}}</h2>
  <h2>{{header}}</h2>
  <img v-if="image" v-for="data of image" :src="data.publicUrl" alt="">
</template>

