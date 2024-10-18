const FDefault = (() => {
  const controlAnimate = $field => $field.parent().toggleClass('_animate', !!$field?.val()?.length);
  
  function init($document, $fDefault) { 
    $document
      .on('change.controlSelect', '.resources-form-wrapper select', function() {
        controlAnimate($(this));
      })
      .on('focus blur.controlField', '.resources-form-wrapper input', function() {
        controlAnimate($(this));
      })

    $fDefault.find('input', 'select').each((i, item) => controlAnimate($(item)));
  }

  return {
    init: function($document, $fDefault) {
      console.log('FDefault.init');
      init($document, $fDefault);
    }
  };
})();

export { FDefault };