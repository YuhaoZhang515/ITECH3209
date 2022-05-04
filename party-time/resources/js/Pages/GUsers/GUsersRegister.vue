<template>
  <div
    class="bg-gray-600 min-h-screen flex justify-center items-center min-w-full p-12 text-white"
  >
    <div class="bg-white rounded-lg shadow-lg p-12 w-1/3">
      <h1 class="text-black w-full text-center">Register</h1>
      <form @submit.prevent="submitForm">
        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.full_name"
          placeholder="Full Name"
        />
        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.email"
          placeholder="Email"
        />
        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.phone"
          placeholder="Phone"
        />
        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.shipping_address"
          placeholder="Billing Address"
        />
        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.billing_address"
          placeholder="Shipping Address"
        />
        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.password"
          placeholder="Password"
        />
        <div class="w-full text-center">
          <button type="submit" class="bg-green-500 rounded-lg shadow-lg px-6 py-2 mt-4">
            Register
          </button>
        </div>
      </form>
      <h1 class="w-full text-center text-black text-sm mt-6">
        Already Have Account?
        <Link :href="route('gusers.login')" class="underline text-black">Login Now!</Link>
      </h1>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  data() {
    return {
      formData: {
        full_name: "",
        email: "",
        phone: "",
        shipping_address: "",
        billing_address: "",
        password: "",
      },
    };
  },

  methods: {
    submitForm() {
      axios.post("/register", this.formData).then((res) => {
        window.location = "/";
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
