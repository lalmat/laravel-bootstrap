import appApi from "../api/app.js";
import storeUsers from "./modules/users.js";

export default {
  namespaced: true,
  strict: true,

  actions: {
    logout() {
      appApi.logout();
    }
  },

  modules: {
    users: storeUsers
  }
};
