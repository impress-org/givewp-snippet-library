<?php

/*
 *  Give MailChimp Optin Status Email Tag
 *
 *  Adds an email tag called {give_mailchimp_status} to indicate whether the donor opted in or not.
 */
 
 function add_give_mailchimp_optin_email_tag() {
    give_add_email_tag(
        array(
            'tag'      => 'give_mailchimp_status', // The tag name.
            'desc'     => __( 'This outputs whether the donor opted-in to the Newsletter', 'give-mailchimp' ), // For admins.
            'func'     => 'give_mailchimp_optin_email_tag_function', // Callback to function below.
            'context'  => 'general', // This tag can be for both admin and donor notifications.
            'is_admin' => false, // default is false. This is here to simply display it as an option.
        )
    );
}

add_action( 'give_add_email_tags', 'add_give_mailchimp_optin_email_tag' );

/**
 * Return email tag content
 *
 * Example function that returns custom field data if present in payment_meta;
 * The example used here is in conjunction with the Give documentation tutorials.
 *
 * @param array $tag_args Array of arguments
 *
 * @return string
 */
function give_mailchimp_optin_email_tag_function( $tag_args ) {


    $opt_in_meta = give_get_meta( $tag_args['payment_id'], '_give_mc_donation_optin_status', true );

    $output            = __( 'Not opted-in :(', 'give-mailchimp' ); // Fallback message. (optional)

    if ( ! empty( $opt_in_meta ) ) {
        $output = 'Opted-in';
    }

    return $output;
}
