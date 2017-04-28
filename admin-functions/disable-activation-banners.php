<?php
/**
 * Remove plugin activation banners pragmatically
 *
 * This will remove the Give Core welcome and Add-on activation banners which display on the plugin list page. If you are using WP Multisite place this functionality in a plugin that's activated network wide to have it take effect on all sites in the network.
 *
 */
function remove_give_activation_stuff() {

	if ( class_exists( 'Give_Welcome' ) && function_exists('give_update_option') ) {

		give_update_option( 'disable_welcome', 'on' );

	}

	//Remove Strip Add-on activation banner
	remove_action( 'admin_init', 'give_stripe_activation_banner' );

	//Add other remove_actions here...

}

add_action( 'plugins_loaded', 'remove_give_activation_stuff', 999 );