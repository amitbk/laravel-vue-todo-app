<template id="">
  <div class="todo__wrapper container">


    <div class="row d-flex justify-content-center">
      <div class="col-xs-12 col-sm-5">
        <h2>Tasks
          <span class="text-secondary">({{todos.data.length}})</span>
        </h2>
      </div>
    </div>

    <div class="row d-flex justify-content-center">
      <div class="col-xs-12 col-sm-5">

        <div class="input-group mb-3">
          <input v-model="todo" type="text" class="form-control rounded-0" placeholder="New task">
          <div class="input-group-append">
            <span class="input-group-text bg-primary text-white rounded-0" @click="addTodo"><i class="fas fa-plus pr-2"></i> Add</span>
          </div>
        </div>

      </div>
    </div>


    <!-- Todo list -->
    <div class="row d-flex justify-content-center">
      <div class="col-xs-12 col-sm-5">
        <TodoView  v-for="(todo, index) in todos.data" :todo="todo" :key="index"
        @delete-todo="deleteTodo"
        @toggle-complete="toggleCompleteTodo"
        />
      </div>
    </div>


  </div>
</template>

<script>

import TodoView from "./TodoView";

export default {

  name: "TodoListComponent",
  components: { TodoView },
  data() {
    return {
      todo: '',
      todos: {}
    };
  },

  mounted() {
    // fetch todo

    this.getTodos();
  },

  methods: {
    // get a list of all todos
    getTodos() {
      axios.get('/api/todos').then( response => {
          this.todos = response.data;
      })
    },

    // add new todo
    addTodo() {
      axios.post('/api/todos', { title: this.todo } ).then( response => {
        console.log("To do saved.");
        this.$swal('Todo saved');
        this.getTodos();
      }).catch(e => {
        this.$swal('Something went wrong. Please try again.');
      })
    },

    // update existing todo
    updateTodo(todo) {
      axios.put('/api/todos/'+todo.id, { ...todo } ).then( response => {
        this.getTodos();
      })
    },

    // toggle is_completed property of todo
    toggleCompleteTodo(todo) {
      todo.is_completed = !todo.is_completed;
      this.updateTodo(todo);
    },

    // delete todo
    deleteTodo(todo) {
      axios.delete('/api/todos/'+todo.id ).then( response => {
        this.$swal('Todo deleted.');
        this.getTodos();
      })
    },
  }
}
</script>
