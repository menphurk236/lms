<template>
  <nav class="navbar navbar-expand-lg bg-primary navbar-absolute">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <router-link
          :to="{ name: user ? 'home' : 'welcome' }"
          class="navbar-brand"
        >
          <img
            src="https://www.tumtook.com/wp-content/uploads/2022/09/cropped-Tumtook_New_Logo_Invert-2-1.png"
            width="60%"
          />
        </router-link>
      </div>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navigation"
        aria-controls="navigation-index"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
      <div id="navigation" class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <router-link
              :to="{ name: 'login' }"
              class="nav-link"
              active-class="active"
            >
              <i class="now-ui-icons users_circle-08"></i>
              สำหรับผู้ดูแลระบบ
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data: () => ({
    appName: process.env.appName,
  }),

  computed: mapGetters({
    user: "auth/user",
  }),
  created() {
    console.log(this.$route.path === "/login" || this.user);
    if (this.user && this.$route.path === "/login") {
      this.$router.push("/dashboard"); // Redirect to login page if user is not logged in
    }
  },
  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
  },
};
</script>
