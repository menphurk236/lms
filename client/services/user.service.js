import axios from "axios";

export class UserService {
  constructor($axios) {
    this.$axios = axios;
  }

  async getUsers(q) {
    return await this.$axios.get(`/users?q=${q}`);
  }

  async getUser(id) {
    return await this.$axios.get(`/users/${id}`);
  }

  async createUser(data) {
    return await this.$axios.post("/users", data);
  }

  async updateUser(id, data) {
    return await this.$axios.put(`/users/${id}`, data);
  }


}
