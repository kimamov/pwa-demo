<script lang="ts" setup>
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';
import {useAuthStore} from "~/stores/authStore";
import type { FormKitNode } from '@formkit/core'

interface T3CeImageWithDescription extends T3CeBaseProps {
    // bodytext: string,
    // assets?: T3File[]
    content?: any,
    type?: any,
    data?: any
}

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
            uid: 0,
            username: "admin",
            email: "admin@admin.de",
            name: "admin"
        });

        navigateTo('/login/you-are-logged-in');
    }).catch(e => {
        console.log(e)
        authStore.logout();
    })

}

</script>

<template>
    <h1 class="text-xl font-bold mb-2">{{ data.message.header }}</h1>
    <h2>{{ data.message.message }}</h2>
    <h3>{{form.title}}</h3>
    <FormKit
        v-if="form && form.elements?.length"
        :actions="false"
        :submit-label="form.title"
        type="form"
        @submit="submitForm"
    >
        <FormKit v-for="element of form.elements" :label="element.label" :name="element.name" :type="element.type" :value="element.value"></FormKit>
    </FormKit>
  <h1>OAUTH GITHUB</h1>
</template>

<style scoped>

</style>
