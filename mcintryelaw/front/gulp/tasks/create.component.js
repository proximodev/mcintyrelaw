'use strict';

module.exports = () => {
  $.gulp.task('create:component', () => {
    return new Promise(function (resolve, reject) {
      let fContent = '';
      let cPrefix = '';
      let prefixes = {
        link: 'a',
        block: 'b',
        button: 'btn',
        form: 'f',
        list: 'l',
        menu: 'm',
        modal: 'modal',
        preview: 'pr',
        section: 's',
        slider: 'sl',
        svg: 'svg',
        table: 'table'
      };
      let fType = ['pug', 'styl'];
      let cType = process.argv[3].split('--')[1];
      let cName = process.argv[4];
      for (let key in prefixes) {
        if (key === cType) {
          cPrefix = prefixes[key];
        }
      }
      let cFullName = cPrefix + '-' + cName;
      let pTemplate = `mixin ${cFullName}(o = {})\n\n  .${cPrefix}-${cName}`;
      let pugMixinTemplate = `\ninclude ../../../components/${cType}s/${cFullName}/${cFullName}`;
      let sTemplate = `.${cFullName}\n  /* write your styles here */`;
      let cPath = `${$.config.src}/components/${cType}s/${cFullName}`;
      let fName = cPath + '/' + cFullName;
      let pugMixinPath = `${$.config.src}/common/pug/mixins/${cType}s.pug`;

      !$.fs.existsSync(cPath) && $.fs.mkdirSync(cPath);
      $.fs.appendFileSync(pugMixinPath, pugMixinTemplate);
      fType.forEach((fExpansion) => {
        switch (fExpansion) {
          case 'pug':
            fContent = pTemplate;
            break;
          case 'styl':
            fContent = sTemplate;
            break;
        }
        !$.fs.existsSync(fName + '.' + fExpansion) && $.fs.writeFileSync(fName + '.' + fExpansion, fContent);
        console.log('File: ' + cFullName + '.' + fExpansion + ' created');
      });
      resolve();
    });
  });
};