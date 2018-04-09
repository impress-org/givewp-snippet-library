<?php
/**
 * Customize Give's Email Headings
 *
 * Use this snippet to update the donation email's main headings; for instance "New Donation!", etc.
 *
 * @param string $heading Email Heading.
 *
 * @return string
 */
function my_custom_give_email_headings( $heading ) {

	switch ( $heading ) {

		case 'New Donation!':
			$heading = __( 'Boom! New Donation', 'give-snippet' );
			break;
		case 'Donation Receipt':
			$heading = __( 'Your Donation Receipt', 'give-snippet' );
			break;
		case 'Offline Donation Instructions':
            		$heading = __( 'Offline Contribution Instructions', 'give-snippet' );
            		break;
	}

	return $heading;

}
add_filter( 'give_email_heading', 'my_custom_give_email_headings', 10, 1 );
