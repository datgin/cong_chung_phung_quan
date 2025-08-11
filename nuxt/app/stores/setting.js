import { defineStore } from "pinia";

export const useSettingStore = defineStore("setting", {
  state: () => ({
    setting: null,
  }),
  actions: {
    async fetchSetting() {
      // eslint-disable-next-line no-undef
      const { getOne } = useApi();
      const res = await getOne("settings");

      this.setting = res;
    },
  },
});
