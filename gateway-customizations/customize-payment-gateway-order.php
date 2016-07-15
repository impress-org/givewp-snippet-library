<?php
/**
 * Custom Give Gateway Order
 *
 * @description: Reorders the gateways based on a given Uses a helper function to reorder the gateway. Please customize the function name to limit conflicts
 *
 * @param $gateways
 *
 * @return mixed
 */
function my_custom_give_gateway_order( $gateways ) {

	//Check for our helper function first
	if ( function_exists( 'give_9812491_my_array_reorder_keys' ) ) {
		give_9812491_my_array_reorder_keys( $gateways, 'manual,authorize,stripe,offline' ); //This is where you place the gateways in the order you need based on the name of the gateway
	}

	return $gateways;

}


add_filter( 'give_enabled_payment_gateways', 'my_custom_give_gateway_order', 10, 1 );

/**
 * Give function to reorder array keys
 *
 * @description: Helper function for `my_custom_give_gateway_order` - if you customize the name of this function be sure to update the name in `my_custom_give_gateway_order` which you should also customize the name of to limit conflicts
 *
 * @see        : http://php.net/manual/en/function.ksort.php
 * reorder the keys of an array in order of specified keynames; all other nodes not in $keynames will come after last $keyname, in normal array order
 *
 * @param array &$array   - the array to reorder
 * @param mixed $keynames - a csv or array of keynames, in the order that keys should be reordered
 */
function give_9812491_my_array_reorder_keys( &$array, $keynames ) {
	if ( empty( $array ) || ! is_array( $array ) || empty( $keynames ) ) {
		return;
	}
	if ( ! is_array( $keynames ) ) {
		$keynames = explode( ',', $keynames );
	}
	if ( ! empty( $keynames ) ) {
		$keynames = array_reverse( $keynames );
	}
	foreach ( $keynames as $n ) {
		if ( array_key_exists( $n, $array ) ) {
			$newarray = array( $n => $array[ $n ] ); //copy the node before unsetting
			unset( $array[ $n ] ); //remove the node
			$array = $newarray + array_filter( $array ); //combine copy with filtered array
		}
	}
}
