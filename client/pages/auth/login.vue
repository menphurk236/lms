<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('login')">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Username -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("username")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="form.username"
                :class="{ 'is-invalid': form.errors.has('username') }"
                type="text"
                name="username"
                class="form-control"
              />
              <has-error :form="form" field="username" />
            </div>
          </div>

          <!-- Password -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("password")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="form.password"
                :class="{ 'is-invalid': form.errors.has('password') }"
                type="password"
                name="password"
                class="form-control"
              />
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Remember Me -->
          <div class="form-group row">
            <div class="col-md-3" />
            <div class="col-md-7 d-flex">
              <router-link
                :to="{ name: 'password.request' }"
                class="small ml-auto my-auto"
              >
                {{ $t("forgot_password") }}
              </router-link>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t("login") }}
              </v-button>
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from "vform";

export default {
  middleware: "guest",

  data: () => ({
    form: new Form({
      username: "",
      password: "",
    }),
    remember: false,
  }),

  head() {
    return { title: this.$t("login") };
  },

  methods: {
    async login() {
      let data;

      // Submit the form.
      try {
        const response = await this.form.post("/login");
        data = response.data;
      } catch (e) {
        return;
      }

      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember,
      });

      // Fetch the user.
      await this.$store.dispatch("auth/fetchUser");

      // Redirect home.
      this.$router.push({ name: "home" });
    },
  },
};
</script>
