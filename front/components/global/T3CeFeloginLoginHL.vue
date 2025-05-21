<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

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

const form=computed(()=>props?.data?.form)


const {$fetch}=useT3Api();

function getFormData(object) {
    const formData = new FormData();
    Object.keys(object).forEach(key => formData.append(key, object[key]));
    return formData;
}
function submitForm(formValues, node){
    console.log({formValues, node})

    $fetch(`${form.value?.action}`, {
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
    }).then(data=>{
        console.log(data)
    }).catch(e=>{
        console.log(e)
    })

    // const formData=new FormData(formValues);
    // console.log(formData)
}
</script>

<template>
   <h1>FE LOGIN PLACEHOLDER</h1>
    <FormKit
        :action="`https://pwa-demo.ddev.site/headless${form.action}`"
        :method="form.method"
        @submit="submitForm"
        v-if="form && form.elements?.length"
        type="form"
        submit-label="Login"
    >
        <FormKit v-for="element of form.elements.filter(el=>el.type!=='submit')" :type="element.type" :value="element.value" :name="element.name" :label="element.label"></FormKit>
    </FormKit>
  <h2>{{uid}}</h2>
    <pre>
    {{data}}
    </pre>
    <form target="_top" spellcheck="false" action="/login?tx_felogin_login%5Baction%5D=login&amp;tx_felogin_login%5Bcontroller%5D=Login&amp;cHash=ad4cecee773b4acb3134df825f63fe35" method="post">
        <div>
            <input type="hidden" name="__referrer[@extension]" value="Felogin">
            <input type="hidden" name="__referrer[@controller]" value="Login">
            <input type="hidden" name="__referrer[@action]" value="login">
            <input type="hidden" name="__referrer[arguments]" value="YTowOnt9523d4a5c615bea312d13182512966990892bf450">
            <input type="hidden" name="__referrer[@request]" value="{&quot;@extension&quot;:&quot;Felogin&quot;,&quot;@controller&quot;:&quot;Login&quot;,&quot;@action&quot;:&quot;login&quot;}250b9d1b0c469d330d74fc3beb9f54bacfb8a891">
            <input type="hidden" name="__RequestToken" value="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImtpZCI6IntcInR5cGVcIjpcIm5vbmNlXCIsXCJuYW1lXCI6XCJhaXZZQTZQaFpOQXE5V0tmN0s2MEFRXCJ9In0.eyJzY29wZSI6ImNvcmUvdXNlci1hdXRoL2ZlIiwidGltZSI6IjIwMjUtMDUtMjFUMTA6MDY6MjYrMDI6MDAiLCJwYXJhbXMiOnsicGlkIjoiNDQiLCJyZXF1ZXN0Ijp7InVyaSI6Ii9sb2dpbj90eF9mZWxvZ2luX2xvZ2luJTVCYWN0aW9uJTVEPWxvZ2luJmFtcDt0eF9mZWxvZ2luX2xvZ2luJTVCY29udHJvbGxlciU1RD1Mb2dpbiZhbXA7Y0hhc2g9YWQ0Y2VjZWU3NzNiNGFjYjMxMzRkZjgyNWY2M2ZlMzUifX19.Uy3RO5G4XJMclH_NZt65KDSPWYK5hxyGMkZjuU-yVfo"><input type="hidden" name="__trustedProperties" value="{&quot;user&quot;:1,&quot;pass&quot;:1,&quot;submit&quot;:1,&quot;logintype&quot;:1,&quot;noredirect&quot;:1}ca01c5228be558ff5421e5aa90219fe4e9b9f837">
        </div>


        <fieldset>
            <legend>
                Login
            </legend>
            <div>
                <label for="tx-felogin-input-username">
                    Username
                    <input autocomplete="username" id="tx-felogin-input-username" type="text" name="user" required="required">
                </label>
            </div>
            <div>
                <label for="tx-felogin-input-password">
                    Password
                    <input required="required" autocomplete="current-password" id="tx-felogin-input-password" type="password" name="pass" value="">
                </label>
            </div>



            <div>
                <input type="submit" value="Login" name="submit">
            </div>

            <div class="felogin-hidden">
                <input type="hidden" name="logintype" value="login">




                <input type="hidden" name="noredirect" value="1">

            </div>
        </fieldset>

    </form>
</template>

<style scoped>

</style>
