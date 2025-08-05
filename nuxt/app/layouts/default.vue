<script setup>
import { useLoadingStore } from "~/stores/loading";

const isMobileMenuOpen = ref(false);
const loadingStore = useLoadingStore();

const toggleMenu = (val) => {
  isMobileMenuOpen.value = val;
};
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
