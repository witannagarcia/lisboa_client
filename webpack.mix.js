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

mix.js('resources/js/app.js', 'public/js')
.sass("resources/sass/auth.scss", "public/css")
.sass("resources/sass/style.scss", "public/css")
.sass("resources/sass/menu.scss", "public/css")
.sass("resources/sass/kitchen.scss", "public/css")
.sass("resources/sass/orders.scss", "public/css")
.options({
    processCssUrls: false,
});
