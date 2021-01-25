<?php

use GiveFunds\Models\Fund;
use GiveFunds\Repositories\Funds;
use GiveFunds\Repositories\Revenue;

/**
 * Add a {funds} tag for PDF Receipts
 *
 * This tag render total donation raised for selected fund in donation PDF receipt if Funds and Designations is enabled.
 * Make sure you add {funds} pdf tag to PDF content.
 *
 * @param string $template_content
 * @param array $args
 *
 * @return mixed
 */
function give_add_total_pdf_tag( $template_content, $args ) {
	// Exit
	// 1. if fund addon is not active
	// 2. if donation id is invalid
	if ( ! defined( 'GIVE_FUNDS_ADDON_VERSION' ) || empty( $args['donation_id'] ) ) {
		return $template_content;
	}

	/* @var Revenue $fundRevenueRepository */
	$fundRevenueRepository = give( Revenue::class );
	/* @var Funds $fundRepository */
	$fundRepository = give( Funds::class );

	$formAssociatedFunds = $fundRepository->getFormAssociatedFunds( give_get_payment_form_id( $args['donation_id'] ) );

	/* @var Fund $fund */
	$fund             = $formAssociatedFunds[0];
	$total            = $fundRevenueRepository->getFundRevenue( $fund->getId() );
	$template_content = str_replace( '{funds}', give_currency_filter( $total ), $template_content );

	return $template_content;
}

add_filter( 'give_pdf_compiled_template_content', 'give_add_total_pdf_tag', 999, 2 );
