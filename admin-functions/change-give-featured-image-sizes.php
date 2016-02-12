<?php

/**
 *  Change the Give Single Form Featured Image sizes
 *  @NOTE: After implementing this, be sure to run a tool like
 *         Regenerate Thumbnails so the new image sizes can be created
 * 
 */
 
add_filter('give_get_image_size_give_form_single', 'new_give_thumbnail_size');

function new_give_thumbnail_size( $image_size ) {
	$size = get_option( $image_size . '_image_size', array() );

	$size = array(
		'width'  => '400',
		'height' => '400',
		'crop'   => 1
	);

	return $size;

}