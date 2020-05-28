/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
import VueResource from 'vue-resource';
Vue.use(VueResource)
window.axios = require('axios');

import $ from 'jquery';
window.jQuery = $;
window.$ = $;

 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('threads', require('./components/Threads.vue').default);

const app = new Vue({
    el: '#app',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
});

