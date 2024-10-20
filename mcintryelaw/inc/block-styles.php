<?php
/**
* Adds style CSS in guttenberg
**/

function register_button_block_styles() {

    register_block_style(
        'core/cover',
        array(
            'name'  => 'full-width',
            'label' => __( ' Full Width', 'full-width' ),
        )
    );

    register_block_style(
        'core/group',
        array(
            'name'  => 'full-width',
            'label' => __( ' Full Width', 'full-width' ),
        )
    );

    register_block_style(
        'core/paragraph',
            array(
            'name'  => 'paragraph-large',
            'label' => __( ' Large', 'p-large' ),
        )
    );

    register_block_style(
        'core/button',
            array(
            'name'  => 'button-medium',
            'label' => __( ' Medium', 'b-medium' ),
        )
    );

    register_block_style(
        'core/button',
            array(
            'name'  => 'button-large',
            'label' => __( ' Large', 'b-large' ),
        )
    );

    register_block_style(
        'core/button',
            array(
            'name'  => 'button-from',
            'label' => __( ' Form', 'b-form' ),
        )
    );


}
add_action( 'init', 'register_button_block_styles' );


add_filter( 'generateblocks_defaults', function( $defaults ) {
    $color_settings = wp_parse_args(
        get_option( 'generate_settings', array() ),
        generate_get_color_defaults()
    );

    $defaults['button']['backgroundColor'] = $color_settings['form_button_background_color'];
    $defaults['button']['backgroundColorHover'] = $color_settings['form_button_background_color_hover'];
    $defaults['button']['textColor'] = $color_settings['form_button_text_color'];
    $defaults['button']['textColorHover'] = $color_settings['form_button_text_color_hover'];
    $defaults['button']['borderRadiusTopRight'] = '5';
    $defaults['button']['borderRadiusTopLeft'] = '5';
    $defaults['button']['borderRadiusBottomRight'] = '5';
    $defaults['button']['borderRadiusBottomLeft'] = '5';

    return $defaults;
} );

?>