import axios from 'axios'
export class CustomerService {

  constructor($axios) {
    this.$axios = axios
  }

  async getCustomers() {
    return await this.$axios.get('/api/customers')
  }
}
