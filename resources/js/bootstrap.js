window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('materialize-css/dist/js/materialize.js');
    require('./parallax-header.js');

} catch (e) {}

window.axios = require('axios');
// window.axios = require('vue-axios-interceptors');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '35d6a77d98dbaf7b5f97',
    cluster: 'us2',
    forceTLS: true
});

import Swal from 'sweetalert2';

const sucessCallback = (response) => {
    return response;
}

const errorCallback = (error) => {
    if(error.response.status === 401) {
        Swal.fire({
            title: 'Autenticação',
            text: 'Para Acessar este recurso você precisa está autênticado, você será redirecionado',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ok!',
            cancelButtonText: 'Não, obrigado'
        }).then((result) => {
            if (result.value) {
                window.location = '/login';
            }
        })
    } else {
        Swal.fire({
            title: 'Error',
            text: 'Algo deu errado, verifique se sua sessão está ativa.',
            icon: 'error',
            showCancelButton: false,
            confirmButtonText: 'Ok!',
        })
    }

    return Promise.reject (error);
}

window.axios.interceptors.response.use(sucessCallback, errorCallback);

window.Vue = require('vue');

Vue.component('loader', require('./commons/AxiosLoader.vue').default);

const commonApps = new Vue({
    el: '#loader'
})


