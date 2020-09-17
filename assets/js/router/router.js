import Vue from 'vue';
import Router from 'vue-router';
import MainPage from "@/pages/MainPage";
import LinksPage from "@/pages/LinksPage";

Vue.use(Router);

const router = new Router({
    mode: 'hash',
    base: process.env.BASE_URL,
    routes: [{
        path: '/',
        component: MainPage
    }, {
        path: '/links-list',
        component: LinksPage
    }]
});

export default router;