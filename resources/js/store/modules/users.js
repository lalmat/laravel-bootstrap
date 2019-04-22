import appApi from "../../api/app.js";
export default {
  namespaced: true,
  strict: true,

  state: {
    me: {
      id: null,
      name: "anonymous",
      email: "nobody@example.com",
      administrator: false,
      active: false,
      rights: []
    },
    all: []
  },

  actions: {
    load_me({ commit }) {
      appApi.users.me().then(data => {
        commit("set_me", data);
      });
    },
    load_all({ commit }) {
      return new Promise((resolve, reject) => {
        appApi.users.all().then(r => {
          commit("set_all", r);
          resolve(r);
        });
      });
    },
    save({ dispatch }, item) {
      return new Promise((resolve, reject) => {
        appApi.users
          .save(item)
          .then(r => {
            dispatch("load_all").then(foo => resolve(r));
          })
          .catch(e => reject(e));
      });
    },
    drop({ dispatch }, item_id) {
      return new Promise((resolve, reject) => {
        appApi.users.drop(item_id).then(r => {
          dispatch("load_all").then(() => resolve(r));
        });
      });
    }
  },

  mutations: {
    set_all(state, data) {
      state.all = data;
    },
    set_me(state, data) {
      state.me.id = data.id;
      state.me.name = data.name;
      state.me.email = data.email;
      state.me.administrator = data.administrator;
      state.me.active = data.active;
      state.me.rights = data.rights;
    }
  }
};
