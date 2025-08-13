<script setup>
import { useSettingStore } from "~/stores/setting";
import { Swiper, SwiperSlide } from "swiper/vue";
import { ChevronRight, Download } from "lucide-vue-next";

import {
  Autoplay,
  Pagination,
  Navigation,
  EffectFade,
  EffectCube,
  EffectCoverflow,
  EffectFlip,
  EffectCards,
  EffectCreative,
} from "swiper/modules";

import "swiper/css";
import "swiper/css/autoplay";
import "swiper/css/pagination";
import "swiper/css/navigation";
import "swiper/css/effect-fade";
import "swiper/css/effect-cube";
import "swiper/css/effect-coverflow";
import "swiper/css/effect-flip";
import "swiper/css/effect-cards";
import "swiper/css/effect-creative";

const effectModules = {
  fade: EffectFade,
  cube: EffectCube,
  coverflow: EffectCoverflow,
  flip: EffectFlip,
  cards: EffectCards,
  creative: EffectCreative,
};

const modules = computed(() => {
  if (!slider.value) return [];
  return [
    slider.value.autoplay ? Autoplay : null,
    slider.value.pagination ? Pagination : null,
    slider.value.navigation ? Navigation : null,
    effectModules[slider.value.effect] || null,
  ].filter(Boolean);
});

const { getAll, getOne } = useApi();
const { $api } = useNuxtApp();
const settingStore = useSettingStore();

const posts = ref([]);
const legalDocuments = ref([]);
const faqs = ref([]);
const slider = ref(null);
const items = ref([]);

const fetchLegalDocuments = async () => {
  legalDocuments.value = await getAll("legal-documents?page=home");
};

const fetchPosts = async () => {
  posts.value = await getAll("posts");
};

const fetchFaqs = async () => {
  faqs.value = await getAll("faqs");
};

const getSlider = async () => {
  const response = await getOne("sliders");
  slider.value = response;
  items.value = response.items || [];
};

const downloadFile = async (file) => {
  try {
    const response = await $api.get(`legal-documents/download/${file}`, {
      responseType: "blob",
    });

    // Tạo URL từ blob data
    const blob = new Blob([response.data]);
    const downloadUrl = window.URL.createObjectURL(blob);

    // Tạo thẻ <a> để tự động click tải file
    const link = document.createElement("a");
    link.href = downloadUrl;

    // Gán tên file, bạn có thể đặt tĩnh hoặc lấy từ response header Content-Disposition nếu có
    link.download = file;

    document.body.appendChild(link);
    link.click();

    // Dọn dẹp DOM và revoke URL
    link.remove();
    window.URL.revokeObjectURL(downloadUrl);
  } catch (xhr) {
    console.log(xhr);
    message.error("Lỗi tải tài liệu!");
  }
};

watch(
  () => settingStore.setting,
  (setting) => {
    if (!setting) return;

    useSeoMeta({
      title: setting.title,
      description: setting.meta_description,
      ogTitle: setting.meta_title,
      ogDescription: setting.meta_description,
      ogImage: setting.logo,
    });
  },
  { immediate: true }
);

onMounted(() => {
  fetchLegalDocuments();
  fetchPosts();
  fetchFaqs();
  getSlider();
});
</script>

