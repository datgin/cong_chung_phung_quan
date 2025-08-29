<template>
  <div
    v-for="post in posts"
    :key="post.id"
    class="bg-gray-50 overflow-hidden shadow-sm hover:shadow-md transition"
  >
    <NuxtLink :to="`/${post.catalogue?.slug}/${post.slug}`" class="block group">
      <!-- Mobile: flex-row (ảnh trái, text phải) / Desktop: ảnh trên, text dưới -->
      <div class="flex flex-row md:flex-col">
        <!-- Ảnh -->
        <div class="w-1/3 md:w-full h-28 md:h-48 overflow-hidden">
          <NuxtImg
            :src="post.thumbnail"
            :alt="post.title"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
          />
        </div>

        <!-- Nội dung -->
        <div class="p-3 flex-1">
          <h3
            class="text-sm md:text-md font-semibold text-gray-800 group-hover:text-blue-800 transition line-clamp-2"
          >
            {{ post.title }}
          </h3>
        </div>
      </div>
    </NuxtLink>
  </div>
</template>

<script setup>
import { CalendarDays } from "lucide-vue-next";

defineProps({
  posts: { type: Array, default: () => [] },
});
</script>

<style scoped></style>
