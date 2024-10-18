'use strict';

module.exports = () => {
  $.gulp.task('stylus', () => {
    return $.gulp.src($.config.assets.css)
      .pipe($.gp.plumber())
      .pipe($.gp.sourcemaps.init())
      .pipe($.gp.stylus({
        compress: true,
        'include css': true
      })).on('error', $.gp.notify.onError({ title: 'Style' }))
      .pipe($.gp.postcss([
        require('stylelint')(),
        require('postcss-gradient-transparency-fix'),
        require('postcss-flexbugs-fixes'),
        require('autoprefixer')({ overrideBrowserslist: $.config.autoprefixerConfig }),
        require('postcss-reporter')()
      ]))
      .pipe($.gp.if($.config.minify, $.cleanCSS({ debug: true }, (details) => {
        $.fancyLog($.colors.bold.red(`${details.name}: Original - ${(details.stats.originalSize / 1e3).toFixed(1)} kb`));
        $.fancyLog($.colors.bold.green(`${details.name}: Min - ${(details.stats.minifiedSize / 1e3).toFixed(1)} kb`));
      })))
      .pipe($.gp.sourcemaps.write('.'))
      .pipe($.gulp.dest($.config.public.css))
      .pipe($.gp.if($.config.reload, $.browserSync.stream({ once: true })));
  });
};
