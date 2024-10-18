'use strict';

module.exports = () => {
  $.gulp.task('copy:jsLibs', () => {
    return $.gulp.src($.config.assets.jsLibs, { since: $.gulp.lastRun('copy:jsLibs') })
      .pipe($.gp.plumber())
      .pipe($.gulp.dest($.config.public.jsLibs));
  });
};