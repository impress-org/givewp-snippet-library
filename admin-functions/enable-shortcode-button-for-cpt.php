<?php
/**
 * Add's Give's shortcode builder to a custom post type.
 *
 * @param array $args Array of pages allowing the shortcode builder.
 *
 * @return array
 */
function my_give_custom_cpt_admin_shortcode_button( $args ) {

	// My CPT edit screen for cpt "movies" - swap this out with your CPT name
	$args[] = 'edit.php?post_type=movies';

	return $args;

}

add_filter( 'give_shortcode_button_pages', 'my_give_custom_cpt_admin_shortcode_button' );