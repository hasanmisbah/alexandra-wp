const mix = require('laravel-mix');
const webpackConfig = require('./webpack.config.js');

mix
  .sass('src/resource/css/author_bio.scss', 'assets/css')
  .css('src/resource/css/alexandra.css', 'assets/css')
  .js('src/resource/js/app.js', 'assets/js')
  .vue({ version: 3 })
  .js('src/resource/js/ajax-handler.js', 'assets/js')
  .webpackConfig(webpackConfig)
  .setResourceRoot('../../wp-content/plugins/alexandra/assets/')
  .sourceMaps();
