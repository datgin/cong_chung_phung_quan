<script setup>
import { useRoute } from "vue-router";
const { getOne } = useApi();

// Dữ liệu demo
const slides = [
  {
    title: "Công chứng văn bản thỏa thuận tài sản vợ chồng",
    image:
      "https://image.congchungnguyenhue.com/300x170/2025/02/06/cong_chung_hop_dong_tang_cho_quyen_su_dung_dat_0602153931.jpg",
    url: "/cong-chung-tai-san-vo-chong",
  },
  {
    title: "Ủy quyền sang tên sổ đỏ",
    image:
      "https://image.congchungnguyenhue.com/300x170/2025/02/06/dich_thuat_cong_chung_0602152615.jpg",
    url: "/uy-quyen-sang-ten",
  },
];

const latestPosts = [
  {
    title: "Hợp đồng ủy quyền: Rủi ro tiềm ẩn và giải pháp từ góc nhìn thực tế",
    image:
      "https://image.congchungnguyenhue.com/200x128/2025/06/24/5_0203005402_2406170525.jpg",
    url: "/hop-dong-uy-quyen",
  },
  {
    title: "TUYỂN DỤNG CÔNG CHỨNG VIÊN – LÀM VIỆC TẠI HÀ NỘI",
    image:
      "https://image.congchungnguyenhue.com/200x128/2025/06/24/5_0203005402_2406170525.jpg",
    url: "/tuyen-dung-cong-chung",
  },
  {
    title: "Di sản thừa kế là cổ phần, phần vốn góp: Cách xử lý?",
    image:
      "https://image.congchungnguyenhue.com/200x128/2025/06/24/5_0203005402_2406170525.jpg",
    url: "/co-phan-phan-von-gop",
  },
];

const procedures = [
  {
    title: "Thủ tục công chứng Hợp đồng Mua bán, chuyển nhượng nhà đất",
    description:
      "Thủ tục công chứng hợp đồng Mua bán, chuyển nhượng nhà/đất. A. GIẤY TỜ BÊN BÁN CẦN CUNG CẤP...",
    image:
      "https://image.congchungnguyenhue.com/260x160/2025/02/11/thu_tuc_cong_chung_hop_dong_mua_ban,_chuyen_nhuong_nha_dat_1102092047.jpg",
    url: "/thu-tuc-hop-dong-mua-ban",
  },
  {
    title: "Thủ tục công chứng văn bản từ chối nhận di sản thừa kế",
    description:
      "CÁC GIẤY TỜ CẦN CUNG CẤP - Trong trường hợp bên từ chối là người Việt Nam...",
    image:
      "https://image.congchungnguyenhue.com/260x160/2025/02/11/thu_tuc_cong_chung_hop_dong_mua_ban,_chuyen_nhuong_nha_dat_1102092047.jpg",
    url: "/tu-choi-thua-ke",
  },
  // Thêm các thủ tục khác tương tự...
];

const route = useRoute();
const slug = route.params.slug;

const title = ref("");

const current = ref(1);

const items = computed(() => [
  {
    label: title.value,
  },
]);

onMounted(async () => {
  try {
    const result = await getOne(`/catalogues/${slug}`);
    title.value = result.name;
  } catch (err) {
    console.error("Lỗi gọi API:", err);
  }
});

const fetch = async () => {
  try {
    const result = await getOne(`/catalogues/${slug}`);

    title.value = result.name;
  } catch (err) {
    console.error("Lỗi gọi API:", err);
  }
};

watch(current, (page) => {
  console.log(page);
  
});

onMounted(() => {
  fetch();
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
            Thủ tục công chứng
          </h2>

          <div v-for="(item, index) in procedures" :key="index">
            <div class="flex gap-4 group">
              <a :href="item.url" class="w-28 sm:w-60 shrink-0">
                <img
                  :src="item.image"
                  alt=""
                  class="w-full h-[100px] sm:h-[160px] object-cover group-hover:opacity-90 transition"
                />
              </a>
              <div class="flex-1">
                <a
                  :href="item.url"
                  class="text-base sm:text-lg font-medium text-gray-700 group-hover:text-red-600 transition"
                >
                  {{ item.title }}
                </a>
                <!-- Mô tả: ẩn trên mobile -->
                <p
                  class="text-sm text-gray-600 mt-1 line-clamp-3 hidden sm:block"
                >
                  {{ item.description }}
                </p>
              </div>
            </div>

            <!-- Chỉ hiển thị <hr> nếu không phải item cuối -->
            <hr
              v-if="index < procedures.length - 1"
              class="border-t border-gray-200 my-5"
            />
          </div>

          <div class="mt-6 flex justify-end">
            <a-pagination
              v-model:current="current"
              :total="50"
              show-less-items
            />
          </div>
        </div>
      </div>

      <!-- Cột chiếm 3 phần -->
      <div class="md:col-span-3 space-y-5 px-3 md:px-0">
        <SidebarRight :slides="slides" :latest-posts="latestPosts" />
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
