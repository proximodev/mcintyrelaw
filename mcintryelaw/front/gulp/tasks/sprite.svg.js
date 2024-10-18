'use strict';
const customSTYLTemplate = $.path.join(__dirname, `../svg-sprite-styl-template.styl`);
const customDEMOTemplate = $.path.join(__dirname, `../svg-sprite-demo-template.html`);

module.exports = () => {
  $.gulp.task('sprite:svg', () => {
    return $.gulp.src($.config.assets.spriteSvg)
      .pipe($.gp.plumber())
      .pipe($.gp.cheerio({
        run: ($, file) => {
          const $linearGradient = $(`linearGradient`);
          const $clipPath = $(`clipPath`);
          const $mask = $(`mask`);
          let $defs = $(`defs`);
          const hasLinearGradient = $linearGradient.length > 0;
          const hasClipPath = $clipPath.length > 0;
          const hasMask = $mask.length > 0;
          const hasDefs = $defs.length > 0;

          if (file.basename.indexOf('.blank.') >= 0) {
            $('[fill]').removeAttr('fill');
            $('[stroke]').removeAttr('stroke');
            $('[style]').removeAttr('style');

            file.basename = file.basename.split('.blank.')[0] + '.svg';
          }

          if (!hasClipPath && !hasMask && !hasLinearGradient) return;
          if (!hasDefs) {
            $defs = $(`<defs></defs>`);
            $defs.prependTo(`svg`);
          }

          function copyToDefs(i, el) {
            const $el = $(el);
            const $clone = $el.clone();
            $clone.appendTo($defs);
            $el.remove();
          }

          if (hasClipPath) $clipPath.each(copyToDefs);
          if (hasMask) $mask.each(copyToDefs);
          if (hasLinearGradient) $linearGradient.each(copyToDefs);
        },
        parserOptions: {
          xmlMode: true,
        },
      }))
      .pipe($.gp.svgmin(file => {
        const { relative, } = file;
        const prefix = $.path.basename(relative, $.path.extname(relative));
        return {
          js2svg: {
            pretty: true,
          },
          plugins: [{
            // this prevent duplicated IDs when bundled in the same file
            cleanupIDs: { prefix: `${prefix}-`, },
          }, {
            // some cleaning
            removeDoctype: true,
          }, {
            removeXMLProcInst: true,
          }, {
            removeTitle: true,
          }, {
            removeDesc: { removeAny: true, },
          },
          ],
        };
      }))
      .pipe($.svgSymbols({
        class: `.svg-%f`,
        svgAttrs: {
          class: 'svg-templates',
          'aria-hidden': 'true'
        },
        templates: [
          'default-svg',
          customDEMOTemplate,
          customSTYLTemplate
        ]
      }))
      .pipe($.gp.rename(function (path) {
        path.basename = `_set`;
      }))
      .pipe($.gp.if(/[.]svg$/, $.gulp.dest($.config.public.spriteImg)))
      .pipe($.gp.if(/[.]styl/, $.gulp.dest($.config.public.spriteCss)))
      .pipe($.gp.if(/[.]html$/, $.gulp.dest($.config.public.html)));
  });
};


