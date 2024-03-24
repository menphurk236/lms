<template>
  <div class="font-sans antialiased bg-light">
    <!-- <navbar /> -->
    <div class="wrapper">
      <div class="sidebar" data-color="red"><sidebar /></div>
      <div class="main-panel" id="main-panel">
        <!-- Navbar -->

        <HeaderNavber />

        <!-- End Navbar -->
        <div class="panel-header panel-header-sm"></div>
        <div class="content">
          <nuxt />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderNavber from '../components/HeaderNavber.vue'
import Sidebar from '~/components/Sidebar'

export default {
  components: {
    Sidebar,
    HeaderNavber
  },
};
</script>
