<?php
/**
 * Exclude the Donation Upsell if certain products are in the cart.
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
 
function give_woo_exclude_upsell_for_specific_products( $is_enabled, $give_donation_location, $upsell_donation_forms ) {
    
    // Get customer's cart by product ID.
	$cart_products_ids_array = array();
	foreach ( WC()->cart->get_cart() as $cart_item ) {
		$cart_products_ids_array[] = $cart_item['product_id'];
	}
    
    // Product IDs that should exclude the upsell
    $products = array(123, 456);
    
	if ( in_array( $products, $cart_products_ids_array ) ) {
			$is_enabled = false;
	}

	return $is_enabled;
}

add_action( 'give_wc_should_donation_upsell_display', 'give_woo_exclude_upsell_for_specific_products', 10, 3 );
