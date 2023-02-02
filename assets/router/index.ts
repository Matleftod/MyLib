import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue'
import Home from '../components/Home.vue'
import About from '../components/About.vue';
import Account from '../components/Account.vue'
import Books from '../components/Books.vue'
import Thanks from '../components/Thanks.vue';
import MyBook from '../components/MyBook.vue';

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
        path: '/books',
        component: Books,
    },
    {
        name: 'Thanks',
        path: '/thanks',
        component: Thanks,
    },
    {
        name: 'MyBook',
        path: '/mybook',
        component: MyBook,
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