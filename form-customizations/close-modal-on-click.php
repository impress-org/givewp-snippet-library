<?php
/**
 * Adjusts the modal so that clicking on the background closes it.
 *
 * @param array $args
 *
 * @return array $args
 */
function my_give_modal_close_on_click( $args ) {
	$args['close_on_bg_click'] = true;

	return $args;
}

add_filter( 'give_magnific_options', 'my_give_modal_close_on_click' );