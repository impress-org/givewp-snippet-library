<?php

/**
 *  Change the role that donors are assigned when they register at donation
 *
 *  See here for WP User Roles: https://codex.wordpress.org/Roles_and_Capabilities
 *  See here for Give User Roles: https://givewp.com/documentation/core/give-user-roles/
 */
 
add_filter('give_insert_user_args', 'custom_give_user_role');

function custom_give_user_role( $user_data ) {
	$user_args['role'] = 'contributor';

	return $user_args;
}
