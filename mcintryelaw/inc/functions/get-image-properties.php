<?php
/**
* Description: Accepts media object from ACF and returns image source, alt and title tags
*
* Example usage:
* $imageObject = get_field('my_image_field'); // Assuming this comes from an ACF field
* $imageAttributes = get_image_properties($imageObject, 'medium'); // 'medium' is the desired size
* echo '<img src="' . $imageAttributes['src'] . '" alt="' . $imageAttributes['alt'] . '" title="' . $imageAttributes['title'] . '">';
*
*/

function get_image_properties($imageObject, $size = 'full') {
    // Check if the image object is provided and has sizes
    if (!empty($imageObject) && isset($imageObject['sizes'][$size])) {
        $imgSrc = $imageObject['sizes'][$size];
        $imgAlt = esc_attr($imageObject['alt'] ?? '');
        $imgTitle = esc_attr($imageObject['title'] ?? '');
    } else {
        // Use placeholder if no image is provided
        $imgSrc = get_stylesheet_directory_uri() . "/assets/images/placeholder-1080x720.png";
        $imgAlt = "Placeholder Alt";
        $imgTitle = "Placeholder Title";
    }

    // Return image attributes as an array
    return [
        'src' => $imgSrc,
        'alt' => $imgAlt,
        'title' => $imgTitle,
    ];
}
?>

