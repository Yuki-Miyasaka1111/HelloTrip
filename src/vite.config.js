import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // base: '/HelloTrip/',
    // build: {
    //     outDir: resolve(__dirname, 'public'),
    //     assetsDir: '',
    //     rollupOptions: {
    //         entryFileNames: (assetInfo) => {
    //             const ext = assetInfo.name.endsWith('.css') ? 'css' : 'js';
    //             return `[name].[ext]/[name].[ext]`;
    //         },
    //         assetFileNames: '[ext]/[name].[ext]',
    //         chunkFileNames: 'js/[name].js',
    //     },
    // },
});