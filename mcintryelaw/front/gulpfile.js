'use strict';

let env = (process.env.NODE_ENV === 'heroku')
  ? process.env.NODE_ENV
  : require('gulp-env')({ file: '.env.json' });

global.$ = {
  package: require('./package.json'),
  config: require('./gulp/config'),
  gulp: require('gulp'),
  del: require('del'),
  buf: require('vinyl-buffer'),
  merge: require('merge-stream'),
  mergeJSON: require('gulp-merge-json'),
  browserSync: require('browser-sync').create(),
  gp: require('gulp-load-plugins')(),
  autoprefixer: require('gulp-autoprefixer'),
  cleanCSS: require('gulp-clean-css'),
  imageminMozjpeg: require('imagemin-mozjpeg'),
  fs: require('fs'),
  stylint: require('gulp-stylint'),
  fancyLog: require('fancy-log'),
  colors: require('ansi-colors'),
  emitty: require('emitty').setup('assets', 'pug'),
  gulpWebpack: require('webpack-stream'),
  webpack: require('webpack'),
  webpackStream: require('webpack-stream'),
  svgSymbols: require('gulp-svg-symbols'),
  path: require('path'),
  pathPlugins: {
    task: require('./gulp/paths.js')
  }
};

$.pathPlugins.task.forEach(function (taskPath) {
  require(taskPath)();
});

$.gulp.task('build', $.gulp.series(
  //'clean',
  $.gulp.parallel(
    'pug:data',
    'sprite:svg'
  ),
  $.gulp.parallel(
    'pug',
    'stylus',
    'scripts'
  ),
  $.gulp.parallel(
    'copy:image',
    'copy:fonts',
    'copy:jsLibs'
  )
));

$.gulp.task('build-short', $.gulp.series(
  //'clean',
  $.gulp.parallel(
    'pug:data',
    'sprite:svg'
  ),
  $.gulp.parallel(
    'pug',
    'stylus',
    'scripts'
  )
));

$.gulp.task('cc', $.gulp.series(
  'create:component'
));

$.gulp.task('test', $.gulp.series(
  $.gulp.parallel(
    'lint:stylus',
    'lint:pug',
    'lint:scripts'
  ),
));

$.gulp.task('default', $.gulp.series(
  ['build', 'test'],
  $.gulp.parallel(
    'watch',
    'serve'
  )
));
