'use strict';
let browserSyncConfig = {
  directory: true,
  notification: false,
  reloadOnRestart: false,
  startPath: 'index.html',
  index: 'index.htm',
  open: $.config.openBrowser,
  ghostMode: false,
  server: $.config.dist,
  port: $.config.port,
  https: $.config.https,
};

$.config.reload && Object.assign(browserSyncConfig, { files: $.config.dist + '/**/*.*' });

module.exports = () => {
  $.gulp.task('serve', () => {
    $.browserSync.init(browserSyncConfig);
  });
};
