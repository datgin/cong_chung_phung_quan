<script setup>
const { getAll } = useApi();

const faqs = ref([]);

const current = ref(1);
const total = ref(0);

const items = computed(() => [
  {
    label: "Câu hỏi thường gặp ",
  },
]);

const fetchFaqs = async (page = 1) => {
  try {
    const response = await getAll(`/faqs/?page=${page}&type=paginate`);

    faqs.value = response.data;
    current.value = response.current_page;
    total.value = response.total;
  } catch (err) {
    console.error("Lỗi gọi API:", err);
  }
};

onMounted(async () => {
  fetchFaqs();
});

watch(current, (page) => {
  console.log(page);
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
            Câu hỏi thường gặp
          </h2>

          <div v-for="(item, index) in faqs" :key="item.id">
            <div class="flex gap-4 group">
              <NuxtLink
                :to="`/cau-hoi-thuong-gap/${item.slug}`"
                class="w-28 sm:w-60 shrink-0"
              >
                <img
                  :src="item.thumbnail"
                  alt=""
                  class="w-full h-[100px] sm:h-[160px] object-cover group-hover:opacity-90 transition"
                />
              </NuxtLink>

              <div class="flex-1">
                <NuxtLink
                  :to="`/cau-hoi-thuong-gap/${item.slug}`"
                  class="text-base sm:text-lg font-medium text-gray-700 group-hover:text-red-600 transition"
                >
                  {{ item.title }}
                </NuxtLink>
                <!-- Mô tả: ẩn trên mobile -->
                <p
                  class="text-sm text-gray-600 mt-1 line-clamp-3 hidden sm:block"
                >
                  {{ truncateWords(item.excerpt, 50) }}
                </p>
              </div>
            </div>

            <!-- Chỉ hiển thị <hr> nếu không phải item cuối -->
            <hr
              v-if="index < faqs.length - 1"
              class="border-t border-gray-200 my-5"
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
