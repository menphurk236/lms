<template>
  <header>
    <div class="logo">
      <a href="#" class="simple-text logo-normal">
        <img
          src="https://www.tumtook.com/wp-content/uploads/2022/09/cropped-Tumtook_New_Logo_Invert-2-1.png"
        />
      </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        <li :class="{ active: this.$nuxt.$route.path === '/dashboard' }">
          <router-link
            :to="{ name: 'dashboard' }"
            :class="{ active: this.$nuxt.$route.path === '/dashboard' }"
          >
            <i class="now-ui-icons shopping_shop"></i>
            <p>แดชบอร์ด</p>
          </router-link>
        </li>
        <li :class="{ active: this.$nuxt.$route.path === '/department/list' }">
          <a
            data-toggle="collapse"
            class="collapsed"
            href="#departmentExamples"
          >
            <i class="now-ui-icons education_atom"></i>
            <p>แผนก <b class="caret"></b></p>
          </a>
          <div class="" id="departmentExamples">
            <ul class="nav">
              <li
                :class="{
                  active: this.$nuxt.$route.path === '/department/list',
                }"
              >
                <router-link :to="{ name: 'department.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> แผนกทั้งหมด </span>
                </router-link>
              </li>
              <li>
                <a
                  data-toggle="modal"
                  data-target="#staticBackdrop"
                  @click="showModal = true"
                  ><span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มแผนก </span></a
                >
                <b-modal v-model="showModal" title="เพิ่มแผนก" hide-footer>
                  <form
                    class="form-horizontal"
                    @submit.prevent="handleSubmit()"
                  >
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
              </li>
            </ul>
          </div>
        </li>
        <li
          :class="{
            active:
              this.$nuxt.$route.path === '/category/list' ||
              this.$nuxt.$route.path === '/video/list' ||
              this.$nuxt.$route.path === '/video/create',
          }"
        >
          <a data-toggle="collapse" class="collapsed" href="#videoExamples">
            <i class="now-ui-icons media-1_button-play"></i>
            <p>วิดิโอ LMS <b class="caret"></b></p>
          </a>
          <div class="" id="videoExamples">
            <ul class="nav">
              <li
                :class="{ active: this.$nuxt.$route.path === '/category/list' }"
              >
                <router-link :to="{ name: 'category.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> หมวดวิดิโอ </span>
                </router-link>
              </li>
              <li :class="{ active: this.$nuxt.$route.path === '/video/list' }">
                <router-link :to="{ name: 'video.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> วิดิโอทั้งหมด </span>
                </router-link>
              </li>
              <li
                :class="{ active: this.$nuxt.$route.path === '/video/create' }"
              >
                <router-link :to="{ name: 'video.create' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มวิดิโอ </span>
                </router-link>
              </li>
            </ul>
          </div>
        </li>
        <li
          :class="{
            active:
              this.$nuxt.$route.path === '/employee/list' ||
              this.$nuxt.$route.path === '/employee/create',
          }"
        >
          <a data-toggle="collapse" class="collapsed" href="#empExamples">
            <i class="now-ui-icons users_circle-08"></i>
            <p>พนักงาน <b class="caret"></b></p>
          </a>
          <div class="" id="empExamples">
            <ul class="nav">
              <li
                :class="{
                  active: this.$nuxt.$route.path === '/employee/list',
                }"
              >
                <router-link :to="{ name: 'employee.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> พนักงานทั้งหมด </span>
                </router-link>
              </li>
              <li
                :class="{
                  active: this.$nuxt.$route.path === '/employee/create',
                }"
              >
                <router-link :to="{ name: 'employee.create' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มพนักงาน </span>
                </router-link>
              </li>
            </ul>
          </div>
        </li>
        <li
          :class="{
            active:
              this.$nuxt.$route.path === '/users/create' ||
              this.$nuxt.$route.path === '/users/list',
          }"
        >
          <a data-toggle="collapse" class="collapsed" href="#usersExamples">
            <i class="now-ui-icons users_single-02"></i>
            <p>ผู้ใช้งาน <b class="caret"></b></p>
          </a>
          <div id="usersExamples" class="">
            <ul class="nav">
              <li
                :class="{
                  active: this.$nuxt.$route.path === '/users/list',
                }"
              >
                <router-link :to="{ name: 'users.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> ผู้ใช้งานทั้งหมด </span>
                </router-link>
              </li>
              <li
                :class="{
                  active: this.$nuxt.$route.path === '/users/create',
                }"
              >
                <router-link :to="{ name: 'users.create' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มผู้ใช้งาน </span>
                </router-link>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </header>
</template>

<script>
import { required } from "vuelidate/lib/validators";
export default {
  data() {
    return {
      showModal: false,
      form: {
        name: "",
      },
    };
  },
  validations: {
    form: {
      name: {
        required,
      },
    },
  },
  methods: {
    handleSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      this.$store.dispatch("department/createDepartment", this.form);
      this.showModal = false;
    },
  },
};
</script>

<style>
</style>
