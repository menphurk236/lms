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
import $ from "jquery";
window.jQuery = window.$ = $;
import HeaderNavber from "../components/HeaderNavber.vue";
import Sidebar from "~/components/Sidebar";

export default {
  components: {
    Sidebar,
    HeaderNavber,
  },
  // mounted() {
  //   $(document).on("click", ".navbar-toggle", () => {
  //     let $toggle = $(".navbar-toggle");
  //     let navbarMenuVisible =
  //       this.$store.state.nowuiDashboard.misc.navbar_menu_visible;

  //     if (navbarMenuVisible == 1) {
  //       $("html").removeClass("nav-open");
  //       this.$store.commit("toggleNavbarMenuVisibility", 0);
  //       setTimeout(() => {
  //         $toggle.removeClass("toggled");
  //         $("#bodyClick").remove();
  //       }, 550);
  //     } else {
  //       setTimeout(() => {
  //         $toggle.addClass("toggled");
  //       }, 580);

  //       let div = '<div id="bodyClick"></div>';
  //       $(div)
  //         .appendTo("body")
  //         .click(() => {
  //           $("html").removeClass("nav-open");
  //           this.$store.commit("toggleNavbarMenuVisibility", 0);
  //           setTimeout(() => {
  //             $toggle.removeClass("toggled");
  //             $("#bodyClick").remove();
  //           }, 550);
  //         });

  //       $("html").addClass("nav-open");
  //       this.$store.commit("toggleNavbarMenuVisibility", 1);
  //     }
  //   });
  // },
};
////////////////////////
$(document).on("click", ".navbar-toggle", function () {
  let $toggle = $(".navbar-toggle");
  $toggle = $(this);

  //if (nowuiDashboard.misc.navbar_menu_visible == 1) {
  $("html").removeClass("nav-open");
  //nowuiDashboard.misc.navbar_menu_visible = 0;
  setTimeout(function () {
    $toggle.removeClass("toggled");
    $("#bodyClick").remove();
  }, 550);
  //} else {
  setTimeout(function () {
    $toggle.addClass("toggled");
  }, 580);

  let div = '<div id="bodyClick"></div>';
  $(div)
    .appendTo("body")
    .click(function () {
      $("html").removeClass("nav-open");
      //nowuiDashboard.misc.navbar_menu_visible = 0;
      setTimeout(function () {
        $toggle.removeClass("toggled");
        $("#bodyClick").remove();
      }, 550);
    });

  $("html").addClass("nav-open");
  //nowuiDashboard.misc.navbar_menu_visible = 1;
  //}
});
</script>
