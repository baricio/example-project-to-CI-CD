<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <input type="text" v-model="task" v-on:keyup.enter="newTask" class="form-control add-todo" placeholder="Add todo">
                <hr>
                <ul class="list-group">
                    <li v-for="(item, index) in todoList" class="list-group-item">
                        <div class="row">
                            <div class="col-md-10">
                                <label class="form-check-labebtnl">{{item.task}}</label>
                            </div>
                            <div class="col-md-2">
                                <button type="button" v-on:click="remove(item.id, index)" class="btn btn-success">Done</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                task: "",
                todos:[]
            }
        },
        computed: {
            todoList: function() {
                return this.todos;
            }
        },
        methods: {
            getAllTasks: function() {
                axios.get('/api/todos').then((response) => {
                    this.todos = response.data.data
                })
            },
            newTask: function() {
                axios.post('/api/todos', {task: this.task}).then((response) => {
                    this.getAllTasks()
                })
                this.task = ""
            },
            remove: function(id, index) {
                axios.delete('/api/todos/' + id).then((response) => {
                    this.todos.splice(index, 1);
                });
            }
        },
        mounted() {
            this.getAllTasks();
            console.log('Component mounted.')
        }
    }
</script>
