require("./bootstrap");

import Vue from "vue";

// Vuex Store
import Vuex from "vuex";
Vue.use(Vuex);
import storeData from "./store/index.js";
const store = new Vuex.Store(storeData);

// Vue Router
import router from "./router.js";

// Load main App
import App from "./App.vue";

// Bootstrap Application
export default new Vue({
  store,
  router,
  render: h => h(App)
}).$mount("#app");
