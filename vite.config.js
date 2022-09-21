import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/js/dashboard.js',
                'resources/js/AJAX_request.js',
                'resources/js/tag.js',
                'resources/js/search-select.js',
                'resources/css/app.css'
            ],
            refresh: true,
        }),
    ],
});
