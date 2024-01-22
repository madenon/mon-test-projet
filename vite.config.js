import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/carousel/slick/slick.css','resources/carousel/slick/slick-theme.css','resources/carousel/slick/slick.js'
            ],
            refresh: true,
        }),
    ],
});
