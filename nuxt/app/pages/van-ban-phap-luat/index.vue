<script setup>
import { Download } from "lucide-vue-next";

const { getAll } = useApi();
const { $api } = useNuxtApp();

const current = ref(1);
const total = ref(0);

const items = computed(() => [
  {
    label: "Văn bản pháp luật",
  },
]);

const legalDocuments = ref([]);

const fetchLegalDocuments = async (page = 1) => {
  try {
    const response = await getAll(`legal-documents?page=${page}&type=paginate`);

    legalDocuments.value = response.data;
    current.value = response.current_page;
    total.value = response.total;
  } catch (error) {
    console.log(error);
    message.error("Đã có lỗi ra, vui lòng thử lại sau!");
  }
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

onMounted(fetchLegalDocuments);

watch(current, (page) => {
  fetchLegalDocuments(page);
});
</script>

<template>
  <div class="max-w-7xl mx-auto pb-10">
    <Breadcrumb :items="items" />

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
      <!-- Cột chiếm 9 phần -->
      <div class="md:col-span-9 px-3 md:px-0">
        <div>
          <h2
            class="text-xl font-bold text-gray-800 uppercase heading-line mb-8"
          >
            Văn bản pháp luật
          </h2>

          <div v-for="(item, index) in legalDocuments" :key="item.id">
            <div class="flex gap-4 group justify-between items-center">
              <NuxtLink
                :to="`/van-ban-phap-luat/${item.slug}`"
                class="text-base text-md text-gray-500 group-hover:text-red-600 transition"
              >
                {{ item.title }}
              </NuxtLink>

              <button
                class="flex items-center bg-gray-100 hover:bg-gray-200 rounded-full py-2 px-3 cursor-pointer"
                @click="downloadFile(item.file)"
              >
                Tải về <Download class="w-4 h-4 ms-2" />
              </button>
            </div>

            <!-- Chỉ hiển thị <hr> nếu không phải item cuối -->
            <hr
              v-if="index < legalDocuments.length - 1"
              class="border-t border-gray-200 my-3"
            />
          </div>

          <div v-if="total > 10" class="mt-6 flex justify-end">
            <a-pagination
              v-model:current="current"
              :total="total"
              show-less-items
            />
          </div>
        </div>
      </div>

      <!-- Cột chiếm 3 phần -->
      <div class="md:col-span-3 space-y-5 px-3 md:px-0">
        <SidebarRight />
      </div>
    </div>
  </div>
</template>

<style>
.swiper-button-next,
.swiper-button-prev {
  color: white;
  background-color: rgba(0, 0, 0, 0.5);
  width: 32px;
  height: 32px;
  border-radius: 9999px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s ease;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

.swiper-button-next::after,
.swiper-button-prev::after {
  font-size: 16px;
  font-weight: bold;
}

.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
