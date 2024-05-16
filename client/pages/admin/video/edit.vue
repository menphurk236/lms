<template>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">แก้ไข วิดิโอ Lms</h4>
          </div>
          <div class="card-body">
            <form
              class="form-horizontal"
              method="POST"
              @submit.prevent="handleSubmit"
              enctype="multipart/form-data"
            >
              <div class="row">
                <label class="col-form-label" style="font-size: 1em"
                  >ชื่อหมวด</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <v-select
                      v-model="form.category_video_id"
                      :options="category_videos"
                      :reduce="(item) => item.id"
                      :class="{
                        'is-invalid': $v.form.category_video_id.$error,
                      }"
                      @option:selected="
                        (category_videos) => onSelectedCategory(category_videos)
                      "
                      @option:deselected="
                        (category_videos) =>
                          onDeselectedCategory(category_videos)
                      "
                      label="name"
                    >
                    </v-select>
                    <div
                      v-if="!$v.form.category_video_id.required"
                      class="invalid-feedback"
                    >
                      กรุณาเลือกชื่อหมวด
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-form-label" style="font-size: 1em"
                  >ชื่อวิดิโอ</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      :class="{
                        'is-invalid': $v.form.title.$error,
                      }"
                      v-model="form.title"
                    />
                    <div
                      v-if="!$v.form.title.required"
                      class="invalid-feedback"
                    >
                      กรุณากรอกชื่อวิดิโอ
                    </div>
                  </div>
                </div>
                <label class="col-form-label" style="font-size: 1em"
                  >ความยาว</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.video_duration"
                      placeholder="ตัวอย่างการกรอก 00:00"
                      :class="{
                        'is-invalid': $v.form.video_duration.$error,
                      }"
                      class="form-control"
                    />
                    <div
                      v-if="!$v.form.video_duration.required"
                      class="invalid-feedback"
                    >
                      กรุณากรอกความยาววิดิโอ (ตัวอย่างการกรอก 00:00)
                    </div>
                  </div>
                </div>
                <label class="col-md-1 col-form-label" style="font-size: 1em"
                  >อัพโหลดวิดิโอ</label
                >
                <div class="col-md-3">
                  <input
                    type="file"
                    ref="video_path"
                    @change="selectFile()"
                    accept="video/mp4,video/x-m4v,video/*"
                    :class="{ 'is-invalid': $v.form.video_path.$error }"
                  />
                  <div
                    v-if="$v.form.video_path.$error"
                    class="invalid-feedback"
                  >
                    <span v-if="!$v.form.video_path.required"
                      >กรุณาอัพโหลดวิดิโอ</span
                    >
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-form-label" style="font-size: 1em"
                  >ผู้สร้าง</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.created_upload"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-form-label" style="font-size: 1em"
                  >ผู้อัพวิดิโอ</label
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
              <div class="card-header">
                <h4 class="card-title">เพิ่มแผนกที่ต้องดู</h4>
              </div>
              <div class="row">
                <label class="col-form-label" style="font-size: 1em"
                  >แผนก</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <v-select
                      multiple
                      v-model="department_id"
                      :options="departments"
                      :reduce="(item) => item.id"
                      @option:selected="
                        (departments) => onSelectedDepartment(departments)
                      "
                      @option:deselected="
                        (departments) => onDeselectedDepartment(departments)
                      "
                      label="name"
                    ></v-select>
                  </div>
                </div>
                <label class="col-form-label" style="font-size: 1em"
                  >รายชื่อพนักงาน</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <v-select
                      multiple
                      v-model="employee_id"
                      :options="employees"
                      :reduce="(item) => item.id"
                      @option:selected="(employees) => onSelectedEmp(employees)"
                      @option:deselected="
                        (employees) => onDeselectedEmp(employees)
                      "
                      label="name"
                    ></v-select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <button type="submit" class="btn btn-primary">บันทึก</button>
                  <button type="reset" class="btn btn-info">ยกเลิก</button>
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
import { VueSelect as vSelect } from "vue-select";
import "vue-select/dist/vue-select.css";
import { mapGetters } from "vuex";
import Swal from "sweetalert2";
import axios from "axios";
import { required } from "vuelidate/lib/validators";
export default {
  middleware: "auth",
  components: {
    vSelect,
  },
  computed: mapGetters({
    user: "auth/user",
  }),
  validations: {
    form: {
      category_video_id: {
        required,
      },
      title: {
        required,
      },
      video_duration: {
        required,
      },
      video_path: {
        required,
      },
    },
  },
  data: () => ({
    form: {
      category_video_id: "",
      title: "",
      video_duration: "",
      video_path: "",
      created_upload: "",
      department_id: [],
      employee_id: [],
    },
    departments: [],
    category_videos: [],
    employees: [],
    department_id: [],
    employee_id: [],
  }),
  created() {
    this.getVideo();
    this.category();
    this.department();
    this.employeebydepartment();
  },
  methods: {
    async getVideo() {
      const { id } = this.$route.params;
      const { data: video } = await this.$videoService.getVideo(id);
      this.form = video;
      this.department_id = video.department_id.map((item) => item.id);
      this.employee_id = video.employee_id.map((item) => item.id);
    },
    async department() {
      const response = await this.$masterDataService.getDepartment();
      this.departments = response.data;
    },
    async employeebydepartment() {
      const response = await axios.get(
        "master/employee-by-department/?search=" + this.department_id
      );
      this.employees = response.data;
      console.log(this.department_id);
    },
    async category() {
      const response = await this.$masterDataService.getCategoryVideo();
      this.category_videos = response.data;
    },
    onSelectedCategory: function (opt) {
      this.form.category_video_id = opt.id;
    },
    onDeselectedCategory: function () {
      this.form.category_video_id = "";
    },

    onSelectedDepartment: function (opt) {
      this.department_id = opt.map((item) => item.id);
      this.employeebydepartment();
    },

    onDeselectedDepartment: function () {
      this.department_id = [];
    },

    onSelectedEmp: function (opt) {
      this.employee_id = opt.map((item) => item.id);
    },

    onDeselectedEmp: function () {
      this.employee_id = [];
    },

    // eslint-disable-next-line require-await
    async selectFile() {
      this.form.video_path = this.$refs.video_path.files[0];
    },
    // eslint-disable-next-line require-await
    async handleSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return false;
      } else {
        this.updateVideo();
      }
    },
    async updateVideo() {
      const formData = new FormData();
      formData.append("category_video_id", this.form.category_video_id);
      formData.append("title", this.form.title);
      formData.append("video_duration", this.form.video_duration);
      formData.append("video_path", this.form.video_path);
      formData.append("created_upload", this.form.created_upload);
      this.department_id.forEach((option) => {
        formData.append("department_id[]", option);
      });
      this.employee_id.forEach((option) => {
        formData.append("employee_id[]", option);
      });
      const { id } = this.$route.params;
      await axios
        .put("videos/" + id, formData)
        .then((response) => {
          this.$router.push({ name: "video.list" });
          Swal.fire({
            icon: "success",
            title: "แจ้งเตือนระบบ",
            text: "บันทึกข้อมูลสำเร็จ",
            reverseButtons: true,
            confirmButtonText: "ok",
            cancelButtonText: "cancel",
          });
        })
        .catch((response) => {
          Swal.fire({
            icon: "error",
            title: "แจ้งเตือนระบบ",
            text: response,
            reverseButtons: true,
            confirmButtonText: "ok",
            cancelButtonText: "cancel",
          });
        });
    },
  },
};
</script>

<style>
</style>
