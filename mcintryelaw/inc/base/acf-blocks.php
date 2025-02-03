<?php
/**
 * Defines ACF blocks
 * https://www.advancedcustomfields.com/resources/acf_register_block_type_type/
 */

add_action('acf/init', 'my_acf_init');

function my_acf_init() {
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'gallery-block',
            'title'             => __('Gallery'),
            'description'       => __('Gallery compoment for photos'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'media',
            'icon'              => 'images-alt',
            'keywords'          => array( 'people', 'team', 'lawyer', 'bio'),
            'post_types'        => array('post', 'page', 'practice-area'),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'gallery-slider',
            'title'             => __('Gallery Slider'),
            'description'       => __('Image slider component'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'media',
            'icon'              => 'format-image',
            'keywords'          => array( 'photo', 'gallery', 'images', 'slider'),
            'post_types'        => array('post', 'page', 'practice-area'),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'content-tile',
            'title'             => __('Content Tile'),
            'description'       => __('Tile linked to pages and posts'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'content',
            'icon'              => 'format-image',
            'keywords'          => array( 'tiles', 'content'),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'people-block',
            'title'             => __('People'),
            'description'       => __('Tile linked to pages and posts'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'content',
            'icon'              => 'groups',
            'keywords'          => array( 'people', 'team', 'lawyer', 'bio'),
            'post_types'        => array('post', 'page', 'practice-area'),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'testimonial-slider',
            'title'             => __('Testimonial Video Slider'),
            'description'       => __('Slider with testimonial videos'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'video',
            'icon'              => 'format-image',
            'keywords'          => array( 'video', 'testimonial'),
            'post_types'        => array('post', 'page', 'practice-area'),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'video-block',
            'title'             => __('Video Block'),
            'description'       => __('Block with support for YouTube'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'media',
            'icon'              => 'format-image',
            'keywords'          => array( 'media', 'video', 'youtube' ),
            'post_types'        => array('post', 'page', 'practice-area'),
            'mode'              => 'edit',
            //'enqueue_style'     => get_stylesheet_directory_uri . '/template-parts/blocks/media-block/media-block.css',
        ));


        acf_register_block_type(array(
            'name'              => 'video-tiles',
            'title'             => __('Video Tiles'),
            'description'       => __('List of videos in tile format with support for YouTube'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'media',
            'icon'              => 'format-image',
            'keywords'          => array( 'media', 'video', 'youtube' ),
            'post_types'        => array('post', 'page', 'practice-area'),
            'mode'              => 'edit',
            //'enqueue_style'     => get_stylesheet_directory_uri . '/template-parts/blocks/media-block/media-block.css',
        ));

    }
}

function my_acf_block_render_callback( $block ) {
    $slug = str_replace('acf/', '', $block['name']);
    if( file_exists( get_theme_file_path("/blocks/{$slug}/{$slug}.php") ) ) {
        include( get_theme_file_path("/blocks/{$slug}/{$slug}.php") );
    }
}

?>