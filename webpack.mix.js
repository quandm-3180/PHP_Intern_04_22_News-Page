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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.sass('resources/sass/custom-admin.scss', 'public/css');
mix.sass('resources/sass/custom.scss', 'public/css')
    .sass('resources/sass/custom-notification.scss', 'public/css');

mix.js('resources/js/summernote.js', 'public/js');
mix.js('resources/js/changepoststatus.js', 'public/js');
mix.js('resources/js/change-user-status.js', 'public/js');
mix.js('resources/js/custom-client.js', 'public/js');
mix.js('resources/js/confirm-remove.js', 'public/js');
mix.js('resources/js/dashboard-statistics.js', 'public/js')
    .js('resources/js/helper.js', 'public/js')
    .js('resources/js/notification.js', 'public/js');

mix.copy("resources/i18n/en.json", "public/i18n/en.json")
    .copy("resources/i18n/vi.json", "public/i18n/vi.json")
    .copy('resources/js/utils.js', 'public/js');
