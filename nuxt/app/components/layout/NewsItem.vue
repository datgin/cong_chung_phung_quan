<template>
  <div
    v-for="post in filteredPosts"
    :key="post.id"
    class="bg-gray-50 rounded overflow-hidden shadow-sm hover:shadow-md transition"
  >
    <NuxtLink :to="`/news/${post.slug}`" class="block group">
      <div class="h-36 sm:h-40 md:h-48 overflow-hidden">
        <NuxtImg
          :src="post.image"
          :alt="post.title"
          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
        />
      </div>
      <div class="p-3">
        <p class="text-xs text-gray-400 mb-2 flex items-center">
          <CalendarDays class="w-4 h-4 me-1" />
          <span>
            {{ new Date(post.published_at).toLocaleDateString("vi-VN") }}
          </span>
        </p>
        <h3
          class="text-md font-semibold text-gray-800 group-hover:text-blue-800 transition line-clamp-2"
        >
          {{ post.title }}
        </h3>
        <p class="text-sm text-gray-600 mt-2">
          {{ truncateWords(post.excerpt, 35) }}
        </p>
      </div>
    </NuxtLink>
  </div>
</template>

<script setup>
import { CalendarDays } from "lucide-vue-next";

const props = defineProps({
  posts: { type: Array, default: () => [] },
  selectedCategory: { type: String, default: null },
});

const filteredPosts = computed(() => {
  if (!props.selectedCategory || props.selectedCategory === "Tất cả")
    return props.posts;
  return props.posts.filter((p) => p.category === props.selectedCategory);
});
</script>

<style scoped></style>
