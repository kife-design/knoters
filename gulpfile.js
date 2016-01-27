var elixir = require('laravel-elixir');

var paths = {
    'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/',
    'bootstrap_md': './vendor/bower_components/bootstrap-material-design/dist/',
    'jquery': './vendor/bower_components/jquery/dist/',
    'jqueryUi': './vendor/bower_components/jquery-ui/',
    'fontawesome': './vendor/bower_components/fontawesome/',
    'videojs': './vendor/bower_components/video.js/dist/video-js/',
    'bootstrapSelect': './vendor/bower_components/bootstrap-select/dist/'
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
        .copy(paths.bootstrapSelect + 'css/bootstrap-select.css', 'resources/assets/sass/vendor/bootstrap-select/bootstrap-select.scss')
        .copy(paths.fontawesome + "/scss/", 'resources/assets/sass/vendor/fontawesome/')
        .copy(paths.videojs + "/video-js.css", 'resources/assets/sass/vendor/videojs/videojs.scss')

        //bower JS ---> resources/assets/js/vendor
        .copy(paths.jquery + "/jquery.js", 'resources/assets/js/vendor/jquery.js')
        .copy(paths.jqueryUi + 'jquery-ui.js', 'resources/assets/js/vendor/jquery-ui.js')
        .copy(paths.bootstrap + "/javascripts/bootstrap.js", 'resources/assets/js/vendor/bootstrap.js')
        .copy(paths.bootstrapSelect + 'js/bootstrap-select.js', 'resources/assets/js/vendor/bootstrap-select.js')
        .copy(paths.videojs + "/video.dev.js", 'resources/assets/js/vendor/video.dev.js')

        //bower FONTS --> public/fonts
        .copy(paths.fontawesome + "/fonts", "public/fonts")
        .copy(paths.videojs + "/font", "public/fonts")

        .sass([
            "home.scss"
        ], "public/css/home.css")

        .sass([
            "editor.scss"
        ], "public/css/editor.css")

        .scripts([
            'vendor/jquery.js',
            'vendor/bootstrap.js',
            'app.js'
        ], 'public/js/app.js')

        .scripts([
            'vendor/jquery.js',
            'vendor/jquery-ui.js',
            'vendor/bootstrap.js',
            'vendor/bootstrap-select.js',
            'vendor/video.dev.js',
            'mathUtilities.js',
            'vendor/sources/vjs.vimeo.js',
            'vendor/sources/vjs.youtube.js'
        ], 'public/js/vendor.js')

        .browserify([
            'editor.js'
        ])
        .version(["js/app.js", "css/home.css", "css/editor.css"]);
});
