<?php
/**
 * Restrict the list of available states in the US states dropdown. 
 * This snippet allows organizations to only allow donations from specific states.
 *
 * @param array $states
 *
 * @return array $states
 */

function my_give_custom_us_states_list( $states ) {
	$states = array(
        'PA' => 'Pennsylvania',
        'NY' => 'New York',
    );

	return $states;
}

add_filter( 'give_us_states', 'my_give_custom_us_states_list');