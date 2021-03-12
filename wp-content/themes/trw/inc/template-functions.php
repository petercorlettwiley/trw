<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package trw
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function trw_body_classes( $classes ) {
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
add_filter( 'body_class', 'trw_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function trw_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'trw_pingback_header' );

/**
 * Allow SVG uploads via media uploader
 */
function trw_upload_files( $allowed ) {
  $allowed['svg'] = 'image/svg+xml';
  return $allowed;
}
add_filter( 'upload_mimes', 'trw_upload_files');

/**
 * Link video.js plugin
 */
function trw_video_plugin() {
  echo '<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>';
}
add_action( 'wp_footer', 'trw_video_plugin' );
