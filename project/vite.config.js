import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/sass/common.scss',
                'resources/sass/admin.scss',
                'resources/js/app.js',
                'resources/js/dashboard.js',
                'resources/js/subjects.js',
            ],
            refresh: true,
        }),
    ],
});
