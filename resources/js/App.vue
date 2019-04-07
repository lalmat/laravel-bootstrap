<template>
  <div class="laravel-app">

    <el-container class="app-container">
      <el-header class="app-header">
        <app-header></app-header>
      </el-header>

      <el-container>

        <el-aside class="app-side">
          <app-menu></app-menu>
        </el-aside>

        <el-container>
          <el-main><router-view></router-view></el-main>
        </el-container>

      </el-container>

    </el-container>

  </div>
</template>
<script>
  import AppMenu   from './AppMenu.vue';
  import AppHeader from './AppHeader.vue';
  import {mapState} from 'vuex';

  export default {
    name: 'App',

    computed: {
      ...mapState(['user'])
    },

    mounted() {
      this.$store.dispatch('updateMe');
    },

    methods : {
      logout() {
        this.$http.post('/logout')
          .finally(() => {
            window.location.href = "/login";
          });
      }
    },
    components : {
      'app-menu': AppMenu,
      'app-header': AppHeader
    }
  };
</script>
<style style="scss" scoped>
  .laravel-app {
    height:100%;
    width: 100%;
  }
  .app-container {
    width: 100%;
    height: 100%;
  }
  .app-header {
    height: 60px;
    line-height: 60px;
    background-color: #777;
    color: #fff;
  }
  .app-side {
    width:170px;
    border-right: 1px solid #ccc;
  }
</style>