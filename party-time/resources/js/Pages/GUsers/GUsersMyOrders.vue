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
                <Link :href="route('gusers.home')">
                  <BreezeApplicationLogo class="block h-9 w-auto" />
                </Link>
              </div>
              <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('gusers.home')">
                  Home
                </BreezeDropdownLink>
              </div>
               <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('guser.profile')">
                  My Profile
                </BreezeDropdownLink>
              </div>
               <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('guser.myorders')">
                  My Orders
                </BreezeDropdownLink>
              </div>
               <div class="flex items-center ml-6">
                <BreezeDropdownLink :href="route('guser.support')">
                  Support
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
                        {{ user.full_name }}

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
                    <BreezeDropdownLink :href="route('guser.profile')" as="button">
                      My Profile
                    </BreezeDropdownLink>
                    <BreezeDropdownLink :href="route('guser.support')" as="button">
                      Support
                    </BreezeDropdownLink>
                    <BreezeDropdownLink :href="route('guser.logout')" as="button">
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
                {{ user.full_name }}
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <BreezeDropdownLink :href="route('guser.profile')" as="button">
                My Profile
              </BreezeDropdownLink>
              <BreezeDropdownLink :href="route('guser.support')" as="button">
                Support
              </BreezeDropdownLink>
              <BreezeDropdownLink :href="route('guser.logout')" as="button">
                Log Out
              </BreezeDropdownLink>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="min-w-full">
        <h1 class="text-center py-12 text-3xl font-bold">Current Pending Orders</h1>

        <table class="table w-full shadow-lg" border="1">
          <tr class="p-4 text-sm">
            <th class="p-4 font-bold">Order#</th>
            <th class="p-4 font-bold">User</th>
            <th class="p-4 font-bold">Email</th>
            <th class="p-4 font-bold">Phone</th>
            <th class="p-4 font-bold">Shipping Addres</th>
            <th class="p-4 font-bold">Billing Address</th>
            <th class="p-4 font-bold">Products</th>
            <th class="p-4 font-bold">Quantity</th>
            <th class="p-4 font-bold">Price/Item</th>
            <th class="p-4 font-bold">SubTotal/Item</th>
            <th class="p-4 font-bold">Total</th>
            <th class="p-4 font-bold">Order Status</th>
          </tr>
          <tr class="text-center text-xs" v-for="order in orders" :key="order.id">
            <td class="p-4">{{ order.id }}</td>
            <td class="p-4">{{ order.user.full_name }}</td>
            <td class="p-4">{{ order.user.email }}</td>
            <td class="p-4">{{ order.user.phone }}</td>
            <td class="p-4">{{ order.user.shipping_address }}</td>
            <td class="p-4">{{ order.user.billing_address }}</td>
            <td class="p-4">
              <div v-for="product_name in order.products_names" :key="product_name">
                {{ product_name }}
              </div>
            </td>
            <td class="p-4">
              <div v-for="product_qty in order.products_qtys" :key="product_qty">
                {{ product_qty }}
              </div>
            </td>
            <td class="p-4">
              <div v-for="product_price in order.products_prices" :key="product_price">
                Rs.{{ product_price }}
              </div>
            </td>
            <td class="p-4">
              <div
                v-for="(product_price, index) in order.products_prices"
                :key="product_price"
              >
                Rs.{{ product_price * order.products_qtys[index] }}
              </div>
            </td>
            <td class="p-4">Rs.{{ order.products_total }}</td>
            <!-- <td class="p-4" v-if="order.order_status == 1">Pending</td>
            <td class="p-4" v-if="order.order_status == 2">Processing</td>
            <td class="p-4" v-if="order.order_status == 3">Completed</td> -->
            <button
              class="bg-yellow-500 py-2 mr-3 text-white px-8 rounded-lg"
              disabled
              v-if="order.order_status == 1"
            >
              Pending
            </button>
            <button
              class="bg-red-500 py-2 mr-3 text-white px-8 rounded-lg"
              v-if="order.order_status == 2"
              disabled
            >
              Processing
            </button>
            <button
              class="bg-gray-600 py-2 mr-3 px-8 text-white rounded-lg disabled:opacity-25"
              v-if="order.order_status == 3"
              disabled
            >
              Completed
            </button>
            <!-- 
            
            <td class="p-4">{{ user.shipping_address }}</td>
            <td class="p-4">{{ user.billing_address }}</td>
            <td class="p-4">
              <Link
                :href="`/superadmin/users/toogle_block/` + user.id"
                v-if="user.active == 1"
              >
                <input type="checkbox" checked />
              </Link>
              <Link :href="`/superadmin/users/toogle_block/` + user.id" v-else>
                <input type="checkbox" />
              </Link>
            </td>
            
           -->
          </tr>
        </table>
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
import Footer from '@/Components/FooterUser.vue'

export default {
  components: {
    BreezeApplicationLogo,
    BreezeDropdown,
    BreezeDropdownLink,
    BreezeNavLink,
    BreezeResponsiveNavLink,
    Link,
    Footer
  },
  props: {
    user: {
      type: Object,
      default: {},
    },
    orders: {
      type: Array,
      default: [],
    },
  },
};
</script>
