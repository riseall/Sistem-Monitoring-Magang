import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faArrowRightFromBracket, faArrowRightToBracket, faBook, faBriefcase, faBuilding, faCalendarDays, faCameraRetro, faChevronLeft, faChevronRight, faClipboard, faClockRotateLeft, faHouseChimney, faMapLocationDot, faUserTie, faUsers} from '@fortawesome/free-solid-svg-icons'
import { faUser } from '@fortawesome/free-regular-svg-icons';
library.add(faHouseChimney, faUsers, faChevronRight, faChevronLeft, faBuilding, faBriefcase, faClipboard, faBook, faUserTie, faMapLocationDot, faClockRotateLeft, faUser, faCameraRetro, faArrowRightToBracket, faArrowRightFromBracket, faCalendarDays)
const appName = import.meta.env.VITE_APP_NAME || 'Internship Monitor';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
