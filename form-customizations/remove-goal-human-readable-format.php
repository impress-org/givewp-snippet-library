<?php

/**
 * Remove human readable format from goals.
 *
 * @param $human_format_amount
 * @param $amount
 * @param $sanitize_amount
 *
 * @return string
 */
function my_remove_give_human_readable_filter( $human_format_amount, $amount, $sanitize_amount ) {

	$amount = give_format_amount( $sanitize_amount, array(
		'sanitize' => false,
	) );

	return $amount;
}

add_filter( 'give_human_format_large_amount', 'my_remove_give_human_readable_filter', 10, 3 );
