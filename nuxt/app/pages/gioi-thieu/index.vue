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
              {{ introduction?.title }}
            </h1>
            <p class="text-sm text-gray-500">
              Ngày cập nhật gần đây:
              <span class="font-medium text-gray-600">
                {{
                  new Date(introduction?.updated_at).toLocaleDateString("vi-VN")
                }}
              </span>
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

<script setup>
import { sanitizeHTML } from "~/utils/sanitize";

const { getOne } = useApi();

const items = computed(() => [
  {
    label: "Giới thiệu",
  },
]);

const introduction = ref([]);

const fetchIntroduction = async () => {
  introduction.value = await getOne("introduction");
};

const safeContent = computed(() =>
  sanitizeHTML(introduction.value?.content || "")
);

onMounted(fetchIntroduction);
</script>

<style lang="scss" scoped></style>
