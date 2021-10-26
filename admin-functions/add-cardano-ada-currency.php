<?php
/**
 * Adds a new Currency symbol and name to Give payment options
 * @since 1.0
 * NOTE: This adds the currency as an option in your currency settings and will output in your front-end forms. But it is up to your Payment Gateway to handle that currency correctly. This means that even though the form will show your currency, and you'll see the reports with this currency, your Payment processor may reflect something different.
 */

/*
 * Adds Cardano Ada currency to your Give settings
 * by Huth S0lo
 */

add_filter('give_currencies', 'add_cardanoada_currency');

function add_cardanoada_currency($currencies) {

    $currencies['ADA'] = __( 'Cardano Ada (&#x20B3;)', 'give' );

    return $currencies;
}

/*
 * Converts the currency code to the correct HTML character symbol
 * for the form output
 */

add_filter('give_currency_symbol', 'add_ada_symbol', 10,3);

function add_ada_symbol($currency = '') {

    switch ( $currency ) :
        case "ADA" :
            $symbol = '&#x20B3;';
            break;
    endswitch;

    return $currency;
}
