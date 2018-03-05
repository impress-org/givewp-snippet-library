<?php

/**
 * Make the Give Donation form a multipart/form-data form
 *
 */

function give_add_multipart_tag_donation_form( $final_output, $args ) {
    $form_tag = "<form id=\"give-form-{$args['form_id']}\"";
	$final_output = str_replace( $form_tag, "{$form_tag} enctype=\"multipart/form-data\"", $final_output );

	return $final_output;
}

add_filter( 'give_donate_form', 'give_add_multipart_tag_donation_form', 10, 2 );
