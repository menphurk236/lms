import axios from 'axios'
export class VideoService {
  constructor($axios) {
    this.$axios = axios
  }

  async getVideosCreate() {
    return await this.$axios.get('/videos/create')
  }

  async getVideos(q) {
    return await this.$axios.get(`/videos?q=${q}`)
  }

  async getVideo(id) {
    return await this.$axios.get(`/videos/${id}`)
  }

  async createVideo(video) {
    return await this.$axios.post('/videos', video)
  }

  async updateVideo(video) {
    return await this.$axios.put(`/videos/${video.id}`, video)
  }

  async deleteVideo(id) {
    return await this.$axios.delete(`/videos/${id}`)
  }
}
