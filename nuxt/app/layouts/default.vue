<script setup>
import { useLoadingStore } from "~/stores/loading";
import { useSettingStore } from "~/stores/setting";

const isMobileMenuOpen = ref(false);
const loadingStore = useLoadingStore();

const settingStore = useSettingStore();

onMounted(async () => {
  await settingStore.fetchSetting();
});

const toggleMenu = (val) => {
  isMobileMenuOpen.value = val;
};

watch(
  () => settingStore.setting,
  (setting) => {
    useHead({
      link: [{ rel: "icon", type: "image/png", href: setting.favicon }],
    });
  }
);
</script>

<template>
  <div>
    <HeaderComponent @toggle-menu="toggleMenu" />
    <NavigationComponent
      :is-mobile-menu-open="isMobileMenuOpen"
      @toggle-menu="toggleMenu"
    />
    <slot></slot>
    <FooterComponent />
    <FloatingActions />
    <FullPageLoader :visible="loadingStore.isLoading" />
  </div>
</template>
