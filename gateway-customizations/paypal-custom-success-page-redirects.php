<?php
/**
 * Plugin Name: Give - Custom PayPal Success Redirects
 * Plugin URI:  https://givewp.com/
 * Description: Send donors to different success pages per donation form.
 * Version:     1.0
 * Author:      Devin Walker
 * Author URI:  https://wordimpress.com
 */

// No direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register 'Tributes' section on edit donation form page.
 *
 * @since  1.0.0
 * @access public
 *
 * @param array $settings section array.
 *
 * @return array $settings return the tributes sections array.
 */
function give_custom_pp_metabox_settings( $settings ) {

	$prefix = 'give_custom_pp_redirects_fields';

	$pp_custom_settings = array(
		"{$prefix}_options" => array(
			'id'     => "{$prefix}_options",
			'title'  => __( 'PayPal Options', 'give' ),
			'fields' => array(
				// PayPal Standard
				array(
					'name'    => __( 'PayPal Standard Success Page', 'give' ),
					'desc'    => sprintf( __( 'The page donors are sent to after completing their donations. The %s shortcode should be on this page.', 'give' ), '<code>[give_receipt]</code>' ),
					'id'      => "{$prefix}_standard_success_page",
					'type'    => 'select',
					'options' => give_cmb2_get_post_options( array(
						'post_type'   => 'page',
						'numberposts' => - 1,
					), true ),
				),
				// PayPal Pro Option
				array(
					'name'    => __( 'PayPal Pro Success Page', 'give' ),
					'desc'    => sprintf( __( 'The page donors are sent to after completing their donations. The %s shortcode should be on this page.', 'give' ), '<code>[give_receipt]</code>' ),
					'id'      => "{$prefix}_pro_success_page",
					'type'    => 'select',
					'options' => give_cmb2_get_post_options( array(
						'post_type'   => 'page',
						'numberposts' => - 1,
					), true ),
				),
			),
		),
	);

	return array_merge( $settings, $pp_custom_settings );
}

// Per-Form Meta box settings.
add_action( 'give_metabox_form_data_settings', 'give_custom_pp_metabox_settings', 10, 1 );


/**
 * Custom PayPal Standard Success Redirect.
 *
 * This uses the option created above.
 *
 * @param $paypal_args
 * @param $payment_data
 *
 * @return array $paypal_args
 */
function give_custom_pp_standard_redirect( $paypal_args, $payment_data ) {
	$form_id           = intval( $payment_data['post_data']['give-form-id'] );
	$form_success_page = give_get_meta( $form_id, 'give_custom_pp_redirects_fields_standard_success_page', true );

	// If this donation form has a custom PP Standard success page.
	if ( ! empty( $form_success_page ) ) {
		$paypal_args['return'] = get_permalink( $form_success_page );
	}

	return $paypal_args;

}

add_filter( 'give_paypal_redirect_args', 'give_custom_pp_standard_redirect', 10, 2 );


/**
 * Custom PayPal Pro gateway success redirect.
 *
 * @param $redirect
 * @param $gateway
 * @param $query_string
 *
 * @return string $redirect URL where to redirect donors.
 */
function give_custom_pp_pro_redirect( $redirect, $gateway, $query_string ) {

	$form_id           = isset( $_REQUEST['give-form-id'] ) ? $_REQUEST['give-form-id'] : '';
	$form_success_page = give_get_meta( $form_id, 'give_custom_pp_redirects_fields_pro_success_page', true );

	$pp_pro_gateways = array( 'paypalpro_payflow', 'paypalpro', 'paypalpro_rest' );

	// If this donation form has a custom PP Standard success page.
	if ( ! empty( $form_success_page ) && in_array( $gateway, $pp_pro_gateways ) ) {
		$redirect = get_permalink( $form_success_page );
	}

	return $redirect;

}

add_filter( 'give_success_page_redirect', 'give_custom_pp_pro_redirect', 10, 3 );
