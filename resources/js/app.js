/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Swal from 'sweetalert2';
window.Swal = Swal;

window.Vue.use(ElementUI);


Vue.component('App', require('./components/App.vue').default);
Vue.component('Auth', require('./components/Auth.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 import router from './routes'

const app = new Vue({
    el: '#app',
    router
});
