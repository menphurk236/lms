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
                <form @submit.prevent="handleSubmit" autocomplete="nope">
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
                      <vue-bootstrap-typeahead
                        v-model="query"
                        placeholder="พิมพ์ชื่อตัวเอง 5 ตัวอักษรขึ้นไป"
                        :data="employees"
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
import VueBootstrapTypeahead from "vue-bootstrap-typeahead";
import { mapGetters } from "vuex";
import Swal from "sweetalert2";

export default {
  layout: "simple",
  components: {
    VueBootstrapTypeahead,
  },
  data: () => ({
    title: process.env.appName,
    query: "",
    employees: [],
  }),

  created() {
    this.getEmployees();
  },

  methods: {
    async getEmployees() {
      try {
        const response = await this.$masterDataService.getEmployee();
        this.employees = response.data.map((employee) => {
          return {
            id: employee.id,
            name: employee.name,
          };
        });
      } catch (error) {
        console.log(error);
      }
    },
    async handleSubmit() {
      console.log(this.query);
      if (this.query.length < 5) {
        Swal.fire({
          icon: "error",
          title: "ข้อผิดพลาด",
          text: "กรุณากรอกชื่อตัวเอง 5 ตัวอักษรขึ้นไป",
        });
      } else {
        this.$router.push({ name: "result", query: { search: this.query } });
      }
    },
  },

  head() {
    return { title: this.$t("home") };
  },

  computed: mapGetters({
    authenticated: "auth/check",
  }),
};
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

.laravel {
  color: #2e495e;
}

.nuxt {
  color: #00c48d;
}
</style>
