'use strict';
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const Dotenv = require('dotenv-webpack');

module.exports = () => {
  $.gulp.task('scripts', () => {
    return $.gulp.src($.config.assets.js)
      .pipe($.webpackStream({
        mode: $.config.minify ? 'production' : 'development',
        entry: {
          app: $.config.src + '/js/main.js',
        },
        output: {
          filename:'[name].js',
        },
        module: {
          rules: [
            {
              test: /\.(js)$/,
              exclude: /(node_modules)/,
              loader: 'babel-loader',
              query: {
                presets: ['@babel/preset-env']
              }
            }
          ]
        },
        plugins: [
          new Dotenv(),
          new UglifyJSPlugin({
            sourceMap: true
          })
        ]
      }))
      .on('error', function () {
        this.emit('end');
      })
      .on('error', $.gp.notify.onError({ title: 'Scripts error' }))
      .pipe($.gulp.dest($.config.public.js));
  });
};
