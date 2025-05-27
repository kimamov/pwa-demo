<script setup lang="ts">
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';

interface T3CePlugin extends T3CeBaseProps {
    data?: object
}

const props = withDefaults(defineProps<T3CePlugin>(), {})


const {$fetch} = useT3Api();

function submitForm(formValues) {
    $fetch(`/create-comment`, {
        method: 'POST',
        credentials: "include",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(formValues)
    }).then(data => {
        console.log(data)
        reloadNuxtApp({
            force: true
        });
        // refreshCurrentPageData()
    }).catch(e => {
        console.log(e)
    })

}
</script>

<template>
    <FormKit
        method="POST"
        @submit="submitForm"
        type="form"
        submit-label="Add comment"
    >
        <FormKit type="text" label="Text" name="text"/>
        <FormKit type="text" label="Author" name="author"/>
    </FormKit>

    <h1>Comments:</h1>
    <li v-for="comment in data.comments">
        "{{ comment.text }}" - <i>{{ comment.author }}</i>
    </li>
</template>

<style scoped>

</style>
