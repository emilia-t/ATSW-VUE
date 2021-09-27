import Vue from 'vue'
import VueRouter from 'vue-router'
import sheetApp from '../components/sheetApp'
import diaryApp from '../components/diaryApp'
import aboutApp from '../components/aboutApp'
import mangaApp from '../components/mangaApp'
Vue.use(VueRouter);
const routes = [
    {
        path: '/components/sheetApp.vue/:game_name',
        name: 'sheetApp',
        component: sheetApp,
        props:true
    },
    {
        path: '/components/aboutApp.vue',
        name: 'aboutApp',
        component: aboutApp
    },
    {
        path: '/components/diaryApp.vue',
        name: 'diaryApp',
        component: diaryApp
    },
    {
        path: '/components/mangaApp.vue',
        name: 'mangaApp',
        component: mangaApp
    },
];

const router = new VueRouter({
routes
});

export default router
