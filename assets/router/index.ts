import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue'
import Home from '../components/Home.vue'
import About from '../components/About.vue';
import Account from '../components/Account.vue'
import Books from '../components/Books.vue'

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
        name: 'Account',
        path: '/account',
        component: Account,
    },
    {
        name: 'Books',
        path: '/Books',
        component: Books,
    }/*,
    {   
        name: 'Login',
        path: '/login', 
        component: Login, 
        props: true }*/
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;