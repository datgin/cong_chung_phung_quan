// plugins/axios.js
import axios from "axios";

export default defineNuxtPlugin(() => {
  const config = useRuntimeConfig();

  const api = axios.create({
    baseURL: config.public.API_BASE_URL,
    headers: {
      Accept: "application/json",
    },
  });

  api.interceptors.request.use((request) => {
    const token = useCookie("auth_token").value;
    if (token) {
      request.headers.Authorization = `Bearer ${token}`;
    }
    return request;
  });

  api.interceptors.response.use(
    (response) => response,
    (error) => {
      console.error("API error:", error.response?.status, error.response?.data);
      return Promise.reject(error);
    }
  );

  return {
    provide: {
      api,
    },
  };
});
