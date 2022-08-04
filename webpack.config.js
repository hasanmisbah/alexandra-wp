const path = require('path')

module.exports = {
  stats: {
    warnings: false,
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'src/resource/js'),
      '~': path.resolve(__dirname, 'src/node_modules')
    }
  }
}
