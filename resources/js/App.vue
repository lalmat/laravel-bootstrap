<template>
  <div class="container-fluid" style="height:100%">
    <div class="row" style="height:100%">
      <div class="col-2 bg-dark text-white">
        <app-menu></app-menu>
      </div>
      <div class="col">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
<script>
import AppMenu from "./AppMenu.vue";
import { mapState } from "vuex";

export default {
  name: "App",

  mounted() {
    this.$store.dispatch("users/load_me");
  },

  methods: {
    logout() {
      this.$http.post("/logout").finally(() => {
        window.location.href = "/login";
      });
    }
  },
  components: {
    "app-menu": AppMenu
  }
};
</script>
<style style="scss" scoped>
.laravel-app {
  height: 100%;
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
  width: 170px;
  border-right: 1px solid #ccc;
}
</style>
