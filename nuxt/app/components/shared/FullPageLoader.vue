<template>
  <transition name="fade">
    <div
      v-if="visible"
      class="fixed inset-0 bg-white/80 backdrop-blur-sm z-[9999] flex items-center justify-center"
    >
      <!-- SVG loading chuyển động kiểu sóng lan rộng -->
      <svg
        width="64"
        height="64"
        viewBox="0 0 100 100"
        class="text-blue-600"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
      >
        <circle cx="50" cy="50" r="0">
          <animate
            attributeName="r"
            values="0;40"
            dur="1.5s"
            repeatCount="indefinite"
            begin="0s"
            keySplines="0.2 0.8 0.2 1"
            calcMode="spline"
          />
          <animate
            attributeName="opacity"
            values="1;0"
            dur="1.5s"
            repeatCount="indefinite"
            begin="0s"
            keySplines="0.2 0.8 0.2 1"
            calcMode="spline"
          />
        </circle>
        <circle cx="50" cy="50" r="0">
          <animate
            attributeName="r"
            values="0;40"
            dur="1.5s"
            repeatCount="indefinite"
            begin="0.75s"
            keySplines="0.2 0.8 0.2 1"
            calcMode="spline"
          />
          <animate
            attributeName="opacity"
            values="1;0"
            dur="1.5s"
            repeatCount="indefinite"
            begin="0.75s"
            keySplines="0.2 0.8 0.2 1"
            calcMode="spline"
          />
        </circle>
      </svg>
    </div>
  </transition>
</template>

<script setup>
defineProps({
  visible: Boolean,
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
