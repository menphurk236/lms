<template>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">เพิ่มผู้ใช้</h4>
          </div>
          <div class="card-body">
            <form
              class="form-horizontal"
              method="POST"
              @submit.prevent="createUser"
              @keydown="form.onKeydown($event)"
            >
              <div class="row">
                <label class="col-form-label mr-4" style="font-size: 1em"
                  >ชื่อผู้ใช้</label
                >
                <div class="col-md-4">
                  <div class="form-group">
                    <input
                      v-model="form.name"
                      :class="{
                        'is-invalid': form.errors.has('name'),
                      }"
                      type="text"
                      class="form-control"
                    />
                    <has-error :form="form" field="name" />
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-form-label mr-1" style="font-size: 1em"
                  >Username</label
                >
                <div class="col-md-4">
                  <div class="form-group">
                    <input
                      v-model="form.username"
                      :class="{
                        'is-invalid': form.errors.has('username'),
                      }"
                      type="text"
                      class="form-control"
                    />
                    <has-error :form="form" field="username" />
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-form-label mr-2" style="font-size: 1em"
                  >Password</label
                >
                <div class="col-md-4">
                  <div class="form-group">
                    <input
                      v-model="form.password"
                      :class="{
                        'is-invalid': form.errors.has('password'),
                      }"
                      type="text"
                      class="form-control"
                    />
                    <has-error :form="form" field="password" />
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-form-label mr-4" style="font-size: 1em"
                  >หน้าที่</label
                >
                <div class="col-md-4">
                  <div class="form-group">
                    <select
                      v-model="form.role_id"
                      :class="{
                        'is-invalid': form.errors.has('role_id'),
                      }"
                      class="form-control"
                    >
                      <option value="">กรุณาเลือก</option>
                      <option value="1">Super Admin</option>
                      <option value="2">Admin</option>
                    </select>
                    <has-error :form="form" field="role_id" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <v-button :loading="form.busy" class="btn btn-primary">
                    บันทึก
                  </v-button>
                  <button type="button" class="btn btn-info">ยกเลิก</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
export default {
  data: () => ({
    form: new Form({
      name: "",
      email: "",
      password: "",
      role_id: "",
    }),
  }),

  methods: {
    async createUser() {
      let data;

      // Submit the form.
      try {
        const response = await this.form.post("/users");
        data = response.data;
      } catch (e) {
        return;
      }
      // Redirect home.
      this.$router.push({ name: "users.list" });
    },
  },
};
</script>

<style>
</style>
