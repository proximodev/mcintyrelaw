const SLGallery = ($slGallery) => {
  const $slider = $slGallery.find('.sl-gallery__list');
  
  const options = {
    slidesToShow: 1,
    prevArrow: $('.sl-gallery .sl-gallery__prev'),
    nextArrow: $('.sl-gallery .sl-gallery__next'),
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
  };

  $slider
    .on('init', function (event, slick) {
      $slider.css('opacity', 1);
    })
    .slick(options);
  
  console.log('SLGallery init');  
}

export { SLGallery };
