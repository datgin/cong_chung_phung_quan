<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Pagination, Navigation, EffectFade } from "swiper/modules";
import "swiper/css";
import "swiper/css/autoplay";
import "swiper/css/pagination";
import "swiper/css/navigation";
import "swiper/css/effect-fade";
// import { ClientOnly } from "#components";
import { Download } from "lucide-vue-next";

const { getAll } = useApi();
const { $api } = useNuxtApp();

const banners = [
  "/images/banner1920x500.jpg",
  "/images/17492023546842b5b259e8f.jpg",
  "/images/banner1920x500.jpg",
];

const modules = [Autoplay, Pagination, Navigation, EffectFade];

const posts = ref([]);

const legalDocuments = ref([]);

const fetchLegalDocuments = async () => {
  legalDocuments.value = await getAll("legal-documents?page=home");
};

const fetchPosts = async () => {
  posts.value = await getAll("posts");
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

onMounted(() => {
  fetchLegalDocuments();
  fetchPosts();
});
</script>

<template>
  <div>
    <div class="relative w-full md:h-[500px] h-[110px]">
      <Swiper
        :modules="modules"
        :slides-per-view="1"
        :loop="true"
        :autoplay="{ delay: 3000, disableOnInteraction: false }"
        effect="fade"
        pagination
        navigation
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
        <div class="mb-8">
          <h2
            class="text-2xl font-bold text-gray-900 pl-4 border-l-4 border-red-500"
          >
            Tin tức nổi bật
          </h2>
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
                <h3
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Tin tức mới cập nhật
                </h3>
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
                <h3
                  class="text-lg font-bold text-gray-900 border-l-4 border-red-500 pl-3 mb-4 uppercase"
                >
                  Câu hỏi thường gặp
                </h3>

                <div class="mb-4">
                  <img
                    src="/images/cong_chung_di_chuc.png"
                    alt="câu hỏi thường gặp"
                    class="w-full h-55 object-cover mb-2 rounded"
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
