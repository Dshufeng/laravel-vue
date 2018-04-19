
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import App from './App.vue';
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter);
Vue.use(ElementUI);
Vue.use(VueAxios, axios);

import util from './lib/util';
Vue.prototype.util = util;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Login from './components/main/Login.vue';
import Dashboard from './components/main/Dashboard.vue';
import Message from './components/Message.vue';
import Example from './components/ExampleComponent.vue';
import Post from './components/Post.vue';
import Options from './components/Options.vue';
import Category from './components/Category.vue';

const routes = [
    {
        path: "/login",
        component:Login,
        hidden: true
    },
    {
        path: '/',
        name:'仪表盘',
        iconCls: 'el-icon-message',
        component: Dashboard,
        children: [
            { path: '/dashboard', component: Message, name: '列表' },
            { path: '/example', component: Example, name: '首页' },
            { path: '/post', component: Post, name: '添加' },
            { path: '/category', component: Category, name: '分类' },
        ]
    },
    {
        path: '/',
        name: '设置',
        iconCls: 'el-icon-setting',
        component: Dashboard,
        children: [
            { path: '/options', component: Options, name: '配置' }
        ]
    }
];

const router = new VueRouter({
    history: true,
    root: 'dashboard', // 默认路由首页
    routes
});

// const app = new Vue({
//     el: '#app'
// });
const app = new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App }
}).$mount('#app');