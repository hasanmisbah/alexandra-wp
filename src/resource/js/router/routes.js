import About from '@/views/About';
import Home from '@/views/Home';

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home
    },
    {
        name: 'About',
        path: '/about',
        component: About,
    },
];

export default routes;
