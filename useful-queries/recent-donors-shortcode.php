<?php
/**
 *  Shortcode to list recent donors
 */
function give_basic_recent_donors_function() {

	// Get the latest 100 Give Donors
	$args = array(
		'number' => 100,
	);

	$donors = Give()->donors->get_donors( $args );

	$output = '';

	foreach ( $donors as $donor ) {

		// Create Donor Object.
		$donor = new Give_Donor( $donor->id );

		// Get First Name.
		$first_name = $donor->get_first_name();

		// Get Last Name Initial Letter.
		$last_name_initial = substr( $donor->get_last_name(), 0, 1 );

		// Prepare Output.
		$output .= "{$first_name}";
		$output .= $last_name_initial ? " {$last_name_initial}, " : ', ';

	}

	$output .= __( ' and many more.', 'give' );

	return $output;

}

add_shortcode( 'donor_list', 'give_basic_recent_donors_function' );
