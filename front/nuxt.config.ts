// https://nuxt.com/docs/api/configuration/nuxt-config
import {resolve} from "path";

export default defineNuxtConfig({
  devtools: {enabled: true},
  // use to import component automatically
  components: true,
  // use @ as root
  alias: {
    "@":resolve(__dirname, "/")
  },

  // use globally scss
  css: [
      "~/assets/main.scss"
  ],

  // Recommended from Tailwind Doc
  postcss: {
    plugins: {
      autoprefixer: {},
      tailwindcss: {}
    }
  },

  modules: [
    '@pinia/nuxt',
    'pinia-plugin-persistedstate/nuxt',
    '@t3headless/nuxt-typo3',
    '@formkit/nuxt'
  ],

  // extends: '@t3headless/nuxt-typo3-ui',

  typo3: {
    i18n: {
      default: 'en',
      locales: ['en', 'pl', 'de']
    },
    api: {
      baseUrl: process.env.API_BASE || 'https://pwa-demo.ddev.site/headless',
      proxyHeaders: ['set-cookie', 'fe_typo_user', 'cookie'], // important to make auth work
      proxyReqHeaders: ['referer', 'fe_typo_user', 'cookie', 'cookies'],

    }
  },
  formkit: {
    autoImport: true,
    configFile: './formkit.config.ts'
  },


  vite: {
    // Vite settings for development mode on DDEV
    server: {
      allowedHosts: ['app_upstream', 'pwa-demo.ddev.site'],
    }
  },

  compatibilityDate: '2025-05-06',
})
