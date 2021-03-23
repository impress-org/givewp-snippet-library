<?php 

/* 
 *  Sample Snippet for the new GiveWP Fields API introduced in version 2.10
 */

add_action( 'give_fields_payment_mode_before_gateways', function( $collection ) {
    // Append a required text field with the name myTextField
    $collection->append(
        give_field( 'text', 'myTextField' )
            ->label( 'My Text Field' )
            ->required()
    );
});
