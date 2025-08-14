<script lang="ts" setup>
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';
import {useAuthStore} from "~/stores/authStore";
import type { FormKitNode } from '@formkit/core'
import { computed, nextTick } from 'vue'
import { navigateTo } from '#imports'

interface T3CeImageWithDescription extends T3CeBaseProps {
    content?: any,
    type?: any,
    data?: any
}
const props = defineProps<T3CeImageWithDescription>()

const form = computed(() => props?.data?.form)


const authStore=useAuthStore();
console.log({authStore});


interface FormValues {
    user: string;
    pass: string;
    [key: string]: string;
}


async function submitForm(formValues: FormValues, node: FormKitNode) {
    console.log({formValues, node})
    node.clearErrors();

    try {
    const data=await authStore.login(formValues);
    console.log({data});

    if (!data) {
        node.setErrors(['Login failed. Please check your credentials and try again.']);
        return false;
    }
        
    } catch (error) {
        node.setErrors(['Login failed. Please check your credentials and try again.']);
        return false;
    }
    
    // if(data){
    //     nextTick(()=>{
    //       navigateTo('/login/you-are-logged-in');
    //     })
    // }

}

</script>

<template>
    <template v-if="authStore.loggedIn && authStore.user">
        <h1>You are logged in</h1>

        <FormKit type="button" @click="authStore.logout">Logout</FormKit>
    </template>
    <template v-else>
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
</template>

<style scoped>

</style>
