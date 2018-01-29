<?php
/**
 *  Exclude some Give Forms from the Give Archive page
 */
function my_custom_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_post_type_archive( 'give_forms' ) ) {
		$query->set( 'post__not_in', array( 1, 13, 266 ) );
	}
}

add_action( 'pre_get_posts', 'my_custom_get_posts', 1 );
