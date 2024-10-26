const FDefault = (() => {
  const controlAnimate = $field => $field.closest('.gfield').toggleClass('_changed', !!$field?.val()?.length);

  function init($document, $fDefault) { 
    $document
      .on('change', '.custom-form select', function() {
        controlAnimate($(this));
      })
      .on('focus', '.custom-form input:not([type="hidden"]), .custom-form textarea', function() {
        $(this).closest('.gfield').addClass('_changed');
      })
      .on('blur', '.custom-form input:not([type="hidden"]), .custom-form textarea', function() {
        controlAnimate($(this));
      })

    $fDefault.find('input:not([type="hidden"])', 'select').each((i, item) => controlAnimate($(item)));
  }

  return {
    init: function($document, $fDefault) {
      console.log('FDefault.init');
      init($document, $fDefault);
    }
  };
})();

export { FDefault };