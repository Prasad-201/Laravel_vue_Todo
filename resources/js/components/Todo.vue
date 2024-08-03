<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-4">
                <div class="card border">
                    <div class="card-header text-center"><h5>To-Do List:</h5></div>
                    <div class="card-body text-center">
                        <div class="input-group">
                            <input type="text" placeholder="Add List:" class="form-control" aria-label="todo" aria-describedby="todo" v-model="todo_input">
                            <div class="input-group-append">
                                <button v-if="!edit_todo_id" type="button" class="btn btn-info" @click="saveTodo()">Add</button>
                                <button v-else type="button" class="btn btn-warning" @click="updateTodo(index)">Update</button>

                            </div>
                        </div>

                        <div class="p-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(todo, index) in todos" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ todo.name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger" @click="deleteTodo(index)">Delete</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning" @click="editTodo(index)">Edit</button>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            todos: [],
            api: 'http://127.0.0.1:8000/api/todos',
            todo_input:'',
            edit_todo_id:'',
            edit_index:'',
        }
    },
    mounted() {
        axios.get(this.api).then(res => {
            this.todos = res.data;
        });
    },
    methods:{
        
        saveTodo(){
            if(this.todo_input.length>0){
                let data={'name':this.todo_input};
                this.axios.post(this.api,data).then(res=>{
                    this.todos.push(res.data);
                     this.todo_input='';
                });
            }
        },
        deleteTodo(index){
            if(this.todos[index].id){
                this.axios.delete(this.api+'/'+this.todos[index].id).then(res=>{
                    this.todos.splice(index,1);
                });
            }
        },

        editTodo(index){
            if(this.todos[index].id){
               this.todo_input=this.todos[index].name;
               this.edit_todo_id=this.todos[index].id;
               this.edit_index=index;
            }
        },

        updateTodo(){
            if(this.todo_input.length>0){
                let data={'name':this.todo_input};
                this.axios.patch(this.api+'/'+this.todos[this.edit_index].id,data).then(res=>{
                    this.todos[this.edit_index].name=res.data.name;
                });
            }
        }
    }
}

</script>
