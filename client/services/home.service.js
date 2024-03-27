import axios from 'axios';
export class HomeService {
  constructor($axios) {
    this.$axios = axios
  }

  async getResult(query) {
    return await this.$axios.get(`/result?q=${query}`);
  }

  async getStream(id) {
    return await this.$axios.get(`/videos/${id}`);
  }
}
