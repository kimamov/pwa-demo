<template>
    <header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-slate-200 text-slate-700">
        <div class="container mx-auto flex flex-col flex-wrap items-center px-4 md:flex-row gap-4">
            <NuxtLink
                to="/"
                class="mb-4 flex items-center font-medium text-gray-900 md:mb-0"
            >
                LOGO
            </NuxtLink>
            <nav class="main-menu md:ml-auto">

              <ul v-if="navigation && navigation.length > 0"
                  class="main-menu__list main-menu__list--first-level flex flex-wrap items-center justify-center gap-6 text-sm"
              >
                <li v-for="{ title, link, children } in navigation"
                    :key="link"
                    class="relative group"
                >
                  <NuxtLink
                      :to="link"
                      class="main-menu__list-item inline-flex items-center px-2 py-1 rounded hover:text-slate-900 hover:bg-slate-100 transition"
                  >
                    {{ title }}
                  </NuxtLink>

                  <ul v-if="children && children.length > 0"
                      class="main-menu__list main-menu__list--second-level absolute hidden group-hover:block bg-white shadow-lg py-2 px-3 rounded-md z-10"
                  >
                    <li v-for="child in children"
                        :key="child.link" class="main-menu__list-item py-1 px-2 rounded hover:bg-slate-100"
                    >
                      <NuxtLink
                          :to="child.link"
                          class="block py-1 hover:text-slate-900"
                      >
                        {{child.title}}
                      </NuxtLink>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
            <div v-if="userData" class="relative">
                <button
                    class="user-avatar flex items-center justify-center w-10 h-10 rounded-full bg-slate-200 text-slate-700 font-bold focus:outline-none focus:ring-2 focus:ring-slate-400 transition"
                    @click="showUserMenu = !showUserMenu"
                    aria-label="User menu"
                >
                    {{ userData.username.charAt(0).toUpperCase() }}
                </button>
                <transition name="fade">
                  <div
                      v-if="showUserMenu"
                      class="absolute right-0 mt-2 w-40 bg-white border border-slate-200 rounded-lg shadow-lg z-30 py-2"
                  >
                      <div class="px-4 py-2 text-slate-700 font-medium border-b border-slate-100">
                        {{ userData.username }}
                      </div>
                      <NuxtLink
                          to="/user/"
                          class="block w-full text-left px-4 py-2 text-slate-700 hover:bg-slate-100 transition"
                          @click="showUserMenu = false"
                      >
                          Profile
                      </NuxtLink>
                      <button
                          class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition"
                          @click="authStore.logout(); showUserMenu = false"
                      >
                          Logout
                      </button>
                  </div>
                </transition>
            </div>
        </div>
        <div class="container mx-auto text-decoration-underline">
            <h1 v-if="title">{{ title }}</h1>
            <h1 v-else>Page has no Title</h1>
        </div>
    </header>
</template>

<script lang="ts" setup>
import {useAuthStore} from "~/stores/authStore";
            import { ref } from 'vue'
            import { onClickOutside } from '@vueuse/core'
            const showUserMenu = ref(false)
            // Optionally, close menu when clicking outside
            const userMenuRef = ref<HTMLElement | null>(null)
            onClickOutside?.(userMenuRef, () => showUserMenu.value = false)

defineProps<{
  title?: string,
  navigation: Array<{
    title: string;
    link: string;
    children: Array<{
      title: string;
      link: string;
    }>;
  }>;
  userData: {
    uid: number;
    username: string;
  } | null;
}>();
const authStore=useAuthStore();
</script>


<style lang="scss">
.router-link-active, .router-link-exact-active {
    font-weight: bold;
}
</style>
