import './vendor/platform-detect.min';
import './vendor/device.min';

import { Footer } from '../comp-wp/footer/footer';
import { Search } from '../comp-wp/forms/search-form';
import { SLAttorneys } from '../components/sliders/sl-attorneys/sl-attorneys';
import { SLGallery } from '../components/sliders/sl-gallery/sl-gallery';
import { SLTestimonials } from '../components/sliders/sl-testimonials/sl-testimonials';
import { SVideos } from '../components/sections/s-videos/s-videos';
import { FDefault } from '../components/forms/f-default/f-default';
import { Modal } from '../components/modals/_modal-default/modal-default';

const $ = window.$ = window.jQuery;

const App = () => {
  /* eslint-disable */
  const $document = $(document),
    $window = $(window),
    $html = $document.find('html'),
    $body = $html.find('body'),
    $footer = $body.find('.back-to-top-wrapper'),
    $search = $body.find('.search-form'),
    $slAttorneys = $body.find('.sl-attorneys'),
    $slGallery = $body.find('.sl-gallery'),
    $slTestimonials = $body.find('.sl-testimonials'),
    $sVideos = $body.find('.s-videos'),
    $fDefault = $body.find('.custom-form'),
    $modal = $body.find('.modal-default');


  /* eslint-enable */
  /* eslint-disable no-alert, no-console */
  var style = 'padding: 5px 10px; background: linear-gradient(green, darkblue); font: 1.3rem Arial, sans-serif; color: white;';
  console.group('%c%s', style, 'App Initialization');
  console.log('App.init');
  console.groupEnd();
  /* eslint-enable no-alert, no-console */

  $footer.length && Footer.init($document);
  $search.length && Search.init($document, $search);
  $slAttorneys.length && SLAttorneys($slAttorneys);
  $slGallery.length && SLGallery($slGallery);
  $slTestimonials.length && SLTestimonials($slTestimonials);
  $modal.length && Modal.init($document, $html);
  $fDefault.length && FDefault.init($document, $fDefault);
  $sVideos.length && SVideos.init($document, $sVideos);
 
};

$(function () {
  App();
});
