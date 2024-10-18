'use strict';

module.exports = () => {
  $.gulp.task('copy:fonts', () => {
    return $.gulp.src($.config.assets.fonts, { since: $.gulp.lastRun('copy:fonts') })
      .pipe($.gp.plumber())
      .pipe($.gulp.dest($.config.public.fonts));
  });
};
