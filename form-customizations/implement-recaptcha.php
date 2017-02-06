<?php
/**
 * Implementing Google's ReCaptcha on All Give Forms
 *
 * Get your Google ReCAPTCHA API Key here: https://www.google.com/recaptcha/
 *
 * Don't forget to update w/ your keys below
 */

/**
 * Validate ReCAPTCHA
 *
 * @param $valid_data
 * @param $data
 */
function give_validate_recaptcha( $valid_data, $data ) {

	$recaptcha_url        = 'https://www.google.com/recaptcha/api/siteverify';

	$recaptcha_secret_key = 'MY SECRET KEY HERE'; // <----- UPDATE WITH YOUR SECRET KEY

	$recaptcha_response = wp_remote_post( $recaptcha_url . "?secret=" . $recaptcha_secret_key . "&response=" . $data['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR'] );
	$recaptcha_data     = wp_remote_retrieve_body( $recaptcha_response );

	if ( ! isset( $recaptcha_data->success ) && ! $recaptcha_data->success == true ) {
		//User must have validated the reCAPTCHA to proceed with donation
		if ( ! isset( $data['g-recaptcha-response'] ) || empty( $data['g-recaptcha-response'] ) ) {
			give_set_error( 'g-recaptcha-response', __( 'Please verify that you are not a robot.', 'give' ) );
		}
	}
	return $valid_data;
}

add_action( 'give_checkout_error_checks', 'give_validate_recaptcha', 10, 2 );

/**
 * Enqueue ReCAPTCHA Scripts
 */
function wpdocs_theme_name_scripts() {

	wp_register_script( 'give-captcha-js', 'https://www.google.com/recaptcha/api.js' );

	//If you only want to enqueue on single form pages then uncomment if statement
//	if ( is_singular( 'give_forms' ) ) {
	wp_enqueue_script( 'give-captcha-js' );
//	}
}

add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

/**
 * Print Necessary Inline JS for ReCAPTCHA
 *
 * @description: This function outputs the appropriate inline js ReCAPTCHA scripts in the footer
 */
function print_my_inline_script() {

	//Uncomment if statement to control output
//	if ( is_singular( 'give_forms' ) ) {
	?>
	<script type="text/javascript">
		jQuery(document).on('give_gateway_loaded', function () {
			grecaptcha.render('give-recaptcha-element', {
				'sitekey': 'YOUR SITE KEY HERE!' //ADD YOU OWN Google API Sitekey here
			});
		});
	</script>
	<?php
//	}
}

add_action( 'wp_footer', 'print_my_inline_script' );

/**
 * Custom ReCAPTCHA Form Field
 *
 * @description: This function adds the reCAPTCHA field above the "Donation Total" field
 *
 * Don't forget to update the sitekey!
 *
 * @param $form_id
 */
function give_myprefix_custom_form_fields( $form_id ) {
	//Add you own google API Site key
	?>
	<div id="give-recaptcha-element" class="g-recaptcha" data-sitekey="YOUR SITE KEY HERE!" style="margin-bottom:1em"></div>
	<?php
}

add_action( 'give_donation_form_before_submit', 'give_myprefix_custom_form_fields', 10, 1 );
