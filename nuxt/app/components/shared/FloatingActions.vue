<template>
  <div
    class="fixed bottom-4 left-4 z-50 flex items-center bg-[#f7ecda] rounded-full shadow-lg"
  >
    <div class="relative">
      <!-- Hiệu ứng ping -->
      <span class="absolute pulse-ring"></span>
      <img
        src="/images/call.png"
        alt="Hotline"
        class="relative z-10 w-12 h-12 rounded-full object-contain"
      />
    </div>
    <a href="tel:0966227979" class="text-red-600 font-bold text-md mx-2">
      0966.22.7979
    </a>
  </div>

  <div class="fixed bottom-4 right-4 flex flex-col gap-3 z-50">
    <!-- Zalo -->
    <a
      href="https://zalo.me/0964305701"
      target="_blank"
      class="shadow-lg rounded-full transition duration-300 ease-in-out hover:scale-110 animate-bounce"
    >
      <img src="/images/zalo.png" alt="Zalo" class="w-12 h-12 object-contain" />
    </a>

    <!-- Messenger -->
    <a
      href="https://m.me/your_facebook_username"
      target="_blank"
      class="shadow-lg rounded-full transition duration-300 ease-in-out hover:scale-110 animate-bounce"
    >
      <img
        src="/images/messenger.png"
        alt="Messenger"
        class="w-12 h-12 object-contain"
      />
    </a>

    <!-- Email -->
    <a
      href="mailto:your@email.com"
      target="_blank"
      class="shadow-lg rounded-full transition duration-300 ease-in-out hover:scale-110 animate-bounce"
    >
      <img
        src="/images/email.png"
        alt="Email"
        class="w-12 h-12 object-contain"
      />
    </a>

    <!-- Scroll to Top -->
    <button
      v-if="showTop"
      class="shadow-lg rounded-full transition duration-300 ease-in-out hover:scale-110"
      @click="scrollToTop"
    >
      <img
        src="/images/arrow-up.png"
        alt="Top"
        class="w-12 h-12 object-contain"
      />
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const showTop = ref(false);

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

const handleScroll = () => {
  showTop.value = window.scrollY > 300;
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
@keyframes ring-ping {
  0% {
    transform: scale(1);
    opacity: 0.8;
  }
  50% {
    transform: scale(1.5);
    opacity: 0.4;
  }
  100% {
    transform: scale(2);
    opacity: 0;
  }
}

.pulse-ring {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: #f43f5e; /* đỏ hồng */
  border-radius: 9999px;
  animation: ring-ping 1.2s infinite;
  z-index: 0;
}
</style>
