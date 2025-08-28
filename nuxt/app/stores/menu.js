import { defineStore } from "pinia";
import { ref, nextTick } from "vue";

export const useMenuStore = defineStore("menu", () => {
  const { getAll } = useApi();

  const defaultMenus = [
    { id: "home", name: "Trang chủ", slug: "/" },
    { id: "gioi-thieu", name: "Giới thiệu", slug: "/gioi-thieu" },
    { id: "tinh-phi", name: "Tính phí", slug: "/tinh-phi" },
    {
      id: "van-ban-phap-luat",
      name: "Văn bản pháp luật",
      slug: "/van-ban-phap-luat",
    },
    {
      id: "cau-hoi-thuong-gap",
      name: "Câu hỏi thường gặp",
      slug: "/cau-hoi-thuong-gap",
    },
    { id: "lien-he", name: "Liên hệ", slug: "/lien-he" },
  ];

  const allMenus = ref([]);

  const fetchMenus = async () => {
    try {
      const result = await getAll("/catalogues");
      allMenus.value = [
        defaultMenus[0],
        defaultMenus[1],
        defaultMenus[2],
        ...result.map((c) => ({
          id: `cat-${c.id}`,
          name: c.name,
          slug: `/${c.slug}`,
        })),
        defaultMenus[3],
        defaultMenus[4],
        defaultMenus[5],
      ];
      await nextTick();
    } catch (err) {
      console.error("Lỗi gọi API:", err);
    }
  };

  return {
    defaultMenus,
    allMenus,
    fetchMenus,
  };
});
