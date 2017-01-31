<?php
/**
 * Pass custom field data when to Stripe when customers are created.
 *
 * Retrieves custom form field data from the $_POST variable and merges them into
 * the metadata array that is passed to Stripe when a new customer is created.
 *
 * Note that Form field manager adds a prefix to the meta key of ffm- so the meta key you see 
 * on the back end of Form Field Manager's interface will need to be prepended with ffm- to function.
 *
 * @param $metadata array An array of default meta data.
 *
 * @return array
 */
function my_give_custom_stripe_meta( $metadata ) {

	$custom_meta_fields = array(
		'ffm-custom_field_1' => isset( $_POST['ffm-custom_field_meta_key_1'] ) ? $_POST['ffm-custom_field_meta_key_1'] : '',
		'ffm-custom_field_2' => isset( $_POST['ffm-custom_field_meta_key_2'] ) ? $_POST['ffm-custom_field_meta_key_2'] : '',
		'ffm-custom_field_3' => isset( $_POST['ffm-custom_field_meta_key_3'] ) ? $_POST['ffm-custom_field_meta_key_3'] : '',
	);

	$metadata = array_merge( $metadata, $custom_meta_fields );

	return $metadata;

}


add_filter( 'give_stripe_customer_metadata', 'my_give_custom_stripe_meta', 10, 2 );
