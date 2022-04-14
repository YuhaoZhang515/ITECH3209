<template>
  <BreezeAuthenticatedLayout>
    <div>
      <h1 class="text-center py-12 text-3xl font-bold">Products</h1>
      <Link :href="route('superadmin.products.add')">
        <button class="py-2 px-6 bg-green-700 rounded-lg my-12 mx-6 text-white">
          Add New Product
        </button>
      </Link>

      <table class="table- w-full shadow-lg" border="1">
        <tr class="p-4">
          <th class="p-4 font-bold">#</th>
          <th class="p-4 font-bold text-left">Product</th>
          <th class="p-4 font-bold">Category</th>
          <th class="p-4 font-bold">Price</th>
          <th class="p-4 font-bold">Size or Qty</th>
          <th class="p-4 font-bold">Stock</th>
          <th class="p-4 font-bold">Actions</th>
        </tr>
        <tr class="text-center" v-for="product in products" :key="product.id">
          <td class="p-4">{{ product.id }}</td>
          <td class="p-4 flex items-center">
            <img :src="product.product_img" alt="" srcset="" class="w-12 h-12" />
            <span class="ml-4">{{ product.product_name }}</span>
          </td>
          <td class="p-4">{{ product.product_cat }}</td>
          <td class="p-4">{{ product.product_price }}</td>
          <td class="p-4">{{ product.product_size_or_qty }}</td>
          <td class="p-4">{{ product.product_stock }}</td>

          <td class="p-4 text-white">
            <Link :href="`/superadmin/products/edit/` + product.id">
              <button class="bg-green-700 py-2 mr-3 px-8 rounded-lg">Edit</button>
            </Link>
            <Link :href="`/superadmin/products/delete/` + product.id">
              <button class="bg-red-700 py-2 px-8 rounded-lg">Delete</button>
            </Link>
          </td>
        </tr>
      </table>
    </div>
    <Footer />
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Footer from '@/Components/Footer.vue'

export default {
  components: {
    BreezeAuthenticatedLayout,
    Link,
    Footer
  },
  props: {
    products: {
      type: Array,
      default: [],
    },
  },
};
</script>

<style lang="scss" scoped></style>
