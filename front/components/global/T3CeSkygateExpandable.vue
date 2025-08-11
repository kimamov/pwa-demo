<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
  // bodytext: string,
  // assets?: T3File[]
  header?: string
  title?: string
  textarea?: string
  image?: Record<string, unknown>[]
  toggle?: number

}

const currentImage = computed(() => {
  if (props.toggle === 1 && props.image?.[1]?.publicUrl) {
    return props.image?.[1]
  }
  return props.image?.[0]
})

const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})
console.log("Props A", {props})
</script>

<template>
  <details class="group max-w-3xl rounded-lg overflow-hidden border border-slate-200 bg-white shadow-sm" open>
    <summary class="flex w-full items-center justify-between bg-slate-800 text-white px-4 py-3 cursor-pointer">
      <h3 class="text-lg font-medium">{{ title }}</h3>
    </summary>
    <div class="flex flex-col gap-3 bg-slate-50 px-4 py-4" role="region">
      <div v-if="textarea" class="prose prose-slate max-w-none" v-html="textarea"></div>
      <div v-if="currentImage?.publicUrl">
        <img :src="currentImage.publicUrl" :alt="currentImage.title || 'Bild'" class="rounded-md shadow-sm" />
      </div>
    </div>
  </details>
</template>

<style scoped>
</style>
