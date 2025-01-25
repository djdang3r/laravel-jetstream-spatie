// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js',
//             ],
//             refresh: true,
//         }),
//     ],
// });

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            buildDirectory: 'build', // Directorio dentro de public_html
        }),
    ],
    build: {
        outDir: '../public_html/build', // Ruta absoluta al directorio de salida
        manifest: true,
    },
    base: '/build/', // Ruta base para los assets
});
