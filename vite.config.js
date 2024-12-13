import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'; 

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@fullcalendar': path.resolve(__dirname, 'node_modules/@fullcalendar') // ✅ This will now work
        }
    }
});
