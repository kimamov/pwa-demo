<script setup lang="ts">
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';
import {useAuthStore} from "~/stores/authStore";

interface T3CePlugin extends T3CeBaseProps {
    data?: any
}

const props = withDefaults(defineProps<T3CePlugin>(), {})

const {loggedIn, logout}=useAuthStore();

const {$fetch} = useT3Api();
const route = useRoute();
interface FormValues {
    text: string;
    author: string;
    image?: File;
    [key: string]: any;
}


function submitForm(formValues: FormValues, node: FormKitNode) {
    // Create FormData to handle file uploads
    const formData = new FormData();
    // Use Extbase plugin argument namespace so TYPO3 maps args/files to the plugin request
    formData.append('tx_sitepackage_commentform[text]', formValues.text);
    formData.append('tx_sitepackage_commentform[author]', formValues.author);
    formData.append('responseElementId', "405")
    
    // Add image if present (handle different shapes from FormKit: File, File[], FileList, { file })
    const imageValue = (formValues as any).image;

    if(imageValue[0] && imageValue[0].file){
      formData.append('tx_sitepackage_commentform[image]', imageValue[0].file, imageValue[0].name);
    }

    // Post to current page path so TYPO3 processes CE in page context
    fetch('https://pwa-demo.ddev.site/headless/create-comment', {
        method: 'POST',
        credentials: "include",
        body: formData, // Let the browser set Content-Type with proper boundary
        // headers: {
        //   'Content-Type': '',
        // }
      }).then(data => {
        console.log(data?.content?.data)
        // reloadNuxtApp({
        //     force: true
        // });
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
        <FormKit type="file" label="Image (optional)" name="image" accept="image/*"/>
    </FormKit>

    <h1>Comments:</h1>
    <div v-if="data?.comments" v-for="comment in data.comments" class="mb-4 p-4 border border-gray-200 rounded-lg">
        <div class="mb-2">
            <strong>"{{ comment.text }}"</strong> - <i>{{ comment.author }}</i>
        </div>
        <pre>{{ comment }}</pre>
        <div v-if="comment.image" class="mt-2">
            <img :src="comment.image" alt="Comment image" class="max-w-xs max-h-48 object-cover rounded-md shadow-md"/>
        </div>
    </div>
</template>

<style scoped>

</style>
