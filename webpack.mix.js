const mix = require('laravel-mix');
// // webpack.mix.js
// const path = require('path');

// mix.webpackConfig({
//     resolve: {
//         alias: {
//             ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js'),
//         },
//     },
// });

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
    .copy('node_modules/prismjs/themes', 'public/css/prism-js')
    .sass('resources/sass/app.scss', 'public/css');
    // .postCss('resources/css/app.css', 'public/css', [
    //     require('postcss-import'),
    //     require('tailwindcss'),
    // ]);

