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
    <div class="user-data">
        <div v-if="data?.isLoggedIn && data?.user" class="user-info">
            <h2>Welcome, {{ data.user.name }}</h2>
            <div class="user-details">
                <p><strong>Username:</strong> {{ data.user.username }}</p>
                <p><strong>Email:</strong> {{ data.user.email }}</p>
            </div>
        </div>
        <div v-else class="not-logged-in">
            <p>Please log in to view your user information.</p>
        </div>
    </div>
</template>

<style scoped>
.user-data {
    max-width: 600px;
    margin: 2rem auto;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.user-info h2 {
    color: #333;
    margin-bottom: 1rem;
}

.user-details {
    margin-top: 1rem;
}

.user-details p {
    margin: 0.5rem 0;
    color: #666;
}

.not-logged-in {
    text-align: center;
    color: #666;
}
</style> 