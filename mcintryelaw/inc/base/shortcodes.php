<?php
/**
* Custom Shortcodes
*/

function display_published_date_shortcode() {
    if (is_single() || is_page()) {
        return '<div class="published-date">' . get_the_date() . '</div>';
    }
    return '';
}
add_shortcode('published_date', 'display_published_date_shortcode');