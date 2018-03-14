<?php

/**
 *  Customize the list of Countries available
 *  NOTE: This list is used in Admin settings as well as front-end forms.
 *
 */
 
add_filter('give_countries', 'my_custom_give_countries');

function my_custom_give_countries() {

    $countries = array(
        ''   => '',
        'DE' => esc_html__( 'Germany', 'give' ),
        'AT' => esc_html__( 'Austria', 'give' ),
        'CH' => esc_html__( 'Switzerland', 'give' ),
    );
    
	return $countries;
}
