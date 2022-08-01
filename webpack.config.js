const path = require('path')
const webpack = require('webpack')

module.exports = {
    stats: {
        warnings: false,
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '~': path.resolve('node_modules')
        }
    },
}
