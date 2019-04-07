<template>
  <div>
    <el-row>
      <el-col :span="8">Laravel Application</el-col>
      <el-col :span="8">&nbsp;</el-col>
      <el-col :span="8" class="right">
        {{ user.name }}
        &nbsp;
        <el-button type="info" circle title="Exit"><i class="material-icons" @click="logout()">power_settings_new</i></el-button>
      </el-col>
    </el-row>
  </div>
</template>
<script>
  import {mapState} from 'vuex';

  export default {

    data() {
      return {};
    },

    computed: {
      ...mapState(['user']),
    },

    methods: {
      logout() {
        this.$store.dispatch('logout');
      }
    }
  }
</script>
<style lang="scss" scoped>
.right {
  text-align:right;
  button {
    position:relative;
    top:7px;
  }
}
</style>