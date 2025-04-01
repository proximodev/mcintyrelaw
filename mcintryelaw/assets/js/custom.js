const $ = jQuery;
const $document = $(document);

$document.ready(function() {

    $('#map-section .map-overlay').on('click', function() {
        $(this).hide(); // Hide overlay when clicked to allow interaction
    });

    $('#map-section .map-container').on('mouseleave', function() {
        $('#map-overlay').show(); // Restore overlay when mouse leaves
    });

});
