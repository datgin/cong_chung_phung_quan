<script setup>
import { useRoute } from "vue-router";
import { sanitizeHTML } from "~/utils/sanitize";

const { getOne } = useApi();

const route = useRoute();
const slug = route.params.postSlug;

const post = ref(null);

const url = useRequestURL();

const getPost = async () => {
  post.value = await getOne(`posts/${slug}`);
};

const items = computed(() => [
  {
    label: post.value?.catalogue?.name || "Tin tức",
    url: "123",
  },
  {
    label: post.value?.title,
  },
]);

watch(
  () => post.value,
  (post) => {
    if (!post) return;

    useSeoMeta({
      title: post.title,
      meta: [
        {
          name: "description",
          content: post.meta_description || "Mô tả mặc định",
        },
        { property: "og:title", content: post.meta_title },
        { property: "og:description", content: post.meta_description },
        { property: "og:image", content: post.thumbnail },
        { property: "og:url", content: url.href },
      ],
    });
  },
  { immediate: true }
);

onMounted(getPost);

const safeContent = computed(() => sanitizeHTML(post.value?.content || ""));
</script>

<template>
  <div class="max-w-7xl mx-auto pb-10">
    <Breadcrumb :items="items" />

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
      <!-- Cột chiếm 9 phần -->
      <div class="md:col-span-9 px-3 md:px-0">
        <div
          class="bg-white rounded shadow-md p-3 space-y-6 border border-gray-100"
        >
          <!-- Tiêu đề & ngày đăng -->
          <div class="space-y-1">
            <h1 class="text-2xl font-bold text-gray-900">
              {{ post?.title }}
            </h1>
            <p class="text-sm text-gray-500">
              Đăng ngày:
              <span class="font-medium text-gray-600">
                {{ new Date(post?.published_at).toLocaleDateString("vi-VN") }}
              </span>
            </p>
            <p>
              {{ post?.excerpt }}
            </p>
          </div>

          <hr class="border-gray-200" />

          <!-- Nội dung chính -->
          <ClientOnly>
            <div
              class="prose max-w-none text-gray-800 leading-relaxed space-y-4"
              v-html="safeContent"
            ></div>
          </ClientOnly>
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
.prose img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.prose span.image-caption {
  display: block;
  font-size: 12px;
  line-height: 22px;
  font-style: italic;
  text-align: center;
  color: #666;
  margin-top: 10px;
}
</style>
