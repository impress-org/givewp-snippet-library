<?php
/**
 * Remove the Give version meta tag in the header of the website.
 *
 * The meta tag looks like this: "<meta name="generator" content="Give v1.8.9" />"
 *
 * Add this snippet and it will be removed.
 */
function remove_give_version_in_header() {
	remove_action( 'wp_head', 'give_version_in_header' );
}

add_action( 'wp_head', 'remove_give_version_in_header', 1 );