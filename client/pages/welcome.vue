<template>
  <div class="wrapper wrapper-full-page">
    <div
      class="full-page full-page-background section-image"
      data-image="~/assets/images/bg.jpg"
    >
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col ml-auto mr-auto text-center">
              <h2 class="title" style="color: black">บทเรียน Lms ออนไลน์</h2>
              <h5 class="description" style="color: black">
                กรอกชื่อตัวเอง เพื่อดูบทเรียน Lms ออนไลน์
              </h5>
            </div>
            <div class="col-md-12 ml-auto">
              <div class="d-flex justify-content-center">
                <form @submit.prevent="handleSubmit()" autocomplete="nope">
                  <div class="form-row align-items-end">
                    <div class="form-group col">
                      <!-- <input
                        class="typeahead form-control"
                        placeholder="พิมพ์ชื่อตัวเอง 5 ตัวอักษรขึ้นไป"
                        id="search"
                        wire:model.defer="search"
                        name="search"
                        type="text"
                        autocomplete="off"
                        required
                      /> -->
                      <vue-typeahead-bootstrap
                        :data="employees"
                        v-model="query"
                        :serializer="(item) => item.name"
                        :minMatchingChars="5"
                        :disabledValues="
                          selectedquery ? [selectedquery.name] : []
                        "
                        placeholder="พิมพ์ชื่อตัวเอง 5 ตัวอักษรขึ้นไป"
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueTypeaheadBootstrap from "vue-typeahead-bootstrap";
import Swal from "sweetalert2";

export default {
  layout: "simple",
  components: {
    VueTypeaheadBootstrap,
  },
  data: () => ({
    title: process.env.appName,
    query: "",
    selectedquery: null,
    employees: [],
  }),

  created() {
    this.getEmployees();
  },

  methods: {
    async getEmployees() {
      const response = await this.$masterDataService.getEmployee();
      this.employees = response.data;
      console.log(this.employees);
    },
    async handleSubmit() {
      if (this.query.length < 5) {
        Swal.fire({
          icon: "error",
          title: "ข้อผิดพลาด",
          text: "กรุณากรอกชื่อตัวเอง 5 ตัวอักษรขึ้นไป",
        });
      } else {
        this.$router.push({
          name: "traning",
          query: { search: this.query },
        });
      }
    },
  },

  head() {
    return { title: this.$t("home") };
  },
};
</script>
