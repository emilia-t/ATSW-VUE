const merge = require('webpack-merge')
module.exports = {
  assetsDir: './static',
  outputDir: './dist',
  lintOnSave: false,
  chainWebpack: config => {
    config.module
        .rule('images')
        .use('url-loader')
        .tap(options => {
          return merge(options, {
            limit: 16384
          })
        })
  }
}


