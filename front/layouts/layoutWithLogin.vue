<script setup lang="ts">
import {useAuthStore} from "~/stores/authStore";

import PageHeader from "~/components/shared/PageHeader.vue";

const { initialData } = useT3Api()
const navigation = computed(() => {
    return initialData.value?.navigation?.[0].children
})

console.log(navigation.value)
const authStore=useAuthStore();


</script>

<template>
    <div class="page min-h-screen bg-slate-50 text-slate-800 flex flex-col" :class="{'page--is-logged-in': authStore.loggedIn}">
        <PageHeader
            v-if="navigation"
            :navigation="navigation"
            :userData="authStore.user"
        />
        <slot />

        <footer class="mt-12 border-t bg-white py-8 text-center text-sm text-slate-500">
            <h2 class="text-base font-medium text-slate-700">footer placeholder login</h2>
        </footer>
    </div>
</template>

<style scoped>

</style>
