<template>
  <div>
    <div class="p-3 text-center text-uppercase">Laravel Application</div>
    <div class="row">
      <div class="col">
        <i class="material-icons align-bottom">account_circle</i>
        {{me.name}}
      </div>
      <div class="col-3 text-center">
        <a href="#" @click="logout()">
          <i class="material-icons align-bottom">power_settings_new</i>
        </a>
      </div>
    </div>
    <hr>

    <div
      v-for="(section, section_index) in menus"
      :key="section_index"
      :index="section_index.toString()"
    >
      {{section.title}}
      <ul>
        <li v-for="(item, item_index) in section.childs" :key="item_index">
          <router-link :to="item.route">{{item.title}}</router-link>
        </li>
      </ul>
      <hr>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import menuAdmin from "./views/admin/menu.js";

export default {
  data() {
    return {};
  },

  computed: {
    ...mapState("users", ["me"]),

    menus() {
      let menus = [];
      if (this.me.administrator) menus.push(menuAdmin);
      return menus;
    }
  },

  methods: {
    logout() {
      this.$store.dispatch("logout");
    }
  }
};
</script>
