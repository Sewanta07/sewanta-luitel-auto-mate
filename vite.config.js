import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/public-core.css', 'resources/css/customer-core.css', 'resources/js/customer-core.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
