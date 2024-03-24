<template>
  <div
    class="modal fade"
    id="departmentModal"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">เพิ่มแผนก</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "modalform",
  props: ["name"],
};
</script>

<style>
</style>
