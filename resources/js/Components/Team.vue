<template>
  <div class="flex justify-center items-center max-w-6xl">
    <table class="table-auto w-full">
      <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
          <th class="py-3 px-6 text-left">Client</th>
          <th class="py-3 px-6 text-center">email</th>
          <th class="py-3 px-6 text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="text-gray-600 text-sm font-light">
        <tr v-for="(user , index ) in users" :key="index" class="border-b border-gray-200 hover:bg-gray-100">
          <td class="py-3 px-6 text-left">
            <div class="flex items-center">
              <span>{{user.name}}</span>
            </div>
          </td>
          <td class="py-3 px-6 text-center">
            <div class="flex item-center justify-center">{{user.email}}</div>
          </td>
          <td class="py-3 px-6 text-center">
            <div class="flex item-center justify-center">
              <div @click="toggleForm(user.id)"
                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                  />
                </svg>
              </div>
              <div @click="deleteUser(user.id)"
                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                  />
                </svg>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import ApiController from "../controllers/api";
export default {
    name:"Team",
    props:["users" , "toggleForm"],
    methods: {
        async deleteUser(id){
           const res = await ApiController.deleteUser(id);
            if (res) {
                this.$emit("fetchUsers");
            }
        }
    },
};
</script>

<style>
</style>