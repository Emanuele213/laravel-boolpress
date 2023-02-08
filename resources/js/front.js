const { h } = require('vue');

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import App from './App.vue';
import VueRouter from 'vue-router'
import PageHome from './pages/PageHome';
import PageAbout from './pages/PageAbout';
import PageContactus from './pages/PageContactus';
import PagePost from './pages/PagePost';
import PagePosts from './pages/PagePosts';
import Page404 from './pages/Page404';

Vue.use(VueRouter);

const routes = [
        {
            path: '/',
            name: 'home',
            component: PageHome, //dare il nome della pagina
        },
        {
            path: '/about',
            name: 'about',
            component: PageAbout, //dare il nome della pagina
        },
        {
            path: '/contact-us',
            name: 'contactUs',
            component: PageContactus, //dare il nome della pagina
        },
        {
            path: '/post/:slug',//dare il paramentro
            name: 'postsShow',
            component: PagePost, //dare il nome della pagina
            props: true,
        },
        {
            path: '/posts',
            name: 'postsIndex',
            component: PagePosts, //dare il nome della pagina
        },
        {
            path: '*',
            name: 'page404',
            component: Page404,
        }
        //TODO: aggiungere la 404
];

//personalizzazione del vue-router
const router = new VueRouter({
    mode: 'history', //toglie l'# dagli indirizzi servono delle modifiche lato server
    routes// routes : routes JS moderno
});

new Vue({
    el: '#root',
    render: h => h(App),
    router // = router : router JS moderno
});
