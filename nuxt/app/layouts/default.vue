<script setup>
import { useLoadingStore } from "~/stores/loading";
import { useSettingStore } from "~/stores/setting";

const isMobileMenuOpen = ref(false);
const loadingStore = useLoadingStore();

const settingStore = useSettingStore();
const url = useRequestURL();

onMounted(async () => {
  await settingStore.fetchSetting();
});

const toggleMenu = (val) => {
  isMobileMenuOpen.value = val;
};

watch(
  () => settingStore.setting,
  (setting) => {
    if (!setting) return;

    useHead({
      link: [{ rel: "icon", type: "image/png", href: setting.favicon }],
    });

    useSeoMeta({
      title: setting.title,
      description: setting.meta_description,
      ogTitle: setting.meta_title,
      ogDescription: setting.meta_description,
      ogImage: setting.logo,
      ogUrl: url.href,
    });
  },
  { immediate: true }
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
