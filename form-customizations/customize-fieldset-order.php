<?php
/**
 * Reorder fieldsets within the Give donation form
 *
 */

/* Remove all Give Fieldsets */
function give_remove_fieldsets() {
    remove_action( 'give_donation_form_top', 'give_output_donation_amount_top' );
    remove_action( 'give_payment_mode_select', 'give_payment_mode_select' );
    remove_action( 'give_donation_form_after_user_info', 'give_user_info_fields' );
    remove_action( 'give_cc_form', 'give_get_cc_form' );
    remove_all_actions( 'give_donation_form_after_cc_form' );
}

add_action( 'init', 'give_remove_fieldsets' );

/* Add all Give Fieldsets */
function give_reorder_fieldsets() {
    add_action( 'give_donation_form_top', 'give_user_info_fields' );
    add_action( 'give_donation_form_top', 'give_output_donation_amount_top' );
    add_action( 'give_donation_form_top', 'give_payment_mode_select' );
    add_action( 'give_donation_form_top', 'give_checkout_submit' );
}

add_action( 'init', 'give_reorder_fieldsets' );
