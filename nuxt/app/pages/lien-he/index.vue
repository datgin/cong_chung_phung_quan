<template>
  <div class="max-w-7xl mx-auto pb-10">
    <Breadcrumb :items="[{ label: 'Liên hệ' }]" />
    <div
      class="bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2"
    >
      <!-- Left: Map + Info -->
      <section
        class="p-6 md:p-8 bg-gradient-to-b from-white bg-slate-50 to-slate-50 shadow"
      >
        <h1 class="text-2xl font-semibold text-slate-800 mb-4">
          Liên hệ chúng tôi
        </h1>

        <div
          class="rounded-xl overflow-hidden border border-slate-100 shadow-sm"
        >
          <!-- Map: sử dụng iframe Google Maps (thay src bằng vị trí của bạn) -->
          <iframe
            class="w-full h-52 md:h-64 border-0"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen=""
            :src="settingStore.setting?.map"
          ></iframe>

          <div class="p-2 md:p-4">
            <ul class="space-y-4">
              <li class="flex items-center gap-3">
                <div class="p-2 rounded-full bg-sky-100 text-sky-600">
                  <MapPinHouse class="w-5 h-5" />
                </div>
                <div>
                  <div class="text-sm font-semibold text-slate-700">
                    Địa chỉ
                  </div>
                  <div class="text-sm text-slate-500">
                    {{ settingStore.setting?.address }}
                  </div>
                </div>
              </li>

              <li class="flex items-center gap-3">
                <div class="p-2 rounded-full bg-emerald-100 text-emerald-600">
                  <Mails class="w-5 h-5" />
                </div>
                <div>
                  <div class="text-sm font-semibold text-slate-700">Email</div>
                  <div class="text-sm text-slate-500">
                    <a
                      :href="`mailto:${settingStore.setting?.email}`"
                      class="underline"
                    >
                      {{ settingStore.setting?.email }}
                    </a>
                  </div>
                </div>
              </li>

              <li class="flex items-center gap-3">
                <div class="p-2 rounded-full bg-orange-100 text-orange-600">
                  <Phone class="w-5 h-5" />
                </div>
                <div>
                  <div class="text-sm font-semibold text-slate-700">
                    Điện thoại
                  </div>
                  <div class="text-sm text-slate-500">
                    <a
                      :href="`tel:${settingStore.setting?.hotline}`"
                      class="underline"
                    >
                      {{ formatPhone(settingStore.setting?.hotline) }}
                    </a>
                  </div>
                </div>
              </li>

              <li class="flex items-center gap-3">
                <div class="p-2 rounded-full bg-violet-100 text-violet-600">
                  <Clock class="w-5 h-5" />
                </div>
                <div>
                  <div class="text-sm font-semibold text-slate-700">
                    Giờ làm việc
                  </div>
                  <div class="text-sm text-slate-500">
                    {{ settingStore.setting?.working_time }}
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <!-- Right: Contact Form -->
      <section id="form" class="p-6 md:p-8">
        <h3 class="text-xl font-semibold text-slate-800 mb-3">
          Gửi tin nhắn cho chúng tôi
        </h3>
        <p class="text-sm text-slate-500 mb-6">
          Chỉ mất vài giây — chúng tôi sẽ liên hệ lại sớm nhất có thể.
        </p>

        <Form class="space-y-4" :validation-schema="schema" @submit="onSubmit">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm text-slate-600 mb-1">Họ và tên</label>
              <Field
                name="name"
                class="w-full rounded-lg border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-200"
                validate-on-input
                placeholder="Tên của bạn"
              />
              <ErrorMessage
                name="name"
                class="text-red-400 text-sm mt-1 block"
              />
            </div>

            <div>
              <label class="block text-sm text-slate-600 mb-1"
                >Số điện thoại</label
              >
              <Field
                name="phone"
                class="w-full rounded-lg border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-200"
                validate-on-input
                placeholder="(Ví dụ: +84 9..)"
              />
              <ErrorMessage
                name="phone"
                class="text-red-400 text-sm mt-1 block"
              />
            </div>
          </div>

          <div>
            <label class="block text-sm text-slate-600 mb-1">Email</label>
            <Field
              type="email"
              name="email"
              class="w-full rounded-lg border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-200"
              validate-on-input
              placeholder="you@example.com"
            />
            <ErrorMessage
              name="email"
              class="text-red-400 text-sm mt-1 block"
            />
          </div>

          <div>
            <label class="block text-sm text-slate-600 mb-1">Nội dung</label>
            <Field
              as="textarea"
              name="message"
              rows="5"
              class="w-full rounded-lg border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-200"
              validate-on-input
              placeholder="Nhập nội dung liên hệ..."
            />

            <ErrorMessage name="message" class="text-red-400 text-sm block" />
          </div>

          <div class="flex items-center justify-end gap-4">
            <button
              :disabled="loading"
              type="submit"
              class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-sky-600 text-white font-medium shadow hover:bg-sky-700 disabled:opacity-60 cursor-pointer"
            >
              <Loader2 v-if="loading" class="w-4 h-4 animate-spin" />
              <span>{{ loading ? "Đang gửi..." : "Gửi liên hệ" }}</span>
            </button>
          </div>
        </Form>

        <div
          v-if="response.message"
          :class="
            response.success
              ? 'mt-4 p-3 rounded-lg bg-emerald-50 text-emerald-700'
              : 'mt-4 p-3 rounded-lg bg-rose-50 text-rose-700'
          "
        >
          {{ response.message }}
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { Form, Field, ErrorMessage } from "vee-validate";
import { Clock, Loader2, Mails, MapPinHouse, Phone } from "lucide-vue-next";
import * as yup from "yup";
import { useSettingStore } from "~/stores/setting";

const { post, loading, error } = useApi();
const response = ref("");
const settingStore = useSettingStore();

const schema = yup.object({
  name: yup.string().required("Tên không được để trống!"),
  phone: yup
    .string()
    .required("Số điện thoại không được để trống!")
    .matches(/^\+?\d+$/, "Số điện thoại không hợp lệ!"),
  email: yup
    .string()
    .required("Email không được để trống!")
    .email("Email không hợp lệ!"),
});

async function onSubmit(values, { resetForm }) {
  try {
    response.value = await post("contacts/send", values);
    resetForm();
  } catch (err) {
    console.log(err);
    response.value = error.value;
  }
}
</script>

<style scoped></style>
