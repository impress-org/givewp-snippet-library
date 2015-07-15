<?php
/**
 * PayPal Add Address Fields
 *
 * @description Adds standard Give address fields to PayPal
 *
 * @access private
 * @since  1.0
 */
add_action( 'give_paypal_cc_form', 'give_default_cc_address_fields');

/**
 * Add Address Fields to test gateway
 *
 * @description Adds standard Give address fields to Test Gateway
 *
 * @access private
 * @since  1.0
 */
add_action( 'give_manual_cc_form', 'give_default_cc_address_fields');
