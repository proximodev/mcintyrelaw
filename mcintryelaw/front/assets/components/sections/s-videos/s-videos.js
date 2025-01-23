const SVideos = (() => {
  function init($document, $sVideos) { 
    const getIframe = src => `<iframe class="_abs" src=${src} frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>`
    
    $document
      .on('click', '.js-more', function() {
        const $parent =  $(this).closest('.s-videos').addClass('_opened');
        const $height = $parent.find('.s-videos__list').height();
        $parent.find('.s-videos__list-wrapper').css('height', $height);
        $(this).removeClass('js-more').addClass('js-less').text('View less');
      })
      .on('click', '.js-less', function() {
        const $parent =  $(this).closest('.s-videos').removeClass('_opened');
        $parent.find('.s-videos__list-wrapper').css('height', '560px');
        $(this).removeClass('js-less').addClass('js-more').text('View more');
      })

    if(device.mobile())  {
      $sVideos.find('.s-media__inner').each((i, item) => {
        const $item = $(item).addClass('_mobile-hide');
        $item.prepend(getIframe($item.attr('data-yt-src')));
        $item.removeAttr('data-open-modal').removeAttr('onclick');
      })
    }
  }

  return {
    init: function($document, $sVideos) {
      console.log('SVideos.init');
      init($document, $sVideos);
    }
  };
})();

export { SVideos };