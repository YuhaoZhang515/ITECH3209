<template>
  <BreezeAuthenticatedLayout>
    <h1 class="text-center py-12 text-3xl font-bold">Product Edit</h1>
    <div class="flex justify-center">
      <form @submit.prevent="submitForm" class="md:w-1/3 text-center w-full">
        <BreezeInput
          id="product_name"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Product Name"
          v-model="formData.product_name"
          required
        />
        <BreezeInput
          id="product_cat"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Category"
          v-model="formData.product_cat"
          required
        />
        <BreezeInput
          id="product_price"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Product Price"
          v-model="formData.product_price"
          required
        />

        <BreezeInput
          id="product_size_or_qty"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Product Size"
          v-model="formData.product_size_or_qty"
          required
        />

        <BreezeInput
          id="product_description"
          type="text"
          class="mt-2 block w-full p-2"
          placeholder="Product Description"
          v-model="formData.product_description"
          required
        />
        <BreezeInput
          id="product_stock"
          type="number"
          class="mt-2 block w-full p-2"
          placeholder="Product Stock"
          v-model="formData.product_stock"
          required
        />

        <button class="rounded-lg mt-6 py-2 px-4 bg-green-700 text-white">
          Update Product
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
    product: {
      type: Object,
      default: {},
    },
  },

  data() {
    return {
      formData: {
        product_name: this.product.product_name,
        product_cat: this.product.product_cat,
        product_price: this.product.product_price,
        product_size_or_qty: this.product.product_size_or_qty,
        product_description: this.product.product_description,
        product_stock: this.product.product_stock,
      },
      id: this.product.id,
    };
  },

  methods: {
    submitForm() {
      axios.post("/superadmin/products/edit/" + this.id, this.formData).then((res) => {
        window.location = "/superadmin/products";
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
