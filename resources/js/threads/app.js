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

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

// Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '35d6a77d98dbaf7b5f97',
    cluster: 'us2',
    forceTLS: true
});


Vue.component('threads', require('./components/Threads.vue').default);

const app = new Vue({
    el: '#app',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
});

