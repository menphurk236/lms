<template>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">ข้อมูลพนักงาน</h4>
          </div>
          <div class="card-body">
            <div class="typography-line">
              <h4><span>ชื่อ</span>{{ employee.name }}</h4>
            </div>
            <div class="typography-line">
              <h4><span>รหัสพนักงาน</span>{{ employee.code }}</h4>
            </div>
            <div class="typography-line">
              <h4><span>แผนก</span>{{ employee.department.name }}</h4>
            </div>
            <div class="typography-line">
              <h4><span>เปอร์เซ็นต์ที่ดู</span>0%</h4>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <th>ลำดับ</th>
                  <th>หมวด</th>
                  <th>ชื่อ Video</th>
                  <th>ความยาว</th>
                  <th>ผู้สร้าง</th>
                  <th class="text-right">Action</th>
                </thead>
                <tbody>
                  <tr v-for="empvideo in employeeVideos" :key="empvideo">
                    <td>{{ 1 }}</td>
                    <td>{{ empvideo.video.categoryvideo.name }}</td>
                    <td>{{ empvideo.video.title }}</td>
                    <td>{{ empvideo.video.video_duration }}</td>
                    <td>-</td>
                    <td class="td-actions">
                      <button
                        class="btn btn-danger btn-icon btn-sm"
                        @click="delete_employeeVideo(empvideo.id)"
                      >
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <center>
              <button
                @click="employeeModelAddVideo = !employeeModelAddVideo"
                class="btn btn-primary btn-lg"
              >
                <i class="fas fa-pencil-alt"></i> เพิ่มวิดิโอ
              </button>
            </center>

            <!-- Modal -->
            <b-modal v-model="employeeModelAddVideo" hide-footer>
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มวิดิโอ</h5>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" @submit.prevent="handleSubmit()">
                  <div class="row">
                    <label class="col-md-2 col-form-label">ชื่อวิดิโอ</label>
                    <div class="col-md-10">
                      <div class="form-group">
                        <v-select
                          v-model="form.video_id"
                          :options="videos"
                          :reduce="(item) => item.id"
                          :class="{
                            'is-invalid': $v.form.video_id.$error,
                          }"
                          label="name"
                        >
                        </v-select>
                        <div
                          v-if="!$v.form.video_id.required"
                          class="invalid-feedback"
                        >
                          กรุณาเลือกแผนกพนักงาน
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <b-button type="submit" class="btn btn-primary"
                      >เพิ่ม</b-button
                    >
                  </div>
                </form>
              </div>
            </b-modal>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueSelect as vSelect } from "vue-select";
import "vue-select/dist/vue-select.css";
import Swal from "sweetalert2";
import { required } from "vuelidate/lib/validators";
export default {
  components: {
    vSelect,
  },
  data() {
    return {
      employee: {
        department: {},
      },
      employeeVideos: [],
      employeeModelAddVideo: false,
      form: {
        video_id: "",
        employee_id: "",
      },
      videos: [],
    };
  },
  validations: {
    form: {
      video_id: {
        required,
      },
    },
  },
  async asyncData({ app: { $videoService } }) {
    // use the user service to get a list of user
    const { data: videos } = await $videoService.getVideos();

    return { videos };
  },
  async mounted() {
    const { id } = this.$route.params;
    const { data: employee } = await this.$employeeService.getEmployee(id);
    this.employee = employee;
    this.employeeVideos =
      employee.employeeVideos.length > 0 ? employee.employeeVideos : [];

    this.videos = this.videos.map((video) => {
      return {
        id: video.id,
        name: video.title,
      };
    });
  },
  methods: {
    async handleSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return false;
      } else {
        this.addVideoEmployee();
      }
    },
    async addVideoEmployee() {
      this.form.employee_id = this.employee.id;
      this.form.video_id = this.form.video_id;
      const { data: employeeVideo } =
        await this.$employeeService.addVideoEmployee(
          this.$route.params.id,
          this.form
        );
      this.employeeModelAddVideo = false;
      this.$fetch();
    },
    async delete_employeeVideo(id) {
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
        await this.$employeeService.deleteVideoEmployee(id);
        Swal.fire("ลบวิดิโอเรียบร้อย!", "", "success");
        this.$nuxt.refresh();
      }
    },
    onSelectedCategory: function (opt) {
      this.form.category_video_id = opt.id;
    },
    onDeselectedCategory: function () {
      this.form.category_video_id = "";
    },
  },

  computed: {
    columns() {
      return [
        {
          label: "ชื่อแผนก",
          field: "department",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "รหัสพนักงาน",
          field: "code",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
        {
          label: "ชื่อ-นามสกุล",
          field: "name",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "เปอร์เซ็นต์ที่ดู",
          field: "video_duration",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "วันที่สร้าง",
          field: "created_at",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "วันที่แก้ไข",
          field: "updated_at",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "Actions",
          field: "actions",
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
