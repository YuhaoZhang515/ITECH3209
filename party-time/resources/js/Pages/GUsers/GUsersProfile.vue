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
      <main class="min-w-full">
        <h1 class="text-center py-12 text-3xl font-bold">Profile Edit</h1>
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
              type="text"
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
      </main>
    </div>
  </div>
  <Footer />
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeInput from "@/Components/Input.vue";
import axios from "axios";
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Footer from '@/Components/FooterUser.vue'

export default {
  components: {
    BreezeAuthenticatedLayout,
    Link,
    BreezeInput,
    BreezeApplicationLogo,
    BreezeDropdown,
    BreezeDropdownLink,
    BreezeNavLink,
    BreezeResponsiveNavLink,
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
      axios.post("/gusers/edit/" + this.id, this.formData).then((res) => {
        window.location = "/";
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
