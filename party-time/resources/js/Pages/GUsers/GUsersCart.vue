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
              <!-- Navigation Links -->
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
                    <BreezeDropdownLink :href="route('guser.myorders')" as="button">
                      My Orders
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
              <BreezeDropdownLink :href="route('guser.myorders')" as="button">
                My Orders
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
      <main>
        <h1 class="w-full text-center text-3xl my-6 font-bold">Items In Your Cart</h1>

        <table class="table bg-white w-full shadow-lg" border="1">
          <tr class="p-4">
            <th class="p-4 font-bold">#</th>
            <th class="p-4 font-bold text-left">Product</th>
            <th class="p-4 font-bold">Price</th>
            <th class="p-4 font-bold">Quantity</th>
            <th class="p-4 font-bold">Total</th>
            <th class="p-4 font-bold text-center">Actions</th>
          </tr>
          <tr class="text-center" v-for="item in items_in_cart" :key="item.id">
            <td class="p-4">{{ item.id }}</td>
            <td class="p-4">
              <div class="flex">
                <img :src="item.product.product_img" class="w-12 h-12" />
                <h1 class="flex items-center">{{ item.product.product_name }}</h1>
              </div>
            </td>
            <td class="p-4">Price.{{ item.product.product_price }}</td>
            <td class="p-4">
              <div class="flex justify-center">
                <Link :href="`/gusers/minus_from_cart/` + item.id">
                  <button class="bg-gray-500 py-2 px-4 text-white rounded-lg">-</button>
                </Link>

                <h1 class="mx-3 flex items-center justify-center font-bold">
                  {{ item.qty }}
                </h1>
                <Link :href="`/gusers/plus_from_cart/` + item.id">
                  <button class="bg-gray-500 py-2 px-4 text-white rounded-lg">+</button>
                </Link>
              </div>
            </td>
            <td class="p-4">AUS.{{ item.product.product_price * item.qty }}</td>

            <td class="p-4 text-white">
              <Link :href="`/gusers/remove_from_cart/` + item.id">
                <button class="bg-red-700 py-2 px-8 rounded-lg">Remove From Cart</button>
              </Link>
            </td>
          </tr>
        </table>

        <div class="bg-white p-6 flex justify-center rounded-lg shadow-md mt-6">
          <h1 class="text-3xl font-bold">Grand Total : AUS.{{ total }}</h1>
        </div>
        <div class="bg-white p-6 flex justify-center rounded-lg shadow-md mt-6">
          <Link href="/gusers/place_order">
            <button
              class="bg-red-700 py-2 px-8 rounded-lg text-white"
              v-if="items_in_cart.length > 0"
            >
              Place Order
            </button>
          </Link>
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

    items_in_cart: {
      type: Number,
      default: 0,
    },
    total: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      showingNavigationDropdown: false,
    };
  },

  methods: {},
};
</script>
