<?php

/**
 *  Add Terms Agreement text and consent to Donation Meta
 *  NOTE: This is then used in the Give CSV Export to show consent.
 *
 */

/**
 * Output Terms in hidden textarea for saving
 *
 * @param $form_id
 */
function custom_givewp_output_terms_for_saving($form_id) {

    $formmeta = get_post_meta($form_id);
    $terms_enabled = $formmeta['_give_terms_option'][0];
    $global = give_get_settings();

    switch($terms_enabled) {
        case 'enabled': $terms = $formmeta['_give_agree_text'][0]; break;
        case 'global': $terms = $global['agreement_text']; break;
        default: return;
    }

    if ( $terms_enabled!=='disabled' ) {
        ?>
        <textarea class="give-textarea" name="give_form_terms" id="give_form_terms" aria-hidden="true"
                  style="display:none;opacity: 0; height: 0; border: 0 !important;" readonly disabled><?php echo $terms; ?></textarea>
        <?php
    }

}

add_action('give_after_donation_levels', 'custom_givewp_output_terms_for_saving');


/**
 * Save Terms and Terms Agreement in to donation meta
 *
 * @param $form_id
 */

function custom_give_save_terms_agreement_to_donation_paymentmeta( $payment_id ) {
    global $post;

    if ( isset($_POST['give_agree_to_terms']) ) {
        $agreed = wp_strip_all_tags( $_POST['give_agree_to_terms'], true );
        $terms = wp_strip_all_tags( $_POST['give_form_terms'], true );
        $pretty_terms = ( $terms == 1 ) ? __('Yes', 'give') : __('No','give');

        give_update_payment_meta( $payment_id, 'give_form_terms', $pretty_terms );
        give_update_payment_meta( $payment_id, 'give_agree_to_terms', $agreed );

    }
}

add_action('give_insert_payment', 'custom_give_save_terms_agreement_to_donation_paymentmeta');

