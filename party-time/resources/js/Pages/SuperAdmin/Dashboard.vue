<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <div class="relative">
      <div class="flex flex-wrap justify-center mb-4 lg:p-24 p-6 md:gap-4 gap-2">
        <div class="lg:w-1/4 md:w-2/4 w-full">
          <Link :href="route('superadmin.users')">
            <div class="shadow-md p-4 md:p-8 box-content m-2 md:m-6 rounded-lg bg-white">
              <img :src="users_img" class="ml-auto mx-auto" />
              <h3 class="text-center mt-6 font-semibold">Users</h3>
            </div>
          </Link>
        </div>
        <div class="lg:w-1/4 md:w-2/4 w-full">
          <Link :href="route('superadmin.staff')">
            <div class="shadow-md p-4 md:p-8 box-content m-2 md:m-6 rounded-lg bg-white">
              <img :src="staff_img" class="ml-auto mx-auto" />
              <h3 class="text-center mt-6 font-semibold">Staff</h3>
            </div>
          </Link>
        </div>
        <div class="lg:w-1/4 md:w-2/4 w-full">
          <Link :href="route('superadmin.products')">
            <div class="shadow-md p-4 md:p-8 box-content m-2 md:m-6 rounded-lg bg-white">
              <img :src="products_img" class="ml-auto mx-auto" />
              <h3 class="text-center mt-6 font-semibold">Products</h3>
            </div>
          </Link>
        </div>
      </div>
    </div>
    <Footer> </Footer>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import users_img from "@/assets/images/users.png";
import staff_img from "@/assets/images/staff.png";
import products_img from "@/assets/images/products.png";
import Footer from '@/Components/Footer.vue'
export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    Link,
    Footer,
    users_img,
    staff_img,
    products_img,
  },
  data() {
    return {
      users_img: users_img,
      staff_img: staff_img,
      products_img: products_img,
    };
  },
};
</script>
