<?php
/**
 * Customize the Gateways Labels
 *
 * @description: This function uses the `give_payment_gateways` library and adjusts the label that appears for the donor on the frontend donation forms. This will affect ALL donation forms.
 *
 * @param $gateways
 *
 * @return mixed
 */
function my_custom_gateway_labels($gateways) {
	$gateways['offline'] = array(
		'admin_label'    => 'Offline Donations',
		'checkout_label' => __( 'Mail a Check', 'give' )
	);
	$gateways['paypal'] = array(
		'admin_label'    => 'PayPal Standard',
		'checkout_label' => __( 'Credit/Debit Card or PayPal', 'give' )
	);

    return $gateways;
}

add_filter('give_payment_gateways', 'my_custom_gateway_labels');
