import axios from 'axios'
export class EmployeeService {

  constructor($axios) {
    this.$axios = axios
  }

  async getEmployee() {
    return await this.$axios.get('/employee')
  }
}
