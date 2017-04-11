<?php
/**
 * Plugin Name:    Give - Custom Payment Status
 * Plugin URI:     https://givewp.com/
 * Description:    Demonstrates how to add one or more custom donation payment post statuses to Give.
 * Author:         WordImpress
 * Author URL:     https://givewp.com/
 * Version:        1.0
 * Domain Path:    /languages
 *
 * Note: This code isn't fully tested yet nor supported. Use at your own risk.
 * Note 2: Don't forget to rename "my_give" to a custom prefix.
 */


/**
 * Register custom post status in WordPress using `register_post_status`.
 */
function my_give_register_post_statuses() {

	register_post_status( 'under_review', array(
		'label'                     => __( 'Under Review', 'give' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Under Review <span class="count">(%s)</span>', 'Under Review <span class="count">(%s)</span>', 'give' ),
	) );

	register_post_status( 'pending_approval', array(
		'label'                     => __( 'Pending Approval', 'give' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Pending Approval <span class="count">(%s)</span>', 'Pending Approval <span class="count">(%s)</span>', 'give' ),
	) );

}

add_action( 'wp_loaded', 'my_give_register_post_statuses' );


/**
 * Register Custom Statuses for Give to interpret.
 *
 * Tells Give about our new payment status.
 *
 * @since  1.0
 * @access public
 *
 * @param  $stati
 *
 * @return array
 */
function my_give_register_custom_statuses( $stati ) {
	$stati['under_review']     = __( 'Under Review', 'give' );
	$stati['pending_approval'] = __( 'Pending Approval', 'give' );

	return $stati;
}

add_filter( 'give_payment_statuses', 'my_give_register_custom_statuses' );


/**
 * Add filter options under to the Give donations table.
 *
 * @param $views
 *
 * @return mixed
 */
function my_give_add_custom_tableview( $views ) {

	$current                = isset( $_GET['status'] ) ? $_GET['status'] : '';
	$payment_count          = wp_count_posts( 'give_payment' );
	$empty                  = '&nbsp;<span class="count">(0)</span>';
	$under_review_count     = isset( $payment_count->under_review ) ? '&nbsp;<span class="count">(' . $payment_count->under_review . ')</span>' : $empty;
	$pending_approval_count = isset( $payment_count->pending_approval ) ? '&nbsp;<span class="count">(' . $payment_count->pending_approval . ')</span>' : $empty;

	$views['under_review'] = sprintf( '<a href="%s"%s>%s</a>', esc_url( add_query_arg( array(
		'status' => 'under_review',
		'paged'  => false,
	) ) ), $current === 'under_review' ? ' class="current"' : '', esc_html__( 'Under Review', 'give' ) . $under_review_count );

	$views['pending_approval'] = sprintf( '<a href="%s"%s>%s</a>', esc_url( add_query_arg( array(
		'status' => 'pending_approval',
		'paged'  => false,
	) ) ), $current === 'pending_approval' ? ' class="current"' : '', esc_html__( 'Pending Approval', 'give' ) . $pending_approval_count );

	return $views;
}

add_filter( 'give_payments_table_views', 'my_give_add_custom_tableview' );


/**
 * Adds bulk options to select dropdown.
 *
 * @param array $actions
 *
 * @return array $actions
 */
function my_give_add_custom_payment_bulk_actions( $actions ) {

	$actions['set-status-under-review']     = __( 'Set To Under Review', 'give' );
	$actions['set-status-pending-approval'] = __( 'Set To Pending Approval', 'give' );

	return $actions;
}

add_filter( 'give_payments_table_bulk_actions', 'my_give_add_custom_payment_bulk_actions', 10, 1 );


/**
 * Processes the bulk actions.
 *
 * @param $id
 * @param $current_action
 */
function my_give_process_custom_bulk_action( $id, $current_action ) {

	switch ( $current_action ) {
		case 'set-status-under-review':
			give_update_payment_status( $id, 'under_review' );
			break;
		case 'set-status-pending-approval':
			give_update_payment_status( $id, 'pending_approval' );
			break;
	}

}


add_filter( 'give_payments_table_do_bulk_action', 'my_give_process_custom_bulk_action', 10, 2 );