var elixir = require('laravel-elixir');

var browserSync = require('laravel-elixir-browser-sync');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.scripts(['*.js']);

    // Browser sync must come after sass and coffee, or else doesn't work
    mix.browserSync([
        'app/**/*',
        'public/**/*',
        'resources/views/**/*'
    ], {
        proxy: 'communitycompass.localhost'
    });
});
