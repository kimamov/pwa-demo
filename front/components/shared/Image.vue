<script setup lang="ts">
const props=defineProps<{
  image: {
    publicUrl: string
  }
}>()
</script>

<template>
<div class="img-wrapper">
  <img :src="image.publicUrl" alt="">
</div>
</template>

<style scoped>
 .img-wrapper{
   overflow: hidden;
   border: 2px solid grey;
   border-radius: 4px;
 }
 img{
   display: block;
   width: 100%;
 }
</style>