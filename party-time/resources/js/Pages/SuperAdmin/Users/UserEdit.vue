<template>
  <BreezeAuthenticatedLayout>
    <h1 class="text-center py-12 text-3xl font-bold">User Edit</h1>
    <div class="flex justify-center">
      <form @submit.prevent="submitForm" class="md:w-1/3 text-center w-full">
        <BreezeInput
          id="full_name"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Full Name"
          v-model="formData.full_name"
          required
        />
        <BreezeInput
          id="email"
          type="email"
          class="mt-2 block w-full p-2"
          placeholder="Email Address"
          v-model="formData.email"
          required
        />
        <BreezeInput
          id="phone"
          type="phone"
          class="mt-2 block w-full p-2"
          placeholder="Phone Number"
          v-model="formData.phone"
          required
        />
        <BreezeInput
          id="shipping_address"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Shipping Address"
          v-model="formData.shipping_address"
          required
        />
        <BreezeInput
          id="billing_address"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Billing Address"
          v-model="formData.billing_address"
          required
        />
        <BreezeInput
          id="password"
          type="password"
          class="mt-2 block w-full p-2"
          placeholder="Enter New Password ( Leave Empty If Don't Want To Change )"
          v-model="formData.password"
        />

        <button class="rounded-lg mt-6 py-2 px-4 bg-green-700 text-white">
          Update User
        </button>
      </form>
    </div>
    <Footer />
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Link } from "@inertiajs/inertia-vue3";
import BreezeInput from "@/Components/Input.vue";
import axios from "axios";
import Footer from '@/Components/Footer.vue'

export default {
  components: {
    BreezeAuthenticatedLayout,
    Link,
    BreezeInput,
    Footer
  },
  props: {
    user: {
      type: Object,
      default: {},
    },
  },

  data() {
    return {
      formData: {
        full_name: this.user.full_name,
        email: this.user.email,
        phone: this.user.phone,
        shipping_address: this.user.shipping_address,
        billing_address: this.user.billing_address,
        password: this.user.password,
      },
      id: this.user.id,
    };
  },

  methods: {
    submitForm() {
      axios.post("/superadmin/users/edit/" + this.id, this.formData).then((res) => {
        window.location = "/superadmin/users";
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
