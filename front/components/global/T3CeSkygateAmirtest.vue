<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
    // bodytext: string,
    // assets?: T3File[]

    header?: string
    title?: string
    name?: string
    lastname?: string

    /*content: {
        header?: string
        title?: string
        name?: string
        lastname?: string
    }*/

}
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})
console.log("Props A", {props})
// console.log(props.content)
</script>

<template>
    <h1>skygate test 222</h1>
    <span>Fallthrough attributes: {{ $attrs }}</span>
    <h2>{{uid}}</h2>
    <h2>{{header}}</h2>
    <h3>{{title}}</h3>
    <p>{{name}} {{lastname}}</p>
  </template>

<style scoped>

</style>
