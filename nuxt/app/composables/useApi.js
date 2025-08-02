export const useApi = (resource) => {
  // eslint-disable-next-line no-undef
  const config = useRuntimeConfig();
  const baseUrl = `${config.public.API_BASE_URL}/${resource}`;

  const error = ref(null);
  const loading = ref(false);
  const data = ref([]);

  const getAll = async (options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $fetch(baseUrl, {
        method: "GET",
        ...options,
      });
      data.value = res;
      return res;
    } catch (err) {
      console.error(`[GET ALL] ${resource} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
    }
  };

  const getOne = async (id, options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $fetch(`${baseUrl}/${id}`, {
        method: "GET",
        ...options,
      });
      return res;
    } catch (err) {
      console.error(`[GET ONE] ${resource}/${id} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
    }
  };

  const post = async (body = {}, options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $fetch(baseUrl, {
        method: "POST",
        body,
        ...options,
      });
      return res;
    } catch (err) {
      console.error(`[POST] ${resource} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
    }
  };

  const put = async (id, body = {}, options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $fetch(`${baseUrl}/${id}`, {
        method: "PUT",
        body,
        ...options,
      });
      return res;
    } catch (err) {
      console.error(`[PUT] ${resource}/${id} error:`, err);
      error.value = err;
      return null;
    } finally {
      loading.value = false;
    }
  };

  const destroy = async (id, options = {}) => {
    loading.value = true;
    error.value = null;
    try {
      const res = await $fetch(`${baseUrl}/${id}`, {
        method: "DELETE",
        ...options,
      });
      return res;
    } catch (err) {
      console.error(`[DELETE] ${resource}/${id} error:`, err);
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
