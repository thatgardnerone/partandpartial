import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Part and Partial';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = resolvePageComponent(`./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'));

        page.then((module) => {
           const page = module.default;
           let layout = page.layout;

           if (typeof layout === 'undefined') {
               layout = DefaultLayout;
           }

           page.layout = layout;
        });

        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
