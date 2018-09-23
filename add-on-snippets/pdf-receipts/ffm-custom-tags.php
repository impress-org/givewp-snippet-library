<?php
/**
 * Add a custom tag to be supported in PDF Receipts.
 * Note: We can use this filter from Give - PDF Receipts Version 2.3.1 onward
 * This tag adds the new {amount} tag.
 *
 * @param html  $template_content html content.
 * @param array $args {
 *
 * @type string $template_content Template content (Required).
 * @type WP_Post|string $give_pdf_payment Payment information related to the Donation (optional if $transaction_id set).
 * @type string $payment Payment method (optional).
 * @type string $payment_method Payment status (optional).
 * @type array $payment_status Payment meta (optional).
 * @type array $payment_meta Donor address information (Required).
 * @type string $buyer_info Donation date (optional).
 * @type string $transaction_id The gateway payment ID save to payment meta (optional).
 * @type string $receipt_link Receipt link (optional).
 * @type bool $is_div_layout true = div based layout | false = table based layout (optional).
 * @type bool $pdf_preview true = For preview PDF in browser |  false = For download PDF in browser (optional).
 * }
 *
 * @return string $template_content Template content.
 */
function give_pdf_compiled_template_content_callback( $template_content, $args ) {
	// Payment ID.
	$payment_id = isset( $args['transaction_id'] ) ? $args['transaction_id'] : isset( $args['payment']->ID ) ? $args['payment']->ID : 0;
	// Adding FFM custom_fields support.
	if ( empty( $payment_id ) || ! class_exists( 'Give_Form_Fields_Manager' ) ) {
		return $template_content;
	}

	// get form id from payment id.
	$form_id = give_get_payment_form_id( $payment_id );

	// Get input field data.
	$ffm       = new Give_FFM_Render_Form();
	$form_data = $ffm->get_input_fields( $form_id );

	// Loop through form fields and match.
	foreach ( $form_data as $key => $value ) {

		if ( ! empty( $value ) ) {

			foreach ( $value as $field ) {

				// ignore section break and HTML input type.
				$ignore_type = array( 'section', 'html', 'action_hook', 'file_upload' );
				if ( isset( $field['name'] ) && isset( $field['input_type'] ) && in_array( $field['input_type'], $ignore_type ) ) {
					continue;
				}

				$field_name = '{' . $field['name'] . '}';
				if ( false !== strpos( $template_content, $field_name ) ) {
					if ( isset( $field['columns'] ) && ! empty( $field['columns'][0] ) ) {
						$field_data = give_get_meta( $payment_id, $field['name'], false );
					} else {
						$field_data = give_get_meta( $payment_id, $field['name'], true );
					}

					// Only show fields with data.
					if ( empty( $field_data ) ) {
						continue;
					}

					if ( in_array( $field['input_type'], array( 'repeat', 'multiselect' ) ) ) {
						$field_value = implode( ',', explode( '| ', $field_data ) );
					} else {
						$field_value = $field_data;
					}
					$template_content = str_replace( $field_name, $field_value, $template_content );
				}
			}
		}
	}

	return $template_content;

}

add_filter( 'give_pdf_compiled_template_content', 'give_pdf_compiled_template_content_callback', 10, 2 );