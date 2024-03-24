import axios from 'axios'
export class EmployeeService {

  constructor($axios) {
    this.$axios = axios
  }

  async getCustomers() {
    return await this.$axios.get('/api/customers')
  }
}
