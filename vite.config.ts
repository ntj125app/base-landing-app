import { defineConfig, loadEnv } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

process.env = { ...process.env, ...loadEnv('', process.cwd()) };

import { builtinModules } from 'module';

const allExternal = [...builtinModules, ...builtinModules.map((module) => `node:${module}`)];

export default defineConfig({
    server: {
        host: true /* Expose to all IP */,
        hmr: {
            host:
                process.env.VITE_PUSHER_HOST ??
                'docker.localhost' /* Set base URL for Hot Module Reload */,
        },
    },
    plugins: [
        laravel({
            input: ['resources/ts/app.ts', 'resources/css/app.scss'],
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
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    build: {
        rollupOptions: {
            output: {
                compact: true,
                manualChunks: {
                    vendor: ['vue', 'vue-router', 'axios', 'pinia', 'pusher-js'],
                },
            },
            external: ['fsevents', ...allExternal],
        },
        manifest: 'manifest.json',
    },
});
