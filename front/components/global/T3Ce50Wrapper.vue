<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';
import { elements } from '../../../public/_assets/37ee5ba7a97ad859ac99cb8181e0c0e3/JavaScript/Contrib/chartjs';
// import type T3ContentElement from '@t3headless/nuxt-typo3/runtime/components/T3ContentElement.vue';

interface T3Ce2ColContainer extends T3CeBaseProps {
    // bodytext: string,
    // assets?: T3File[]
    left?: T3CeBaseProps[]
    right?: T3CeBaseProps[]
}
const props = withDefaults(defineProps<T3Ce2ColContainer>(), {
    // bodytext: ''
})
</script>

<template>

  
<h1>test</h1>
  <h2>{{uid}}</h2>
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3>Left</h3>
        <template v-for="element of left">
          <component  :is="useT3DynamicCe(element.type)" v-bind="element.content"/>
        </template>
      </div>
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3>Right</h3>
        <template v-for="element of right">
          <component  :is="useT3DynamicCe(element.type)" v-bind="element.content"/>
        </template>
      </div>
    </div>
  </div>
</template>

