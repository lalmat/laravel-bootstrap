import appApi from '../api/app.js';
import storeAdmin from './modules/admin.js';

export default {
  strict: true,
  namespaced: true,

  state: {
    // Current active user
    user: {
      name          : 'anonymous',
      email         : 'nobody@example.com',
      administrator : false,
      active        : false,
      rights        : []
    },
  },

  actions: {
    updateMe({commit}) {
      appApi.me().then( (data) => commit('updateMe', data) );
    },

    logout() {
      appApi.logout();
    }

  },

  mutations: {
    updateMe(state, data) {
      console.log(data);
      state.user.name          = data.name;
      state.user.email         = data.email;
      state.user.administrator = data.administrator;
      state.user.active        = data.active;
      state.user.rights        = data.rights;
    }
  },

  modules: {
    admin: storeAdmin,
  }
};