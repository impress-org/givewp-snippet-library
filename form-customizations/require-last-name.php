<?php

/**
 *  Require Last Name Snippet
 *  Adds aesterisk and erro validation to
 *  the last name field of all Give Forms
 *
 */
 
add_filter('give_purchase_form_required_fields', 'give_require_last_name');

function give_require_last_name($form_id) {
    $required_fields = array(
        'give_email' => array(
            'error_id'      => 'invalid_email',
            'error_message' => __( 'Please enter a valid email address', 'give' )
        ),
        'give_first' => array(
            'error_id'      => 'invalid_first_name',
            'error_message' => __( 'Please enter your first name', 'give' )
        ),
        'give_last' => array(
            'error_id'      => 'invalid_last_name',
            'error_message' => __( 'Please enter your last name', 'give' )
        ),

    );
    return $required_fields;
}