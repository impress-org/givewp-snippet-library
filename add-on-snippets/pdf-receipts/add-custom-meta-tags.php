<?php
/**
 * Add a custom meta tag to be supported in PDF Receipts
 *
 * @param mixed $template_content PDF Template Content.
 * @param array $args             List of essential arguments.
 *
 * @return mixed
 */
function give_add_custom_meta_support( $template_content, $args ) {

	$form_id     = isset( $args['form_id'] ) ? $args['form_id'] : '';
	$donation_id = isset( $args['donation_id'] ) ? $args['donation_id'] : '';

	$template_content = apply_filters( 'give_email_template_tags', $template_content, array(
		'form_id'    => $form_id,
		'payment_id' => $donation_id,
	) );

	return $template_content;
}
add_filter( 'give_pdf_compiled_template_content', 'give_add_custom_meta_support', 999, 2 );

