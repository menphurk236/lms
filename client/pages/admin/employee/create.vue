<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">เพิ่มพนักงาน</h4>
      </div>
      <div class="card-body">
        <form class="form-horizontal" @submit.prevent="handleSubmit">
          <div class="row">
            <label class="col-form-label" style="font-size: 1em"
              >แผนกพนักงาน</label
            >
            <div class="col-md-4">
              <div class="form-group">
                <v-select
                  v-model="form.department_id"
                  :options="departments"
                  :reduce="(item) => item.id"
                  :class="{
                    'is-invalid': $v.form.department_id.$error,
                  }"
                  @option:selected="
                    (department) => onSelectedDepartment(department)
                  "
                  @option:deselected="
                    (department) => onDeselectedDepartment(department)
                  "
                  label="name"
                >
                </v-select>
                <div
                  v-if="!$v.form.department_id.required"
                  class="invalid-feedback"
                >
                  กรุณาเลือกแผนกพนักงาน
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-form-label ml-2" style="font-size: 1em"
              >ชื่อ-นามสกุล</label
            >
            <div class="col-md-4">
              <div class="form-group">
                <input
                  type="text"
                  v-model="form.name"
                  :class="{
                    'is-invalid': $v.form.name.$error,
                  }"
                  class="form-control"
                />
                <div v-if="!$v.form.name.required" class="invalid-feedback">
                  กรุณากรอกชื่อ-นามสกุล
                </div>
              </div>
            </div>
            <label class="col-form-label" style="font-size: 1em"
              >รหัสพนักงาน</label
            >
            <div class="col-md-3">
              <div class="form-group">
                <input
                  type="text"
                  v-model="form.code"
                  :class="{
                    'is-invalid': $v.form.code.$error,
                  }"
                  class="form-control"
                />
                <div v-if="!$v.form.code.required" class="invalid-feedback">
                  กรุณากรอกรหัสพนักงาน
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-form-label" style="font-size: 1em"
              >ผู้เพิ่มพนักงาน</label
            >
            <div class="col-md-3">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  :value="user.name"
                  disabled
                />
                <input type="hidden" :value="user.id" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary btn-sm">
                บันทึก
              </button>
              <button type="reset" class="btn btn-info btn-sm">ยกเลิก</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { VueSelect as vSelect } from "vue-select";
import "vue-select/dist/vue-select.css";
import { mapGetters } from "vuex";
import Swal from "sweetalert2";
import { required } from "vuelidate/lib/validators";
export default {
  components: {
    vSelect,
  },
  data() {
    return {
      form: {
        code: "",
        name: "",
        department_id: "",
      },
      departments: [],
    };
  },
  computed: mapGetters({
    user: "auth/user",
  }),
  validations: {
    form: {
      department_id: {
        required,
      },
      code: {
        required,
      },
      name: {
        required,
      },
    },
  },
  mounted() {
    this.department();
  },
  methods: {
    async department() {
      const response = await this.$departmentService.getDepartments();
      this.departments = response.data;
    },
    onSelectedDepartment: function (opt) {
      this.form.department_id = opt.id;
    },
    onDeselectedDepartment: function () {
      this.form.department_id = "";
    },
    async handleSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return false;
      } else {
        this.createEmployee();
      }
    },
    async createEmployee() {
      const response = await this.$employeeService.createEmployee(this.form);
      if (response.status === 201) {
        Swal.fire({
          icon: "success",
          title: "เพิ่มพนักงานสำเร็จ",
          showConfirmButton: false,
          timer: 1500,
        });
        this.$router.push({ name: "employee.list" });
      }
    },
  },
};
</script>

<style>
</style>
