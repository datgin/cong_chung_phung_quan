<template>
  <div class="error-page">
    <h1>Lỗi {{ error.statusCode }}</h1>
    <p>{{ error.message }}</p>
    <NuxtLink to="/">Quay lại trang chủ</NuxtLink>
  </div>
</template>

<script setup>
defineProps({
  error: Object,
});
</script>
