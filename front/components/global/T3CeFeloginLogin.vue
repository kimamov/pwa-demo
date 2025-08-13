<script lang="ts" setup>
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';
import {useAuthStore} from "~/stores/authStore";
import type { FormKitNode } from '@formkit/core'
import { computed } from 'vue'

interface T3CeImageWithDescription extends T3CeBaseProps {
    // bodytext: string,
    // assets?: T3File[]
    content?: any,
    type?: any,
    data?: any
}
1
const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})

const form = computed(() => props?.data?.form)


const {$fetch} = useT3Api();

const authStore=useAuthStore();

interface FormValues {
    user: string;
    pass: string;
    [key: string]: string;
}


function submitForm(formValues: FormValues, node: FormKitNode) {
    console.log({formValues, node})

    $fetch(`${form.value?.action}`, {
        method: 'POST',
        credentials: "include",
        body: new URLSearchParams(formValues),
    }).then(data => {
        console.log(data)

        authStore.setUser({
          email: "admin@admin.com",
          name: "admin admin",
          uid: 0,
          username: "admin"
        });
        // authStore.fetchUser();

        // setTimeout(()=>{
        //     fetch('https://pwa-demo.ddev.site/headless/user/', {
        //         method: 'POST',
        //         body: JSON.stringify({
        //             responseElementId: "404"

        //     })
        // }).then(res=> res.json()).then(data=> console.log(data)).catch(e=> console.log(e))
        // }, 2000)

        // nextTick(()=>{
        //   navigateTo('/login/you-are-logged-in');
        // })
    }).catch(e => {
        console.log(e)
        authStore.logout();
    })

}

</script>

<template>
    <h1 class="text-2xl font-semibold text-slate-800 mb-1">{{ data.message.header }}</h1>
    <p class="text-slate-600 mb-4">{{ data.message.message }}</p>
    <h3 class="text-lg font-medium text-slate-700 mb-2">{{form.title}}</h3>
    <FormKit
        v-if="form && form.elements?.length"
        :actions="false"
        :submit-label="form.title"
        type="form"
        @submit="submitForm"
    >
        <FormKit v-for="element of form.elements" :label="element.label" :name="element.name" :type="element.type" :value="element.value" class="mb-3"></FormKit>
    </FormKit>
  <h1 class="mt-6 text-sm uppercase tracking-wide text-slate-500">OAUTH GITHUB</h1>
</template>

<style scoped>

</style>
