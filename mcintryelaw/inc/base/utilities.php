<?php
/*
* Block Editor Styles
*/
add_action('enqueue_block_editor_assets', 'theme_block_editor_styles');
function theme_block_editor_styles() {
    wp_enqueue_style('admin-styles', get_theme_file_uri('/assets/css/block_editor_styles.css'),  array(), CHILD_THEME_VERSION, false);
}

/*
* Enable excerpt on pages
*/
add_post_type_support( 'page', 'excerpt' );

/*
* Remove WordPress bloat
*/

//Disable emojis
add_action( 'init', 'disable_emojis' );
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

// Remove dashicons in frontend for unauthenticated users
add_action( 'wp_enqueue_scripts', 'dequeue_dashicons' );
function dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}

/*
* Allow execution of php with generate blocks
*/
add_filter( 'generate_hooks_execute_php', '__return_true' );

/*
* Allow SVG uploads
*/
function enable_svg_upload( $mimes ) {
    // Allow SVG file upload
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload' );

// Sanitize SVG uploads to prevent security risks
function sanitize_svg( $file, $url ) {
    if ( strpos( $file['type'], 'svg' ) !== false ) {
        $file['type'] = 'image/svg+xml';
    }
    return $file;
}
add_filter( 'wp_check_filetype_and_ext', 'sanitize_svg', 10, 5 );

add_action( 'init', function() {
    register_nav_menu( 'mobile-menu', __( 'Mobile Menu' ) );
} );

add_filter( 'generate_mobile_header_theme_location', function() {
    return 'mobile-menu';
} );

// Adjust ACF min wysiwyg field height
add_action('admin_head', 'admin_styles');
function admin_styles() {
    ?>
    <style>
        .acf-field.acf-field-wysiwyg,
        .acf-field.acf-field-image {
            min-height: 150px !important;
            height: auto !important;
        }
        .acf-editor-wrap iframe {
            min-height: 0px !important;
            height: auto !important;
        }
    </style>
    <?php
}
?>