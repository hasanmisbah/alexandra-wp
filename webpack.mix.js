const mix = require('laravel-mix');
const webpackConfig = require('./webpack.config.js');


mix
    // .js('src/resource/js/alexandra.js', 'assets/js')
    // .css('src/resource/css/alexandra.css', 'assets/css')
    // .sass('src/resource/css/style.scss', 'assets/css')
    // .sass('src/resource/css/author_bio.scss', 'assets/css')
    .js('src/resource/js/app.js', 'assets/js')
    .vue({version: 3})
    .options({ resourceRoot: '../../' })
    .webpackConfig(webpackConfig)
    .sourceMaps();
