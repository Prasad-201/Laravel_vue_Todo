import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';


import ExampleComponent from './components/ExampleComponent.vue';
import HelloWorld from './components/HelloWorld.vue';
import ToDo from './components/Todo.vue';


const app = createApp({});

app.use(VueAxios, axios);

app.component('example-component', ExampleComponent);
app.component('hello-world', HelloWorld);
app.component('to-do', ToDo);


app.mount('#app');
