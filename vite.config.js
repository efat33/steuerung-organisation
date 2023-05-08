import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import * as glob from "glob";
import path from 'node:path';
import { fileURLToPath } from 'node:url';

let mainScripts = Object.fromEntries(
    glob.sync('resources/js/app.js').map(file => [

        // This remove `resources/js/pages/` as well as the file extension from each file, so e.g.
        // resources/js/pages/nested/foo.js becomes nested/foo
        path.relative('resources/js', file.slice(0, file.length - path.extname(file).length)),
        fileURLToPath(new URL(file, import.meta.url))
    ])
);
mainScripts = Object.values(mainScripts);

let mainStyle = Object.fromEntries(
    glob
        .sync("resources/css/app.css")
        .map((file) => [
            path.relative(
                "resources/css",
                file.slice(0, file.length - path.extname(file).length)
            ),
            fileURLToPath(new URL(file, import.meta.url)),
        ])
);
mainStyle = Object.values(mainStyle);

let pagesScript = Object.fromEntries(
    glob.sync('resources/js/pages/*.js').map(file => [

        // This remove `resources/js/pages/` as well as the file extension from each file, so e.g.
        // resources/js/pages/nested/foo.js becomes nested/foo
        path.relative('resources/js/pages', file.slice(0, file.length - path.extname(file).length)),
        fileURLToPath(new URL(file, import.meta.url))
    ])
);
pagesScript = Object.values(pagesScript);

let pagesStyle = Object.fromEntries(
    glob
        .sync("resources/css/pages/*.css")
        .map((file) => [
            path.relative(
                "resources/css/pages",
                file.slice(0, file.length - path.extname(file).length)
            ),
            fileURLToPath(new URL(file, import.meta.url)),
        ])
);
pagesStyle = Object.values(pagesStyle);

let input = [mainScripts, mainStyle, pagesScript, pagesStyle];
input = [].concat(...input);


export default defineConfig({

    // resolve: {
    //     alias: {
    //         '@css': 'resources/css'
    //     }
    // },

    build: {
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    // Get file extension
                    // TS shows asset name can be undefined so I'll check it and create directory named `compiled` just to be safe
                    let extension = assetInfo.name?.split('.').at(1) ?? 'compiled'

                    // This is optional but may be useful (I use it a lot)
                    // All images (png, jpg, etc) will be compiled within `images` directory,
                    // all svg files within `icons` directory
                    // if (/png|jpe?g|gif|tiff|bmp|ico/i.test(extension)) {
                    //     extension = 'images'
                    // }

                    // if (/svg/i.test(extension)) {
                    //     extension = 'icons'
                    // }

                    // Basically this is CSS output (in your case)
                    return `${extension}/[name].[hash][extname]`
                },
                chunkFileNames: 'js/chunks/[name].[hash].js', // all chunks output path
                entryFileNames: 'js/[name].[hash].js' // all entrypoints output path
            }
        }
    },

    plugins: [
        laravel({
            input,
            refresh: false,
        }),
    ],
});
