<?php

/**
 *   Avatar API Swapper
 *   Loads avatars from avatarapi.com 
 *   for better actual avatars from public sources based on the donor email address
 *
 */
 
add_filter( 'get_avatar', 'avatar_api_swapper', 10, 5 );

function avatar_api_swapper($avatar, $id_or_email, $size, $default, $alt ) {

	$avatar = '<script src="https://www.avatarapi.com/js.aspx?email=' . $id_or_email . '&size=128"></script>';

	return $avatar;
}
