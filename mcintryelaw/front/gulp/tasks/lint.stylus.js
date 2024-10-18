'use strict';

module.exports = () => {
  $.gulp.task('lint:stylus', () => {
    return $.gulp.src($.config.assets.cssLint)
      .pipe($.stylint({ config: '.stylintrc' }))
      .pipe($.stylint.reporter());
  });
};