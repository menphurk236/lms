import axios from 'axios'
export class MasterDataService {

  constructor($axios) {
    this.$axios = axios
  }

  async getDepartment() {
    return await this.$axios.get('/master/department')
  }

  async getEmployee() {
    return await this.$axios.get('/master/employee')
  }

  async getCategoryVideo() {
    return await this.$axios.get('/master/category-video')
  }
}
