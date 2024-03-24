import axios from 'axios'
export class CategoryService {

  constructor($axios) {
    this.$axios = axios
  }

  async getCategories() {
    return await this.$axios.get('/categories')
  }
}
