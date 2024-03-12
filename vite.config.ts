import { defineConfig, splitVendorChunkPlugin } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: true /* Expose to all IP */,
        hmr: {
            host: "docker.localhost" /* Set base URL for Hot Module Reload */,
        },
    },
    plugins: [
        laravel({
            input: ["resources/ts/app.ts", "resources/css/app.scss"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        splitVendorChunkPlugin(),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
    build: {
        rollupOptions: {
            output: {
                compact: true,
            },
        },
        manifest: "manifest.json",
    },
});
