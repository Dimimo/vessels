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

//mix.copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css');
//mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js');
mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/js/bootstrap.js');
mix.css('node_modules/jquery-autocomplete/jquery.autocomplete.css', 'public/css/jquery.autocomplete.css');
mix.js('node_modules/jquery-autocomplete/jquery.autocomplete.js', 'public/js/jquery.autocomplete.js');

mix.sass('resources/sass/app.scss', 'public/css').version();
mix.js('resources/js/app.js', 'public/js').version();
