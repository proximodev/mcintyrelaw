const root = `${process.env.ROOT_FOLDER}`,
  assets = `${process.env.ASSETS_FOLDER}`,
  dist = `${process.env.DIST_FOLDER}`,
  img = `${process.env.IMAGES_FOLDER}`;

module.exports = {
  root: `${root}/`,
  src: `${root}/${assets}`,
  dist: `${root}/${dist}`,
  port: process.env.PORT || 9000,
  openBrowser: process.env.NODE_ENV === 'heroku' ? false : 'local',
  reload: !!process.env.RELOAD,
  minify: !!process.env.MINIFY,
  https: !!process.env.HTTPS,

  assets: {
    html: `${root}/${assets}/views/**/*.pug`,
    htmlData: `${root}/${assets}/components/**/*.json`,
    js: [`${root}/${assets}/js/main.js`],
    jsLibs: `${root}/${assets}/js/vendor/**/*.js`,
    css: `${root}/${assets}/common/stylus/*.styl`,
    cssLint: [`${root}/${assets}/**/*.styl`, `!${root}/${assets}/**/etc/**/*.styl`, `!${root}/${assets}/**/settings/**/*.styl`, `!${root}/${assets}/**/print.styl`],
    pugLint: [`${root}/${assets}/components/**/*.pug`,`${root}/${assets}/common/pug/*.pug`],
    img: [`${root}/${assets}/${img}/**/*.+(png|gif|jpg|jpeg|PNG|JPG|JPEG|SVG|svg|webp)`, `!${root}/${assets}/${img}/**/sprite/**/*`],
    spriteSvg: [`${root}/${assets}/${img}/svg/*.svg`],
    fonts: `${root}/${assets}/fonts/**/*.*`
  },
  public: {
    html: `${root}/${dist}`,
    htmlData: `${root}/${assets}/data`,
    js: `${root}/${dist}/${assets}/js`,
    jsLibs: `${root}/${dist}/${assets}/js/vendor`,
    css: `${root}/${dist}/${assets}/css`,
    img: `${root}/${dist}/${assets}/${img}`,
    spriteImg: `${root}/${assets}/${img}`,
    spriteCss: `${root}/${assets}/common/stylus/etc`,
    fonts: `${root}/${dist}/${assets}/fonts`
  },
  watch: {
    html: `${root}/${assets}/**/*.pug`,
    htmlData: `${root}/${assets}/components/**/*.json`,
    js: [`${root}/${assets}/**/*.js`, `!${root}/${assets}/js/vendor/**/*.js`],
    jsLibs: `${root}/${assets}/js/vendor/**/*.js`,
    css: `${root}/${assets}/**/*.styl`,
    img: `${root}/${assets}/${img}/**/*.+(png|gif|jpg|jpeg|PNG|JPG|JPEG)`,
    spriteSvg: [`${root}/${assets}/${img}/svg/*.svg`],
    fonts: `${root}/${assets}/fonts/**/*.*`
  },
  autoprefixerConfig: [
    "defaults",
    "not IE 11",
    "maintained node versions"
  ]
};

