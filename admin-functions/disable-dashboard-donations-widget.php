<?php
/**
 * Disable the GiveWP Dashboard Widget.
 */
function give_disable_dashboard_widget() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['give_dashboard_sales']);
}
add_action('wp_dashboard_setup', 'give_disable_dashboard_widget', 999);