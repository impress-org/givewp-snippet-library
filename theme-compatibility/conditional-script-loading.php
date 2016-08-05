<?php
/**
 * Dequeue Give's minified JS script.
 *
 * CHANGE THIS FUNCTIONS NAME TO BE UNIQUE!
 *
 * Hooked to the wp_print_scripts action, with a late priority (100), so that it is after the script was enqueued.
 *
 * If SCRIPT_DEBUG is set to true, scripts are enqueued individually.
 */
function give_mysite_deregister_script() {

	$deregister = false;

	//Deregister on the homepage.
	if ( is_home() || is_front_page() ) {
		$deregister = true;
	} elseif(is_page(12)) {
		//Deregister for a specific page.
		$deregister = true;
	}

	//Check if the conditions are met to register.
	if ( $deregister ) {
		wp_deregister_script( 'give' );
	}

}

add_action( 'wp_print_scripts', 'give_mysite_deregister_script', 100 );