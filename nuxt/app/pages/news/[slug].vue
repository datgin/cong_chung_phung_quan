<script setup>
import { useRoute } from "vue-router";

const route = useRoute();
const slug = route.params.slug;
</script>

<template>
  <div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-4">Chi tiết bài viết</h1>
    <p>
      Đường dẫn bài viết: <strong>{{ slug }}</strong>
    </p>
    <!-- Tùy theo slug, bạn có thể fetch dữ liệu bài viết tại đây -->
  </div>
</template>
