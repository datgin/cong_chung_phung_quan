import { useLoadingStore } from "@/stores/loading";

export const useApi = () => {
  const { $api } = useNuxtApp();

  const error = ref(null);
  const loading = ref(false);
  const data = ref([]);

  const getAll = async (url, options = {}) => {
    const loadingStore = useLoadingStore();
    loadingStore.start();
    loading.value = true;
    error.value = null;
    try {
      const res = await $api.get(url, options);
      data.value = res.data?.data;
      return data.value;
    } catch (err) {
      console.error(`[GET ALL] ${url} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
      loadingStore.stop();
    }
  };

  const getOne = async (url, options = {}) => {
    const loadingStore = useLoadingStore();
    loadingStore.start();
    loading.value = true;
    error.value = null;
    try {
      const res = await $api.get(url, options);
      data.value = res.data?.data;
      return data.value;
    } catch (err) {
      console.error(`[GET ONE] ${url} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
      loadingStore.stop();
    }
  };

  const post = async (url, body = {}, options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $api.post(url, body, options);
      return res.data;
    } catch (err) {
      console.error(`[POST] ${url} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
    }
  };

  const put = async (url, body = {}, options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $api.put(url, body, options);
      return res.data;
    } catch (err) {
      console.error(`[PUT] ${url} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
    }
  };

  const destroy = async (url, options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $api.delete(url, options);
      return res.data;
    } catch (err) {
      console.error(`[DELETE] ${url} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
    }
  };

  return {
    data,
    error,
    loading,
    getAll,
    getOne,
    post,
    put,
    destroy,
  };
};
