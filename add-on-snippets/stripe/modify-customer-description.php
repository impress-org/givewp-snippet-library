<?php
/**
 * This function will help you modify customer description.
 *
 * Note: This filter will work with Stripe 2.1.2 and later.
 *
 * @since 1.0.0
 *
 * @param array $args List of Stripe customer arguments.
 *
 * @return array
 */
function my_prefix_modify_customer_description( $args ) {

	$posted_data = give_clean( $_POST );

	$args['description'] = "{$posted_data['give_first']} {$posted_data['give_last']}";

	return $args;

}

add_filter( 'give_stripe_customer_args', 'my_prefix_modify_customer_description', 10, 1 );