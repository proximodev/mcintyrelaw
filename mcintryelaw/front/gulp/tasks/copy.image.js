'use strict';

module.exports = () => {
  $.gulp.task('copy:image', () => {
    return $.gulp.src($.config.assets.img, { since: $.gulp.lastRun('copy:image') })
      .pipe($.gp.plumber())
      .pipe($.gp.if($.config.minify, $.gp.imagemin([
        $.imageminMozjpeg({
          progressive: true,
          quality: 85
        }),
        $.gp.imagemin.gifsicle({ interlaced: true }),
        $.gp.imagemin.optipng({ optimizationLevel: 5 }),
        $.gp.imagemin.svgo({
          plugins: [
            { removeViewBox: false },
            { cleanupIDs: false }
          ]
        })
      ], {
        verbose: true
      })))
      .pipe($.gulp.dest($.config.public.img));
  });
};
