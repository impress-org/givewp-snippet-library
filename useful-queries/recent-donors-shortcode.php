<?php
/**
 *  Shortcode to list recent donors
 *
 * Mint Give Core Version 2.0
 */
function give_basic_recent_donors_function() {

	// get total number of donor in the DB.
	$total_donors  = absint( Give()->donors->count() );
	$number        = 100;
	$less_then_100 = false;

	if ( $total_donors < 100 ) {
		$number        = $total_donors;
		$less_then_100 = true;
	}

	// Get the latest 100 Give Donors
	$args = array(
		'number' => $number,
	);

	$donors = Give()->donors->get_donors( $args );

	$output = array();

	foreach ( $donors as $donor ) {

		// Create Donor Object.
		$donor = new Give_Donor( $donor->id );

		// Get First Name.
		$first_name = $donor->get_first_name();

		// Get Last Name Initial Letter.
		$last_name = $donor->get_last_name();

		// Prepare Output.
		$output[] = "{$first_name} {$last_name}";

	}

	$output = implode( ', ', $output );


	if ( ! empty( $output ) && empty( $less_then_100 ) ) {
		$output .= __( ' and many more.', 'give' );
	}

	return $output;

}

add_shortcode( 'donor_list', 'give_basic_recent_donors_function' );