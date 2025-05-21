<script setup lang="ts">
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';

interface T3CePlugin extends T3CeBaseProps {
    data?: object
}

const props = withDefaults(defineProps<T3CePlugin>(), {})
console.log({props})

function getFormData(object) {
    const formData = new FormData();
    Object.keys(object).forEach(key => formData.append(key, object[key]));
    return formData;
}

function submitForm(formValues) {
    $fetch(`https://pwa-demo.ddev.site/headless/example`, {
        method: 'POST',
        credentials: "include",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(formValues)
        // body: getFormData(formValues),
        // headers: {
        //     "X-CSRF-Token": "", // 👈👈👈 Set the token
        //
        // }
    }).then(data => {
        // window.location.reload()


        console.log(data)
        reloadNuxtApp({
            force: true
        });
        // refreshCurrentPageData()
    }).catch(e => {
        console.log(e)
    })

    // const formData=new FormData(formValues);
    // console.log(formData)

}
</script>

<template>
    <FormKit
        :action="`https://pwa-demo.ddev.site/headless/example`"
        method="POST"
        @submit="submitForm"
        type="form"
        submit-label="Add comment"
    >
        <FormKit type="text" label="Text" name="text"/>
        <FormKit type="text" label="Author" name="author"/>
        <!--        <FormKit type="file" label="image" name="image"/>-->
    </FormKit>

    <h1>Comments:</h1>
    <li v-for="comment in data.comments">
        "{{ comment.text }}" - <i>{{ comment.author }}</i>
    </li>
</template>

<style scoped>

</style>
