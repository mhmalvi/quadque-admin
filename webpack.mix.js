const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/src/backend/apps/apps.js', 'public/js/backend')
    .js('resources/js/src/frontend/apps/apps.js', 'public/js/frontend')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
