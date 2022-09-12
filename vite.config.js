import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/jquery.js',
                'resources/js/js/adminlte.js',
                'resources/js/AJAX_request.js',
                'resources/css/app.css'
            ],
            refresh: true,
        }),
    ],
});
