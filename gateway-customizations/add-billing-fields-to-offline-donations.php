<?php
/**
 * Offline Add Address Fields
 *
 * Add the Give address fieldset to Offline Donations.
 *
 * @access private
 * @since  1.0
 */


add_action( 'give_offline_cc_form', 'give_default_cc_address_fields' );