<?php

/**
 * Rearrange Country Dropdown Snippet.
 *
 * Changes the order of the countries in the billing address dropdown.
 * 
 * In the example, France has been plucked out of the list, and placed at the top of the list.
 * To simply rearrange the list alphabetically, comment out or remove lines 21-24
 *
 * @param $countries
 *
 * @return array
 */
 
function my_give_custom_country_list( $countries ) {
	//sorts the entire array alphabetically
	natcasesort( $countries );
	
	//pulls out France and places it at the beginning of the list
	$name = $countries['FR'];
	unset( $countries['FR'] );
	array_shift( $countries );
	$countries = array( '' => '', 'FR' => $name ) + $countries;

	return $countries;
}

add_filter( 'give_countries', 'my_give_custom_country_list');