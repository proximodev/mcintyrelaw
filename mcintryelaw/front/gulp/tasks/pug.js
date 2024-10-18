'use strict';

function htmllintReporter(filepath, issues) {
  if (issues.length > 0) {
    issues.forEach(function (issue) {
      $.fancyLog($.colors.bold.red('[gulp-htmllint]') + ' ' + $.colors.green(filepath.split('/').slice(-1)[0] + ': ') + $.colors.bold.red(issue.msg));
    });

    process.exitCode = 1;
  }
}

module.exports = () => {
  $.gulp.task('pug', () => {
    return new Promise((resolve, reject) => {
      $.emitty.scan($.emittyChangedFile).then(() => {
        $.gulp.src($.config.assets.html)
          .pipe($.gp.plumber())
          .pipe($.gp.data(() => JSON.parse($.fs.readFileSync(`${$.config.src}/data/data.json`))))
          .pipe($.gp.data(() => process.env))
          .pipe($.gp.if($.isEmitted, $.emitty.filter($.emittyChangedFile)))
          .pipe($.gp.pug({
            pretty: true
          }))
          .pipe($.gulp.dest($.config.public.html))
          .on('end', resolve)
          .on('error', $.gp.notify.onError((error) => {
            reject();
            return {
              title: 'Pug',
              message: error.message
            };
          }));
      });
    });
  });
};
