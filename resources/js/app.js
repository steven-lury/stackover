require('./bootstrap');
require('./fontawesome.js');



import { InertiaApp } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

Vue.prototype.$route = (...args) => route(...args).url()

import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';

Vue.use(VueIziToast);

Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
