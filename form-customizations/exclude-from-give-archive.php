<?php
/**
 *  Exclude some Give Forms from the Give Archive page or the [give_form_grid] shortcode output. 
 *  Add form IDs in the array on line 15 (example shows '1,13,266')
 */

function my_custom_get_posts( $query ) {
	//prevent the forms from being hidden on the backend
	if ( is_admin() ) {
		return;
	}
	
	//limit the query to only Give forms.
	if ( $query->is_post_type_archive( 'give_forms' ) ) {
		$query->set( 'post__not_in', array( 1, 13, 266 ) );
	}
}

add_action( 'pre_get_posts', 'my_custom_get_posts', 1 );
