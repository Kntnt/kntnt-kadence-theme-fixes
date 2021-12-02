<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Fixes for Kadence Theme
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Fixes some shortcomings of the Kadence Theme
 * Version:           1.1.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

defined( 'ABSPATH' ) || die;

add_filter( 'gettext', function ( $translated, $original, $textdomain ) {
	if ( 'kadence' === $textdomain ) {
		if ( 'Search Results for: %s' === $original ) {
			$translated = __( 'Search results for “%s”', 'kntnt-fixes-kadence-theme' );
		}
	}
	return $translated;
}, 10, 3 );

add_action( 'kadence_archive_after_entry_header', function () {
	if ( ! is_front_page() && is_home() ) {
		$pid     = get_option( 'page_for_posts' );
		$content = get_the_content( null, false, $pid );
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content;
	}
} );