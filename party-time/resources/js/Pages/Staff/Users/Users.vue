<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="flex-shrink-0 flex items-center">
                <Link :href="route('staff.home')">
                  <BreezeApplicationLogo class="block h-9 w-auto" />
                </Link>
              </div>
              <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('staff.users')">
                  Users
                </BreezeDropdownLink>
              </div>
              <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('staff.orders')">
                  Orders
                </BreezeDropdownLink>
              </div>
              <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('staff.products')">
                  Products
                </BreezeDropdownLink>
              </div>
              <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('staff.qiueris')">
                  Queries
                </BreezeDropdownLink>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- Settings Dropdown -->
              <div class="ml-3 relative flex">
                <BreezeDropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                      >
                        {{ staff_user.full_name }}

                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <BreezeDropdownLink :href="route('staff.logout')" as="button">
                      Log Out
                    </BreezeDropdownLink>
                  </template>
                </BreezeDropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
              <div class="font-medium text-base text-gray-800">
                {{ staff_user.full_name }}
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <BreezeDropdownLink :href="route('staff.logout')" as="button">
                Log Out
              </BreezeDropdownLink>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="min-w-full">
        <div>
          <h1 class="text-center py-12 text-3xl font-bold">Users</h1>

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
                  :href="`/staff/users/toogle_block/` + user.id"
                  v-if="user.active == 1"
                >
                  <input type="checkbox" checked />
                </Link>
                <Link :href="`/staff/users/toogle_block/` + user.id" v-else>
                  <input type="checkbox" />
                </Link>
              </td>
              <td class="p-4 text-white">
                <Link :href="`/staff/users/edit/` + user.id">
                  <button class="bg-green-700 py-2 mr-3 px-8 rounded-lg">Edit</button>
                </Link>
                <Link :href="`/staff/users/delete/` + user.id">
                  <button class="bg-red-700 py-2 px-8 rounded-lg">Delete</button>
                </Link>
              </td>
            </tr>
          </table>
        </div>
      </main>
    </div>
  </div>
  <Footer />
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import users_img from "@/assets/images/users.png";
import staff_img from "@/assets/images/staff.png";
import products_img from "@/assets/images/products.png";
import Footer from '@/Components/FooterStaff.vue'

export default {
  components: {
    BreezeApplicationLogo,
    BreezeDropdown,
    BreezeDropdownLink,
    BreezeNavLink,
    BreezeResponsiveNavLink,
    Link,
    Footer,
    users_img,
    staff_img,
    products_img,
  },
  props: {
    users: {
      type: Array,
      default: {},
    },
    staff_user: {
      type: Object,
      default: {},
    },
  },
};
</script>
