<template>
  <div>
    <div class="dashboard">
      <Header />
      <main>
        <Toolbar :toggleForm="toggleForm" />
        <Team :users="users" @fetchUsers="getAllUsers" :toggleForm="toggleForm" />
        <UserForm @fetchUsers="getAllUsers" :toggleForm="toggleForm" v-if="formActive" :userID="userID" />
      </main>
    </div>
  </div>
</template>

<script>
import Header from "./Components/Header.vue";
import Toolbar from "./Components/Toolbar.vue";
import Team from "./Components/Team.vue";
import UserForm from "./Components/UserForm.vue";

import ApiController from "./controllers/api";
export default {
  async mounted() {
    // console.log("i love vue");
    this.getAllUsers();
  },
  data() {
    return {
      users: null,
      formActive: false,
      userID:false,
    };
  },
  methods: {
    async getAllUsers() {
      this.users = await ApiController.fetcUsers();
    },
    toggleForm(id = null) {
      this.formActive = !this.formActive;
      this.userID = false;
      if (id) {
          this.userID = id;
      }
    },
  },
  components: {
    Header,
    Team,
    Toolbar,
    UserForm,
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
}
body {
  background-color: #eee;
}
main {
  width: 100vw;
  padding: 24px;
  overflow: hidden;
}
input,
button {
  appearance: none;
  outline: none;
  border: none;
  background: none;
}


</style>