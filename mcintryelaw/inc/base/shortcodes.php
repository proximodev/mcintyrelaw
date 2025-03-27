<?php
/**
* Custom Shortcodes
*/

function display_published_date_shortcode() {
    if (is_single() || is_page()) {
        return '<div class="published-date">Published on ' . get_the_date() . '</div>';
    }
    return '';
}
add_shortcode('published_date', 'display_published_date_shortcode');

function anniversary_shortcode() {
    $anniversary_date = new DateTime('1993-12-18');
    $current_date = new DateTime();
    $interval = $anniversary_date->diff($current_date);
    $years = $interval->y;
    $ordinalVal = get_ordinal_suffix($years);
    return $years . $ordinalVal;
}
add_shortcode('anniversary_years', 'anniversary_shortcode');

function get_ordinal_suffix($number) {
    if ($number % 100 >= 11 && $number % 100 <= 13) {
        return 'th';
    }
    switch ($number % 10) {
        case 1: return 'st';
        case 2: return 'nd';
        case 3: return 'rd';
        default: return 'th';
    }
}
