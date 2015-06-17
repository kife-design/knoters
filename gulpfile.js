var elixir = require('laravel-elixir');

var paths = {
    'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/',
    'jquery': './vendor/bower_components/jquery/dist/',
    'fontawesome': './vendor/bower_components/fontawesome/'
}

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix
        // bower SCSS --> resources/assets/sass/vendor
        .copy(paths.bootstrap + "/stylesheets/", 'resources/assets/sass/vendor/bootstrap/')
        .copy(paths.fontawesome + "/scss/", 'resources/assets/sass/vendor/fontawesome/')

        //bower JS ---> resources/assets/js/vendor
        .copy(paths.jquery + "/jquery.js", 'resources/assets/js/vendor/jquery.js')
        .copy(paths.bootstrap + "/javascripts/bootstrap.js", 'resources/assets/js/vendor/bootstrap.js')

        //bower FONTS --> public/fonts
        .copy(paths.fontawesome + "/fonts", "public/fonts")

        .sass([
            "home.scss"
        ])

        .scripts([
            'vendor/jquery.js',
            'vendor/bootstrap.js',
            'app.js'
            ], 'public/js/app.js')

        .version(["js/app.js", "css/home.css"]);
});
