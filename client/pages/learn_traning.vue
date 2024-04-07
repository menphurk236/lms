<template>
  <div class="full-page full-page-backgroud">
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="container">
              <div class="row">
                <div class="col-md-7 col-12">
                  <h3 class="text-heading">บทเรียน Lms ออนไลน์</h3>
                </div>
                <div class="col-md-5 col-12">
                  <form
                    action=""
                    method="GET"
                    class="form-inline pull-right pull-left-sm input-home"
                  >
                    <div class="form-row align-items-end">
                      <div class="form-group col-7">
                        <label class="sr-only" for="search">Search</label>
                        <input
                          type="text"
                          class="form-control input-search"
                          name="q"
                          id="search"
                          placeholder="ค้นหา"
                        />
                      </div>

                      <div class="form-group col-auto ml-3">
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
                </div>
              </div>

              <section>
                <div class="d-flex flex-row comment-row m-t-0">
                  <div class="comment-text w-100">
                    <h6
                      style="font-size: 16px; font-weight: 400"
                      class="text-responsive"
                    >
                      ชื่อ {{ employee.name }}
                    </h6>
                  </div>
                </div>
                <div class="d-flex flex-row comment-row m-t-0">
                  <div class="comment-text w-100">
                    <h6
                      style="font-size: 16px; font-weight: 400"
                      class="text-responsive"
                    >
                      รหัสพนักงาน {{ employee.code }}
                    </h6>
                  </div>
                </div>
                <div class="d-flex flex-row comment-row m-t-0">
                  <div class="comment-text w-100">
                    <h6
                      style="font-size: 16px; font-weight: 400"
                      class="text-responsive"
                    >
                      แผนก {{ employee.department.name }}
                    </h6>
                  </div>
                </div>
                <div class="d-flex flex-row comment-row m-t-0">
                  <div class="comment-text w-100">
                    <h6
                      style="font-size: 16px; font-weight: 400"
                      class="text-responsive"
                    >
                      เปอร์เซ็นที่ดูวิดิโอทั้งหมด
                    </h6>
                  </div>
                </div>

                <!-- <form
                  action=""
                  method="GET"
                  class="form-inline pull-right pull-left-sm d-xl-none mt-3 mb-3"
                >
                  <div class="form-row align-items-end">
                    <div class="form-group col-8">
                      <label class="sr-only" for="search">Search</label>
                      <input
                        type="text"
                        class="form-control form-control-sm"
                        placeholder="ค้นหา"
                      />
                    </div>

                    <div class="form-group" style="padding-left: 13px">
                      <button
                        type="submit"
                        class="btn btn-primary"
                        style="margin: 0"
                      >
                        ค้นหา
                      </button>
                    </div>
                  </div>
                </form> -->
              </section>

              <section>
                <div class="embed-responsive embed-responsive-16by9">
                  <video
                    width="100%"
                    controls
                    disablePictureInPicture
                    controlsList="nodownload"
                    :src="videos.video_url"
                    v-play="playing"
                  >
                    <source :src="videos.video_url" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
                <div class="d-flex justify-content-center mb-2">
                  <div class="mr-5">
                    <h4 class="font-medium text-heading-general">
                      {{ videos.title }}
                    </h4>
                  </div>
                  <h4 class="font-medium text-heading-general">
                    เวลา {{ videos.video_duration }} นาที
                  </h4>
                </div>
              </section>
              <section class="pt-4">
                <h5 class="font-medium">วิดิโอที่เพิ่มขึ้นใหม่</h5>
                <div class="table-responsive-md">
                  <table
                    class="table table-bordered"
                    style="margin-bottom: 0; border: 1px solid #dee2e6"
                  >
                    <thead style="font-size: 11px; font-weight: 400">
                      <th width="10%">
                        <div class="truncate">ลำดับ</div>
                      </th>
                      <th width="10%" data-field="categoryvideo">
                        <div class="truncate">หมวด</div>
                      </th>
                      <th width="34%" class="text-center">
                        <div class="truncate">ชื่อ Video</div>
                      </th>
                      <th data-sortable="true">
                        <div class="truncate">ความยาว</div>
                      </th>
                      <th>
                        <div class="truncate">ผู้สร้าง</div>
                      </th>
                      <th class="text-right">
                        <div class="truncate">สถานะ</div>
                      </th>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in video" :key="item">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.categoryvideo.name }}</td>
                        <td>
                          <a href="#" @click="play(item.id)">{{
                            item.title
                          }}</a>
                        </td>
                        <td>{{ item.video_duration }}</td>
                        <td>{{ item.created_by != null ? "-" : "-" }}</td>
                        <td class="text-right"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>

              <form
                action=""
                class="form-inline pull-right pull-left-sm mt-3 mb-3 mr-2"
                method="GET"
              >
                <div class="form-row align-items-end">
                  <div class="form-group form-group-lg col-7">
                    <label class="sr-only" for="search">Search</label>
                    <select class="form-control">
                      <option></option>
                      <option>ดูแล้ว</option>
                      <option>ผิดพลาด</option>
                      <option>ดูไม่สำเร็จ</option>
                      <option>ไม่สำเร็จ</option>
                    </select>
                  </div>

                  <div class="form-group" style="margin-left: 29px">
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

              <section class="pt-4">
                <div class="table-responsive-md">
                  <table
                    class="table table-bordered"
                    style="margin-bottom: 0; border: 1px solid #dee2e6"
                  >
                    <thead style="font-size: 11px; font-weight: 400">
                      <th width="10%" data-field="id" data-sortable="true">
                        <div class="truncate">ลำดับ</div>
                      </th>
                      <th
                        width="10%"
                        data-field="categoryvideo"
                        data-sortable="true"
                      >
                        <div class="truncate">หมวด</div>
                      </th>
                      <th width="10%">
                        <div class="truncate">รหัส</div>
                      </th>
                      <th
                        width="34%"
                        class="text-center"
                        data-field="name"
                        data-sortable="true"
                      >
                        <div class="truncate">ชื่อ Video</div>
                      </th>
                      <th data-sortable="true">
                        <div class="truncate">ความยาว</div>
                      </th>
                      <th>
                        <div class="truncate">ผู้สร้าง</div>
                      </th>
                      <th class="text-right">
                        <div class="truncate">สถานะ</div>
                      </th>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: "simple",
  data: () => ({
    employee: {
      department: {},
    },
    videos: [],
    playing: false,
  }),
  created() {
    //console.log("created", this.$route.query.search);
    this.getResultEmp();
  },
  computed: {
    paused() {
      return !this.playing;
    },
  },
  directives: {
    play: {
      bind(el, binding, vnode) {
        console.log("binding: " + binding.arg);
        el.addEventListener("playing", () => {
          vnode.context[binding.expression] = !el.paused;
        });
        el.addEventListener("pause", () => {
          vnode.context[binding.expression] = !el.paused;
        });
        vnode.context[binding.expression] = !el.paused;
      },
      update(el, binding) {
        if (el.paused) {
          if (binding.value) {
            el.play();
          }
        } else if (!binding.value) {
          el.pause();
        }
      },
    },
  },
  methods: {
    async getResultEmp() {
      try {
        const response = await this.$homeService.getResult(
          this.$route.query.search
        );
        console.log(response.data);
        this.employee = response.data.employee;
        this.video = response.data.video;
      } catch (error) {
        console.error(error);
      }
    },
    async play(id) {
      this.playing = !this.playing;
      this.videos = this.video.find((video) => video.id === id);
    },
    async pause() {
      this.playing = false;
    },
  },
};
</script>

<style>
</style>
