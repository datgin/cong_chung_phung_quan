<template>
  <div>
    <!-- Desktop Navigation -->
    <nav
      class="sticky top-0 z-50 bg-[#104A86] text-white shadow hidden md:block"
    >
      <div class="max-w-7xl mx-auto">
        <ul
          ref="navRef"
          class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm"
        >
          <!-- Menu hiển thị trực tiếp -->
          <li
            v-for="menu in visibleMenus"
            :key="menu.id"
            class="p-3 hover:bg-[#c12026] transition-colors menu-item"
          >
            <NuxtLink :to="menu.slug" class="uppercase">{{
              menu.name
            }}</NuxtLink>
          </li>

          <!-- Xem thêm -->
          <li
            v-if="overflowMenus.length"
            class="relative group p-3 hover:bg-[#c12026] transition-colors"
          >
            <span class="uppercase cursor-pointer select-none">
              Xem thêm
              <ChevronDown class="w-4 h-4 inline-block" />
            </span>
            <ul
              class="absolute left-0 top-full hidden group-hover:block bg-white text-black shadow-lg min-w-[200px] z-50"
            >
              <li
                v-for="menu in overflowMenus"
                :key="menu.id"
                class="hover:bg-gray-100"
              >
                <NuxtLink :to="menu.slug" class="block px-4 py-2">{{
                  menu.name
                }}</NuxtLink>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Mobile Slide-in Menu -->
    <div
      class="fixed inset-0 z-50 transition-transform duration-300 ease-in-out md:hidden"
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
          <li v-for="menu in allMenus" :key="menu.id">
            <NuxtLink
              :to="menu.slug"
              class="block py-2"
              @click="$emit('toggle-menu')"
              >{{ menu.name }}</NuxtLink
            >
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { X, ChevronDown } from "lucide-vue-next";
import { useMenuStore } from "@/stores/menu";

defineEmits(["toggle-menu"]);
defineProps({
  isMobileMenuOpen: { type: Boolean, default: false },
});

const menuStore = useMenuStore();

const navRef = ref(null);
const allMenus = ref([]);
const visibleMenus = ref([]);
const overflowMenus = ref([]);

let resizeObserver = null;

watch(
  () => menuStore.allMenus,
  (val) => {
    allMenus.value = val;
    if (val.length) {
      calculateVisibleMenus();
    }
  },
  { immediate: true }
);

const calculateVisibleMenus = async () => {
  if (!navRef.value) return;

  // đợi font load để đo chính xác (nếu browser hỗ trợ)
  if (document.fonts && document.fonts.ready) {
    try {
      await document.fonts.ready;
    } catch (e) {
      console.log(e);
      /* ignore */
    }
  }

  const containerWidth = navRef.value.getBoundingClientRect().width;
  if (!containerWidth) return;

  // tạo container ẩn giống cấu trúc thật (flex + gap)
  const measure = document.createElement("ul");
  measure.className = "flex gap-x-2 whitespace-nowrap"; // tailwind classes áp dụng nếu có
  measure.style.position = "absolute";
  measure.style.visibility = "hidden";
  measure.style.left = "-9999px";
  measure.style.top = "0";
  document.body.appendChild(measure);

  // đo chỗ dành cho "Xem thêm" (cộng 1 ít buffer cho icon)
  const xemLi = document.createElement("li");
  xemLi.className = "p-3 uppercase menu-item";
  xemLi.innerText = "Xem thêm";
  measure.appendChild(xemLi);
  const xemWidth = xemLi.getBoundingClientRect().width + 12; // thêm buffer cho chevron
  measure.removeChild(xemLi);

  const tempVisible = [];
  const tempOverflow = [];
  let broke = false;

  for (let i = 0; i < allMenus.value.length; i++) {
    const menu = allMenus.value[i];

    // tạo li + a giống DOM thật để có cùng kích thước
    const li = document.createElement("li");
    li.className = "p-3 menu-item";
    const a = document.createElement("a");
    a.className = "uppercase";
    a.innerText = menu.name;
    li.appendChild(a);

    measure.appendChild(li);

    const totalWidth = measure.getBoundingClientRect().width;

    const safetyBuffer = 8; // phòng trường hợp margin/scrollbar
    if (!broke && totalWidth + xemWidth + safetyBuffer <= containerWidth) {
      tempVisible.push(menu);
    } else {
      // lần đầu gặp overflow thì push current và phần còn lại vào overflow
      broke = true;
      tempOverflow.push(menu);
      // push rest quickly
      for (let j = i + 1; j < allMenus.value.length; j++)
        tempOverflow.push(allMenus.value[j]);
      break;
    }
  }

  document.body.removeChild(measure);

  visibleMenus.value = tempVisible;
  overflowMenus.value = tempOverflow;
};

onMounted(async () => {
  if (window.ResizeObserver) {
    resizeObserver = new ResizeObserver(() => {
      requestAnimationFrame(() => {
        calculateVisibleMenus();
      });
    });
    if (navRef.value) resizeObserver.observe(navRef.value);
  }
});

onBeforeUnmount(() => {
  if (resizeObserver && navRef.value) {
    resizeObserver.unobserve(navRef.value);
    resizeObserver.disconnect();
  }
  window.removeEventListener("resize", calculateVisibleMenus);
});
</script>

<style scoped>
.group:hover ul {
  display: block;
}
</style>
