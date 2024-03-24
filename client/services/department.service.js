import axios from 'axios';
export class DepartmentService {
  constructor($axios) {
    this.$axios = axios;
  }

  async getDepartments() {
    return await this.$axios.get('/departments');
  }

  async getDepartment(id) {
    return await this.$axios.get(`/departments/${id}`);
  }

  async createDepartment(data) {
    return await this.$axios.post('/departments', data);
  }

  async updateDepartment(id, data) {
    return await this.$axios.put(`/departments/${id}`, data);
  }

  async deleteDepartment(id) {
    return await this.$axios.delete(`/departments/${id}`);
  }
}