<template>
  <div>


    <div v-if="slider" class="relative w-full md:h-[500px] h-[110px]">
      <Swiper
        :modules="modules"
        :slides-per-view="slider.slides_per_view"
        :space-between="slider.space_between"
        :loop="slider.loop"
        :effect="slider.effect"
        :pagination="slider.pagination ? { clickable: true } : false"
        :navigation="slider.navigation"
        :autoplay="
          slider.autoplay
            ? { delay: slider.autoplay_delay, disableOnInteraction: false }
            : false
        "
        class="w-full h-full"
      >
        <SwiperSlide
          v-for="(item, index) in items"
          :key="index"
          class="w-full h-full"
        >
          <component
            :is="item.url ? 'a' : 'div'"
            v-bind="
              item.url
                ? {
                    href: item.url,
                    target: '_blank',
                    rel: 'noopener noreferrer',
                  }
                : {}
            "
            class="block w-full h-full"
          >
            <NuxtImg
              :src="item.image"
              :alt="item.alt || ''"
              class="w-full h-full object-cover"
            />
          </component>
        </SwiperSlide>
      </Swiper>

      <!-- Optional: Caption/Text -->
      <div
        class="absolute inset-0 flex items-center justify-center text-white text-3xl md:text-5xl font-bold bg-black/30"
      >
        <p>Chào mừng bạn đến với trang web</p>
      </div>
    </div>

    <div class="py-10 sm:py-12 bg-white">
      <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
          <h1
            class="text-2xl font-bold text-gray-900 pl-4 border-l-4 border-red-500"
          >
            Tin tức nổi bật
          </h1>
        </div>

        <!-- Grid -->
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
          <PostList :posts="posts" />
        </div>

        <!-- Xem thêm -->
        <div class="flex items-center justify-center my-8">
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

        <section class="bg-white">
          <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
              <!-- Tin mới cập nhật -->
              <div class="bg-white rounded-lg shadow p-5 flex flex-col">
                <h1
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Tin tức mới cập nhật
                </h1>
                <div class="mb-4">
                  <img
                    src="/images/cong_chung_di_chuc.png"
                    alt="tin mới"
                    class="w-full h-55 object-cover mb-2 rounded"
                  />
                  <p class="font-semibold text-gray-800">
                    Hợp đồng ủy quyền: Rủi ro tiềm ẩn và giải pháp từ góc nhìn
                    thực tế
                  </p>
                </div>

                <ul class="text-sm text-gray-700">
                  <li
                    class="flex gap-3 items-start border-b border-gray-300 py-2"
                  >
                    <img
                      src="/images/cong_chung_di_chuc.png"
                      class="w-12 h-10 object-cover rounded"
                    />
                    <div>
                      <p class="text-gray-800">
                        Tuyển dụng công chứng viên – Làm việc tại Hà Nội
                      </p>
                    </div>
                  </li>
                </ul>

                <div class="mt-auto pt-5">
                  <button
                    class="text-red-600 border border-red-500 rounded-full px-4 py-1.5 text-sm hover:bg-red-50"
                  >
                    XEM THÊM
                  </button>
                </div>
              </div>

              <!-- Câu hỏi thường gặp -->
              <div class="bg-white rounded-lg shadow p-5 flex flex-col">
                <h1
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Câu hỏi thường gặp
                </h1>

                <div v-if="faqs[0]" class="mb-4">
                  <NuxtImg
                    :src="faqs[0].thumbnail"
                    :alt="faqs[0].title"
                    class="w-full h-55 object-cover mb-2 rounded"
                  />
                  <p class="font-semibold text-gray-800">
                    {{ faqs[0].title }}
                  </p>
                </div>

                <ul class="space-y-3 text-sm text-gray-700">
                  <li
                    v-for="(faq, index) in faqs.slice(1)"
                    :key="faq.id"
                    class="flex gap-3 items-start py-2"
                    :class="{
                      'border-b border-gray-300':
                        index !== faqs.slice(1).length - 1,
                    }"
                  >
                    <NuxtImg
                      :src="faq.thumbnail"
                      :alt="faq.title"
                      class="w-12 h-10 object-cover rounded"
                    />
                    <div>
                      <p class="text-gray-800">
                        {{ truncateWords(faq.title, 15) }}
                      </p>
                    </div>
                  </li>
                </ul>

                <div class="mt-auto pt-5">
                  <NuxtLink
                    :to="'/cau-hoi-thuong-gap'"
                    class="inline-flex items-center gap-2 text-red-600 border border-red-500 rounded-full px-4 py-1.5 text-sm font-semibold transition-colors duration-300 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer"
                  >
                    XEM THÊM
                    <ChevronRight class="w-4 h-4" />
                  </NuxtLink>
                </div>
              </div>

              <!-- Văn bản pháp luật -->
              <div class="bg-white rounded-lg shadow p-5 flex flex-col">
                <h1
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Văn bản pháp luật
                </h1>

                <div class="mb-4">
                  <img
                    src="/images/van-ban-luat.jpg"
                    alt="Văn bản pháp luật"
                    class="w-full h-55 object-cover rounded"
                  />
                </div>

                <ul class="divide-y divide-gray-200 text-sm text-gray-800">
                  <li
                    v-for="legalDocument in legalDocuments"
                    :key="legalDocument.id"
                    class="flex justify-between py-2 items-center hover:text-blue-600 cursor-pointer"
                  >
                    <NuxtLink :to="`van-ban-phap-luat/${legalDocument.slug}`">
                      {{ legalDocument.title }}
                    </NuxtLink>
                    <Download
                      class="w-4 h-4"
                      @click="downloadFile(legalDocument.file)"
                    />
                  </li>
                </ul>

                <div class="mt-auto pt-5">
                  <NuxtLink
                    :to="'van-ban-phap-luat'"
                    class="inline-flex items-center gap-2 text-red-600 border border-red-500 rounded-full px-4 py-1.5 text-sm font-semibold transition-colors duration-300 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer"
                  >
                    XEM THÊM
                    <ChevronRight class="w-4 h-4" />
                  </NuxtLink>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>
