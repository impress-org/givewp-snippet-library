<?php 
/**
 * Redirect to Custom Page on Successful Donation
 * 
 * In this example, form ID 7 will redirect after successful donation to page/post ID 20,
 * and form ID 230 will redirect after sucessful donation to https://example.com.
 * 
 * For help finding IDs, check out this tutorial:
 * http://www.wpbeginner.com/beginners-guide/how-to-find-post-category-tag-comments-or-user-id-in-wordpress/
 *
 * @return string
 * @author support@givewp.com
 */

function my_custom_give_redirects( $success_page ) {

    $form_id = isset( $_POST['give-form-id'] ) ? $_POST['give-form-id'] : 0;

    if ( $form_id == 7 ) {
        $success_page = esc_url( get_permalink( 20 ) );
    } elseif ( $form_id == 230 ) {
        $success_page = esc_url( 'https://example.com' );
    }

    return $success_page;

}

add_filter( 'give_get_success_page_uri', 'my_custom_give_redirects', 10, 1 );
