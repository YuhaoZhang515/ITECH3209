<template>
  <BreezeAuthenticatedLayout>
    <div>
      <h1 class="text-center py-12 text-3xl font-bold">Staff Members</h1>
      <Link :href="route('superadmin.staff.add')">
        <button class="py-2 px-6 bg-green-700 rounded-lg my-12 mx-6 text-white">
          Add New Staff
        </button>
      </Link>
      <table class="table- w-full shadow-lg" border="1">
        <tr class="p-4">
          <th class="p-4 font-bold">#</th>
          <th class="p-4 font-bold">Name</th>
          <th class="p-4 font-bold">Email</th>
          <th class="p-4 font-bold">Phone</th>
          <th class="p-4 font-bold">Account Active</th>
          <th class="p-4 font-bold">Actions</th>
        </tr>
        <tr class="text-center" v-for="staff in staffs" :key="staff.id">
          <td class="p-4">{{ staff.id }}</td>
          <td class="p-4">{{ staff.full_name }}</td>
          <td class="p-4">{{ staff.email }}</td>
          <td class="p-4">{{ staff.phone }}</td>
          <td class="p-4">
            <Link
              :href="`/superadmin/staff/toogle_block/` + staff.id"
              v-if="staff.active == 1"
            >
              <input type="checkbox" @change="Block()" checked />
            </Link>
            <Link :href="`/superadmin/staff/toogle_block/` + staff.id" v-else>
              <input type="checkbox" @change="UnBlock()" />
            </Link>
          </td>
          <td class="p-4 text-white">
            <Link :href="`/superadmin/staff/edit/` + staff.id">
              <button class="bg-green-700 py-2 mr-3 px-8 rounded-lg">Edit</button>
            </Link>
            <Link :href="`/superadmin/staff/delete/` + staff.id">
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
    staffs: {
      type: Array,
      default: [],
    },
  },
};
</script>

<style lang="scss" scoped></style>
