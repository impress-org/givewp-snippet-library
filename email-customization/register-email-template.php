<?php 

/**
 * Register Custom Email Template
 *
 * This adds the custom email template name to the list of available Email Templates
 * Give will look for the name of this template in the template folder. For example:
 * add 'body-custom.php', 'footer-custom.php', and 'header-custom.php' to your /give/email/ 
 * folder in your theme. Customize those files then add this snippet
 */
 
add_filter('give_email_templates', 'my_register_new_email_template');

function my_register_new_email_template( $templates ) {
	$new = array(
		'custom'    => esc_html__( 'Custom Template', 'give' ),
    'custom-2'  => esc_html__( 'Custom 2 Template', 'give' ),
    'custom-3'  => esc_html__( 'Custom 3 Template', 'give' ),
	);

	$merged = array_merge($templates, $new);

	return $merged;
}
