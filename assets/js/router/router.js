import Vue from 'vue';
import Router from 'vue-router';
import MainPage from '@/pages/MainPage';
import LinksPage from '@/pages/LinksPage';
import ViewPage from '@/pages/ViewPage';

Vue.use(Router);

const router = new Router({
    mode: 'hash',
    base: process.env.BASE_URL,
    routes: [{
        path: '/',
        component: MainPage
    }, {
        name: 'view',
        path: '/view/:searchKey',
        component: ViewPage
    }, {
        path: '/links-list',
        component: LinksPage
    }]
});

export default router;