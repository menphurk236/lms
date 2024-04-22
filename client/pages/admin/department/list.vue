<template>
  <div class="content">
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
                @click="showModal = true"
                class="btn btn-primary btn-sm ml-2"
                >เพิ่มแผนก</b-button
              >
              <b-modal v-model="showModal" title="เพิ่มแผนก" hide-footer>
                <form class="form-horizontal" @submit.prevent="handleSubmit()">
                  <div class="row">
                    <label class="col-md-2 col-form-label">ชื่อแผนก</label>
                    <div class="col-md-8">
                      <div class="form-group">
                        <input
                          type="text"
                          v-model="form.name"
                          class="form-control"
                          :class="{
                            'is-invalid': $v.form.name.$error,
                          }"
                        />
                        <div
                          v-if="!$v.form.name.required"
                          class="invalid-feedback"
                        >
                          กรุณากรอกชื่อแผนก
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary">
                      บันทึก
                    </button>
                  </div>
                </form>
              </b-modal>
            </div>

            <form
              @submit.prevent="getDepartments"
              method="GET"
              class="form-inline m-3"
            >
              <div class="form-group d-flex col-xs-12 col-sm-12">
                <label
                  class="col-label"
                  style="font-size: 1em; margin-right: 16px"
                  >ชื่อแผนก</label
                >
                <div class="form-group col-xs-12">
                  <select class="form-control" v-model="q">
                    <option value>กรุณาเลือก</option>
                    <option
                      v-for="item in listdepartments"
                      :key="item"
                      :value="item.id"
                    >
                      {{ item.name }}
                    </option>
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
                :columns="columns"
                :rows="departments"
                :pagination-options="{
                  enabled: true,
                  mode: 'records',
                }"
                :line-numbers="true"
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
                      @click="editDepartment(props.row.id)"
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
                        : "-"
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
</template>
<script>
import Swal from "sweetalert2";
import ModalForm from "../../../components/ModalForm.vue";
import { required } from "vuelidate/lib/validators";
export default {
  components: {
    ModalForm,
  },
  data() {
    return {
      showModal: false,
      departments: [],
      selectedRows: [],
      form: {
        name: "",
      },
      listdepartments: [],
      q: "",
    };
  },
  validations: {
    form: {
      name: {
        required,
      },
    },
  },
  // async asyncData({ app: { $departmentService } }) {
  //   // use the user service to get a list of user
  //   const { data: departments } = await $departmentService.getDepartments();

  //   return { departments };
  // },
  created() {
    this.getDepartments();
  },
  methods: {
    async getDepartments() {
      const { data: departments } =
        await this.$departmentService.getDepartments(this.q);
      this.listdepartments = departments;
      this.departments = departments;
    },
    async editDepartment(id) {
      this.showModal = true;
      this.form = this.departments.find((department) => department.id === id);
    },
    async handleSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      if (this.form.id) {
        await this.$departmentService.updateDepartment(this.form.id, this.form);
      } else {
        await this.$departmentService.createDepartment(this.form);
      }

      this.showModal = false;
      this.form = {
        name: "",
      };
      this.$nuxt.refresh();
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
      const { value } = await Swal.fire({
        title: "คุณแน่ใจหรือไม่?",
        text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่, ลบข้อมูล!",
      });

      if (value) {
        await this.$departmentService.deleteDepartment(id);
        this.departments = this.departments.filter((department) => {
          return department.id !== id;
        });
        Swal.fire("ลบแผนกเรียบร้อย!", "", "success");
      }
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
          dateInputFormat: "yyyy-MM-dd", // expects 2018-03-16
          dateOutputFormat: "MMM do yyyy", // outputs Mar 16th 2018
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
