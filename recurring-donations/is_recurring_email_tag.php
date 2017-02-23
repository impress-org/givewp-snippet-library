<?php
/**
  * Adds a Custom "is_recurring" Email Tag
  * @description: This function creates a custom Give email template tag
  *
  * @param $payment_id
  */

add_action( 'give_add_email_tags', 'yourprefix_recurring_email_tag' );

function yourprefix_recurring_email_tag( $payment_id ) {

    give_add_email_tag( 'is_recurring', 'Outputs a sentence saying whether this is a recurring donation or not', 'yourprefix_recurring_email_tag_data' );

}

/**
 * Output sentence if the donation is a recurring donation
 *
 * @description Example function that returns a custom message if the donation is a recurring donation.
 * @param $payment_id
 *
 * @return string|void
 */


function yourprefix_recurring_email_tag_data( $payment_id, $payment_meta ) {

    $payment_meta = give_get_payment_meta( $payment_id );
    global $give_receipt_args;

    //$payment = get_post( $payment_id );
    $db      = new Give_Subscriptions_DB();
    $args    = array(
        'parent_payment_id' => $payment_id
    );

    $subscriptions = $db->get_subscriptions( $args );

    // Sanity check: ensure this is a subscription donation.
    if ( empty( $subscriptions ) ) {
        return false;
    }

    $getperiod = $subscriptions[0]->period;

    switch ($getperiod) {
        case 'month':
            $period = "a monthly";
            break;
        case 'week':
            $period = "a weekly";
            break;
        case 'year':
            $period = "an annual";
            break;
        case 'day':
            $period = "a daily";
            break;
    }

    $output = '<strong>This is ' . $period . ' recurring donation.</strong>';

    return $output;
}