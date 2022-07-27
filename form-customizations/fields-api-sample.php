<?php 

/* 
 *  Sample Snippets for the new GiveWP Fields API introduced in version 2.10
 */

add_action( 'give_fields_payment_mode_before_gateways', function( $collection ) {

    // Append a required text field with the name myTextField
    $collection->append(
        give_field( 'text', 'myTextField' )
            ->label( 'My Text Field' )
            ->required() // Could instead be marked as readOnly() (optional)
            ->helpText( __( 'This is my custom text field.' ) )
    );
});


add_action( 'give_fields_payment_mode_before_gateways', function( $collection ) {

    // Show in the Donation Receipt (for the legacy template uses the donation confirmation).
    $collection->append(
        give_field( 'text', 'myTextField' )
            ->label( 'My Text Field' )
            ->showInReceipt()
    );
});


add_action( 'give_fields_payment_mode_before_gateways', function( $collection ) {

    // Store a field value as Donor Meta (instead of Donation Meta).
    $collection->append(
        give_field( 'text', 'myTextField' )
            ->label( 'My Text Field' )
            ->storeAsDonorMeta() // Otherwise store as Donation Meta (default)
            ->showInReceipt() // When stored as Donor meta it uses the Donor section of the receipt.
    );
});


add_action( 'give_fields_payment_mode_before_gateways', function( $collection ) {

    // Add support for an email tag.
    $collection->append(
        give_field( 'text', 'myTextField' )
            ->label( 'My Text Field' )
            ->emailtag( 'my-text-field' )
    );
});

add_action( 'give_fields_payment_mode_before_gateways', function( $collection ) {
    $collection->append(

        // Select field with options.
        give_field( 'select', 'mySelectField' )
            ->label( 'My Select Field' )
            ->options(
                [ 'aye', __( 'Aye' ) ],
                [ 'bee', __( 'Bee' ) ]
            )

    );
});
