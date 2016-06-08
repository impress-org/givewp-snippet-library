<?php 
/**
 * 	 Implementing ReCaptcha on All Give Forms
 *	 DO NOT USE IN PRODUCTION AT ALL
 *	 This Snippet is not yet finalized.
 *
 **/

function give_validate_recaptcha( $valid_data, $data ) {

    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret_key = '6LeuJRwTAAAAAAs1_zFyvaAsOyJtvPKan_mFseMy';

    $recaptcha_response = file_get_contents($recaptcha_url . "?secret=" . $recaptcha_secret_key . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $recaptcha_data = json_decode($recaptcha_response);

    if(isset($recaptcha_data->success) AND $recaptcha_data->success == true) {
        return;
    } else {
        give_set_error( 'g-recaptcha-response', __( 'Please verify that you are not a robot.', 'give' ) );
    }
}

add_action( 'give_checkout_error_checks', 'give_validate_recaptcha', 10, 2 );

function wpdocs_theme_name_scripts() {
    
    wp_register_script( 'give-captcha-js', 'https://www.google.com/recaptcha/api.js');

    if (is_singular('give_forms')) {
	    wp_enqueue_script( 'give-captcha-js');
	}
}

add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

function print_my_inline_script() {
  	if ( is_singular('give_forms') ) {
		?>
			<script type="text/javascript">
				jQuery(document).on('give_gateway_loaded', function() {
				    grecaptcha.render('give-recaptcha-element', {
				        'sitekey' : '6LeuJRwTAAAAAMO3VKuGUgmpnCDLHrImmUXCYkWX'
				    });
				});
			</script>
		<?php
  	}
}

add_action( 'wp_footer', 'print_my_inline_script' );

function give_myprefix_custom_form_fields( $form_id ) {
	?>
		<div id="give-recaptcha-element" class="g-recaptcha" data-sitekey="6LeuJRwTAAAAAMO3VKuGUgmpnCDLHrImmUXCYkWX" style="margin-bottom:1em">
		</div>
	<?php
}

add_action( 'give_after_donation_levels', 'give_myprefix_custom_form_fields', 10, 1 );

/**
 *   Need to add logic for hwo to handle the "success" response
 *   from Google when the ReCaptcha returns successful
 *
 **/