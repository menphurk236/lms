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
                วิดิโอ LMS
              </h4>
              <div style="font-size: 16px; font-weight: 400">
                วิดิโอ LMS ทั้งหมด {{ videos.length }} วิดิโอ
                <router-link
                  to="/video/create"
                  class="btn btn-primary btn-sm ml-2"
                  >เพิ่ม</router-link
                >
              </div>
              <form
                @submit.prevent="getVideos"
                method="GET"
                class="form-inline pull-right pull-left-sm m-3"
              >
                <div class="form-row align-items-end">
                  <div class="form-group col-8 mr-1">
                    <label class="sr-only" for="search">Search</label>
                    <input
                      type="text"
                      class="form-control input-search"
                      v-model="q"
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
                  :rows="videos"
                  :pagination-options="{
                    enabled: true,
                    mode: 'records',
                  }"
                  :line-numbers="true"
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
                            name: 'video.edit',
                            params: { id: props.row.id },
                          })
                        "
                        class="btn btn-success btn-icon btn-sm"
                        ><i class="fas fa-pencil-alt"></i
                      ></b-button>
                      <b-button
                        class="btn btn-danger btn-icon btn-sm"
                        @click="delete_video(props.row.id)"
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
import Swal from "sweetalert2";
export default {
  data() {
    return {
      q: "",
      videos: [],
    };
  },
  created() {
    this.getVideos();
  },
  computed: {
    columns() {
      return [
        {
          label: "รหัสวิดิโอ",
          field: "id",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "ชื่อวิดิโอ",
          field: "title",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
        {
          label: "ความยาว",
          field: "video_duration",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "ผู้สร้าง",
          field: "user",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
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
  methods: {
    async getVideos() {
      const { data: videos } = await this.$videoService.getVideos(this.q);
      this.videos = videos;
    },
    async delete_video(id) {
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
        await this.$videoService.deleteVideo(id);
        this.videos = this.videos.filter((video) => video.id !== id);
        Swal.fire("ลบวิดิโอเรียบร้อย!", "", "success");
      }
    },
    async delete_by_selected() {
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
        const selected = this.$refs.vgtTableRef.selectedRows;
        for (let i = 0; i < selected.length; i++) {
          await this.$videoService.deleteVideo(selected[i].id);
          this.videos = this.videos.filter(
            (video) => video.id !== selected[i].id
          );
        }
      }
    },
  },
};
</script>

<style>
</style>
