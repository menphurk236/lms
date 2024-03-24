<template>
  <div class="content">
    <div class="row">
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">พนักงานทั้งหมด</h5>
            <span style="font-size: 54px">100 คน</span>
            <div class="dropdown">
              <i class="fas fa-user-friends fa-6x"></i>
            </div>
          </div>
          <div class="card-body"></div>
          <div class="card-footer"></div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">แผนกทั้งหมด</h5>
            <span style="font-size: 54px">20 แผนก</span>
            <div class="dropdown">
              <i class="fas fa-address-book fa-6x"></i>
            </div>
          </div>
          <div class="card-body"></div>
          <div class="card-footer"></div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">วิดิโอทั้งหมด</h5>
            <span style="font-size: 54px">100 วิดิโอ</span>
            <div class="dropdown">
              <i class="fas fa-video fa-6x"></i>
            </div>
          </div>
          <div class="card-body"></div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-tasks">
          <div class="card-header">
            <h5 class="card-category">คิดเป็น % ของแต่ละแผนก</h5>
          </div>
          <div class="card-body">
            <canvas id="myChart1"></canvas>
          </div>
          <div class="card-footer">
            <hr />
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-category">แผนกที่ดูวิดิโอเยอะสุด (คิดเป็น %)</h5>
          </div>
          <div class="card-body">
            <canvas id="myChart2"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
};
</script>

<style>
</style>
