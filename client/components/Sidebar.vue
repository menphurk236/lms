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
        <li class="">
          <router-link :to="{ name: 'dashboard' }">
            <i class="now-ui-icons shopping_shop"></i>
            <p>แดชบอร์ด</p>
          </router-link>
        </li>
        <li class="">
          <a data-toggle="collapse" href="#departmentExamples">
            <i class="now-ui-icons education_atom"></i>
            <p>แผนก <b class="caret"></b></p>
          </a>
          <div class="" id="departmentExamples">
            <ul class="nav">
              <li class="">
                <router-link :to="{ name: 'department.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> แผนกทั้งหมด </span>
                </router-link>
              </li>
              <li>
                <!-- <a data-toggle="modal" data-target="#staticBackdrop">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มแผนก </span>
                </a> -->
                <router-link :to="{ name: 'department.create' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มแผนก </span>
                </router-link>
              </li>
            </ul>
          </div>
        </li>
        <li class="">
          <a data-toggle="collapse" href="#videoExamples">
            <i class="now-ui-icons media-1_button-play"></i>
            <p>วิดิโอ LMS <b class="caret"></b></p>
          </a>
          <div class="" id="videoExamples">
            <ul class="nav">
              <li class="">
                <router-link :to="{ name: 'catogory.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> หมวดวิดิโอ </span>
                </router-link>
              </li>
              <li class="">
                <router-link :to="{ name: 'video.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> วิดิโอทั้งหมด </span>
                </router-link>
              </li>
              <li class="">
                <router-link :to="{ name: 'video.create' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มวิดิโอ </span>
                </router-link>
              </li>
            </ul>
          </div>
        </li>
        <li class="">
          <a data-toggle="collapse" href="#empExamples">
            <i class="now-ui-icons users_circle-08"></i>
            <p>พนักงาน <b class="caret"></b></p>
          </a>
          <div class="" id="empExamples">
            <ul class="nav">
              <li class="">
                <router-link :to="{ name: 'employee.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> พนักงานทั้งหมด </span>
                </router-link>
              </li>
              <li class="">
                <router-link :to="{ name: 'employee.create' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> เพิ่มพนักงาน </span>
                </router-link>
              </li>
            </ul>
          </div>
        </li>
        <li class="">
          <a data-toggle="collapse" href="#usersExamples">
            <i class="now-ui-icons users_single-02"></i>
            <p>ผู้ใช้งาน <b class="caret"></b></p>
          </a>
          <div id="usersExamples" class="">
            <ul class="nav">
              <li class="">
                <router-link :to="{ name: 'users.list' }">
                  <span class="sidebar-mini-icon">-</span>
                  <span class="sidebar-normal"> ผู้ใช้งานทั้งหมด </span>
                </router-link>
              </li>
              <li class="">
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
export default {};
</script>

<style>
</style>
