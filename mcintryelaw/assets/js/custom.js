const $ = jQuery;
const $document = $(document);

$document.ready(function() {

    $('#map-section .map-overlay').on('click', function() {
        $(this).hide(); // Hide overlay when clicked to allow interaction
    });

    $('#map-section .map-container').on('mouseleave', function() {
        $('#map-overlay').show(); // Restore overlay when mouse leaves
    });

    var bannerImage = $('#basic-banner-image');
    var alignValue = $('#featured_image_mobile_align').text().trim();

    if (alignValue && bannerImage.length) {
        console.log("alignValue: " + alignValue);
        bannerImage
            .removeClass('align-left align-center align-right')
            .addClass(alignValue);
    }

});
