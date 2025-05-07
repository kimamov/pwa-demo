<script setup lang="ts">
import type { T3CeBaseProps, T3File } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
    // bodytext: string,
    // assets?: T3File[]
    content?: any,
    type?: any,
    data?: any
}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})

const form=computed(()=>props?.data?.form)
</script>

<template>
   <h1>FE LOGIN PLACEHOLDER</h1>
    <FormKit v-if="form && form.elements?.length" type="form">
        <FormKit v-for="element of form.elements" :type="element.type" :value="element.value" :name="element.name" :label="element.label"></FormKit>
    </FormKit>
  <h2>{{uid}}</h2>
    <pre>
    {{data}}
    </pre>
</template>

<style scoped>

</style>
