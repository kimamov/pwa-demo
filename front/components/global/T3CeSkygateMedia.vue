<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';
import Image from "~/components/shared/Image.vue";

interface T3CeImageWithDescription extends T3CeBaseProps {
    header?: string
    images?: {
      publicUrl: string
    }[]
}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
})
</script>

<template>
    <h2>{{uid}}</h2>
  <h2>{{header}}</h2>

  <Image v-if="images" v-for="image of images" :image="image"/>
</template>

