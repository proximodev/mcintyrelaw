'use strict';

module.exports = () => {
  $.gulp.task('clean', (cb) => $.del($.config.dist, cb));
};