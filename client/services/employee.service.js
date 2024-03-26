import axios from 'axios'
export class EmployeeService {

  constructor($axios) {
    this.$axios = axios
  }

  async getEmployees() {
    return await this.$axios.get('/employees')
  }

  async getEmployee(id) {
    return await this.$axios.get(`/employees/${id}`)
  }

  async createEmployee(data) {
    return await this.$axios.post('/employees', data)
  }

  async updateEmployee(id, data) {
    return await this.$axios.put(`/employees/${id}`, data)
  }

  async deleteEmployee(id) {
    return await this.$axios.delete(`/employees/${id}`)
  }

  async addVideoEmployee(id, data) {
    return await this.$axios.post(`/employees/add-video/${id}`, data)
  }

  async deleteVideoEmployee(id) {
    return await this.$axios.delete(`/employees/delete-video/${id}`)
  }

}
