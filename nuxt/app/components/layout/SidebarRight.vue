<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation, Autoplay } from "swiper/modules";

const modules = [Navigation, Autoplay];

// Props
defineProps({
  slides: { type: Array, default: () => [] },
  latestPosts: { type: Array, default: () => [] },
});
</script>

<template>
  <a href="https://congchungnguyenhue.com/thu-tuc-cap-so-do.html">
    <img
      src="https://image.congchungnguyenhue.com/300x350/2025/01/09/sang-ten-so-do_0901205922.jpg"
      alt="Sang tên sổ đỏ"
      class="w-full h-auto"
    />
  </a>

  <div class="w-full max-w-sm mt-5 mb-3">
    <h2 class="text-lg font-bold text-gray-900 mb-2">
      <span class="text-red-600 font-bold mr-1">|</span>CÔNG CHỨNG
    </h2>

    <Swiper
      :modules="modules"
      :slides-per-view="1"
      :loop="true"
      :breakpoints="{
        640: { slidesPerView: 1 },
        768: { slidesPerView: 1 },
        1024: { slidesPerView: 1 },
      }"
      :autoplay="{ delay: 3000 }"
      navigation
      class="overflow-hidden"
    >
      <SwiperSlide v-for="(item, index) in slides" :key="index">
        <a :href="item.url">
          <img :src="item.image" alt="" class="w-full h-auto object-cover" />
          <p
            class="mt-2 text-sm font-semibold text-black leading-snug hover:text-red-600 transition"
          >
            {{ item.title }}
          </p>
        </a>
      </SwiperSlide>
    </Swiper>
  </div>

  <div class="flex items-center justify-center my-6">
    <div class="flex items-center w-full">
      <div class="flex-1 border-t border-gray-300"></div>
      <button
        class="mx-4 px-5 py-1.5 text-red-600 border border-red-500 rounded-full text-sm font-semibold hover:bg-red-50 transition cursor-pointer"
      >
        XEM THÊM
      </button>
      <div class="flex-1 border-t border-gray-300"></div>
    </div>
  </div>

  <div class="space-y-4 lg:sticky lg:top-16">
    <h2 class="text-base font-bold text-black">
      <span class="text-red-600 font-bold">|</span>
      TIN MỚI NHẤT
    </h2>

    <div v-for="(item, index) in latestPosts" :key="index" class="flex gap-2">
      <a :href="item.url" class="w-[80px] shrink-0">
        <img :src="item.image" alt="" class="w-full h-[60px] object-cover" />
      </a>
      <a
        :href="item.url"
        class="text-sm font-medium leading-tight text-black hover:text-red-600 transition"
      >
        {{ item.title }}
      </a>
    </div>
  </div>
</template>
