import './vendor/platform-detect.min';
import './vendor/device.min';

import { Footer } from '../comp-wp/footer/footer';
//import { SFaq } from '../components/sections/s-faq/s-faq';
//import { FDefault } from '../components/forms/f-default/f-default';
//import { Modal } from '../components/modals/_modal-default/modal-default';

const $ = window.$ = window.jQuery;

const App = () => {
  /* eslint-disable */
  const $document = $(document),
    $window = $(window),
    $html = $document.find('html'),
    $body = $html.find('body'),
    $footer = $body.find('.back-to-top-wrapper'),
    //$sFaq = $body.find('.schema-faq'),
    //$fDefault = $body.find('[class*=form-wrapper] form'),
    $modal = $body.find('.modal-default');


  /* eslint-enable */
  /* eslint-disable no-alert, no-console */
  var style = 'padding: 5px 10px; background: linear-gradient(green, darkblue); font: 1.3rem Arial, sans-serif; color: white;';
  console.group('%c%s', style, 'App Initialization');
  console.log('App.init');
  console.groupEnd();
  /* eslint-enable no-alert, no-console */

  $footer.length && Footer.init($document);
  //$modal.length && Modal.init($document, $html);
  //$sFaq.length && SFaq.init($document, $sFaq);
  //$fDefault.length && FDefault.init($document, $fDefault);
 
};

$(function () {
  App();
});
