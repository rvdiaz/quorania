<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package quorania-microsite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function quorania_microsite_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'quorania_microsite_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function quorania_microsite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'quorania_microsite_pingback_header' );

/**
 * Remove wordpress default edit 
 */ 
function quorania_microsite_remove_editor_init() {
    if ( ! is_admin() ) {
       return;
    } 
    $current_post_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT );
    $update_post_id = filter_input( INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT );
    if ( isset( $current_post_id ) ) {
       $post_id = absint( $current_post_id );
    } else if ( isset( $update_post_id ) ) {
       $post_id = absint( $update_post_id );
    } else {
       return;
    }
    if ( isset( $post_id ) ) {
           remove_post_type_support( 'page', 'editor' );
		   remove_post_type_support( 'page', 'thumbnail' );
		   remove_post_type_support( 'page', 'page-attributes' );
    }
}
add_action( 'init', 'quorania_microsite_remove_editor_init' );