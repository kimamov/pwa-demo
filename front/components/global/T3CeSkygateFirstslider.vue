<script setup lang="ts">
import type { T3CeBaseProps } from '@t3headless/nuxt-typo3';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css/navigation';
// import './style.css';

interface T3CeImageWithDescription extends T3CeBaseProps {
  header?: string;
  isSlider?: boolean;
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
const cleanHtml = (html: string) => {
  return html.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
};

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

const modules = ref([Navigation, Pagination]);

</script>

<template>
  <h2>{{ header }}</h2>
  <section class="section">
    <div class="container">
      <div v-if="isSlider" class="slider-container">
        <Swiper
            :cssMode="true"
            :slidesPerView="1"
            :spaceBetween="0"
            :loop="false"
            :keyboard="{
              enabled: true,
            }"
            :navigation="true"
            :pagination="{
              clickable: true,
            }"
            :breakpoints=" {
              768: {
                slidesPerView: 2,
                spaceBetween: 20
              },
              1440: {
                slidesPerView: 3,
                spaceBetween: 30
              }
            }"
            :modules="modules"
            class="mySwiper"
        >
          <SwiperSlide class="amir" v-for="(slide, index) in slides" :key="index">
            <div class="slide-card">
              <h3>{{ slide.slideTitle }}</h3>
              <p v-html="slide.slideDescription"></p>
              <a :href="slide.slideLink">Mehr erfahren</a>
              <img :src="slide.slideImage" :alt="slide.slideTitle" />
            </div>
          </SwiperSlide>
        </Swiper>
      </div>
      <div v-else class="card-container">
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
      </div>
    </div>
  </section>
</template>

<style scoped lang="scss">
.section {
  padding: 32px 0;
}
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
  margin-bottom: auto;

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