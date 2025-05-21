<script lang="ts" setup>
import type {T3CeBaseProps} from '@t3headless/nuxt-typo3';

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

function getFormData(object) {
    const formData = new FormData();
    Object.keys(object).forEach(key => formData.append(key, object[key]));
    return formData;
}

function submitForm(formValues, node) {
    console.log({formValues, node})

    $fetch(`${form.value?.action}`, {
        method: 'POST',
        credentials: "include",
        // headers: {
        //     'Content-Type': 'application/x-www-form-urlencoded',
        // },
        body: new URLSearchParams(formValues),
        // body: getFormData(formValues),
        // headers: {
        //     "X-CSRF-Token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImtpZCI6IntcInR5cGVcIjpcIm5vbmNlXCIsXCJuYW1lXCI6XCJ1QlBvekVYQkd5ZFBZTDFiME1sMWJRXCJ9In0.eyJzY29wZSI6ImNvcmUvdXNlci1hdXRoL2ZlIiwidGltZSI6IjIwMjUtMDUtMTlUMjI6MTc6MDErMDI6MDAiLCJwYXJhbXMiOnsicGlkIjoiNDQiLCJyZXF1ZXN0Ijp7InVyaSI6Ii9sb2dpbj90eF9mZWxvZ2luX2xvZ2luJTVCYWN0aW9uJTVEPWxvZ2luJmFtcDt0eF9mZWxvZ2luX2xvZ2luJTVCY29udHJvbGxlciU1RD1Mb2dpbiZhbXA7Y0hhc2g9YWQ0Y2VjZWU3NzNiNGFjYjMxMzRkZjgyNWY2M2ZlMzUifX19.WCvBZZq20h8VaklsyVB-z5Qfa93s5ah6pbUSkDxDv-E", // 👈👈👈 Set the token
        //
        // }
    }).then(data => {
        console.log(data)
        reloadNuxtApp({
            force: true
        });
    }).catch(e => {
        console.log(e)
    })

    // const formData=new FormData(formValues);
    // console.log(formData)

}

// onMounted(()=>{
//     console.log("mounted")
//     requestAnimationFrame(()=>{
//         const form=document.querySelector('form')
//         console.log(form)
//         if(form){
//             form.action=`/headless`+form.action;
//         }
//     })
// })
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
<!--        <pre>-->
<!--        {{data}}-->
<!--        </pre>-->
</template>

<style scoped>

</style>
