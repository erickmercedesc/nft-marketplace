require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { 
                route,
                round(number){
                    return parseFloat(number).toFixed(2);
                },
                currency(amount) {
                    const formatter = new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'})
                    return formatter.format(amount);
                },
                copy(text) {
                    var input = document.createElement('input');
                    input.setAttribute('value', text);
                    document.body.appendChild(input);
                    input.select();
                    var result = document.execCommand('copy');
                    document.body.removeChild(input);
                    return result;
                }                
            } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
