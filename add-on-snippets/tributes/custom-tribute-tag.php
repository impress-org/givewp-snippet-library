<?php

/**
 * Custom Tribute Tag
 * For eCards and PDFs
 *
 */
 
add_filter('give_tribute_tags', 'prefix_custom_tribute_ecard_tag');

function prefix_custom_tribute_ecard_tag($tribute_tags = array()) {
	$new_tribute_tag = array(
		array(
			'tag'         => 'member_names',
			'description' => __( 'Names of members sponsoring this Mass.', 'give-tributes' ),
			'function'    => 'give_tribute_member_names_card',
		)
	);
	return array_merge( $tribute_tags, $new_tribute_tag );
}


function give_tribute_member_names_card( $payment_id ) {

	$payment      = new Give_Payment( $payment_id );
	$payment_meta = $payment->payment_meta;

	$member_names = $payment_meta['member_names'];

	$output = __( 'No referral data found.', 'give-tributes' );

	if ( ! empty( $member_names ) ) {
		$output = $member_names;
	}
	return $output;
}
