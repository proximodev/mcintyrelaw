<?php
/**
* Custom Content Types
*/

/*
* Rewrite URL - Practice Areas - Add taxonomy
*/
function rewrite_practice_area_slug( $args, $post_type ) {
    if ( $post_type === 'practice-area') {
        $args['rewrite'] = array (
            'slug'       => '/%practice-area-types%',
            'with_front' => false,
        );
    }
    return $args;
}
add_filter( 'register_post_type_args', 'rewrite_practice_area_slug', 10, 2 );

function set_practice_area_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'practice-area' ){
        $terms = wp_get_object_terms( $post->ID, 'practice-area-types' );
        if( $terms ){
            return str_replace( '%practice-area-types%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'set_practice_area_permalinks', 1, 2 );