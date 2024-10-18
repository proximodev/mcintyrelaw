const Footer = (() => {
  function init($document) {
    $document
      .on('click', '.back-to-top-wrapper p', function() {
        window.scrollTo(0,0);
      })
  }

  return {
    init: function ($document) {
        console.log('Footer.init');
        init($document);
    }
  };

})();

export {Footer}

