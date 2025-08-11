// @ts-check
import withNuxt from "./.nuxt/eslint.config.mjs";

export default withNuxt(
  // Your custom configs here
  {
    rules: {
      "vue/html-self-closing": [
        "error",
        {
          html: {
            void: "always",
            normal: "never", // ✅ Không yêu cầu self-close với <div>, <span>, ...
            component: "always",
          },
          svg: "always",
          math: "always",
        },
      ],
      "vue/no-v-html": "off",
    },
  }
);
