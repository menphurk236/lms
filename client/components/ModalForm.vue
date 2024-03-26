<template>
  <b-modal id="showModal" title="เพิ่มแผนก">
    <form class="form-horizontal">
      <div class="row">
        <label class="col-md-2 col-form-label">ชื่อแผนก</label>
        <div class="col-md-4">
          <div class="form-group">
            <input type="text" class="form-control" />
          </div>
        </div>
        <label class="col-md-2 col-form-label">รหัสแผนก</label>
        <div class="col-md-4">
          <div class="form-group">
            <input type="text" class="form-control" />
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </form>
  </b-modal>
</template>

<script>
export default {
  name: "modalform",
};
</script>

<style>
</style>
