import { createRouter, createWebHashHistory } from 'vue-router';
import Home from '@/views/Home'
import About from '@/views/About'

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'About',
        path: '/about',
        component: About,
    },
];

const router = createRouter({
    history: createWebHashHistory(window.location.pathname),
    routes,
});


export default router;
