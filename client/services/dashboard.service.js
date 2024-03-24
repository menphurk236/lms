import axios from 'axios'

export class DashboardService {
  constructor($axios) {
    this.$axios = axios
  }

  async getDashboard() {
    return await this.$axios.get('/api/recommendations')
  }
}
