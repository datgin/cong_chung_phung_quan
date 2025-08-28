<template>
  <footer
    class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-slate-300"
  >
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <!-- Logo & Description -->
        <div class="order-1">
          <div class="mb-6">
            <h2
              class="text-3xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-4"
            >
              PHUNG QUAN
            </h2>
            <div
              class="w-12 h-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full mb-4"
            ></div>
            <div class="space-y-4">
              <div
                class="flex items-center gap-3 text-slate-400 hover:text-white transition-colors duration-200"
              >
                <div
                  class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center"
                >
                  <Mail class="w-4 h-4 text-blue-400" />
                </div>
                <div class="text-sm">
                  <div class="text-white">Email</div>
                  <div class="text-slate-400">
                    <a
                      :href="`mailto:${settingStore.setting?.email}`"
                      class="underline"
                      >{{ settingStore.setting?.email }}</a
                    >
                  </div>
                </div>
              </div>
              <div
                class="flex items-center gap-3 text-slate-400 hover:text-white transition-colors duration-200"
              >
                <div
                  class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center"
                >
                  <Phone class="w-4 h-4 text-green-400" />
                </div>
                <div class="text-sm">
                  <div class="text-white">Hotline</div>
                  <div class="text-slate-400">
                    <a
                      :href="`tel:${settingStore.setting?.hotline}`"
                      class="underline"
                    >
                      {{ formatPhone(settingStore.setting?.hotline) }}
                    </a>
                  </div>
                </div>
              </div>
              <div
                class="flex items-center gap-3 text-slate-400 hover:text-white transition-colors duration-200"
              >
                <div
                  class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center"
                >
                  <MapPin class="w-4 h-4 text-red-400" />
                </div>
                <div class="text-sm">
                  <div class="text-white">Địa chỉ</div>
                  <div class="text-slate-400">
                    {{ settingStore.setting?.address }}
                  </div>
                </div>
              </div>
              <div
                class="flex items-center gap-3 text-slate-400 hover:text-white transition-colors duration-200"
              >
                <div
                  class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center"
                >
                  <Clock class="w-4 h-4 text-purple-400" />
                </div>
                <div class="text-sm">
                  <div class="text-white">Giờ làm việc</div>
                  <div class="text-slate-400">
                    {{ settingStore.setting?.working_time }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Social Media -->
          <div class="flex gap-4">
            <a
              v-if="settingStore.setting?.url_facebook"
              :href="settingStore.setting?.url_facebook"
              target="_blank"
              class="w-10 h-10 bg-slate-800 border border-gray-100/10 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/25"
            >
              <Facebook class="w-5 h-5" />
            </a>
            <a
              v-if="settingStore.setting?.url_twitter"
              :href="settingStore.setting?.url_twitter"
              class="w-10 h-10 bg-slate-800 border border-gray-100/10 rounded-full flex items-center justify-center hover:bg-sky-500 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-sky-500/25"
            >
              <Twitter class="w-5 h-5" />
            </a>
            <a
              v-if="settingStore.setting?.url_youtobe"
              :href="settingStore.setting?.url_youtobe"
              class="w-10 h-10 bg-slate-800 border border-gray-100/10 rounded-full flex items-center justify-center hover:bg-red-700 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-red-500/25"
            >
              <Youtube class="w-5 h-5" />
            </a>
          </div>
        </div>

        <!-- Navigation -->
        <div class="order-2">
          <h3 class="text-white font-semibold text-lg mb-6 relative">
            Chuyên mục
            <div
              class="absolute -bottom-2 left-0 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full"
            ></div>
          </h3>
          <ul class="space-y-3">
            <li v-for="item in navigationItems" :key="item.href">
              <NuxtLink
                :to="item.href"
                class="text-slate-400 hover:text-white hover:translate-x-1 transition-all duration-200 flex items-center group uppercase"
              >
                <span
                  class="w-1 h-1 bg-blue-500 rounded-full mr-3 group-hover:w-2 transition-all duration-200"
                ></span>
                {{ item.label }}
              </NuxtLink>
            </li>
          </ul>
        </div>

        <!-- Tin tức nổi bật -->
        <div class="order-3">
          <h3 class="text-white font-semibold text-lg mb-6 relative">
            Tin mới
            <div
              class="absolute -bottom-2 left-0 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full"
            ></div>
          </h3>
          <ul class="space-y-4">
            <li
              v-for="post in highlightPosts"
              :key="post.id"
              class="border-b border-slate-700 pb-3"
            >
              <NuxtLink
                :to="`/${post.catalogue?.slug}/${post.slug}`"
                class="text-slate-300 hover:text-white transition-colors duration-200 block"
              >
                {{ post.title }}
              </NuxtLink>
              <p class="text-xs text-slate-500 mt-1 truncate">
                {{ post.excerpt }}
              </p>
            </li>
          </ul>
        </div>

        <!-- Google Maps -->
        <div class="order-4">
          <h3 class="text-white font-semibold text-lg mb-6 relative">
            Bản đồ
            <div
              class="absolute -bottom-2 left-0 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-cyan-500"
            ></div>
          </h3>
          <div class="overflow-hidden shadow-lg">
            <iframe
              class="w-full h-64 sm:h-48 md:h-40 border-0"
              loading="lazy"
              allowfullscreen
              referrerpolicy="no-referrer-when-downgrade"
              :src="settingStore.setting?.map"
            ></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-slate-700/50 bg-slate-900/50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3">
        <div
          class="flex flex-col md:flex-row justify-center items-center gap-4"
        >
          <p class="text-slate-400 text-sm">
            {{ settingStore.setting?.copyright }}
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import {
  Clock,
  Facebook,
  Mail,
  MapPin,
  Phone,
  Twitter,
  Youtube,
} from "lucide-vue-next";
import { ref } from "vue";
import { useSettingStore } from "~/stores/setting";
import { useMenuStore } from "@/stores/menu";

const { getAll } = useApi();

const menuStore = useMenuStore();

const settingStore = useSettingStore();

const navigationItems = ref([]);

watch(
  () => menuStore.allMenus,
  (val) => {
    navigationItems.value = val.map((menu) => ({
      href: menu.slug,
      label: menu.name,
    }));
  },
  { immediate: true }
);

const highlightPosts = ref([]);

const fetchPostsLatest = async () => {
  const posts = await getAll("posts/latest");
  highlightPosts.value = posts.slice(0, 3);
};

onMounted(fetchPostsLatest);
</script>
