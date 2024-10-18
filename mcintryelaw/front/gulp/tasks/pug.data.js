'use strict';

module.exports = function () {
  $.gulp.task('pug:data', function () {
    return $.gulp.src($.config.assets.htmlData)
      .pipe($.mergeJSON({
        fileName: 'data.json',
        edit: (json, file) => {
          let filename = $.path.basename(file.path);
          let data = {};
          let primaryKey = filename
            .replace($.path.extname(filename), '')
            .toLowerCase()
            .replace(/[-_]+/g, ' ')
            .replace(/[^\w\s]/g, '')
            .replace(/ (.)/g, function ($1) {
              return $1.toUpperCase();
            })
            .replace(/ /g, '');

          data[primaryKey] = json;
          return data;
        }
      }))
      .pipe($.gulp.dest($.config.public.htmlData));
  });
};

