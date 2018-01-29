<?php

/**
 *  Change all instances of the word "Donation" throughout the plugin
 *
 **/
 
 /* GiveWP - change "Donation Total" */

function change_give_donation_total_label() {
    return __('Contribution Total', 'give');
}
add_filter( 'give_donation_total_label', 'change_give_donation_total_label' );

function my_givewp_text_strings( $translated_text, $untranslated_text, $domain ) {
        switch ( $untranslated_text ) {
        case 'Donor' :
                      	$translated_text = __( 'Contributor', 'give' );
                        break;
        case 'Donors' :
                       	$translated_text = __( 'Contributors', 'give' );
                        break;
        case 'Donation' :
                        $translated_text = __( 'Contribution', 'give' );
                        break;
        case 'Donations' :
                        $translated_text = __( 'Contributions', 'give' );
                        break;
        case 'Donation Total' :
                        $translated_text = __( 'Contribution Total', 'give' );
                        break;
        case 'Donation Name' :
                        $translated_text = __( 'Contribution Name', 'give' );
                        break;
        case 'Donation Total:' :
                        $translated_text = __( 'Contribution Total:', 'give' );
                        break;
        case 'Donation Status' :
                        $translated_text = __( 'Contribution Status', 'give' );
                        break;
        case 'Donation Information' :
                        $translated_text = __( 'Contribution Information', 'give' );
                        break;
        case 'Make this Donation' :
                        $translated_text = __( 'Make this Contribution', 'give' );
                        break;
        case 'Payment Complete: Thank you for your donation.' :
                        $translated_text = __( 'Payment Complete: Thank you for your contribution.', 'give' );
                        break;
        case 'Payment Preapproved: Thank you for your donation.' :
                        $translated_text = __( 'Payment Preapproved: Thank you for your contribution.', 'give' );
                        break;
        case 'Thank you for your donation and continued support. Your generosity is appreciated! Here are your donation details:' :
                        $translated_text = __( 'Thank you for your contribution and continued support. Your generosity is appreciated! Here are your contribution details:', 'give');
                        break;
        case 'Thank you for your donation. Your generosity is appreciated! Your card will be charged within seven days pending approval of the donation. You will receive an additional email receipt approved. Here are the details of your donation for your records:' :
                        $translated_text = __( 'Thank you for your donation. Your generosity is appreciated! Your card will be charged within seven days pending approval of the contribution. You will receive an additional email receipt approved. Here are the details of your contribution for your records:', 'give');
                        break;
        case 'It looks like you haven\'t made any donations.' :
                        $translated_text = __( 'It looks like you haven\'t made any contributions.', 'give' );
                        break;
        case 'Total Donation' :
                        $translated_text = __( 'Total Contribution', 'give' );
                        break;
        case 'Donation ID' :
                        $translated_text = __( 'Contribution ID', 'give' );
                        break;
        case 'Donation Receipt' :
                        $translated_text = __( 'Contribution Receipt', 'give' );
                        break;
        case 'Return to All Donations' :
                        $translated_text = __( 'Return to All Contributions', 'give' );
                        break;
        case 'You have not made any subscription donations.' : /* not working */
                        $translated_text = __( 'You have not made any subscription contributions.', 'give' );
                        break;
       case 'Make this donation' :
                        $translated_text = __( 'Make this contribution', 'give' );
                        break;
       case "I'd like to help cover the transaction fees of {fee_amount} for my donation." :
                        $translated_text = __( "I'd like to help cover the transaction fees of for my contribution.", 'give' );
                        break;
    }
    return $translated_text;
}

add_filter( 'gettext', 'my_givewp_text_strings', 10, 3 );
