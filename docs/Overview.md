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