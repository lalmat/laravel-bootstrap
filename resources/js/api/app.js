import { apiCall } from "./api.js";
import usersApi from "./users.js";
export default {
  users: usersApi,

  logout() {
    apiCall("/logout").finally(() => {
      window.location.href = "/login";
    });
  }
};
