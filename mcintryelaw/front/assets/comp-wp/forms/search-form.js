const Search = (() => {
  function init($document, $search) {
    const hideForm = $el => {
      $el.removeClass('_search-open').addClass('_search-closed').find('input').val('');
    }

    hideForm($search.parent());

    $document
      .on('click', '._search-closed .search-toggle', function() {
        $(this).parent().addClass('_search-open').removeClass('_search-closed').find('input').focus();
      })
      .on('click', '._search-open .search-toggle', function() {
        hideForm($(this).parent());
      })
      .on('keyup', function (e) {
        if (e.keyCode === 27) {
          hideForm($search.parent());
        }
    });

    $(window)
      .on('scroll', function() {
        hideForm($search.parent());
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

