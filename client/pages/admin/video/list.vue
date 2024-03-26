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
                            name: 'admin.video.edit',
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
                    <!-- {{
                      props.column.field == "role"
                        ? props.row.role !== null
                          ? props.row.role.name
                          : ""
                        : props.row[props.column.field]
                    }} -->
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
  async asyncData({ app: { $videoService } }) {
    // use the user service to get a list of user
    const { data: videos } = await $videoService.getVideos();

    return { videos };
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
  methods: {},
};
</script>

<style>
</style>
