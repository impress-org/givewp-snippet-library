<?php

/*
* Changes the "Your Donation is almost Complete!" text at the top of an online donation "confirmation" page.
*
*/
add_filter( 'give_receipt_offline_payment_heading', 'my_give_offline_donations_receipt_header');

function my_give_offline_donations_receipt_header() {
	return "YOUR TEXT HERE";
}