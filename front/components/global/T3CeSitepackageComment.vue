<script setup lang="ts">
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';
import {useAuthStore} from "~/stores/authStore";

interface T3CePlugin extends T3CeBaseProps {
    data?: object
}

const props = withDefaults(defineProps<T3CePlugin>(), {})

const {loggedIn, logout}=useAuthStore();

const {$fetch} = useT3Api();

function submitForm(formValues, node) {
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
    }).catch(e => {
      if(e.statusCode===403){
        // handle unauthorized
        console.log(e)
        node.setErrors([
            `Looks like you are not authorized to create a comment... ${e.message}`
        ])
      }else{
        console.log(e.statusCode)
        console.log(e)

        node.setErrors([
          `failed to post.. ${e.message}`
        ])
      }
    })

}
</script>

<template>
  <div class="mb-8" v-if="!loggedIn">
    <h2 >to create a comment, you must be logged in first</h2>
    <h3>for testing purposes, you can still submit the form, to see the errors.</h3>
    <NuxtLink class="font-medium text-blue-600 dark:text-blue-500 hover:underline" to="/login" >Go to login page</NuxtLink>
  </div>
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
