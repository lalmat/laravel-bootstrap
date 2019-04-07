import VueRouter from 'vue-router'
import Vue from 'vue';
Vue.use(VueRouter);

export default new VueRouter({
  base:'/app',
  mode:'history',
  routes: [
    {
      path: '/',
      name: 'Home',
      component: () => import('./views/Dashboard.vue')
    },
    {
      path: '/users',
      name: 'Users',
      component: () => import('./views/admin/Users.vue')
    },
    {
      path: '/user_rights',
      name: 'UserRights',
      component: () => import('./views/admin/UserRights.vue')
    }
  ]
});