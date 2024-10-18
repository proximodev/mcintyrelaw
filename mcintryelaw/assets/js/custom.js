const $ = jQuery;
const $document = $(document);

$document.ready(function() {
  $document
    .on('click', '.back-to-top-wrapper p', function() {
      console.log('-------custom------')
      window.scrollTo(0,0);
    })

});
