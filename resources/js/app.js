import './bootstrap';
import '../css/app.css';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import VueApexCharts from "vue3-apexcharts";

const appName = import.meta.env.VITE_APP_NAME || 'Barbershop';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .component('Datepicker', VueDatePicker)
            .component('Apexchart', VueApexCharts)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
