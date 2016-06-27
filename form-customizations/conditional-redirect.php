<<<<<<< HEAD
<?php 
/**
 * Redirect to Custom Page on Successful Donation
 *
 * @return string
 */
function my_custom_give_redirects( $success_page ) {

    $form_id = isset( $_POST['give-form-id'] ) ? $_POST['give-form-id'] : 0;

    if ( $form_id == 7 ) {
        $success_page = esc_url( get_permalink( 20 ) );
    }

    return $success_page;

}

=======
<?php 
/**
 * Redirect to Custom Page on Successful Donation
 *
 * @return string
 */
function my_custom_give_redirects( $success_page ) {

    $form_id = isset( $_POST['give-form-id'] ) ? $_POST['give-form-id'] : 0;

    if ( $form_id == 7 ) {
        $success_page = esc_url( get_permalink( 20 ) );
    }

    return $success_page;

}

>>>>>>> 237a24920d7846afa13f147f67344a2efae88921
add_filter( 'give_get_success_page_uri', 'my_custom_give_redirects', 10, 1 );