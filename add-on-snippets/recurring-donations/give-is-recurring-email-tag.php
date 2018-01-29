<?php
/**
 * Plugin Name: Give - Recurring Helper
 * Plugin URI: https://givewp.com/documentation/developers/how-to-create-custom-form-fields/
 * Description: This plugin demonstrates adds custom fields to your Give give forms with validation, email functionality, and field data output on the payment record within wp-admin.
 * Version: 1.0
 * Author: WordImpress
 * Author URI: https://givewp.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// We want to check some things upon activation so we'll use this action to run everything first.
add_action( 'plugins_loaded', 'giret_includes' );

function giret_includes() {
	// Only load if the Give Plugin is active
	if ( ! class_exists( 'Give' ) ) {
		return false;
	}
}
/**
 * Custom Form Fields
 *
 * @param $form_id
 */

add_action( 'give_after_donation_levels', 'giret_give_custom_form_fields', 10, 1 );

function giret_give_custom_form_fields( $form_id ) {
	$getformmeta = get_post_meta( $form_id );
	$recurringsupport = get_post_meta( $form_id , '_give_recurring', true );
	$ismulti = get_post_meta( $form_id, '_give_price_option', true );

	if ( !empty($recurringsupport) ) :

		if ( $recurringsupport == 'yes_donor' || $recurringsupport == 'yes_admin' ) :

			$isrecurring = ( $recurringsupport != 'yes_donor' || $recurringsupport != 'yes_admin' ? 'No' : 'Yes');

			if ( $recurringsupport == 'yes_donor' ) {
				?>
				<script type="text/javascript">
                    jQuery(document).ready(function( $ ) {
                        if ( $('.give-recurring-donors-choice input').is(":checked") ){
                            $('#giret_give_is_recurring').val( 'Yes' );
                        } else {
                            $('#giret_give_is_recurring').val( 'No' );
                        }

                        $('.give-recurring-donors-choice input').change(function(){
                            $('#giret_give_is_recurring').val( $(this).is(':checked') ? 'Yes' : 'No' );
                        })
                    });
				</script>

			<?php } if ( $recurringsupport == 'yes_admin' && $ismulti == 'multi') { ?>
			<script type="text/javascript">
                jQuery(document).ready(function( $ ) {

                    $('ul.give-donation-levels-wrap li button').click(function(){
                        $('#giret_give_is_recurring').val( $(this).is('.give-recurring-level') ? 'Yes' : 'No' );
                    })
                });
			</script>
		<?php } ?>
			<input type="hidden" name="giret_give_is_recurring" id="giret_give_is_recurring" value="<?php echo esc_attr( $isrecurring ); ?>"></input>
			<?php
		endif;
	endif;
}

/**
 * Add Field to Payment Meta
 *
 * Store the custom field data custom post meta attached to the `give_payment` CPT.
 *
 * @param $payment_id
 * @param $payment_data
 *
 * @return mixed
 */

add_action( 'give_insert_payment', 'giret_give_save_field', 10, 2 );

function giret_give_save_field( $payment_id, $payment_data ) {

	if ( isset( $_POST['giret_give_is_recurring'] ) ) {
		$message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['giret_give_is_recurring'] ) ) );
		add_post_meta( $payment_id, 'giret_give_is_recurring', $message );
	}

}

/**
 * Adds a Custom "give_is_recurring" Email Tag
 *
 * This function creates a custom Give email template tag.
 *
 * @param $payment_id
 */
function giret_give_email_tag( $payment_id ) {

	give_add_email_tag( 'give_is_recurring', 'This outputs whether this donation is a recurring donation or not with a simple "Yes" or "No".', 'giret_get_give_email_tag_data' );

}

add_action( 'give_add_email_tags', 'giret_give_email_tag' );

/**
 * Get Donation Referral Data
 *
 * Example function that returns Custom field data if present in payment_meta;
 * The example used here is in conjunction with the Give documentation tutorials.
 *
 * @param $payment_id
 * @param $payment_meta
 *
 * @return string
 */
function giret_get_give_email_tag_data( $payment_id, $payment_meta ) {

	$engraving_message = get_post_meta( $payment_id, 'giret_give_is_recurring', true );

	$output = __( 'No recurring data found.', 'give' );

	if ( ! empty( $engraving_message ) ) {
		$output = wpautop( $engraving_message );
	}

	return $output;
}
