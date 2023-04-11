<?php

/**
 *  Customize the payment description sent to Authorize.net
 *  The following snippets add the form title to the default description
**/

// Use this function to filter the Authorize.net payment description on recurring donations
add_filter(
	'give_authorize_recurring_payment_description',
	function($description, $purchase_data, $subscription){
		
		/**  Uncomment this block to get the $purchase_data array listed in Donations -> Tools -> Logs
		*	\Give\Framework\PaymentGateways\Log\PaymentGatewayLog::success('Contents of the variables',
		*		[
		*			'Purchase Data' => $purchase_data,
		*			'Subscription' => $subscription,
		*		]
		*	);
		**/

		$description .= ' - '. $purchase_data['post_data']['give-form-title'];

		return $description;
	},
	999,
	3
);

// Use this function to filter the Authorize.net payment description on one-time donations
add_filter(
	'give_authorize_one_time_payment_description',
	function($description, $purchase_data){
		
		/** Uncomment this block to get the $purchase_data array listed in Donations -> Tools -> Logs
		*	\Give\Framework\PaymentGateways\Log\PaymentGatewayLog::success('Contents of the variables',
		*		[
		*			'Purchase Data' => $purchase_data,
		*		]
		*	);
		**/

		$description .= ' - '. $purchase_data['post_data']['give-form-title'];

		return $description;
	},
	999,
	2
);