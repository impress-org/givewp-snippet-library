<?php
/**
 *	THIS DOESN'T WORK!!!
 *	Change Admin notification email address per form
 *	NOTE: This doesn't yet work
 *
 */

add_filter('give_admin_notice_emails', 'per_form_email_notifications');

function per_form_email_notifications($payment_id) {

    $emails = isset( $give_options['admin_notice_emails'] ) && strlen( trim( $give_options['admin_notice_emails'] ) ) > 0 ? $give_options['admin_notice_emails'] : get_bloginfo( 'admin_email' );
    $emails = array_map( 'trim', explode( "\n", $emails ) );

    $form_id = give_get_payment_form_id( $payment_id );

    if( $form_id == '5183') {
        $emails = 'matt@givewp.com';
    }

    return $emails;
}