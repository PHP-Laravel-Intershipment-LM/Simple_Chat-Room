const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.copy('resources/sass/style.css', 'public/assets/css');
mix.copy('resources/sass/login.css', 'public/assets/css');
mix.copy('resources/js/app.js', 'public/assets/js');
mix.copy('resources/js/bootstrap.js', 'public/assets/js');
mix.copy('resources/js/main.js', 'public/assets/js');

mix.disableNotifications();