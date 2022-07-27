const mix = require('laravel-mix');


mix
    .js('src/resource/js/alexandra.js', 'assets/js')
    .css('src/resource/css/alexandra.css', 'assets/css')
    .sass('src/resource/css/style.scss', 'assets/css')
    .sourceMaps()
