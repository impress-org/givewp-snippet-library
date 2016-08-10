<?php
/**
 * Hide Give's Admin Shortcode Button.
 *
 * @return array
 */
function my_give_hide_admin_shortcode_button() {
	return array();
}

add_filter( 'give_shortcode_button_pages', 'my_give_hide_admin_shortcode_button' );