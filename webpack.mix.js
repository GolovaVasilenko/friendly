const mix = require('laravel-mix');

mix.copyDirectory('resources/front/fonts', 'public/fonts');
mix.copyDirectory('resources/front/img', 'public/img');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/admin.js', 'public/admin/js')
    .sass('resources/sass/admin.scss', 'public/admin/css').version();


