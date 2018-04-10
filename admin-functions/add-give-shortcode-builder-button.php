<?php

/**
 *  Adds the shortcode builder button to TinyMCE editor on the admin page(s) of your choice
 *
 *  As of Give 2.1
 *  ref: https://github.com/WordImpress/Give/issues/2980#issuecomment-379972047
 */
 
function give_add_button_on_cat_page( $pages ){
	$pages[] = 'term.php';

	return $pages;
}

add_filter( 'give_shortcode_button_pages', 'give_add_button_on_cat_page', 10 );
