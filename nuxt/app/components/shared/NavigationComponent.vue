<template>
  <!-- Desktop Navigation -->
  <nav class="sticky top-0 z-50 bg-[#dd3333] text-white shadow hidden md:block">
    <div class="max-w-7xl mx-auto">
      <ul
        class="flex flex-wrap justify-center md:justify-start items-center gap-x-2 gap-y-1 text-sm"
      >
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="/" class="uppercase">Trang chủ</a>
        </li>
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="/" class="uppercase">Giới thiệu</a>
        </li>
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="#" class="uppercase">Thủ tục công chứng</a>
        </li>
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="#" class="uppercase">Danh mục công chứng</a>
        </li>
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="#" class="uppercase">Tính phí</a>
        </li>
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="#" class="uppercase">Thủ tục cấp sổ đỏ</a>
        </li>
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="#" class="uppercase">Văn bản pháp luật</a>
        </li>
        <li class="p-3 hover:bg-[#c12026] transition-colors">
          <a href="#" class="uppercase">Tin tức</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Mobile Slide-in Menu -->
  <div
    class="fixed inset-0 z-50 transition-transform duration-300 ease-in-out"
    :class="isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
  >
    <!-- Overlay -->
    <div
      class="absolute inset-0 bg-black opacity-30 transition-opacity duration-300 ease-in-out"
      @click="$emit('toggle-menu')"
    ></div>

    <!-- Menu -->
    <div class="relative w-72 bg-white h-full shadow-lg p-4 z-50">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Menu</h3>
        <button @click="$emit('toggle-menu')">
          <X class="w-6 h-6 text-gray-800" />
        </button>
      </div>
      <ul class="space-y-2 text-gray-800 text-base font-medium">
        <li><a href="/" class="block py-2">Giới thiệu</a></li>
        <li><a href="#" class="block py-2">Thủ tục công chứng</a></li>
        <li><a href="#" class="block py-2">Danh mục công chứng</a></li>
        <li><a href="#" class="block py-2">Tính phí</a></li>
        <li><a href="#" class="block py-2">Thủ tục cấp sổ đỏ</a></li>
        <li><a href="#" class="block py-2">Văn bản pháp luật</a></li>
        <li><a href="#" class="block py-2">Tin tức</a></li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { X } from "lucide-vue-next";

defineEmits(["toggle-menu"]);

defineProps({
  isMobileMenuOpen: { type: Boolean, default: false },
});
</script>

<style lang="scss" scoped></style>
