'use strict';

module.exports = () => {
  $.gulp.task('watch', () => {
    $.isEmitted = true;

    $.gulp.watch($.config.watch.html, $.gulp.series('pug', 'lint:pug'))
      .on('all', (event, filepath) => {
        $.emittyChangedFile = filepath;
      });
    $.gulp.watch($.config.watch.htmlData, $.gulp.series('pug:data', 'pug', 'lint:pug'));
    $.gulp.watch($.config.watch.css, $.gulp.series('stylus', 'lint:stylus'));
    $.gulp.watch($.config.watch.js, $.gulp.series('scripts', 'lint:scripts'));
    $.gulp.watch($.config.watch.fonts, $.gulp.series('copy:fonts'));
    $.gulp.watch($.config.watch.img, $.gulp.series('copy:image'));
    $.gulp.watch($.config.watch.jsLibs, $.gulp.series('copy:jsLibs'));
  });
};
