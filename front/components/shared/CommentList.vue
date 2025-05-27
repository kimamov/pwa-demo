<script setup lang="ts">
const props=defineProps<{comments: any[]}>()
</script>

<template>
<ul>
    <li v-for="comment of comments">
        {{comment}}
    </li>
</ul>
</template>

<style scoped>

</style>
