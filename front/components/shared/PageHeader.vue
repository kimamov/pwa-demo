<template>
    <header class="text-gray-600">
        <div class="container mx-auto flex flex-col flex-wrap items-center p-5 md:flex-row">
            <NuxtLink
                to="/"
                class="mb-4 flex items-center font-medium text-gray-900 md:mb-0"
            >
                <TheLogo />
            </NuxtLink>
            <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto">
                <NuxtLink
                    v-for="{ link, title } in navigation"
                    :key="link"
                    class="mr-5 hover:text-gray-900"
                    :to="link"
                >
                    {{ title }}
                </NuxtLink>
            </nav>
            <T3LocaleSwitcher/>
            <div v-if="userData" class="user-avatar m-4 p-1 border-2">
                USER (logged in)
                <button class="bg-green-200 p-2 rounded" @click="authStore.logout()">
                    click for logout
                </button>

            </div>
        </div>
    </header>
</template>

<script lang="ts" setup>
import {useAuthStore} from "~/stores/authStore";

defineProps<{ navigation: Array<{ link: string; title: string }>, userData: any }>()
const authStore=useAuthStore();
</script>
<style lang="postcss">
.router-link-active, .router-link-exact-active {
    @apply font-bold;
}
</style>
