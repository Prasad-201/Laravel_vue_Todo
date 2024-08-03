<template>
    <div>
        <h1>Hello, World!</h1>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'HelloWorld',
    data() {
        return {
            todos: [],
            api: 'http://127.0.0.1:8000/api/todos'
        };
    },
    mounted() {
        axios.get(this.api).then(res => {
            this.todos = res.data;
        }).catch(error => {
            console.error("There was an error fetching the todos:", error);
        });
    }
}
</script>

<style scoped>
h1 {
    color: blue;
}
</style>
