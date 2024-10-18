'use strict';

module.exports = () => {
  $.gulp.task('lint:pug', () => {
    return $.gulp.src($.config.assets.pugLint)
      .pipe($.gp.pugLinter({ reporter: 'default' }));
  });
};