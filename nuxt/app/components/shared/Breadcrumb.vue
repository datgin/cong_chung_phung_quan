<template>
  <nav aria-label="Breadcrumb" class="py-3 px-3 md:px-0">
    <ol
      class="flex items-center gap-1 text-sm text-gray-700 dark:text-gray-200 overflow-x-auto whitespace-nowrap no-scrollbar"
    >
      <!-- Trang chủ luôn luôn có -->
      <li>
        <NuxtLink
          to="/"
          class="block transition-colors text-[12px] hover:text-gray-900 dark:hover:text-white"
        >
          Trang chủ
        </NuxtLink>
      </li>

      <!-- Duyệt các mục breadcrumb -->
      <template v-for="(item, index) in items" :key="index">
        <!-- Icon phân cách -->
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

        <!-- Hiển thị breadcrumb item -->
        <li>
          <NuxtLink
            v-if="item.url"
            :to="item.url"
            class="block transition-colors text-[12px] hover:text-gray-900 dark:hover:text-white"
          >
            {{ item.label }}
          </NuxtLink>
          <span
            v-else
            class="block transition-colors font-medium text-[12px] text-gray-900 dark:text-white"
          >
            {{ item.label }}
          </span>
        </li>
      </template>
    </ol>
  </nav>
</template>

<script setup>
defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});
</script>
