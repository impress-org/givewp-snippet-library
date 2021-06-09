<?php

/** Adds start_date option and {start_date} message placeholder to [give_totals] shortcode.
 *  Attribute should in format start_date="YYYYMMDD".
 * 
 *  For the case [give_totals total="nnnn" start_date="YYYYMMDD"] which ignores the start date,
 *    force form-by-form recalculation of earnings by setting ids attribute to list of all forms
 */ 

function ou_give_totals_atts( $out, $pairs, $atts, $shortcode ) {
	if ( $start_date = date_create_from_format( 'Ymd', trim( $atts['start_date'] ) ) ) {
		$out['start_date'] = date_format( $start_date, get_option( 'date_format' ) );

		if ( empty( $out['cats'] ) && empty( $out['tags'] ) && empty( $out['ids'] ) ) {
			$query = new Give_Forms_Query( array( 'post_status' => 'publish', ) );
			$forms = $query->get_forms();

			foreach ( $forms as $form ) $result[] = $form->ID;
			$out['ids'] = implode( ',', $result );
		}
	}

	return $out;
}

add_filter( 'shortcode_atts_give_totals', 'ou_give_totals_atts', 10, 4 );


/* Modify each form earnings total to earnings after start date if one is set */

function ou_give_totals_form_earning( $form_earning, $post, $atts ) {
	if ( ! empty( $atts['start_date'] ) ) {
		$stats = new Give_Payment_Stats();
		$form_earning = $stats->get_earnings( $post, $atts['start_date'], 'today' );
	}

	return $form_earning; 
}

add_filter( 'give_totals_form_earning', 'ou_give_totals_form_earning', 10, 3 );


/** Replace {start_date} placeholder in shortcode message */

function ou_give_totals_message( $message, $atts ) {
	$message = str_replace(
		'{start_date}',
		$atts['start_date'],
		$message
	);

	return $message;
}

add_filter( 'give_totals_shortcode_message', 'ou_give_totals_message', 10, 2 );