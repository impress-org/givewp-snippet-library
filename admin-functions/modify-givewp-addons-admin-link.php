<?php
/**
 * Update GiveWP's "Add-ons" link.
 *
 * This allows affiliates to change the link according to their needs.
 * Be sure you customize the function name to be specific to your brand.
 * The super late priority ensures it removes the current menu item and always appears last in the list.
 */
function my_custom_function_modify_givewp_addons_link() {

	$menu_slug = 'edit.php?post_type=give_forms';
	// Remove existing page
	remove_submenu_page( $menu_slug, 'give-addons' );

	// Add affiliate link to GiveWP.com
	global $submenu;
	$submenu[ $menu_slug ][] = array( 'Add-ons', 'install_plugins', 'https://givewp.com/ref/412' );

}

add_action( 'admin_menu', 'my_custom_function_modify_givewp_addons_link', 9999999 );
