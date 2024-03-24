<template>
  <div>
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4
                class="card-title"
                style="font-size: 2.25em; font-weight: 500"
              >
                ผู้ใช้
              </h4>
              <div style="font-size: 16px; font-weight: 400">
                ผู้ใช้ทั้งหมด {{ users.length }} คน
                <router-link
                  to="/users/create"
                  class="btn btn-primary btn-sm ml-2"
                  >เพิ่ม</router-link
                >
              </div>
              <form
                action=""
                method="GET"
                class="form-inline pull-right pull-left-sm m-3"
              >
                <div class="form-row align-items-end">
                  <div class="form-group col-8 mr-1">
                    <label class="sr-only" for="search">Search</label>
                    <input
                      type="text"
                      class="form-control input-search"
                      name="q"
                      id="search"
                      placeholder="ค้นหา"
                    />
                  </div>

                  <div class="form-group col-auto">
                    <button
                      type="submit"
                      class="btn btn-primary"
                      style="margin: 0"
                    >
                      ค้นหา
                    </button>
                  </div>
                </div>
              </form>

              <div class="table-responsive">
                <vue-good-table
                  mode="remote"
                  :columns="columns"
                  :rows="users"
                  style-class="tableOne vgt-table"
                >
                  <div slot="selected-row-actions">
                    <button
                      class="btn btn-danger"
                      @click="delete_by_selected()"
                    >
                      {{ $t("Del") }}
                    </button>
                  </div>
                  <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'actions'">
                      <b-button
                        @click="
                          $router.push({
                            name: 'admin.user.edit',
                            params: { id: props.row.id },
                          })
                        "
                        class="btn btn-success btn-icon btn-sm"
                        ><i class="fas fa-pencil-alt"></i
                      ></b-button>
                      <b-button
                        class="btn btn-danger btn-icon btn-sm"
                        @click="delete_user(props.row.id)"
                        variant="outline-danger"
                        ><i class="far fa-trash-alt"></i
                      ></b-button>
                    </span>
                    {{
                      props.column.field == "role"
                        ? props.row.role !== null
                          ? props.row.role.name
                          : ""
                        : props.row[props.column.field]
                    }}
                  </template>
                </vue-good-table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  async asyncData({ app: { $userService } }) {
    // use the user service to get a list of user
    const { data: users } = await $userService.getUsers();

    return { users };
  },
  // created() {
  //   this.getDataUser();
  // },
  methods: {
    async getDataUser() {
      // access and call the users service via the Vue component instance
      const { data: users } = await this.$userService.getUsers();
      this.users = users;
    },
  },
  computed: {
    columns() {
      return [
        {
          label: "ชื่อผู้ใช้",
          field: "name",
          tdClass: "text-center",
          thClass: "text-center",
        },
        {
          label: "Username",
          field: "username",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "Password",
          field: "password",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
        {
          label: "หน้าที่",
          field: "role",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
        {
          label: "จัดการ",
          field: "actions",
          html: true,
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
      ];
    },
  },
};
</script>

<style>
</style>
