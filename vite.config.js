import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/jquery-3.3.1.min.js',
                'resources/js/jquery.validate.min.js',
                'resources/js/scripts.js',
                'resources/js/modernizr-3.6.0.min.js',
                'resources/js/bootstrap.min.js',
                'resources/js/map-cluster/infobox.min.js',
                'resources/js/map-cluster/markerclusterer.js',
                'resources/js/map-cluster/maps.js',
            ],
            refresh: true,
        }),
    ],
});