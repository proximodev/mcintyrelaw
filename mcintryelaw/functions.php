<?php
/**
* McIntrye Functions
*/

// Child Theme Version
$ver = wp_get_theme()->get('Version');
define( 'CHILD_THEME_VERSION', $ver);

// Enqueue
function theme_styles() {

    // Dev only
    $verRnd = rand();

    wp_dequeue_style( 'generate-child-css' );
    wp_deregister_style( 'generate-child-css' );
    wp_enqueue_style( 'mcintryelaw-child', get_stylesheet_directory_uri() . '/style.css', array() , $verRnd, false );
    wp_enqueue_style( 'common-css', get_stylesheet_directory_uri() . '/assets/css/common.css', array() , $verRnd, false);

    wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array(), CHILD_THEME_VERSION, false );
    wp_enqueue_script( 'modal', get_stylesheet_directory_uri() . '/assets/js/modal.js', array(), CHILD_THEME_VERSION, true );
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array(), CHILD_THEME_VERSION, true );
    wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/assets/js/app.js', array(), $verRnd, true );

}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

/*
* Custom Content Types
*/
include( get_theme_file_path("/inc/base/content-types.php") );

/*
* Taxonomies
*/
//include( get_theme_file_path("/inc/base/taxomonies.php") );

/*
* ACF Fields
*/
//include( get_theme_file_path("/inc/base/acf-fields.php") );

/*
* ACF Blocks
*/
include( get_theme_file_path("/inc/base/acf-blocks.php") );

/*
* Customized Blocks and Styles
*/
include( get_theme_file_path("/inc/base/block-styles.php") );

/*
* Media
*/
include( get_theme_file_path("/inc/base/media.php") );

/*
* Utilities
*/
include( get_theme_file_path("/inc/base/utilities.php") );
