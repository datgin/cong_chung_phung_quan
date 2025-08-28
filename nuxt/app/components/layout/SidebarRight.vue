<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation, Autoplay } from "swiper/modules";
import { useSettingStore } from "~/stores/setting";

const settingStore = useSettingStore();
const modules = [Navigation, Autoplay];
const { getAll } = useApi();
const latestPosts = ref([]);
const slides = ref([]);
const sliderTitle = ref("");
const catalogue = ref(null);

const fetchPostLatest = async () => {
  latestPosts.value = await getAll("posts/latest");
};

const fetchSliderPosts = async () => {
  const response = await getAll("posts/slider");
  slides.value = response.posts;
  catalogue.value = response.catalogue;
};

onMounted(() => {
  fetchPostLatest();
  fetchSliderPosts();
});
</script>

<template>
  <NuxtLink :to="settingStore.setting?.link_banner || 'javascript:void(0)'">
    <img
      :src="settingStore.setting?.banner"
      :alt="settingStore.setting?.alt_banner"
      class="w-full h-auto"
    />
  </NuxtLink>

  <div class="w-full max-w-sm mt-5 mb-3">
    <h2 class="text-lg font-bold text-gray-900 mb-2">
      <span class="text-red-600 font-bold mr-1">|</span>
      {{ catalogue?.slider_title }}
    </h2>

    <Swiper
      :modules="modules"
      :slides-per-view="1"
      :loop="slides.length > 2"
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
        <NuxtLink :to="`/${catalogue?.slug}/${item.slug}`">
          <img
            :src="item.thumbnail"
            alt=""
            class="w-full h-auto object-cover"
          />
          <p
            class="mt-2 text-sm font-semibold text-black leading-snug hover:text-red-600 transition"
          >
            {{ item.title }}
          </p>
        </NuxtLink>
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

    <div v-for="item in latestPosts" :key="item.id" class="flex gap-2">
      <NuxtLink
        :to="`/${item.catalogue?.slug}/${item.slug}`"
        class="w-[80px] shrink-0"
      >
        <img
          :src="item.thumbnail"
          alt=""
          class="w-full h-[60px] object-cover"
        />
      </NuxtLink>

      <NuxtLink
        :to="`/${item.catalogue?.slug}/${item.slug}`"
        class="text-sm font-medium leading-tight text-black hover:text-red-600 transition"
      >
        {{ item.title }}
      </NuxtLink>
    </div>
  </div>
</template>
