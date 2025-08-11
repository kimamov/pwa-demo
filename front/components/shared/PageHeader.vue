<template>
    <header class="text-gray-600">
        <div class="container mx-auto flex flex-col flex-wrap items-center p-5 md:flex-row">
            <NuxtLink
                to="/"
                class="mb-4 flex items-center font-medium text-gray-900 md:mb-0"
            >
                LOGO
            </NuxtLink>
            <nav class="main-menu md:ml-auto">

              <ul v-if="navigation && navigation.length > 0"
                  class="main-menu__list main-menu__list--first-level flex flex-wrap items-center justify-center text-base"
              >
                <li v-for="{ title, link, children } in navigation"
                    :key="link"
                    class="relative group"
                >
                  <NuxtLink
                      :to="link"
                      class="main-menu__list-item mr-5 hover:text-gray-900"
                  >
                    {{ title }}
                  </NuxtLink>

                  <ul v-if="children && children.length > 0"
                      class="main-menu__list main-menu__list--second-level absolute hidden group-hover:block bg-white shadow-md py-2 px-4 rounded z-10"
                  >
                    <li v-for="child in children"
                        :key="child.link" class="main-menu__list-item pb-2 border-b-1"
                    >
                      <NuxtLink
                          :to="child.link"
                          class="py-2 hover:text-gray-900"
                      >
                        {{child.title}}
                      </NuxtLink>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
            <div v-if="userData" class="user-avatar m-4 p-1 border-2">
                USER (logged in)
                <button class="bg-green-200 p-2 rounded" @click="authStore.logout()">
                    click for logout
                </button>

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
  userData: any;
}>();
const authStore=useAuthStore();
</script>
<style lang="postcss">
.router-link-active, .router-link-exact-active {
    @apply font-bold;
}
</style>
