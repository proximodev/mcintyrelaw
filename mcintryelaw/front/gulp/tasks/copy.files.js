'use strict';

module.exports = () => {
  $.gulp.task('copy:files', () => {
    return $.gulp.src($.config.assets.files, { since: $.gulp.lastRun('copy:files') })
      .pipe($.gp.plumber())
      .pipe($.gulp.dest($.config.public.files));
  });
};
