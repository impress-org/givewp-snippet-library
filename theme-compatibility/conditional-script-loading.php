<?php
/**
 * Dequeue Give's minified JS scripts.
 *
 * CHANGE THIS FUNCTIONS NAME TO BE UNIQUE!
 *
 * Hooked to the wp_print_scripts action, with a late priority (100), so that it is after the script was enqueued.
 *
 * If SCRIPT_DEBUG is set to true, scripts are enqueued individually.
 */


/**
 * Deregister and dequeue scripts.
 */
function give_mysite_deregister_script() {

	$deregister = false;

	// Deregister on the homepage.
	if ( is_home() || is_front_page() ) {
		$deregister = true;
	} elseif ( is_page( 12 ) ) {
		//Deregister for a specific page.
		$deregister = true;
	}

	// Check if the conditions are met to register.
	if ( $deregister ) {
		wp_deregister_script( 'give' );
		wp_dequeue_script( 'give' );
	}

}

add_action( 'wp_print_scripts', 'give_mysite_deregister_script', 100 );


/**
 * Dequeue just on certain Post Types
 */
function give_mysite_dequque_posttype_script() {

	// Change the conditional here to dequeue where you need.
	if ( is_singular( 'post_type' ) ) {
		wp_deregister_script( 'give' );
		wp_dequeue_script( 'give' );
	}
}

add_action( 'wp_print_scripts', 'give_mysite_dequque_posttype_script', 100 );

/**
 * Dequeue Stripe JS just on certain Page IDs
 */
function conditional_remove_give_stripe_js() {

	// Get all pages, and define page IDs to exclude
	$all_pages = is_page();
	$excluded_pages = array(2,3);

	if ( in_array( $all_pages, $excluded_pages ) ) {
		wp_deregister_script( 'give-stripe-js' );
	}

}

add_action('wp_print_scripts', 'conditional_remove_give_stripe_js', 101);
