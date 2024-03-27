<template>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title" style="font-size: 2.25em; font-weight: 500">
              พนักงาน
            </h3>
            <div style="font-size: 16px; font-weight: 400">
              พนักงานทั้งหมด {{ employees.length }} คน
              <router-link
                to="/employee/create"
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
                    wire:model="search"
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
            <div class="clearfix"></div>
            <div class="col-sm-12">
              <div class="btn-group pull-right">
                <button
                  type="submit"
                  id="export_csv_data"
                  name="export_csv_data"
                  value="Export to CSV"
                  class="btn btn-info btn-sm btn-round"
                >
                  Export to CSV
                </button>
              </div>
            </div>
            <div class="table-responsive-md">
              <vue-good-table
                mode="remote"
                :columns="columns"
                :rows="employees"
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
                    <router-link
                      :to="{
                        name: 'employee.view',
                        params: { id: props.row.id },
                      }"
                      class="btn btn-success btn-icon btn-sm"
                      ><i class="fas fa-eye"></i
                    ></router-link>
                    <b-button
                      class="btn btn-danger btn-icon btn-sm"
                      @click="delete_employee(props.row.id)"
                      variant="outline-danger"
                      ><i class="far fa-trash-alt"></i
                    ></b-button>
                  </span>
                  {{
                    props.column.field == "department"
                      ? props.row.department !== null
                        ? props.row.department.name
                        : ""
                      : props.row[props.column.field]
                  }}
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
export default {
  async asyncData({ app: { $employeeService } }) {
    // use the user service to get a list of user
    const { data: employees } = await $employeeService.getEmployees();

    return { employees };
  },
  computed: {
    columns() {
      return [
        {
          label: "ชื่อแผนก",
          field: "department",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "รหัสพนักงาน",
          field: "code",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
        {
          label: "ชื่อ-นามสกุล",
          field: "name",
          tdClass: "text-center",
          thClass: "text-center",
          sortable: true,
        },
        {
          label: "เปอร์เซ็นต์ที่ดู",
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
