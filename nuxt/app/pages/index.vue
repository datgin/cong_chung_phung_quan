<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/autoplay";
import { ClientOnly } from "#components";
import { Download } from "lucide-vue-next";
import axios from "axios";
// import { useApi } from "~/composables/useApi";

// const { getAll } = useApi("");

const fetchData = async () => {
  const response = await axios.get("http://127.0.0.1:8000/api/test");
  console.log(response);
};

onMounted(() => {
  fetchData();
});

const selectedCategory = ref("Tất cả");

const banners = [
  "/images/banner1920x500.jpg",
  "/images/banner1920x500.jpg",
  "/images/banner1920x500.jpg",
];

const posts = [
  {
    id: 1,
    title: "Hướng dẫn học Nuxt 3 bài bản",
    slug: "hoc-nuxt-3-bai-ban",
    image: "/images/cong_chung_di_chuc.png",
    category: "Lập trình",
    published_at: "2025-07-29",
    excerpt:
      "Bài viết hướng dẫn bạn làm quen với Nuxt 3 một cách dễ hiểu và dễ áp dụng.",
  },
  {
    id: 2,
    title: "Top 10 font chữ đẹp cho website hiện đại",
    slug: "font-chu-dep-cho-website",
    image: "/images/cong_chung_di_chuc.png",
    category: "SEO",
    published_at: "2025-07-25",
    excerpt:
      "Gợi ý các font chữ hiện đại, tinh tế, dễ đọc cho thiết kế UI web hiện nay.",
  },
  {
    id: 3,
    title: "Top 10 font chữ đẹp cho website hiện đại",
    slug: "font-chu-dep-cho-website",
    image: "/images/cong_chung_di_chuc.png",
    category: "Thiết kế",
    published_at: "2025-07-25",
    excerpt:
      "Gợi ý các font chữ hiện đại, tinh tế, dễ đọc cho thiết kế UI web hiện nay.",
  },
  {
    id: 4,
    title: "Top 10 font chữ đẹp cho website hiện đại",
    slug: "font-chu-dep-cho-website",
    image: "/images/cong_chung_di_chuc.png",
    category: "Tin tức",
    published_at: "2025-07-25",
    excerpt:
      "Gợi ý các font chữ hiện đại, tinh tế, dễ đọc cho thiết kế UI web hiện nay.",
  },
];

const categories = ["Tất cả", "Lập trình", "Thiết kế", "SEO", "Tin tức"];

// const config = useRuntimeConfig();
// console.log(config.public.apiBase);
</script>

<template>
  <div>
    <div class="relative w-full md:h-[500px] h-[110px]">
      <Swiper
        :modules="[Autoplay]"
        :slides-per-view="1"
        :loop="true"
        :autoplay="{ delay: 3000 }"
        class="w-full h-full"
      >
        <SwiperSlide
          v-for="(img, index) in banners"
          :key="index"
          class="w-full h-full"
        >
          <NuxtImg :src="img" alt="banner" class="w-full h-full object-cover" />
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
        <div
          class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4"
        >
          <h2 class="text-2xl font-bold text-gray-900">Tin tức nổi bật</h2>

          <!-- Nút lọc (Desktop) -->
          <div class="flex-wrap gap-2 hidden md:flex">
            <button
              v-for="cat in categories"
              :key="cat"
              :class="[
                'px-4 py-1.5 rounded-full border border-gray-300 text-sm font-medium transition-all duration-200',
                selectedCategory === cat
                  ? 'bg-blue-600 text-white shadow-lg'
                  : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-blue-600 cursor-pointer',
              ]"
              @click="selectedCategory = cat"
            >
              {{ cat }}
            </button>
          </div>

          <!-- Dropdown lọc (Mobile) -->
          <div class="block md:hidden">
            <ClientOnly>
              <a-select v-model:value="selectedCategory" class="w-full">
                <a-select-option
                  v-for="cat in categories"
                  :key="cat"
                  :value="cat"
                  >{{ cat }}</a-select-option
                >
              </a-select>
            </ClientOnly>
          </div>
        </div>

        <!-- Grid -->
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
          <NewsItem :posts="posts" :selected-category="selectedCategory" />
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
                <h3
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Tin tức mới cập nhật
                </h3>
                <div class="mb-4">
                  <img
                    src="/images/cong_chung_di_chuc.png"
                    alt="tin mới"
                    class="w-full h-40 object-cover rounded-md mb-2"
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
                  <li class="flex gap-3 items-start py-2">
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
                <h3
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Câu hỏi thường gặp
                </h3>

                <div class="mb-4">
                  <img
                    src="/images/cong_chung_di_chuc.png"
                    alt="câu hỏi thường gặp"
                    class="w-full h-40 object-cover rounded-md mb-2"
                  />
                  <p class="font-semibold text-gray-800">
                    Thủ tục công chứng mua bán nhà đất cần những giấy tờ gì?
                  </p>
                </div>

                <ul class="space-y-3 text-sm text-gray-700">
                  <li
                    class="flex gap-3 items-start border-b border-gray-300 py-2"
                  >
                    <img
                      src="/images/cong_chung_di_chuc.png"
                      class="w-12 h-10 object-cover rounded"
                    />
                    <div>
                      <p class="text-gray-800">
                        Di chúc không công chứng có được coi là hợp pháp?
                      </p>
                    </div>
                  </li>
                  <li
                    class="flex gap-3 items-start border-b border-gray-300 py-2"
                  >
                    <img
                      src="/images/cong_chung_di_chuc.png"
                      class="w-12 h-10 object-cover rounded"
                    />
                    <div>
                      <p class="text-gray-800">
                        Di chúc không công chứng có được coi là hợp pháp?
                      </p>
                    </div>
                  </li>
                  <li class="flex gap-3 items-start py-2">
                    <img
                      src="/images/cong_chung_di_chuc.png"
                      class="w-12 h-10 object-cover rounded"
                    />
                    <div>
                      <p class="text-gray-800">
                        Di chúc không công chứng có được coi là hợp pháp?
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

              <!-- Văn bản pháp luật -->
              <div class="bg-white rounded-lg shadow p-5 flex flex-col">
                <h3
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Văn bản pháp luật
                </h3>

                <div class="mb-4">
                  <img
                    src="/images/cong_chung_di_chuc.png"
                    alt="Văn bản pháp luật"
                    class="w-full h-40 object-cover rounded-md"
                  />
                </div>

                <ul class="divide-y divide-gray-200 text-sm text-gray-800">
                  <li
                    class="flex justify-between py-2 items-center hover:text-blue-600 cursor-pointer"
                  >
                    Luật kinh doanh bất động sản 2014
                    <Download class="w-4 h-4" />
                  </li>
                  <li
                    class="flex justify-between py-2 items-center hover:text-blue-600 cursor-pointer"
                  >
                    Luật quốc tịch 2008
                    <Download class="w-4 h-4" />
                  </li>
                  <li
                    class="flex justify-between py-2 items-center hover:text-blue-600 cursor-pointer"
                  >
                    Luật tố tụng dân sự 2015
                    <Download class="w-4 h-4" />
                  </li>
                  <li
                    class="flex justify-between py-2 items-center hover:text-blue-600 cursor-pointer"
                  >
                    Luật Đất Đai 2013
                    <Download class="w-4 h-4" />
                  </li>
                  <li
                    class="flex justify-between py-2 items-center hover:text-blue-600 cursor-pointer"
                  >
                    Bộ luật Dân sự 2015
                    <Download class="w-4 h-4" />
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
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>
