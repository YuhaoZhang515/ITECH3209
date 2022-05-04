<template>
  <div
    class="bg-gray-600 min-h-screen flex justify-center items-center min-w-full p-12 text-white"
  >
    <div class="bg-white rounded-lg shadow-lg p-12 w-1/3">
      <h1 class="text-black w-full text-center">Login</h1>
      <form @submit.prevent="submitForm">
        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.email"
          placeholder="Email"
          type="email"
          required
        />

        <input
          class="w-full border-2 shadow mt-2 p-2 text-black"
          v-model="formData.password"
          placeholder="Password"
          type="password"
          required
        />
        <div class="w-full text-center">
          <button type="submit" class="bg-green-500 rounded-lg shadow-lg px-6 py-2 mt-4">
            Login
          </button>
        </div>
      </form>
      <h1 class="w-full text-center text-black text-sm mt-6">
        No Account Yet?
        <Link :href="route('gusers.register')" class="underline text-black"
          >Register Now!</Link
        >
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
        email: "",
        password: "",
      },
    };
  },

  methods: {
    submitForm() {
      axios.post("/login", this.formData).then((res) => {
        if (res.data == 1) {
          window.location = "/";
        } else if (res.data == 2) {
          alert("Password Is Wrong");
        } else if (res.data == -1) {
          alert("Your Account Has Been Block By Admin");
        } else {
          alert("No Account With This Email");
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
