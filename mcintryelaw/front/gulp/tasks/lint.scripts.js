'use strict';

module.exports = () => {
  $.gulp.task('lint:scripts', () => {
    return $.gulp.src($.config.assets.js)
      .pipe($.gp.eslint())
      .pipe($.gp.eslint.format());
  });
};