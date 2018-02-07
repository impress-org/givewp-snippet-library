<?php
/**
 * Donor Gratitude Email
 *
 * This class handles all email notification settings.
 */

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Give_Donor_Gratitude_Email' ) ) :

	/**
	 * Give_Donor_Gratitude_Email
	 *
	 * @abstract
	 * @since       2.0
	 */
	class Give_Donor_Gratitude_Email extends Give_Email_Notification {
		/* @var Give_Payment $payment */
		public $payment;

		/**
		 * Create a class instance.
		 *
		 * @access  public
		 * @since   2.0
		 */
		public function init() {
			// Initialize empty payment.
			$this->payment = new Give_Payment( 0 );

			$this->load( array(
				'id'                    => 'donor-gratitude',
				'label'                 => __( 'Donor Gratitude', 'give' ),
				'description'           => __( 'Donor Gratitude will be sent to admin when donor donation amount greater then certain amount.', 'give' ),
				'has_recipient_field'   => false,
				'notification_status'   => 'disabled',
				'default_email_subject' => __( '{name} you made my day!', 'give' ),
				'default_email_message' => $this->get_default_email_message(),
			) );

			add_action( 'give_new-donation_email_notification', array( $this, 'setup_email_notification' ) );
		}


		/**
		 * @param null $form_id
		 *
		 * @return array
		 */
		public function get_extra_setting_fields( $form_id = null ) {
			return array(
				array(
					'id'      => "{$this->config['id']}_threshold_amount",
					'name'    => esc_html__( 'Threshold Amount', 'give' ),
					'desc'    => esc_html__( 'Enter the threshold amount for email. This email will be sent only if donor donation amount greater or equal to this amount.', 'give' ),
					'default' => '',
					'type'    => 'text',
				),
			);
		}


		/**
		 * Get default email message.
		 *
		 * @since  2.0
		 * @access public
		 *
		 * @return string
		 */
		public function get_default_email_message() {
			$message = __( 'Dear {name},', 'give' ) . "\n\n";
			$message .= __( 'As I sat here this morning opening the mail, I came across your generous donation. I can’t tell you how much I appreciate your support.', 'give' ) . "\n";
			$message .= __( 'Your generous donation of {payment_total} will go a long way and beyond.', 'give' ) . "\n\n";
			$message .= __( '{name}, thank you once again for your donation. It means the world to us!.', 'give' ) . "\n\n";
			$message .= __( 'With gratitude,.', 'give' ) . "\n\n";
			$message .= __( '{sitename}.', 'give' ) . "\n\n";

			/**
			 * Filter the default message
			 */
			return apply_filters(
				"give_{$this->config['id']}_get_default_email_message",
				$message,
				$this
			);
		}


		/**
		 * Set email data.
		 */
		public function setup_email_data() {
			do_action( "give_{$this->config['id']}_setup_email_data", $this, $this->payment );
		}

		/**
		 * Setup email notification.
		 *
		 * @access public
		 *
		 * @param int $payment_id
		 */
		public function setup_email_notification( $payment_id ) {
			$this->payment = new Give_Payment( $payment_id );

			/**
			 * Filter the threshold amount.
			 */
			$threshold_donation_amount = apply_filters(
				"give_{$this->config['id']}_threshold_amount",
				Give_Email_Notification_Util::get_value( $this, "{$this->config['id']}_threshold_amount", $this->payment->form_id, '' ),
				$this->payment,
				$this
			);

			if ( ! empty( $threshold_donation_amount ) && $threshold_donation_amount <= $this->payment->total ) {
				// Set email data.
				$this->setup_email_data();

				// Send email.
				$this->send_email_notification( array(
					'payment_id' => $payment_id,
				) );
			}
		}


		/**
		 * Register email notification.
		 *
		 * @param array $emails
		 *
		 * @return array
		 */
		public function register( $emails ) {
			$emails[] = self::get_instance();

			return $emails;
		}
	}

endif; // End class_exists check

add_filter( 'give_email_notifications', array( Give_Donor_Gratitude_Email::get_instance(), 'register' ) );