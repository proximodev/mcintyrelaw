<?php
/**
 * Defines ACF blocks
 * https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */

add_action('acf/init', 'my_acf_init');

function my_acf_init() {
    if( function_exists('acf_register_block') ) {

        acf_register_block(array(
            'name'              => 'media-block',
            'title'             => __('Media Block'),
            'description'       => __('Block with support for images, YouTube and Loom'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'media',
            'icon'              => 'format-image',
            'keywords'          => array( 'media', 'video', 'youtube' ),
            'post_types'        => array('post', 'page'),
            'mode'              => 'edit',
            //'enqueue_style'     => get_stylesheet_directory_uri . '/template-parts/blocks/media-block/media-block.css',
        ));

        acf_register_block(array(
            'name'              => 'people-block',
            'title'             => __('People'),
            'description'       => __('Tile linked to pages and posts'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'content',
            'icon'              => 'groups',
            'keywords'          => array( 'people', 'team', 'lawyer', 'bio'),
            'post_types'        => array('post', 'page'),
            'mode'              => 'edit',
        ));

        acf_register_block(array(
            'name'              => 'gallery-block',
            'title'             => __('Gallery'),
            'description'       => __('Gallery compoment for photos'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'media',
            'icon'              => 'images-alt',
            'keywords'          => array( 'people', 'team', 'lawyer', 'bio'),
            'post_types'        => array('post', 'page'),
            'mode'              => 'edit',
        ));

        acf_register_block(array(
            'name'              => 'content-tile',
            'title'             => __('Content Tile'),
            'description'       => __('Tile linked to pages and posts'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'content',
            'icon'              => 'format-image',
            'keywords'          => array( 'tiles', 'content'),
            'post_types'        => array('post', 'page'),
            'mode'              => 'edit',
        ));

    }
}

function my_acf_block_render_callback( $block ) {
    $slug = str_replace('acf/', '', $block['name']);
    if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/blocks/{$slug}/{$slug}.php") );
    }
}
?>