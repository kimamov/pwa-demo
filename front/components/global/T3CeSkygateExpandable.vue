<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
  // bodytext: string,
  // assets?: T3File[]
  header?: string
  title?: string
  textarea?: string
  image?: object
  toggle?: number

}

const currentImage = computed(() => {
  if (props.toggle === 1 && props.image[1]?.publicUrl) {
    return props.image[1]
  }
  return props.image[0]
})

const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
    // bodytext: ''
})
console.log("Props A", {props})
</script>

<template>
  <details class="expandable" open>
    <summary class="expandable__summary">
      <h3 class="headline headline--h3 headline--white">{{ title }}</h3>
    </summary>
    <div class="expandable__panel" role="region">
      <div v-if="textarea" v-html="textarea"></div>
      <div v-if="currentImage?.publicUrl">
        <img :src="currentImage.publicUrl" :alt="currentImage.title || 'Bild'" />
      </div>
    </div>
  </details>
</template>

<style lang="scss">
.expandable {
  max-width: 50rem;

  &__summary {
    display: flex;
    position: relative;
    width: 100%;
    background: darkslategrey;
    padding: 0.25rem 1rem;

    &:before {
      content: "";
      position: absolute;
      width: 2rem;
      height: 2rem;
      top: calc(50% - 1rem);
      right: 1rem;
      background-color: #fff;
      -webkit-mask: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCjxwYXRoIGQ9Ik02IDkuODUxOTJMNy44MDMxNSA4TDEyIDEyLjMxMjRMMTYuMTk2OSA4TDE4IDkuODUxOTJMMTIgMTZDOS45Nzc5NSAxMy45NzM0IDcuOTk3MDUgMTEuOTAzOCA2IDkuODUxOTJaIiBmaWxsPSJjdXJyZW50Q29sb3IiLz4NCjwvc3ZnPg0K);
      mask: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCjxwYXRoIGQ9Ik02IDkuODUxOTJMNy44MDMxNSA4TDEyIDEyLjMxMjRMMTYuMTk2OSA4TDE4IDkuODUxOTJMMTIgMTZDOS45Nzc5NSAxMy45NzM0IDcuOTk3MDUgMTEuOTAzOCA2IDkuODUxOTJaIiBmaWxsPSJjdXJyZW50Q29sb3IiLz4NCjwvc3ZnPg0K);
      -webkit-mask-repeat: no-repeat;
      mask-repeat: no-repeat;
      -webkit-mask-position: 50% 50%;
      mask-position: 50% 50%;
      transform: translateY(0%) rotate(0deg);
      transition: transform 300ms ease;
      z-index: 1;
    }

    &:after {
      content: "";
      position: absolute;
      width: 2rem;
      height: 2rem;
      top: calc(50% - 1rem);
      right: 1rem;
      background-color: transparent;
      transform: translateY(0%) rotate(0deg);
      transition: transform 300ms ease;
      border-radius: 50%;
      z-index: 0;
    }

    h3 {
      margin-bottom: 0;
    }
  }

  &__panel {
    display: flex;
    flex-direction: column;
    gap: 6px;
    background: #f2f2f2;
    padding: 1rem;
  }

  &[open] {
    .expandable__summary {

      &:after {
        transform: translateY(0%) rotate(180deg);
      }

      &:before {
        transform: translateY(0%) rotate(180deg);
      }
    }
  }
}

.headline {
  color: inherit;
  line-height: 150%;
  margin-bottom: 1.125rem;
  margin-top: 0;
  font-style: normal;
  font-stretch: normal;
  font-optical-sizing: auto;
  font-weight: normal;

  &--white {
    color: #ffffff;
  }

  &--h1 {
    font-size: 3rem;
  }
  &--h2 {
    font-size: 2.5rem;
  }
  &--h3 {
    font-size: 2rem;
  }
  &--h4 {
    font-size: 1.25rem;
  }
}

h1 {
  font-size: 3rem;
}
h2 {
  font-size: 2.5rem;
}
h3 {
  font-size: 2rem;
}
h4 {
  font-size: 1.25rem;
}
</style>
