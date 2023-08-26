import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/sass/common.scss',
                'resources/sass/admin.scss',
                'resources/js/dashboard.js',
                'resources/js/subjects.js',
            ],
            refresh: true,
        }),
    ],
});
