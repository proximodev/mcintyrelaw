const SMedia = (() => {
  function init($document, $sMedia) {
    if(!device.mobile()) {
      return;
    }

    $sMedia.each((i, item) => {
      const $inner = $(item).find('.s-media__inner');
      $inner.removeAttr('data-open-modal').removeAttr('onClick');
      const src = $inner.attr('data-src');
      const ytSrc = $inner.attr('data-yt-src');
      const imgSrc = $inner.attr('data-img-src');
      $inner.removeAttr('href');
      $inner.css({'padding-top': 0})
      if(ytSrc) {
        $inner.find('img').remove();
        $inner.find('.s-media__overlay').css('pointer-events', 'none');
        $inner.append(`<iframe width="100%" height="360" src=${ytSrc} allow="autoplay; encrypted-media" frameborder="0" allowfullscreen></iframe>`)
        return;
      }
      if(src) {
        $inner.find('img').remove();
        $inner.find('.s-media__overlay').css('pointer-events', 'none');
        $inner.append(`<iframe width="100%" height="360" src=${src} frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>`)
        return;
      }
      $inner.html(`<img src=${imgSrc} alt='image' style='position: static; height: auto'/>`);
    })

    window.focus();
    window.addEventListener('blur', () => {
      setTimeout(() => {
        if(document.activeElement.tagName === 'IFRAME') {
          document.activeElement.closest('section').classList.toggle('_play');
          window.focus();
        }
      })
    })
  }
  
  return {
    init($document, $sMedia) {
      console.log('SMedia init');
      init($document, $sMedia);
    }
  };
})();

export { SMedia };
