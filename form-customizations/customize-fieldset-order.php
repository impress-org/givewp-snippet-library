<?php
//WARNING: THIS CODE IS UNTESTED - TEST THOROUGHLY PRIOR TO DEPLOYING ON PRODUCTION

/**
 * Remove all Give Fieldsets
 */
function give_remove_fieldsets() {

	remove_action( 'give_checkout_form_top', 'give_output_donation_amount_top' );
	remove_action( 'give_payment_mode_select', 'give_payment_mode_select' );
	remove_action( 'give_purchase_form_after_user_info', 'give_user_info_fields' );
	remove_action( 'give_cc_form', 'give_get_cc_form' );
	remove_all_actions( 'give_purchase_form_after_cc_form' );

}

add_action( 'init', 'give_remove_fieldsets' );

/**
 * Add back all Give Fieldsets
 *
 * @description: This function will hook into a Give action and re-add actions in the order they are added;
 */
function give_reorder_fieldsets() {

	//You can move the actions around here to switch the order of the fieldsets
	//Just make sure that they are all there to prevent complications ;)
	add_action( 'give_checkout_form_top', 'give_user_info_fields' );
	add_action( 'give_checkout_form_top', 'give_output_donation_amount_top' );
	add_action( 'give_checkout_form_top', 'give_payment_mode_select' );
	add_action( 'give_checkout_form_top', 'give_get_cc_form' );
	add_action( 'give_checkout_form_top', 'give_checkout_submit' );

}

add_action( 'init', 'give_reorder_fieldsets' );