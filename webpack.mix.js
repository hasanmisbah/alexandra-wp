const mix = require('laravel-mix');
const webpackConfig = require('./webpack.config.js');

mix
  .js('src/resource/js/app.js', 'assets/js')
  .vue({ version: 3 })
  .webpackConfig(webpackConfig)
  .options({
    resourceRoot: '../../wp-content/plugins/alexandra/assets/',
    publicPath: 'assets/',
  })
  .setResourceRoot('../../wp-content/plugins/alexandra/assets/')
  .sourceMaps();
