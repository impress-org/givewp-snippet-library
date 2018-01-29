<?php
/**
 * Plugin Name: Give License Helper
 * Plugin URI: 
 * Description: Install, activate, navigate to Donations > Settings > Advanced > Clear old license. Then deactivate and unistall this plugin.
 * Author: BenUNC
 * 
 *
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function my_give_delete_old_licenses() {
	
	foreach ( give_get_settings() as $option => $value ) {
		if ( stripos( strrev( $option ), strrev( '_license_key' ) ) === 0 ) {
			give_delete_option( $option );
		}
	}
	foreach ( wp_load_alloptions() as $option => $value ) {
		if ( strpos( $option, 'give_' ) === 0 && stripos( strrev( $option ), strrev( '_license_active' ) ) === 0 ) {
			delete_option( $option );
		}
	}
}

add_filter( 'give_get_sections_advanced', 'my_give_license_clear_section' );

function my_give_license_clear_section( $section ) {
	$section['license-fix'] = __( 'Clear old license', 'give' );

	return $section;
}

function my_give_license_add_advanced_settings( $settings ) {

	$current_section = give_get_current_setting_section();

	if ( 'license-fix' !== $current_section ) {
		return $settings;
	}
	my_give_delete_old_licenses();
	echo "<h2>All Set! Things should work now. Navigate To the Licenses tab above and re-enter your licenses</h2>";

	return $settings;

}

add_filter( 'give_get_settings_advanced', 'my_give_license_add_advanced_settings', 10, 1 );
