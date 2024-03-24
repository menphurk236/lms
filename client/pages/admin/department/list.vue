<template>
  <div class="content">
    <modalform v-if="showModal" name="Umesh" />
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title" style="font-size: 2.25em; font-weight: 500">
              แผนก
            </h3>
            <div style="font-size: 16px; font-weight: 400">
              แผนกทั้งหมด {{ departments.length }} แผนก
              <b-button
                @click="showModal=true"
                class="btn btn-primary btn-sm ml-2"
                >เพิ่มแผนก</b-button>
            </div>

            <form action="" method="GET" class="form-inline m-3">
              <div class="form-group d-flex col-xs-12 col-sm-12">
                <label
                  class="col-label"
                  style="font-size: 1em; margin-right: 16px"
                  >ชื่อแผนก</label
                >
                <div class="form-group col-xs-12">
                  <select class="form-control" wire:model="search">
                    <option value>กรุณาเลือก</option>
                  </select>
                </div>

                <button
                  type="submit"
                  class="ml-2 btn btn-primary btn-sm"
                  style="margin: 0"
                >
                  <span
                    class="glyphicon glyphicon-search"
                    aria-hidden="true"
                  ></span>
                  ค้นหา
                </button>
              </div>
            </form>
            <div class="table-responsive-md">
              <vue-good-table
                mode="remote"
                :columns="columns"
                :rows="departments"
                style-class="tableOne vgt-table"
              >
                <div slot="selected-row-actions">
                  <button class="btn btn-danger" @click="delete_by_selected()">
                    {{ $t("Del") }}
                  </button>
                </div>
                <template slot="table-row" slot-scope="props">
                  <span v-if="props.column.field == 'actions'">
                    <b-button
                      @click="
                        $router.push({
                          name: 'admin.department.edit',
                          params: { id: props.row.id },
                        })
                      "
                      class="btn btn-success btn-icon btn-sm"
                      ><i class="fas fa-pencil-alt"></i
                    ></b-button>
                    <b-button
                      class="btn btn-danger btn-icon btn-sm"
                      @click="delete_department(props.row.id)"
                      variant="outline-danger"
                      ><i class="far fa-trash-alt"></i
                    ></b-button>
                  </span>
                  {{
                    props.column.field == "user"
                      ? props.row.user !== null
                        ? props.row.user.name
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
import ModalForm from "@/components/global/ModalForm.vue";
export default {
  components: {
    ModalForm,
  },
  data: () => ({
    showModal: false,
  }),

  async asyncData({ app: { $departmentService } }) {
    // use the user service to get a list of user
    const { data: departments } = await $departmentService.getDepartments();

    return { departments };
  },
  // created() {
  //   this.getDataUser();
  // },
  methods: {
    async showDetails() {
      this.showModal = true;
    },
    async delete_by_selected() {
      // console.log("delete_by_selected");
      // console.log(this.selectedRows);
      // let data;
      // try {
      //   const response = await this.form.post("/users");
      //   data = response.data;
      // } catch (e) {
      //   return;
      // }
      // this.$router.push({ name: "users.list" });
    },
    async delete_department(id) {
      // console.log("delete_user", id);
      // let data;
      // try {
      //   const response = await this.form.post("/users");
      //   data = response.data;
      // } catch (e) {
      //   return;
      // }
      // this.$router.push({ name: "users.list" });
    },
  },
  computed: {
    columns() {
      return [
        {
          label: "ชื่อแผนก",
          field: "name",
          tdClass: "text-center",
          thClass: "text-center",
        },
        {
          label: "วันที่",
          field: "created_at",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "ผู้สร้าง",
          field: "user",
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
