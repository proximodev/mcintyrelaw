'use strict';

module.exports = () => {
  $.gulp.task('copy:assets', () => {
    return $.gulp.src($.config.laravel.sources, { since: $.gulp.lastRun('copy:assets') })
      .pipe($.gp.plumber())
      .pipe($.gulp.dest($.config.laravel.dist));
  });
};
