import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue'
import Home from '../components/Home.vue'
import About from '../components/About.vue';

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home,
    },
    {
        name: 'About',
        path: '/about',
        component: About,
    },
    {   
        name: 'Login',
        path: '/login', 
        component: Login, 
        props: true }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;