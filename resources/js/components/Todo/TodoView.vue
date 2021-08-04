<template id="">
  <div class="row mb-2">
      <div class="col-10 pr-0 cursor-pointer" @click="$emit('toggle-complete', todo)">
          <div class="p-2 text-white" :class="[todo.is_completed ? 'bg-success' : 'bg-secondary']">
            <del v-if="todo.is_completed">{{ todo.title }}</del>
            <span v-else> {{ todo.title }}</span>
          </div>
      </div>
      <div class="col-2 pl-0">
        <div @click="$emit('delete-todo', todo)" class="p-2 text-white px-4 bg-danger h-100 d-flex justify-content-center align-items-center cursor-pointer">
          <i class="fas fa-times"></i>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: "TodoView",
  props: ["todo"]
}
</script>

<style >
  .cursor-pointer {
    cursor: pointer;
  }
</style>
