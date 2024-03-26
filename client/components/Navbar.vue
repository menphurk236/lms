<template>
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <router-link
        :to="{ name: user ? 'home' : 'welcome' }"
        class="navbar-brand"
      >
        {{ appName }}
      </router-link>

      <button
        :aria-label="$t('toggle_navigation')"
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarToggler"
        aria-controls="navbarToggler"
        aria-expanded="false"
      >
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li v-if="user" class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-dark"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                :src="user.photo_url"
                class="rounded-circle profile-photo mr-1"
              />
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link
                :to="{ name: 'settings.profile' }"
                class="dropdown-item pl-3"
              >
                <fa icon="cog" fixed-width />
                {{ $t("settings") }}
              </router-link>

              <div class="dropdown-divider" />
              <a class="dropdown-item pl-3" href="#" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t("logout") }}
              </a>
            </div>
          </li>
          <template v-else>
            <li class="nav-item">
              <router-link
                :to="{ name: 'login' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("login") }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                :to="{ name: 'register' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("register") }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav> -->
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
