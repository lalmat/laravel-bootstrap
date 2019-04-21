import { apiCall } from "./api.js";
export default {
  me() {
    return apiCall("GET", "/users/me");
  },

  all() {
    return apiCall("GET", "/users");
  },

  load(id) {
    return apiCall("GET", `/users/${id}`);
  },

  save(user) {
    if (user.id == null) {
      return apiCall("POST", "/users", user);
    } else {
      return apiCall("PATCH", `/users/${user.id}`, user);
    }
  },

  drop(id) {
    return apiCall("DELETE", `/users/${id}`);
  }
};
