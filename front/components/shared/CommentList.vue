<script setup lang="ts">
const props=defineProps<{comments: any[]}>()
</script>

<template>
<ul class="space-y-2">
    <li v-for="comment of comments" class="rounded border border-slate-200 bg-white px-3 py-2 text-slate-700 shadow-sm">
        {{comment}}
    </li>
</ul>
</template>

<style scoped>

</style>
