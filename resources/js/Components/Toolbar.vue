<template>
  <div class="toolbar w-full p-4 flex items-center justify-between">
    <h2 class="text-3xl text-gray-700 font-normal">Team</h2>
    <div class="">
      <button
        @click="toggleForm()"
        class="
          inline-block
          py-2
          px-4
          bg-green-800
          hover:bg-green-900
          text-white text-xl
          font-bold
          uppercase
          cursor-pointer
          rounded-md
          transition-all
          ease-out
          duration-500
        "
      >
        Add a user
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "toolbar",
  props: ["toggleForm"],
};
</script>

<style>
</style>