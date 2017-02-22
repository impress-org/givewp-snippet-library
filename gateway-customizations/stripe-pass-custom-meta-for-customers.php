<?php
/**
 * Pass custom field data when to Stripe when customers are created.
 *
 * Retrieves custom form field data from the $_POST variable and merges them into
 * the metadata array that is passed to Stripe when a new customer is created.
 *
 * @param $metadata array An array of default meta data.
 *
 * @return array
 */
function my_give_custom_stripe_meta( $metadata ) {

	$custom_meta_fields = array(
		'custom_field_1' => isset( $_POST['custom_field_meta_key_1'] ) ? $_POST['custom_field_meta_key_1'] : '',
		'custom_field_2' => isset( $_POST['custom_field_meta_key_2'] ) ? $_POST['custom_field_meta_key_2'] : '',
		'custom_field_3' => isset( $_POST['custom_field_meta_key_3'] ) ? $_POST['custom_field_meta_key_3'] : '',
	);

	$metadata = array_merge( $metadata, $custom_meta_fields );

	return $metadata;

}


add_filter( 'give_stripe_customer_metadata', 'my_give_custom_stripe_meta', 10, 2 );
