<template>
  <div class="login-page sidebar-mini">
    <navbar />
    <div class="wrapper wrapper-full-page">
      <nuxt />
    </div>
  </div>
</template>
<script>
import Navbar from "~/components/Navbar";
export default {
  components: {
    Navbar,
  },
};
</script>
