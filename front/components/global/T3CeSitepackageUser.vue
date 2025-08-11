<script setup lang="ts">
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';

interface T3CePlugin extends T3CeBaseProps {
    data?: {
        isLoggedIn: boolean;
        user?: {
            uid: number;
            username: string;
            email: string;
            name: string;
        };
    }
}

const props = withDefaults(defineProps<T3CePlugin>(), {})
</script>

<template>
    <div class="max-w-xl mx-auto my-8 rounded-lg bg-white p-6 shadow-sm border border-slate-200">
        <div v-if="data?.isLoggedIn && data?.user" class="">
            <h2 class="text-xl font-semibold text-slate-800">Welcome, {{ data.user.name }}</h2>
            <div class="mt-3 space-y-1 text-slate-700">
                <p><span class="font-medium text-slate-600">Username:</span> {{ data.user.username }}</p>
                <p><span class="font-medium text-slate-600">Email:</span> {{ data.user.email }}</p>
            </div>
        </div>
        <div v-else class="text-center text-slate-600">
            <p>Please log in to view your user information.</p>
        </div>
    </div>
</template>

<style scoped>
</style> 