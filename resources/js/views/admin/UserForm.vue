<template>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userFormLabel">User form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="userForm_name">Name</label>
            <input
              type="text"
              class="form-control"
              id="userForm_name"
              aria-describedby="userForm_nameHelp"
              placeholder="Enter name"
              v-model="user.name"
            >
            <small id="userForm_nameHelp" class="form-text text-muted">The user first and last name.</small>
          </div>

          <div class="form-group">
            <label for="userForm_email">E-mail address</label>
            <input
              type="text"
              class="form-control"
              id="userForm_email"
              aria-describedby="userForm_emailHelp"
              placeholder="Enter email"
              v-model="user.email"
            >
            <small
              id="userForm_emailHelp"
              class="form-text text-muted"
            >The user e-mail address used to reset password and login.</small>
          </div>

          <div class="form-group">
            <label for="userForm_password">Password</label>
            <input
              type="password"
              class="form-control"
              id="userForm_password"
              placeholder="Type the new password"
              v-model="user.password"
            >
            <input
              type="password"
              class="form-control"
              placeholder="Retype password for check"
              v-model="user.password_verification"
            >
          </div>
        </form>
        <div class="alert alert-danger" role="alert" v-if="error != ''">{{error}}</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="$emit('save')">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</template>
<script>
import appApi from "../../api/app.js";
export default {
  props: ["user", "error"]
};
</script>
