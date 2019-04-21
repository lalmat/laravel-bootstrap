<template>
  <div class="mt-2">
    <div class="row">
      <div class="col">
        <button class="btn btn-primary btn-sm" @click="formOpen()">Add new user</button>
      </div>
      <div class="col text-center">
        <h5>Users Administration</h5>
      </div>
      <div class="col text-right">
        <i class="material-icons align-bottom">filter_list</i>
        <input type="text" v-model="filter">
      </div>
    </div>

    <table class="table table-stripped table-hover mt-2">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>E-mail</th>
          <th>Creation</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tr v-for="u in all" :key="u.id">
        <td>{{u.id}}</td>
        <td>
          {{u.name}}
          <b v-if="u.id == me.id">*You*</b>
        </td>
        <td>{{u.email}}</td>
        <td>{{u.created_at}}</td>
        <td class="text-center">
          <div class="btn-group" role="group" :aria-label="`${u.name} actions`">
            <button
              type="button"
              class="btn btn-sm btn-primary"
              data-toggle="modal"
              data-target="#userModel"
              @click="formOpen(u.id)"
            >
              <i class="material-icons md-24">edit</i>
            </button>
            <button type="button" class="btn btn-sm btn-danger" @click="drop(u.id)">
              <i class="material-icons md-24">delete</i>
            </button>
          </div>
        </td>
      </tr>
    </table>
    <div
      id="userForm"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="formUserLabel"
      aria-hidden="true"
    >
      <user-form :user="user" :error="error" v-on:save="save()"></user-form>
    </div>
  </div>
</template>
<script>
import userForm from "./UserForm.vue";
import { mapState } from "vuex";
export default {
  data() {
    return {
      user: {
        id: null,
        name: null,
        email: null,
        password: null,
        password_verification: null
      },
      error: "",
      filter: ""
    };
  },
  computed: {
    ...mapState("users", ["me", "all"])
  },
  mounted() {
    this.$store.dispatch("users/load_all");
  },
  methods: {
    formOpen(id = null) {
      if (id) this.load(id);
      $("#userForm").modal("show");
    },

    load(id) {
      appApi.users.load(id).then(r => (this.user = r));
    },

    save() {
      this.$store
        .dispatch("users/save", this.user)
        .then(r => {
          $("userForm").modal("hide");
        })
        .catch(e => {
          console.log("error", e);
          this.error = e.data.message;
        });
    },

    drop(id) {
      if (id == this.me.id) alert("You can't delete yourself.");
      else {
        if (confirm(`Delete the user with ID:${id} ?`)) {
          this.$store.dispatch("users/drop", id);
        }
      }
    }
  },
  components: {
    "user-form": userForm
  }
};
</script>
