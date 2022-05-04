<template>
  <div>
<img :src="logo" class="w-full h-full" alt="" srcset="" />
  </div>
</template>

<script>
import logo from "@/assets/images/logo.jpg";

  export default {
    components: {
      logo,
    },
    data() {
      return {
        logo: logo
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>