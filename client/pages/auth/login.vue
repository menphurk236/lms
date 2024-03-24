<template>
  <!-- <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('login')">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
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

              <v-button :loading="form.busy">
                {{ $t("login") }}
              </v-button>
            </div>
          </div>
        </form>
      </card>
    </div>
  </div> -->
  <div class="full-page full-page-background">
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="bg-white shadow rounded">
              <div class="row">
                <div class="col-md-5 ps-0 d-none d-md-block">
                  <div class="form-right h-100 text-white text-center">
                    <img
                      src="~/assets/images/image_login.jpg"
                      alt="bg-image"
                      class="img-fluid"
                    />
                  </div>
                </div>
                <div class="col-md-7 pe-0">
                  <div class="form-left h-100 py-5 px-5">
                    <form
                      class="row g-4"
                      method="POST"
                      @submit.prevent="login"
                      @keydown="form.onKeydown($event)"
                    >
                      <div class="col-12">
                        <label
                          >ชื่อผู้ใช้งาน<span class="text-danger"
                            >*</span
                          ></label
                        >
                        <div class="input-group">
                          <input
                            v-model="form.username"
                            :class="{
                              'is-invalid': form.errors.has('username'),
                            }"
                            type="text"
                            name="username"
                            class="form-control"
                          />
                          <has-error :form="form" field="username" />
                        </div>
                      </div>

                      <div class="col-12">
                        <label
                          >รหัสผ่าน<span class="text-danger">*</span></label
                        >
                        <div class="input-group">
                          <input
                            v-model="form.password"
                            :class="{
                              'is-invalid': form.errors.has('password'),
                            }"
                            type="password"
                            name="password"
                            class="form-control"
                          />
                          <has-error :form="form" field="password" />
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <router-link
                          :to="{ name: 'password.request' }"
                          class="float-end text-primary"
                        >
                          ลืมรหัสผ่าน?
                        </router-link>
                      </div>

                      <div class="col-12">
                        <v-button
                          :loading="form.busy"
                          class="btn btn-primary btn-block"
                        >
                          {{ $t("login") }}
                        </v-button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";

export default {
  layout: "simple",
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
      this.$router.push({ name: "dashboard" });
    },
  },
};
</script>
