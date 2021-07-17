<template>
  <div
    class="
      user-form
      fixed
      top-0
      left-0
      right-0
      bottom-0
      z-50
      flex
      justify-center
      items-center
    "
  >
    <div
      @click="toggleForm()"
      class="
        form-overlay
        absolute
        top-0
        left-0
        right-0
        bottom-0
        z-0
        bg-black bg-opacity-50
      "
    ></div>
    <form
      class="form relative z-10 bg-white p-8 rounded-lg w-full max-w-md"
      @submit.prevent="userID === false ? addNewUser() : updateUser()"
    >
      <h3 class="mb-8 text-4xl text-gray-700">User Form</h3>
      <div class="form-group block mb-4">
        <label class="block mb-1" for="Name">Name</label>
        <input
          type="text"
          v-model="name"
          id="name"
          class="
            form-control
            block
            w-full
            border border-solid border-gray-300
            py-3
            px-4
            text-base text-gray-500
            rounded
            focus:shadow
            focus:border-transparent
          "
        />
      </div>
      <div class="form-group block mb-4">
        <label class="block mb-1" for="Email">Email</label>
        <input
          type="text"
          v-model="email"
          id="Email"
          class="
            form-control
            block
            w-full
            border border-solid border-gray-300
            py-3
            px-4
            text-base text-gray-500
            rounded
            focus:shadow
            focus:border-transparent
          "
        />
      </div>
      <div class="form-group block mb-4" v-if="!userID">
        <label class="block mb-1" for="password">Password</label>
        <input
          type="text"
          v-model="password"
          id="password"
          class="
            form-control
            block
            w-full
            border border-solid border-gray-300
            py-3
            px-4
            text-base text-gray-500
            rounded
            focus:shadow
            focus:border-transparent
          "
        />
      </div>
      <div class="flex justify-center items-center">
        <button
          class="
            px-4
            py-3
            text-white
            bg-green-600
            hover:bg-green-800
            rounded-full
            shadow-md
            transition-all
            ease-out
            duration-500
          "
        >
          {{userID ? 'Update' : 'Add' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import ApiController from "../controllers/api";

export default {
  name: "UserForm",
  props: ["toggleForm", "userID"],
  data() {
    return {
      name: "",
      email: "",
      password: "",
      user: null,
    };
  },
  methods: {
    async addNewUser() {
      let user = await ApiController.createUser(
        this.name,
        this.email,
        this.password
      );
      if (user) {
        this.$emit("fetchUsers");
        this.toggleForm();
      }
    },
    async getUser() {
      this.user = await ApiController.getUser(this.userID);
    //   console.log(this.user);
    this.name =this.user.name;
    this.email = this.user.email;
    },
    async updateUser() {
      let user = await ApiController.updateUser(
        this.name,
        this.email,
        this.userID
      );
      if (user) {
        this.$emit("fetchUsers");
        this.toggleForm();
      }
    },
  },
  mounted() {
    if (this.userID) {
      this.getUser();

    }
  },
};
</script>

<style>
</style>