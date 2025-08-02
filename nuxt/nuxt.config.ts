import tailwindcss from "@tailwindcss/vite";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },
  css: ["~/assets/css/main.css"],
  // devServer: {
  //   host: "127.0.0.1",
  //   port: 3000,
  // },
  modules: [
    "@nuxt/eslint",
    "@nuxt/image",
    "@nuxt/ui",
    "@nuxtjs/google-fonts",
    "nuxt-swiper",
    "@ant-design-vue/nuxt",
  ],
  vite: {
    plugins: [tailwindcss()],
  },
  googleFonts: {
    families: {
      "Be+Vietnam+Pro": [100, 200, 300, 400, 500, 600, 700, 800, 900],
    },
    display: "swap",
  },
  components: [
    {
      path: "~/components",
      pathPrefix: false,
    },
  ],
  app: {
    head: {
      meta: [
        { charset: "utf-8" },
        { name: "viewport", content: "width=device-width, initial-scale=1" },
      ],
      link: [],
      script: [
        {
          src: "",
          type: "text/javascript",
        },
      ],
    },
  },
  runtimeConfig: {
    public: {
      API_BASE_URL: process.env.API_BASE_URL,
      LARAVEL_URL: process.env.LARAVEL_URL,
    },
  },
});
