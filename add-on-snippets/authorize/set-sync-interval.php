<?php

/**
 *  Change the interval by which we query the Authorize.net Subscriptions
 *  This is useful when the Authorize account has a lot of subscriptions
 *  This helps prevent timeouts on the site during the Sync process
 *  Ref: https://github.com/impress-org/give-recurring-donations/issues/797
**/

function give_customize_authnet_sync_timespan(){
	return '6 months ago';
}

add_filter('give_authorize_sync_timespan', 'give_customize_authnet_sync_timespan');
