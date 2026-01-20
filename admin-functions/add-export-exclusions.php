<?php

/**
 * Add sensitive settings to the export exclusion checkbox list.
 *
 * @param array $excludes Array of settings that can be excluded.
 * @return array Modified array with sensitive options added.
 */
function give_export_excludes( $excludes ) {

    // Stripe
    $excludes['stripe_live_secret_key']       = __( 'Stripe Live Secret Key', 'give' );
    $excludes['stripe_test_secret_key']       = __( 'Stripe Test Secret Key', 'give' );
    $excludes['stripe_live_publishable_key']  = __( 'Stripe Live Publishable Key', 'give' );
    $excludes['stripe_test_publishable_key']  = __( 'Stripe Test Publishable Key', 'give' );
    $excludes['stripe_license_key']           = __( 'Stripe License Key', 'give' );

    // PayPal Commerce
    $excludes['paypal_commerce_client_id']     = __( 'PayPal Commerce Client ID', 'give' );
    $excludes['paypal_commerce_client_secret'] = __( 'PayPal Commerce Client Secret', 'give' );
    $excludes['paypal_commerce_merchant_id']   = __( 'PayPal Commerce Merchant ID', 'give' );
    $excludes['paypal_commerce_access_token']  = __( 'PayPal Commerce Access Token', 'give' );
    $excludes['paypal_commerce_webhook']       = __( 'PayPal Commerce Webhook Config', 'give' );

    // PayPal Standard
    $excludes['paypal_email']                           = __( 'PayPal Standard Email', 'give' );
    $excludes['live_paypal_standard_api_username']      = __( 'PayPal Standard Live API Username', 'give' );
    $excludes['live_paypal_standard_api_password']      = __( 'PayPal Standard Live API Password', 'give' );
    $excludes['live_paypal_standard_api_signature']     = __( 'PayPal Standard Live API Signature', 'give' );
    $excludes['test_paypal_standard_api_username']      = __( 'PayPal Standard Test API Username', 'give' );
    $excludes['test_paypal_standard_api_password']      = __( 'PayPal Standard Test API Password', 'give' );
    $excludes['test_paypal_standard_api_signature']     = __( 'PayPal Standard Test API Signature', 'give' );

    // PayPal REST API
    $excludes['live_paypal_api_client_id']    = __( 'PayPal REST Live Client ID', 'give' );
    $excludes['live_paypal_api_secret']       = __( 'PayPal REST Live Secret', 'give' );
    $excludes['sandbox_paypal_api_client_id'] = __( 'PayPal REST Sandbox Client ID', 'give' );
    $excludes['sandbox_paypal_api_secret']    = __( 'PayPal REST Sandbox Secret', 'give' );

    // PayPal NVP API
    $excludes['live_paypal_api_username']  = __( 'PayPal NVP Live Username', 'give' );
    $excludes['live_paypal_api_password']  = __( 'PayPal NVP Live Password', 'give' );
    $excludes['live_paypal_api_signature'] = __( 'PayPal NVP Live Signature', 'give' );
    $excludes['test_paypal_api_username']  = __( 'PayPal NVP Test Username', 'give' );
    $excludes['test_paypal_api_password']  = __( 'PayPal NVP Test Password', 'give' );
    $excludes['test_paypal_api_signature'] = __( 'PayPal NVP Test Signature', 'give' );

    // PayPal Payflow
    $excludes['payflow_paypal_vendor']   = __( 'PayPal Payflow Vendor', 'give' );
    $excludes['payflow_paypal_user']     = __( 'PayPal Payflow User', 'give' );
    $excludes['payflow_paypal_password'] = __( 'PayPal Payflow Password', 'give' );

    // Braintree
    $excludes['braintree_merchantId']                = __( 'Braintree Merchant ID', 'give' );
    $excludes['braintree_merchantAccountId']         = __( 'Braintree Merchant Account ID', 'give' );
    $excludes['braintree_publicKey']                 = __( 'Braintree Public Key', 'give' );
    $excludes['braintree_privateKey']                = __( 'Braintree Private Key', 'give' );
    $excludes['sandbox_braintree_merchantId']        = __( 'Sandbox Braintree Merchant ID', 'give' );
    $excludes['sandbox_braintree_merchantAccountId'] = __( 'Sandbox Braintree Merchant Account ID', 'give' );
    $excludes['sandbox_braintree_publicKey']         = __( 'Sandbox Braintree Public Key', 'give' );
    $excludes['sandbox_braintree_privateKey']        = __( 'Sandbox Braintree Private Key', 'give' );

    // Authorize.Net
    $excludes['give_api_login']                         = __( 'Authorize.Net Live API Login', 'give' );
    $excludes['give_transaction_key']                   = __( 'Authorize.Net Live Transaction Key', 'give' );
    $excludes['give_authorize_sandbox_api_login']       = __( 'Authorize.Net Sandbox API Login', 'give' );
    $excludes['give_authorize_sandbox_transaction_key'] = __( 'Authorize.Net Sandbox Transaction Key', 'give' );
    $excludes['give_authorize_public_client_key']       = __( 'Authorize.Net Live Public Client Key', 'give' );
    $excludes['give_authorize_sandbox_public_client_key'] = __( 'Authorize.Net Sandbox Public Client Key', 'give' );

    // Mollie
    $excludes['_give_mollie_api_key'] = __( 'Mollie API Key', 'give' );

    // BitPay
    $excludes['bitpay_api_client_token']      = __( 'BitPay Live API Token', 'give' );
    $excludes['bitpay_test_api_client_token'] = __( 'BitPay Test API Token', 'give' );

    // GoCardless
    $excludes['give_gocardless_settings']  = __( 'GoCardless Settings', 'give' );
    $excludes['gocardless_webhook_secret'] = __( 'GoCardless Webhook Secret', 'give' );

    // Razorpay
    $excludes['razorpay_live_merchant_key_id']     = __( 'Razorpay Live Merchant Key ID', 'give' );
    $excludes['razorpay_live_merchant_secret_key'] = __( 'Razorpay Live Merchant Secret', 'give' );
    $excludes['razorpay_test_merchant_key_id']     = __( 'Razorpay Test Merchant Key ID', 'give' );
    $excludes['razorpay_test_merchant_secret_key'] = __( 'Razorpay Test Merchant Secret', 'give' );

    // Square
    $excludes['give_square_live_access_token']             = __( 'Square Live Access Token', 'give' );
    $excludes['give_square_sandbox_access_token']          = __( 'Square Sandbox Access Token', 'give' );
    $excludes['give_square_live_personal_access_token']    = __( 'Square Live Personal Access Token', 'give' );
    $excludes['give_square_sandbox_personal_access_token'] = __( 'Square Sandbox Personal Access Token', 'give' );

    // Plaid (ACH)
    $excludes['plaid_client_id']  = __( 'Plaid Client ID', 'give' );
    $excludes['plaid_secret_key'] = __( 'Plaid Secret Key', 'give' );

    // 2Checkout
    $excludes['twocheckout-merchantCode']      = __( '2Checkout Merchant Code', 'give' );
    $excludes['twocheckout-secretKey']         = __( '2Checkout Secret Key', 'give' );
    $excludes['twocheckout-buyLinkSecretWord'] = __( '2Checkout Buy Link Secret', 'give' );
    $excludes['twocheckout-public-key']        = __( '2Checkout Public Key', 'give' );
    $excludes['twocheckout-private-key']       = __( '2Checkout Private Key', 'give' );
    $excludes['twocheckout-api-username']      = __( '2Checkout API Username', 'give' );
    $excludes['twocheckout-api-password']      = __( '2Checkout API Password', 'give' );

    // PayUMoney
    $excludes['payumoney_live_merchant_key']    = __( 'PayUMoney Live Merchant Key', 'give' );
    $excludes['payumoney_live_salt_key']        = __( 'PayUMoney Live Salt Key', 'give' );
    $excludes['payumoney_sandbox_merchant_key'] = __( 'PayUMoney Sandbox Merchant Key', 'give' );
    $excludes['payumoney_sandbox_salt_key']     = __( 'PayUMoney Sandbox Salt Key', 'give' );

    // PayFast
    $excludes['give_payfast_live_merchant_id']            = __( 'PayFast Live Merchant ID', 'give' );
    $excludes['give_payfast_live_merchant_access_key']    = __( 'PayFast Live Access Key', 'give' );
    $excludes['give_payfast_live_passphrase']             = __( 'PayFast Live Passphrase', 'give' );
    $excludes['give_payfast_sandbox_merchant_id']         = __( 'PayFast Sandbox Merchant ID', 'give' );
    $excludes['give_payfast_sandbox_merchant_access_key'] = __( 'PayFast Sandbox Access Key', 'give' );
    $excludes['give_payfast_sandbox_passphrase']          = __( 'PayFast Sandbox Passphrase', 'give' );

    // Recaptcha
    $excludes['recaptcha_key']    = __( 'Recaptcha Key', 'give' );
    $excludes['recaptcha_secret'] = __( 'Recaptcha Secret Key', 'give' );

    // Cloudflare Turnstile
    $excludes['givewp_cloudflare_turnstile_site_key']   = __( 'Cloudflare Turnstile Site Key', 'give' );
    $excludes['givewp_cloudflare_turnstile_secret_key'] = __( 'Cloudflare Turnstile Secret Key', 'give' );

    // Mailchimp
    $excludes['give_mailchimp_api'] = __( 'Mailchimp API Key', 'give' );

    // ConvertKit
    $excludes['give_convertkit_api']        = __( 'ConvertKit API Key', 'give' );
    $excludes['give_convertkit_api_secret'] = __( 'ConvertKit API Secret', 'give' );

    // Constant Contact
    $excludes['givewp_constant_contact_access_token']  = __( 'Constant Contact Access Token', 'give' );
    $excludes['givewp_constant_contact_refresh_token'] = __( 'Constant Contact Refresh Token', 'give' );

    // Salesforce
    $excludes['give_salesforce_salesforce-refresh-token'] = __( 'Salesforce Refresh Token', 'give' );
    $excludes['give_salesforce_salesforce-access-token']  = __( 'Salesforce Access Token', 'give' );

    // Google Analytics
    $excludes['google_analytics_ga4_measurement_protocol_api_secret'] = __( 'Google Analytics API Secret', 'give' );

    // Zapier / Data Transfer
    $excludes['public_dtd_key']  = __( 'Zapier Public DTD Key', 'give' );
    $excludes['private_dtd_key'] = __( 'Zapier Private DTD Key', 'give' );

    // License Keys
    $excludes['give_licenses']                         = __( 'GiveWP Addon Licenses (All)', 'give' );
    $excludes['give_fee_recovery_license_key']         = __( 'Fee Recovery License Key', 'give' );
    $excludes['give_tributes_license_key']             = __( 'Tributes License Key', 'give' );
    $excludes['give_zapier_license_key']               = __( 'Zapier License Key', 'give' );
    $excludes['give_form_field_manager_license_key']   = __( 'Form Field Manager License Key', 'give' );
    $excludes['give_manual_donations_license_key']     = __( 'Manual Donations License Key', 'give' );
    $excludes['give_pdf_receipts_license_key']         = __( 'PDF Receipts License Key', 'give' );
    $excludes['give_recurring_donations_license_key']  = __( 'Recurring Donations License Key', 'give' );
    $excludes['give_authorizenet_gateway_license_key'] = __( 'Authorize.net Gateway License Key', 'give' );
    $excludes['give_stripe_gateway_license_key']       = __( 'Stripe Gateway License Key', 'give' );
    $excludes['give_gocardless_gateway_license_key']   = __( 'GoCardless Gateway License Key', 'give' );
    $excludes['give_mailchimp_license_key']            = __( 'Mailchimp License Key', 'give' );
    $excludes['give_currency_switcher_license_key']    = __( 'Currency Switcher License Key', 'give' );

    return $excludes;
}
add_filter( 'give_settings_export_excludes', 'give_export_excludes' );

