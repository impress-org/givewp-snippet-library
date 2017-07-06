<?php
/**
 *  Shortcode to list recent donors
 */
function give_basic_recent_donors_function() {

	// Get the latest 100 Give Donors
	$args = array(
		'number' => 100,
	);

	$donors = Give()->customers->get_customers( $args );

	$output = '';

	foreach ( $donors as $donor ) {

		$output = $donor->name . ', ';
		// First and Last Name
		$name = $donor->name;

		// Split up the names
		$separate = explode( ' ', $name );

		// find the surname
		$last = array_pop( $separate );

		// Shorten up the name so it's Jason T.  instead of Jason Tucker
		$shortenedname = implode( ' ', $separate ) . ' ' . $last[0] . '.';

		// Display the Jason T. and include a , after it.
		$output .= $shortenedname . ', ';

	}
	$output .= ' and many more.';

	return $output;

}

add_shortcode( 'donor_list', 'recent_donors_function' );
