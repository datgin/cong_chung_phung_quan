<script setup>
const isMobileMenuOpen = ref(false);

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
  </div>
</template>
