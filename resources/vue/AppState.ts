import axios from "axios";
import Echo from "laravel-echo";
import { defineStore } from "pinia";
import { supportedBrowsers } from "../ts/browser";
import { MenuItem } from "primevue/menuitem";

export const useWebApiStore = defineStore("webapi", {
    state: () => ({
        /** WEB for API requests */
    }),
});

export const useApiStore = defineStore("api", {
    state: () => ({
        /** API request */
    }),
});

interface MenuItemExtended extends MenuItem {
    key: string;
    label: string;
    icon?: string;
    url?: string;
    command?: () => void;
    items?: Array<MenuItemExtended>;
}

export const useMainStore = defineStore("main", {
    state: () => ({
        /** Additional data */
        appName: import.meta.env.APP_NAME,
        appVersion: "",
        userName: "",
        userId: "",
        notificationList: [],
        browserSuppport: true,
        menuItems: Array<MenuItemExtended>(),
        expandedKeysMenu: {},
        turnstileToken: "",
    }),

    actions: {
        init() {
            /** Get Constant */
        },

        browserSuppportCheck() {
            /**
             * Test if browser is compatible
             */
            if (!supportedBrowsers.test(navigator.userAgent)) {
                this.$patch({ browserSuppport: false });
            } else {
                this.$patch({ browserSuppport: true });
            }
        },

        async spaCsrfToken() {
            /**
             * Get new CSRF Token set everytime app is created
             */
            axios.get("/sanctum/csrf-cookie").then(() => {
                console.log("csrf cookie init");
            });
        },

        async getNotificationList() {
            /**
             * Get notification list
             */
        },

        updateExpandedKeysMenu(expandedKeys: string) {
            this.$patch({
                expandedKeysMenu: {
                    [expandedKeys]: true,
                },
            });
        },
    },
});

export const useEchoStore = defineStore("echo", {
    state: () => ({
        laravelEcho: new Echo({
            broadcaster: "pusher",
            key: import.meta.env.VITE_PUSHER_APP_KEY,
            cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "mt1",
            wsHost: import.meta.env.VITE_PUSHER_HOST
                ? import.meta.env.VITE_PUSHER_HOST
                : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
            wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
            wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
            forceTLS:
                (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
            enabledTransports: ["ws", "wss"],
        }),
    }),
});
