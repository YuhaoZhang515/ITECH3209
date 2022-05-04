<template>
  <BreezeAuthenticatedLayout>
    <div>
      <h1 class="text-center py-12 text-3xl font-bold">Users</h1>
      <Link :href="route('superadmin.users.add')">
        <button class="py-2 px-6 bg-green-700 rounded-lg my-12 mx-6 text-white">
          Add New User
        </button>
      </Link>

      <table class="table- w-full shadow-lg" border="1">
        <tr class="p-4">
          <th class="p-4 font-bold">#</th>
          <th class="p-4 font-bold">Name</th>
          <th class="p-4 font-bold">Email</th>
          <th class="p-4 font-bold">Phone</th>
          <th class="p-4 font-bold">Shipping Addres</th>
          <th class="p-4 font-bold">Billing Address</th>
          <th class="p-4 font-bold">Account Active</th>
          <th class="p-4 font-bold">Actions</th>
        </tr>
        <tr class="text-center" v-for="user in users" :key="user.id">
          <td class="p-4">{{ user.id }}</td>
          <td class="p-4">{{ user.full_name }}</td>
          <td class="p-4">{{ user.email }}</td>
          <td class="p-4">{{ user.phone }}</td>
          <td class="p-4">{{ user.shipping_address }}</td>
          <td class="p-4">{{ user.billing_address }}</td>
          <td class="p-4">
            <Link
              :href="`/superadmin/users/toogle_block/` + user.id"
              v-if="user.active == 1"
            >
              <input type="checkbox"  checked />
            </Link>
            <Link :href="`/superadmin/users/toogle_block/` + user.id" v-else>
              <input type="checkbox"  />
            </Link>
          </td>
          <td class="p-4 text-white">
            <Link :href="`/superadmin/users/edit/` + user.id">
              <button class="bg-green-700 py-2 mr-3 px-8 rounded-lg">Edit</button>
            </Link>
            <Link :href="`/superadmin/users/delete/` + user.id">
              <button class="bg-red-700 py-2 px-8 rounded-lg">Delete</button>
            </Link>
          </td>
        </tr>
      </table>
    </div>
    <Footer> </Footer>
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
    users: {
      type: Array,
      default: [],
    },
  },
};
</script>

<style lang="scss" scoped></style>