/**
 * Remove sensitive credentials from GiveWP settings export based on user selection.
 *
 * @param array $settings The Give settings array being exported.
 * @return array Modified settings with sensitive data removed.
 */
function give_remove_credentials_from_export( $settings ) {

    // Only filter during export action
    if ( ! isset( $_POST['give-action'] ) || 'core_settings_export' !== $_POST['give-action'] ) {
        return $settings;
    }

    // Get user-selected exclusions (sanitized)
    $selected_excludes = isset( $_POST['settings_export_excludes'] )
        ? array_map( 'sanitize_text_field', (array) $_POST['settings_export_excludes'] )
        : array();

    // Stripe: Map checkbox keys to nested setting keys
    $stripe_key_mapping = array(
        'stripe_live_secret_key'      => 'live_secret_key',
        'stripe_test_secret_key'      => 'test_secret_key',
        'stripe_live_publishable_key' => 'live_publishable_key',
        'stripe_test_publishable_key' => 'test_publishable_key',
    );

    // Filter Stripe accounts array
    if ( isset( $settings['_give_stripe_get_all_accounts'] ) && is_array( $settings['_give_stripe_get_all_accounts'] ) ) {
        foreach ( $settings['_give_stripe_get_all_accounts'] as $account_id => $account_data ) {
            foreach ( $stripe_key_mapping as $checkbox_key => $setting_key ) {
                if ( isset( $selected_excludes[ $checkbox_key ] ) && give_is_setting_enabled( $selected_excludes[ $checkbox_key ] ) ) {
                    unset( $settings['_give_stripe_get_all_accounts'][ $account_id ][ $setting_key ] );
                }
            }
        }
    }

    // PayPal Commerce: Map checkbox keys to nested setting keys
    $paypal_key_mapping = array(
        'paypal_commerce_client_id'     => 'clientId',
        'paypal_commerce_client_secret' => 'clientSecret',
        'paypal_commerce_merchant_id'   => 'merchantId',
        'paypal_commerce_access_token'  => 'accessToken',
    );

    // Filter PayPal Commerce Live account
    if ( isset( $settings['give_paypal_commerce_live_account'] ) && is_array( $settings['give_paypal_commerce_live_account'] ) ) {
        foreach ( $paypal_key_mapping as $checkbox_key => $setting_key ) {
            if ( isset( $selected_excludes[ $checkbox_key ] ) && give_is_setting_enabled( $selected_excludes[ $checkbox_key ] ) ) {
                unset( $settings['give_paypal_commerce_live_account'][ $setting_key ] );
            }
        }
    }

    // Filter PayPal Commerce Sandbox account
    if ( isset( $settings['give_paypal_commerce_sandbox_account'] ) && is_array( $settings['give_paypal_commerce_sandbox_account'] ) ) {
        foreach ( $paypal_key_mapping as $checkbox_key => $setting_key ) {
            if ( isset( $selected_excludes[ $checkbox_key ] ) && give_is_setting_enabled( $selected_excludes[ $checkbox_key ] ) ) {
                unset( $settings['give_paypal_commerce_sandbox_account'][ $setting_key ] );
            }
        }
    }

    // PayPal Commerce webhooks
    if ( isset( $selected_excludes['paypal_commerce_webhook'] ) && give_is_setting_enabled( $selected_excludes['paypal_commerce_webhook'] ) ) {
        unset( $settings['give_paypal_commerce_live_webhook_config'] );
        unset( $settings['give_paypal_commerce_sandbox_webhook_config'] );
    }

    // Simple key removals (non-nested settings)
    $simple_keys = array(
        // Stripe
        'stripe_license_key',

        // PayPal Standard
        'paypal_email',
        'live_paypal_standard_api_username',
        'live_paypal_standard_api_password',
        'live_paypal_standard_api_signature',
        'test_paypal_standard_api_username',
        'test_paypal_standard_api_password',
        'test_paypal_standard_api_signature',

        // PayPal REST
        'live_paypal_api_client_id',
        'live_paypal_api_secret',
        'sandbox_paypal_api_client_id',
        'sandbox_paypal_api_secret',

        // PayPal NVP
        'live_paypal_api_username',
        'live_paypal_api_password',
        'live_paypal_api_signature',
        'test_paypal_api_username',
        'test_paypal_api_password',
        'test_paypal_api_signature',

        // PayPal Payflow
        'payflow_paypal_vendor',
        'payflow_paypal_user',
        'payflow_paypal_password',

        // Braintree
        'braintree_merchantId',
        'braintree_merchantAccountId',
        'braintree_publicKey',
        'braintree_privateKey',
        'sandbox_braintree_merchantId',
        'sandbox_braintree_merchantAccountId',
        'sandbox_braintree_publicKey',
        'sandbox_braintree_privateKey',

        // Authorize.Net
        'give_api_login',
        'give_transaction_key',
        'give_authorize_sandbox_api_login',
        'give_authorize_sandbox_transaction_key',
        'give_authorize_public_client_key',
        'give_authorize_sandbox_public_client_key',

        // Mollie
        '_give_mollie_api_key',

        // BitPay
        'bitpay_api_client_token',
        'bitpay_test_api_client_token',

        // GoCardless
        'give_gocardless_settings',
        'gocardless_webhook_secret',

        // Razorpay
        'razorpay_live_merchant_key_id',
        'razorpay_live_merchant_secret_key',
        'razorpay_test_merchant_key_id',
        'razorpay_test_merchant_secret_key',

        // Square
        'give_square_live_access_token',
        'give_square_sandbox_access_token',
        'give_square_live_personal_access_token',
        'give_square_sandbox_personal_access_token',

        // Plaid
        'plaid_client_id',
        'plaid_secret_key',

        // 2Checkout
        'twocheckout-merchantCode',
        'twocheckout-secretKey',
        'twocheckout-buyLinkSecretWord',
        'twocheckout-public-key',
        'twocheckout-private-key',
        'twocheckout-api-username',
        'twocheckout-api-password',

        // PayUMoney
        'payumoney_live_merchant_key',
        'payumoney_live_salt_key',
        'payumoney_sandbox_merchant_key',
        'payumoney_sandbox_salt_key',

        // PayFast
        'give_payfast_live_merchant_id',
        'give_payfast_live_merchant_access_key',
        'give_payfast_live_passphrase',
        'give_payfast_sandbox_merchant_id',
        'give_payfast_sandbox_merchant_access_key',
        'give_payfast_sandbox_passphrase',

        // Recaptcha
        'recaptcha_key',
        'recaptcha_secret',

        // Cloudflare Turnstile
        'givewp_cloudflare_turnstile_site_key',
        'givewp_cloudflare_turnstile_secret_key',

        // Mailchimp
        'give_mailchimp_api',

        // ConvertKit
        'give_convertkit_api',
        'give_convertkit_api_secret',

        // Constant Contact
        'givewp_constant_contact_access_token',
        'givewp_constant_contact_refresh_token',

        // Salesforce
        'give_salesforce_salesforce-refresh-token',
        'give_salesforce_salesforce-access-token',

        // Google Analytics
        'google_analytics_ga4_measurement_protocol_api_secret',

        // Zapier
        'public_dtd_key',
        'private_dtd_key',

        // License Keys
        'give_licenses',
        'give_fee_recovery_license_key',
        'give_tributes_license_key',
        'give_zapier_license_key',
        'give_form_field_manager_license_key',
        'give_manual_donations_license_key',
        'give_pdf_receipts_license_key',
        'give_recurring_donations_license_key',
        'give_authorizenet_gateway_license_key',
        'give_stripe_gateway_license_key',
        'give_gocardless_gateway_license_key',
        'give_mailchimp_license_key',
        'give_currency_switcher_license_key',
    );

    foreach ( $simple_keys as $key ) {
        if ( isset( $selected_excludes[ $key ] ) && give_is_setting_enabled( $selected_excludes[ $key ] ) ) {
            unset( $settings[ $key ] );
        }
    }

    return $settings;
}
add_filter( 'give_get_settings', 'give_remove_credentials_from_export' );