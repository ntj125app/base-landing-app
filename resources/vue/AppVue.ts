import { createApp, App } from 'vue';
import { createPinia, Pinia } from 'pinia';
const pinia: Pinia = createPinia();
import PrimeVue from 'primevue/config';
import PrimeTailwind from './presets/custom';

/** Vue router needed for navigation menu */
import { router } from './AppRouter';

/** Primevue Globals */
import DialogService from 'primevue/dialogservice';
import ToastService from 'primevue/toastservice';
import Tooltip from 'primevue/tooltip';

// Mount Application Instances
const MainApp: App<Element> = createApp({})
    .use(router)
    .use(pinia)
    .use(PrimeVue, {
        unstyled: true,
        pt: PrimeTailwind,
        ptOptions: { mergeProps: true },
    })
    .use(DialogService)
    .use(ToastService)
    .directive('tooltip', Tooltip);

/** Global Composenent / Page Registration */
import CmpAppSet from './Components/CmpAppSet.vue';
MainApp.component('CmpAppSet', CmpAppSet);

/** Add Sentry */
import * as Sentry from '@sentry/vue';

Sentry.init({
    app: MainApp,
    dsn: import.meta.env.VITE_SENTRY_DSN ?? '',

    integrations: [Sentry.browserTracingIntegration({ router })],
});

router.isReady().then(() => {
    MainApp.mount('#app');
});
