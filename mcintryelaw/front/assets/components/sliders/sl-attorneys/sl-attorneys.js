const SLAttorneys = ($slAttorneys) => {
  const $slider = $slAttorneys.find('.sl-attorneys__list');
  
  const options = {
    slidesToShow: 4,
    prevArrow: $('.sl-attorneys .sl-attorneys__prev'),
    nextArrow: $('.sl-attorneys .sl-attorneys__next'),
    speed: 250,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        }
      },
    ]
  };

  $slider
    .on('init', function (event, slick) {
      $slider.css('opacity', 1);
    })
    .slick(options);
  
  console.log('SLAttorneys init');  
}

export { SLAttorneys };
