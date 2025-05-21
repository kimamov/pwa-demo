<script setup lang="ts">
import {useAuthStore} from "~/stores/authStore";

const { initialData } = useT3Api()
const navigation = computed(() => {
    return initialData.value?.navigation?.[0].children
})

const authStore=useAuthStore();


</script>

<template>
    <div>
        <header v-if="navigation">
            <nav>
                <NuxtLink
                    v-for="{ link, title } in navigation"
                    :key="link"
                    :to="link"
                >
                    {{ title }}
                </NuxtLink>
                <h4 v-if="authStore.loggedIn">logged in</h4>
            </nav>
        </header>
        <slot />
    </div>
</template>

<style scoped>

</style>
