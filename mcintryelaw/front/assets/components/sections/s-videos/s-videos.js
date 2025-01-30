const SVideos = (() => {
  function init($document, $sVideos) { 
    $sVideos.each((i, item) => {
      const $section = $(item);

      if(device.mobile())  {
        const getIframe = src => `<iframe class="_abs" src=${src} frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>`
        
        $section.find('.s-media__inner').each((i, item) => {
          const $item = $(item).addClass('_mobile-hide');
          $item.prepend(getIframe($item.attr('data-yt-src')));
          $item.removeAttr('data-open-modal').removeAttr('onclick');
        })
      }
      const $videoWrapper = $section.find('.s-videos__list-wrapper');
  
      if($section.find('.s-videos__item').length < 4 || $videoWrapper.hasClass('view-all')) {
        $section.find('.videos__btn-wrapper').css('display', 'none');
        $videoWrapper.css('height', 'auto');
      } else {
  
        if (device.mobile() || window.innerWidth <= 600)  {
          const $height = $section.find('.s-videos__list').height();
          const $calcHeight = window.innerWidth > 600 ? '560px' : $height > 1500 ? '1320px' : 'auto';
          $videoWrapper.css('height', $calcHeight);
        }   
  
        $document
          .on('click', '.js-more', function() {
            const $parent =  $(this).closest('.s-videos').addClass('_opened');
            
            $parent.find('.s-videos__list-wrapper').css('height', 'auto');
            $(this).removeClass('js-more').addClass('js-less').text('View less');
          })
          .on('click', '.js-less', function() {
            const $parent =  $(this).closest('.s-videos').removeClass('_opened');
            const $height = $parent.find('.s-videos__list').height();
            const $calcHeight = window.innerWidth > 600 ? '560px' : $height > 1500 ? '1320px' : 'auto';
  
            $parent.find('.s-videos__list-wrapper').css('height', $calcHeight);
            $(this).removeClass('js-less').addClass('js-more').text('View more');
          })
      }
    })
  }

  return {
    init: function($document, $sVideos) {
      console.log('SVideos.init');
      init($document, $sVideos);
    }
  };
})();

export { SVideos };