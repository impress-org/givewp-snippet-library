<?php
/**
 * Reorder fieldsets within the Give donation form.
 *
 * WARNING: This snippet can be problematic if running older versions of GiveWP and multiple payment gateways.
 * Whenever unhooking and rehooking always TEST THOROUGHLY and never code on a live site.
 */

/**
 * Remove all Give Fieldsets.
 */
function give_remove_fieldsets() {
	remove_action( 'give_donation_form_top', 'give_output_donation_amount_top' );
	remove_action( 'give_payment_mode_select', 'give_payment_mode_select' );
	remove_action( 'give_donation_form_after_user_info', 'give_user_info_fields' );
	remove_action( 'give_cc_form', 'give_get_cc_form' );
	remove_all_actions( 'give_donation_form_after_cc_form' );
}

add_action( 'give_init', 'give_remove_fieldsets' );

/**
 * Add all Give Fieldsets in another order.
 */
function give_reorder_fieldsets() {
	add_action( 'give_donation_form_top', 'give_output_donation_amount_top' );
	add_action( 'give_donation_form_top', 'give_user_info_fields' );
	add_action( 'give_donation_form_top', 'give_payment_mode_select', 10, 2 );
	add_action( 'give_donation_form_bottom', 'give_checkout_submit', 9999, 2 );
}

add_action( 'give_init', 'give_reorder_fieldsets' );
