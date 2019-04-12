<?php
/**
 * Show or hide the donation upsell for certain products.
 *
 * This function first gathers the Product IDs of the customer's cart. Next it compares those IDs with the IDs of the
 * products that the admin wishes the donation upsell to display for.
 *
 * @param $is_enabled bool Is true by default.
 * @param $give_donation_location
 * @param $upsell_donation_forms
 *
 * @return bool
 */
function give_woo_show_donation_for_specific_products( $is_enabled, $give_donation_location, $upsell_donation_forms ) {

	// Get customer's cart by product ID.
	$cart_products_ids_array = array();
	foreach ( WC()->cart->get_cart() as $cart_item ) {
		$cart_products_ids_array[] = $cart_item['product_id'];
	}

	// Setting this to false for the conditions below.
	// NOTE: Depending on your use case this may not be needed.
	// $is_enabled = false;

	/**
	 * Uncomment an example below or create your own conditions.
	 */

	// Example 1: Only display upsell if a single product is contained within the cart. The customer can have other products, but this one needs to be in the cart for the upsell to display.
	//	if ( in_array( 692, $cart_products_ids_array ) ) {
	//		$is_enabled = true;
	//	}

	// Example 2: Only display upsell if ONLY the single product is in the cart.
	//	if( in_array( 692, $cart_products_ids_array ) && 2 === count($cart_products_ids_array) ) {
	//		$is_enabled = true;
	//	}

	// Always return $is_enabled as boolean.
	return $is_enabled;

}

add_action( 'give_wc_should_donation_upsell_display', 'give_woo_show_donation_for_specific_products', 10, 3 );