const SLTestimonials = ($slTestimonials) => {
  const $slider = $slTestimonials.find('.sl-testimonials__list');
  
  const options = {
    slidesToShow: 3,
    prevArrow: $('.sl-testimonials .sl-testimonials__prev'),
    nextArrow: $('.sl-testimonials .sl-testimonials__next'),
    speed: 250,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          vertical: true,
          verticalSwiping: true,
        }
      },
    ]
  };

  $slider
    .on('init', function (event, slick) {
      $slider.css('opacity', 1);
    })
    .slick(options);
  
  console.log('SLTestimonials init');  
}

export { SLTestimonials };
