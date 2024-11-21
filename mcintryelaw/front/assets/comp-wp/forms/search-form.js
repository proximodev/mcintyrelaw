const Search = (() => {
  function init($document, $search) {
    const elHide = $el => {
      $el.removeClass('_search-open').addClass('_search-closed').find('input').val('');
    }

    elHide($search.parent());
    
    $document
      .on('click', '._search-closed .search-toggle', function() {
        $(this).parent().addClass('_search-open').removeClass('_search-closed').find('input').focus();
      })
      .on('click', '._search-open .search-toggle', function() {
        elHide($(this).parent());
      })
      .on('keyup', function (e) {
        if (e.keyCode === 27) {
          elHide($search.parent());
        }
    });

    $(window)
      .on('scroll', function() {
        elHide($search.parent());
      })
  }

  return {
    init: function ($document, $search) {
        console.log('Search.init');
        init($document, $search);
    }
  };

})();

export { Search }

