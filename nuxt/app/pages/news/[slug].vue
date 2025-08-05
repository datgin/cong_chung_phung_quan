<script setup>
import { useRoute } from "vue-router";

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

const route = useRoute();
const slug = route.params.slug;
console.log(slug);
</script>

<template>
  <div class="max-w-7xl mx-auto pb-10">
    <nav aria-label="Breadcrumb" class="py-3 px-3 md:px-0">
      <ol
        class="flex items-center gap-1 text-sm text-gray-700 dark:text-gray-200 overflow-x-auto whitespace-nowrap no-scrollbar"
      >
        <li>
          <a
            href="#"
            class="block transition-colors text-[12px] hover:text-gray-900 dark:hover:text-white"
          >
            Home
          </a>
        </li>

        <li class="rtl:rotate-180">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="m9 20.247 6-16.5"
            />
          </svg>
        </li>

        <li>
          <a
            href="#"
            class="block transition-colors text-[12px] hover:text-gray-900 dark:hover:text-white"
          >
            Sao y chứng thực giấy tờ - Tài liệu
          </a>
        </li>

        <li class="rtl:rotate-180">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="m9 20.247 6-16.5"
            />
          </svg>
        </li>

        <li>
          <a
            href="#"
            class="block transition-colors font-medium text-[12px] hover:text-gray-900 dark:hover:text-white"
          >
            Sao y chứng thực giấy tờ - Tài liệu
          </a>
        </li>
      </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
      <!-- Cột chiếm 9 phần -->
      <div class="md:col-span-9 px-3 md:px-0">
        <div
          class="bg-white rounded shadow-md p-3 space-y-6 border border-gray-100"
        >
          <!-- Tiêu đề & ngày đăng -->
          <div class="space-y-1">
            <h1 class="text-2xl font-bold text-gray-900">
              Hướng dẫn sử dụng hệ thống quản lý nội dung
            </h1>
            <p class="text-sm text-gray-500">
              Đăng ngày:
              <span class="font-medium text-gray-600">04/08/2025</span>
            </p>
          </div>

          <hr class="border-gray-200" />

          <!-- Nội dung chính -->
          <div class="prose max-w-none text-gray-800">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
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
