ar
<script setup>
import { Phone, MapPin, Search, AlignJustify, X } from "lucide-vue-next";
import { nextTick, ref } from "vue";
import { useSettingStore } from "~/stores/setting";
const settingStore = useSettingStore();

const emit = defineEmits(["toggle-menu"]);

const isSearchOpen = ref(false);
const searchInput = ref(null);

const openBoxSearch = async () => {
  isSearchOpen.value = true;
  await nextTick();
  searchInput.value.focus();
};
</script>

<template>
  <header class="sticky md:static top-0 z-50 bg-white shadow">
    <!-- Top Bar -->
    <div class="text-gray-800 max-w-7xl mx-auto bg-white">
      <div
        class="py-3 flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
      >
        <!-- Mobile Top -->
        <div class="flex items-center justify-between md:hidden">
          <!-- Left: Menu -->
          <button class="p-3" @click="emit('toggle-menu', true)">
            <AlignJustify class="w-5 h-5 text-gray-800" />
          </button>

          <!-- Center: Logo -->
          <div class="w-1/2 flex justify-center">
            <NuxtImg src="/images/logo.png" alt="logo" class="object-contain" />
          </div>

          <!-- Right: Search -->
          <button class="p-3" @click="openBoxSearch">
            <Search class="w-5 h-5 text-gray-800" />
          </button>
        </div>

        <!-- Desktop -->
        <div class="hidden md:flex justify-between items-center w-full">
          <div
            class="w-[25%] h-[60px] flex items-center justify-center overflow-hidden"
          >
            <NuxtImg
              :src="settingStore.setting?.logo"
              alt="logo"
              class="object-contain w-full h-full"
            />
          </div>

          <div class="w-[25%]">
            <div class="flex items-center gap-2">
              <div class="rounded-full border-red-700 p-2 border-2">
                <Phone class="w-4 h-4 text-red-700" />
              </div>
              <div>
                <p>
                  <strong
                    >Hotline:
                    {{ formatPhone(settingStore.setting?.hotline) }}</strong
                  >
                </p>
                <p>Email: {{ settingStore.setting?.email }}</p>
              </div>
            </div>
          </div>

          <div class="w-[25%]">
            <div class="flex items-center gap-2">
              <div class="rounded-full border-red-700 p-2 border-2">
                <MapPin class="w-4 h-4 text-red-700" />
              </div>
              <div>
                <p>
                  <strong>Địa chỉ: </strong> {{ settingStore.setting?.address }}
                </p>
              </div>
            </div>
          </div>

          <!-- Search icon -->
          <div
            class="group hidden md:flex items-center border-1 border-gray-300 rounded-full p-2 cursor-pointer"
            @click="openBoxSearch"
          >
            <Search
              class="w-5 h-5 text-gray-600 cursor-pointer group-hover:text-red-600"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Search Modal Overlay -->
    <div
      v-if="isSearchOpen"
      class="fixed inset-0 z-70 flex items-center justify-center bg-black opacity-90 backdrop-blur-sm transition-opacity duration-300"
      @click="isSearchOpen = false"
    >
      <!-- Modal content -->
      <div
        class="relative z-50 bg-white rounded-md w-11/12 md:w-1/2 px-6 py-10 shadow-xl animate-fade-in cursor-default"
        @click.stop
      >
        <!-- Close Button -->
        <button
          class="absolute top-3 right-3 text-gray-500 hover:text-red-600 transition cursor-pointer"
          @click="isSearchOpen = false"
        >
          <X class="w-5 h-5" />
        </button>

        <!-- Search Input -->
        <div>
          <input
            ref="searchInput"
            type="text"
            placeholder="Nhập từ khóa tìm kiếm..."
            class="w-full border-b-2 border-gray-300 focus:border-red-500 outline-none text-md px-1 py-2 placeholder-gray-400 transition duration-200"
          />
        </div>
      </div>
    </div>
  </header>
</template>
