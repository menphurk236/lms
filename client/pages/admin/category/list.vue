<template>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title" style="font-size: 2.25em; font-weight: 500">
              หมวดวิดิโอ
            </h3>
            <div style="font-size: 16px; font-weight: 400">
              หมวดวิดิโอทั้งหมด {{ categories.length }} หมวด
            </div>

            <form
              class="form-horizontal mt-2"
              method="POST"
              @submit.prevent="handleSubmit"
            >
              <div class="row">
                <label class="col-form-label" style="font-size: 1em"
                  >รหัสหมวด</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <input
                      type="text"
                      :class="{
                        'is-invalid': $v.form.code.$error,
                      }"
                      v-model="form.code"
                      class="form-control input-sm"
                    />
                    <div v-if="!$v.form.code.required" class="invalid-feedback">
                      กรุณากรอกรหัสหมวด
                    </div>
                  </div>
                </div>
                <label class="col-form-label" style="font-size: 1em"
                  >ชื่อหมวด</label
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <input
                      type="text"
                      :class="{
                        'is-invalid': $v.form.name.$error,
                      }"
                      v-model="form.name"
                      class="form-control input-sm"
                    />
                    <div v-if="!$v.form.name.required" class="invalid-feedback">
                      กรุณากรอกชื่อหมวด
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn btn-primary btn-sm">
                    บันทึก
                  </button>
                  <button type="reset" class="btn btn-info btn-sm">
                    ยกเลิก
                  </button>
                </div>
              </div>
            </form>
            <div class="table-responsive-md">
              <vue-good-table
                mode="remote"
                :columns="columns"
                :rows="categories"
                :pagination-options="{
                  enabled: true,
                  mode: 'records',
                }"
                :line-numbers="true"
                style-class="tableOne vgt-table"
              >
                <div slot="selected-row-actions">
                  <button class="btn btn-danger" @click="delete_by_selected()">
                    {{ $t("Del") }}
                  </button>
                </div>
                <template slot="table-row" slot-scope="props">
                  <span v-if="props.column.field == 'actions'">
                    <b-button
                      @click="
                        $router.push({
                          name: 'admin.category.edit',
                          params: { id: props.row.id },
                        })
                      "
                      class="btn btn-success btn-icon btn-sm"
                      ><i class="fas fa-pencil-alt"></i
                    ></b-button>
                    <b-button
                      class="btn btn-danger btn-icon btn-sm"
                      @click="delete_category(props.row.id)"
                      variant="outline-danger"
                      ><i class="far fa-trash-alt"></i
                    ></b-button>
                  </span>
                </template>
              </vue-good-table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import Swal from "sweetalert2";
export default {
  data: () => ({
    form: {
      code: "",
      name: "",
    },
  }),
  validations: {
    form: {
      code: {
        required,
      },
      name: {
        required,
      },
    },
  },
  async asyncData({ app: { $categoryService } }) {
    // use the user service to get a list of user
    const { data: categories } = await $categoryService.getCategories();

    return { categories };
  },
  methods: {
    async delete_by_selected() {
      // console.log("delete_by_selected");
      // console.log(this.selectedRows);
      // let data;
      // try {
      //   const response = await this.form.post("/users");
      //   data = response.data;
      // } catch (e) {
      //   return;
      // }
      // this.$router.push({ name: "users.list" });
    },
    async delete_category(id) {
      Swal.fire({
        title: "คุณแน่ใจหรือไม่?",
        text: "คุณต้องการลบหมวดวิดิโอนี้จริงหรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่, ลบเลย!",
        cancelButtonText: "ยกเลิก",
      }).then(async (result) => {
        if (result.value) {
          try {
            await this.$categoryService.deleteCategory(id);
            this.$nuxt.refresh();
          } catch (e) {
            return;
          }
        }
      });
    },
    async handleSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        return false;
      } else {
        this.createCategory();
      }
    },
    async createCategory() {
      const formData = new FormData();
      formData.append("code", this.form.code);
      formData.append("name", this.form.name);

      try {
        await this.$categoryService.createCategory(formData);
        this.$nuxt.refresh();
        this.form.clear();
      } catch (e) {
        return;
      }
    },
  },
  computed: {
    columns() {
      return [
        {
          label: "รหัส",
          field: "code",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "หมวด",
          field: "name",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "",
          field: "actions",
          html: true,
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
      ];
    },
  },
};
</script>

<style>
</style>
