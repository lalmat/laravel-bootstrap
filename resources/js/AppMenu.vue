<template>
  <div>
    <el-menu>
      <el-submenu v-for="(section, section_index) in menus"
        :key="section_index"
        :index="section_index.toString()">
        <template slot="title">
          <i class="material-icons">{{ section.icon }}</i>
          <span>{{section.title}}</span>
        </template>
        <el-menu-item v-for="(item, item_index) in section.childs"
          :key="item_index"
          :index="section_index+'-'+item_index">
          <router-link :to="item.route">{{item.title}}</router-link>
        </el-menu-item>
      </el-submenu>
    </el-menu>
  </div>
</template>
<script>
  import {mapState} from 'vuex';
  import menuAdmin from './views/admin/menu.js';

  export default {

    data() {
      return {};
    },

    computed: {
      ...mapState(['user']),

      menus() {
        let menus = [];
        if (this.user.administrator) menus.push(menuAdmin);
        return menus;
      }
    }

  }
</script>