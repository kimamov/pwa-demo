// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: {enabled: true},

  modules: [
    '@t3headless/nuxt-typo3',
    '@formkit/nuxt'
  ],

  extends: '@t3headless/nuxt-typo3-ui',

  typo3: {
    i18n: {
      default: 'en',
      locales: ['en', 'pl', 'de']
    },
    api: {
      // baseUrl: process.env.API_BASE || 'https://api.t3pwa.com'
      baseUrl: process.env.API_BASE || 'https://pwa-demo.ddev.site/headless',
      // baseUrl: process.env.API_BASE || 'https://api.pwa-demo.ddev.site'
      proxyHeaders: ['set-cookie'], // important to make auth work
      proxyReqHeaders: ['referer', 'fe_typo_user', 'cookie', 'cookies'],

    }
  },
  formkit: {
    autoImport: true,
    configFile: './formkit.config.ts'
    // configFile: './my-configs/formkit.config.ts',
  },
  // components: {
  //     dirs: [{
  //         path: ' @/components/global',
  //         global: true
  //     }],
  // },

  vite: {
    // Vite settings for development mode on DDEV
    server: {
      allowedHosts: ['app_upstream', 'pwa-demo.ddev.site'],
    }
  },

  compatibilityDate: '2025-05-06',
})
