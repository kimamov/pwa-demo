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
    <div class="page" :class="{'page--is-logged-in': authStore.loggedIn}">
        <PageHeader
            v-if="navigation"
            :navigation="navigation"
            :userData="authStore.user"
        />
        <slot />

        <footer>
            <h2>footer placeholder</h2>
        </footer>
    </div>
</template>

<style scoped>

</style>
