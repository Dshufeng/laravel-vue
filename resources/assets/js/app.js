
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter);
Vue.use(ElementUI);
Vue.use(VueAxios, axios)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/ExampleComponent.vue'));
Vue.component('profile', require('./components/Profile.vue'));
Vue.component('message', require('./components/Message.vue'));
Vue.component('layout', require('./components/main/Layout.vue'));
Vue.component('login', require('./components/main/Login.vue'));
const routes = [
    { path: '/example', component: {template :"<example></example>"  } },
    { path: "/profile", component: { template: "<profile></profile>" } },
    { path: "/message", component: { template: "<message></message>" } }
];
const router = new VueRouter({
    routes: routes // （缩写）相当于 routes: routes
});

// const app = new Vue({
//     el: '#app'
// });
const app = new Vue({
    router
}).$mount('#app');