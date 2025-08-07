<template>
    <NuxtLayout :name="layoutName">
        <NuxtPage />
    </NuxtLayout>
</template>

<script setup lang="ts">


const route = useRoute()
console.log('ROUTE: ', route.path);

const layoutName = computed(() =>
    route.path.startsWith('/login')
        ? 'layout-with-login'
        : 'default'
)


/*
const route = useRoute();

definePageMeta({
  layout: route.path.startsWith('/admin') ? 'admin' : 'default'
});
* */

</script>

<style scoped>
header a {
  display: inline-block;
  margin-right: 10px;
}
</style>
