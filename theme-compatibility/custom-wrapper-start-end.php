<?php
/**
 * Give uses a similar templating approach as WooCommerce and BuddyPress. If you notice the single post view of the Give donation forms going full width or being too small of a width it's likely an incompatibility with the wrapper tags. Use the functions below to customize it based on your theme's structuring.
 */


/**
 * Custom Give Single Template Wrapper Start
 */
function my_custom_give_start_wrapper() {
	echo '<div class="wrapper hentry" style="box-sizing: border-box;">';
}

add_filter( 'give_default_wrapper_start', 'my_custom_give_start_wrapper' );

/**
 * Custom Give Single Template Wrapper End
 */
function my_custom_give_end_wrapper() {
	echo '</div>';
}

add_filter( 'give_default_wrapper_end', 'my_custom_give_end_wrapper' );