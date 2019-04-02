<?php

/**
 *   Give Donation Level Email Tag
 *   Outputs the name of the donation level chosen on a multi-level form
 *   Email tag = {give_donation_level}
 */
 
function add_give_mailchimp_optin_email_tag() {
    give_add_email_tag(
        array(
            'tag'      => 'give_donation_level', // The tag name.
            'desc'     => __( 'This outputs the level name of the donation amount for multi-level donations', 'give' ), // For admins.
            'func'     => 'give_level_name_email_tag_function', // Callback to function below.
            'context'  => 'donation', // This tag can be for both admin and donor notifications.
            'is_admin' => false, // default is false. This is here to simply display it as an option.
        )
    );
}

add_action( 'give_add_email_tags', 'add_give_mailchimp_optin_email_tag' );

/**
 * Callback function for the email tag output
 *
 * @return string
 */
function give_level_name_email_tag_function( $tag_args ) {

    $args = array(
        'only_level' => true,
        'separator'  => '',
    );

    $form_title = give_get_donation_form_title($tag_args['payment_id'], $args);

    $output = '';

    if ( ! empty( $form_title ) ) {
        $output = $form_title;
    }

    return $output;
}
