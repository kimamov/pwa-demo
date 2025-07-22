# TYPO3 Headless & PWA Demo Distribution

This setup enables quick exploration of a PWA (Progressive Web App) solution for TYPO3.\
It includes a Docker/DDEV local environment, preconfigured with TYPO3 and a JavaScript demo application.

The solution is built upon several key TYPO3 initiatives:

- [TYPO3 Headless](https://github.com/TYPO3-Headless/headless)
- [TYPO3 Headless News](https://github.com/TYPO3-Headless/headless_news)
- [Nuxt TYPO3](https://github.com/TYPO3-Headless/nuxt-typo3)
- [Nuxt TYPO3 Starter](https://github.com/TYPO3-Headless/nuxt-typo3-starter)

## How to start with TYPO3 Headless video tutorial
[![video still](https://i.ytimg.com/vi/7MOwugAyHkY/hq720.jpg)](https://www.youtube.com/watch?v=7MOwugAyHkY)

## Requirements

Ensure you have [DDEV](https://ddev.readthedocs.io/en/stable/) version `v1.12.7` or newer.

We recommend using Unix-like operating systems, such as Linux or macOS, due to several issues reported with WSL2 usage.

## Installation

1) Clone the repository and navigate to the repository folder

```
git clone https://github.com/TYPO3-Headless/pwa-demo.git
cd pwa-demo
```

2) Start the DDEV Docker containers

```
ddev start
```

3) Launch the frontend application by entering the following command

```
ddev pwa-front start
```

You can access application in your browser, using following links:

| Application | URL | Credentials |
| --- | --- |----------------------|
| Frontend | https://pwa-demo.ddev.site |                      |
| TYPO3 backend | https://api.pwa-demo.ddev.site/typo3 | ```admin:password``` |

## Development

Active development of this extension is a part of the TYPO3 PWA initiative. For more information, visit the [TYPO3 PWA Initiative](https://typo3.org/community/teams/typo3-development/initiatives/pwa/).

## Front-end exploration

To initiate Nuxt in development mode, execute:

```
ddev pwa-front dev
```

## How to reimport database?

Occasionally, the database for the `pwa-demo` project is updated. If you want to update your database, execute the following command in your project root:

```bash
ddev import-db --file ./data/db.sql.gz
```



# Overview
This project integrates a Nuxt.js frontend with a TYPO3 Headless backend.

## Application Architecture
With this setup, the backend is split into two servers:

1. The **API server**, in this case hosting a TYPO3 instance, configured to be headless
2. A **Node.js server** hosting a Nuxt.js application

When a client reaches out to the website, the Node.js server will be contacted under https://pwa-demo.ddev.site.
The Nuxt application will detect that this is a fresh connection and will request the page contents
from the API Server under https://api.pwa-demo.ddev.site.

## Backend
Frontend components that are normally rendered as HTML within vanilla TYPO3, are now rendered as JSON
with the `friendsoftypo3/headless` extension.
Most of the core elements are already supported for JSON rendering by the headless extension.
Third-party custom content elements need to be supported manually, if they are to be used within the headless site.
A lot of major extensions, such as `ext-news`, `cms-felogin` have companion packages aiming to provide headless support for their custom content elements.

### Content Blocks
Custom content elements can easily be created using the Content Blocks extension (`friendsoftypo3/content-blocks`).
The third-party extension `netzbewegung/nb-headless-content-blocks` is used a bridge between the headless extension and
the Content Blocks extension.
With that extension installed, a custom Typo3 DataProcessor is installed that reads the custom `headless.php` "template"
that returns a JSON element.
The bridge extension doesn't seem to be backed very well, but it is not a very big nor complicated extension.
In the worst case, we could maintain the package ourselves.

## Frontend
In the front-end land, this project uses the `@t3headless/nuxt-typo3` and `@t3headless/nuxt-typo3-ui` adapters.
They provide basic templates and styling for the core elements.
The entire frontend is a Nuxt single-page-application (SPA) by default.

Pages consist out of Vue.js components.
Every custom content elements requires its own Vue component, following a naming convention of "T3Ce" as prefix, followed by the component name.

### Rendering
Nuxt.js is capable of rendering the frontend on the server.
This is very useful, as the first request of a session can be delivered as standard HTML to the browser, resulting
in a more stable page load, without many page layout shifts, if done right.

Subsequent requests, e.g. when navigating to a different sub-page, will then be sent as JSON content.
The Nuxt application's frontend code will then proceed to update the page contents according to the received JSON.
Thereby, the single-page-application nature of the website is provided.

### Page specific overrides
It is possible to configure each page individually, to be rendered in the classic way, i.e. the server outputs HTML.
Such pages will then cause a page reload upon navigating to them.

Additionally, it is possible to configure Typo3 so that it's output type depends on the requested content type.
This so-called "headless mixed mode" evaluates the content-type request header and then uses the specific rendering engine.
For example, if the client includes the header "Content-Type: application/json", the output will be in JSON format (headless mode).
But if instead, the client includes the header "Content-Type: text/html", the output will use classic fluid rendering.
However, for this approach, three templates have to be created per content element: FE Fluid, Vue Component, BE Fluid (preview).

## SEO
Because Nuxt.js renders the first request as HTML, the flow doesn't differ from classic Typo3 sites.
SEO specific tags and content can be rendered as usual.

## Creating custom components
First, create new content block using:
```shell
ddev typo3 make:content-block
```

This will invoke a dialog guiding through the content block creation.

Afterward, delete the `frontend.html` template from the content element directory.
Then, create a file called `headless.php` in the content element directory.
This file will be executed by the headless bridge extension when trying to render the content block as JSON.

By default, the data of the content block will be inside the json under the `data` key. 
If you want to use the node module `@t3headless/nuxt-typo3` to render the content block, you will need to move the data to the `content` key.
To do this, you need to add this to your `setup.typoscript` file at packages/EXT_KEY/Configuration/Sets/SitePackage/setup.typoscript

Example for a custom content block called `skygate_test`:

```typoscript

tt_content.skygate_test = JSON
tt_content.skygate_test {
    fields {
        appearance =< lib.appearance

        colPos = INT
        colPos {
            field = colPos
        }

        content = TEXT
        content {
            dataProcessing {
                10 = nb-content-blocks-json
                10.as = data
            }
        }

        id = INT
        id {
            field = uid
        }

        type = TEXT
        type {
            field = CType
        }
    }
}

```
this will add the processed data to the `content` key, so that the node module can render it correctly.

## Create vue component for the content block
After creating the content block, you need to create a Vue component for it.
The component should be created in the components/global and named `T3Ce<ContentBlockName>.vue`, where `<ContentBlockName>` is the name of your content block.
This will make sure that `@t3headless/nuxt-typo3` automatically picks it up and renders it correctly.

here is an example of a Vue component for a content block called `skygate_test`:
```vue

<script setup lang="ts">
  import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

  interface T3CeImageWithDescription extends T3CeBaseProps {
    header?: string
    title?: string
  }
  const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    header: 'header fallback',
    title: 'title fallback'
  })
</script>

<template>
  <h2>{{uid}}</h2>
  <h2>{{header}}</h2>
  <h3>{{title}}</h3>
</template>

```
