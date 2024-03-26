import axios from 'axios'
export class CategoryService {

  constructor($axios) {
    this.$axios = axios
  }

  async getCategories() {
    return await this.$axios.get('/categories')
  }

  async getCategory(id) {
    return await this.$axios.get(`/categories/${id}`)
  }

  async createCategory(data) {
    return await this.$axios.post('/categories', data)
  }

  async updateCategory(id, data) {
    return await this.$axios.put(`/categories/${id}`, data)
  }

  async deleteCategory(id) {
    return await this.$axios.delete(`/categories/${id}`)
  }
}
