import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import './resources/css/app.scss';
import './resources/js/app.js';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ]
});
