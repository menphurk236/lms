import axios from "axios";

export class UserService {
  constructor($axios) {
    this.$axios = axios;
  }

  async getUsers() {
    return await this.$axios.get("/users");
  }
}
