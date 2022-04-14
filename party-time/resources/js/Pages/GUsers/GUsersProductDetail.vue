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
                <Link :href="route('gusers.cart')" class="flex items-center">
                  <h2 class="mx-4 flex items-center">
                    <svg
                      height="24"
                      viewBox="0 -31 512.00033 512"
                      width="24"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="m166 300.003906h271.003906c6.710938 0 12.597656-4.4375 14.414063-10.882812l60.003906-210.003906c1.289063-4.527344.40625-9.390626-2.433594-13.152344-2.84375-3.75-7.265625-5.964844-11.984375-5.964844h-365.632812l-10.722656-48.25c-1.523438-6.871094-7.617188-11.75-14.648438-11.75h-91c-8.289062 0-15 6.710938-15 15 0 8.292969 6.710938 15 15 15h78.960938l54.167968 243.75c-15.9375 6.929688-27.128906 22.792969-27.128906 41.253906 0 24.8125 20.1875 45 45 45h271.003906c8.292969 0 15-6.707031 15-15 0-8.289062-6.707031-15-15-15h-271.003906c-8.261719 0-15-6.722656-15-15s6.738281-15 15-15zm0 0"
                      />
                      <path
                        d="m151 405.003906c0 24.816406 20.1875 45 45.003906 45 24.8125 0 45-20.183594 45-45 0-24.8125-20.1875-45-45-45-24.816406 0-45.003906 20.1875-45.003906 45zm0 0"
                      />
                      <path
                        d="m362.003906 405.003906c0 24.816406 20.1875 45 45 45 24.816406 0 45-20.183594 45-45 0-24.8125-20.183594-45-45-45-24.8125 0-45 20.1875-45 45zm0 0"
                      />
                    </svg>

                    <span class="mx-1 text-gray-7">{{ items_in_carts }}</span>
                  </h2>
                </Link>
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
        <div
          class="flex bg-white rounded-lg shadow-xl w-9/12 mt-12 ml-auto mr-auto justify-center items-center"
        >
          <div class="w-1/2">
            <img :src="product.product_img" class="p-6" />
          </div>
          <div class="w-1/2">
            <h1 class="font-bold text-4xl">
              {{ product.product_name }}
            </h1>
            <h2 class="font-bold text-2xl">Rs.{{ product.product_price }}</h2>
            <h2 class="font-bold text-md mt-4">{{ product.product_size_or_qty }}</h2>

            <h2 class="font-bold text-md">Stock: {{ product.product_stock }}</h2>

            <p
              class="w-auto text-lg"
              style="white-space: break-word; overflow: hidden; text-overflow: ellipsis"
            >
              {{ product.product_description }}
            </p>
            <button
              @click="addToCart(product.id)"
              class="bg-green-500 text-white rounded-lg shadow-lg px-6 py-2 mt-4"
            >
              Add To Cart
            </button>
          </div>
        </div>
        <h1 class="text-center w-full mt-6 font-bold text-2xl">Reviews From Users</h1>

        <div class="p-12 w-9/12 ml-auto mr-auto mt-6 bg-white rounded-lg shadow-lg">
          <div v-for="item in items" :key="item.id">
            {{ item }}
          </div>
          <div
            class="bg-gray-200 p-2 mt-2 rounded-lg"
            v-for="review in reviews"
            :key="review.id"
          >
            <h1 class="font-bold text-lg p-2">{{ review.user_name }}</h1>
            <h1 class="text-sm p-2">
              {{ review.review }}
            </h1>
          </div>

          <div class="bg-gray-400 p-2 mt-6 rounded-lg">
            <input
              class="p-2 w-2/3"
              v-model="review"
              placeholder="Enter Your Review For This Product Here..."
            />
            <button
              @click="sendReview(product.id)"
              class="rounded-lg w-1/3 bg-green-500 text-white p-2"
            >
              Send Review
            </button>
          </div>
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
import Input from "@/Components/Input.vue";
import Footer from '@/Components/FooterUser.vue'

export default {
  components: {
    BreezeApplicationLogo,
    BreezeDropdown,
    BreezeDropdownLink,
    BreezeNavLink,
    BreezeResponsiveNavLink,
    Link,
    Input,
    Footer
  },
  props: {
    user: {
      type: Object,
      default: {},
    },
    product: {
      type: Object,
      default: {},
    },
    items_in_cart: {
      type: Number,
      default: 0,
    },
    reviews: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      showingNavigationDropdown: false,
      items_in_carts: this.items_in_cart,
      review: "",
    };
  },

  methods: {
    addToCart(product_id) {
      var formData = {
        user_id: this.user.id,
        product_id: product_id,
      };

      axios.post("/addToCart", formData).then((res) => {
        if (res.data == 1) {
          this.items_in_carts += 1;
        }
      });
    },
    sendReview(product_id) {
      var formData = {
        review: this.review,
        product_id: product_id,
      };

      axios.post("/addReview", formData).then((res) => {
        // alert("Review Added Successfully!");
        window.location.reload();
      });
    },
  },
};
</script>
