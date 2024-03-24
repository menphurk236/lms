import axios from 'axios'
export class VideoService {

  constructor($axios) {
    this.$axios = axios
  }

  async getVideos() {
    return await this.$axios.get('/api/videos')
  }
}
