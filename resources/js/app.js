/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es'

Vue.use(ElementUI, { locale }) // plantillas con vuejs
window.Vue.use(ElementUI);



import Swal from 'sweetalert2';// alertas en botones
window.Swal = Swal;

export const EventBus = new Vue();// Para traspasar permisos entre componentes
window.EventBus = EventBus;

Vue.component('App', require('./components/App.vue').default);
Vue.component('Auth', require('./components/Auth.vue').default);
Vue.component('Home', require('./components/Home.vue').default);


import router from './routes'

const app = new Vue({
    el: '#app',
    router
});