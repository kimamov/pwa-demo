<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';

interface T3CeImageWithDescription extends T3CeBaseProps {
  header?: string;
  slider: {
    slide_title: string;
    slide_link: {
      url: string;
      attr: { href: string };
    };
    slide_image: {
      publicUrl: string;
      alt: string;
      title: string;
    }[];
    slide_description: string;
  }[];
}

const props = withDefaults(defineProps<T3CeImageWithDescription>(), {
  slider: []
});

console.log("Props Slider", {props});

const slides = computed(() => {
  return props.slider.map((slide) => ({
    slideTitle: slide.slide_title,
    slideLink: slide.slide_link.attr.href,
    slideImage: slide.slide_image[0]?.publicUrl,
    slideDescription: slide.slide_description,
  }));
});

const cleanHtml = (html: string) => {
  return html.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
};


</script>

<template>
  <h2>{{ header }}</h2>
  <div v-if="slides" class="slider-overview">
    <div v-for="(slide, index) in slides" :key="index" class="slide-card">
      <div v-if="slide.slideImage" class="slide-image">
        <img :src="slide.slideImage" :alt="slide.slideTitle" />
      </div>
      <h3 class="slide-title">{{ slide.slideTitle }}</h3>
      <div class="slide-description" v-html="cleanHtml(slide.slideDescription)"></div>
      <a :href="slide.slideLink" class="slide-link">Mehr erfahren</a>
    </div>
  </div>
</template>

<style scoped lang="scss">
.slider-overview {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  justify-content: center;
  margin: 0 auto;
}

.slide-card {
  border: 1px solid #ddd;
  padding: 16px;
  width: 300px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  text-align: center;
  background-color: #fff;
  transition: transform 0.3s ease;

  &:hover {
    transform: scale(1.05);
  }

  .slide-title {
    font-size: 1.25rem;
    margin-bottom: 8px;
    color: #333;
  }

  .slide-description {
    font-size: 1rem;
    margin-bottom: 12px;
    color: #666;
    line-height: 1.5;
    text-align: left;
  }

  .slide-link {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;

    &:hover {
      text-decoration: underline;
    }
  }

  .slide-image {
    margin-top: 16px;

    img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }
  }
}
</style>