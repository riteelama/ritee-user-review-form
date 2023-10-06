<?php
/**
 * JobApplicationForm AJAX
 *
 * AJAX Event Handler
 *
 * @class    AJAX
 * @version  1.0.0
 * @package  UserReviewForm/Ajax
 * @category Class
 */

namespace  UserReviewForm;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AJAX Class
 */
class AJAX {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		self::add_ajax_events();
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax)
	 */
	public static function add_ajax_events() {

		add_action( 'wp_ajax_ritee_user_review_form_submit_form', array( __CLASS__, 'submit_form' ) );
		add_action('wp_ajax_nopriv_ritee_user_review_form_submit_form', array( __CLASS__, 'submit_form' ) );
	}

	/**
	 * Handle form submit.
	 */
	public static function submit_form() {
		global $wpdb;

		if ( ! check_ajax_referer( 'ritee_user_review_form_submit_nonce', 'security' ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Nonce error please reload.', 'ritee-user-review-form' ),
				)
			);
		}

		$error_message = array();
		$applicant_data = array();

		if ( isset( $_POST['first_name'] ) && '' !== $_POST['first_name'] ) {
			$applicant_data['first_name'] = sanitize_text_field( $_POST['first_name'] );
		} else {
			$error_message['first_name_error'] = esc_html__( 'First Name field is required', 'ritee-user-review-form' );
		}

        if ( isset( $_POST['last_name'] ) && '' !== $_POST['last_name'] ) {
			$applicant_data['last_name'] = sanitize_text_field( $_POST['last_name'] );
		}

		if ( isset( $_POST['user_email'] ) && '' !== $_POST['user_email'] ) {
			$applicant_data['email'] = sanitize_text_field( $_POST['user_email'] );
            $parts = explode("@",$applicant_data['email']);            
            $applicant_data['username'] = $parts[0];
		} else {
			$error_message['user_email_error'] = esc_html__( 'Email field is required', 'ritee-user-review-form' );
		}

        if ( isset( $_POST['user_password'] ) && '' !== $_POST['user_password'] ) {
			$applicant_data['password'] = sanitize_text_field( $_POST['user_password'] );
		} else {
			$error_message['user_password_error'] = esc_html__( 'Password field is required', 'ritee-user-review-form' );
		}

		if ( isset( $_POST['user_review'] ) && '' !== $_POST['user_review'] ) {
			$applicant_data['review'] = sanitize_text_field( $_POST['user_review'] );
		}

		if ( isset( $_POST['user_rating'] ) && '' !== $_POST['user_rating'] ) {
			$applicant_data['rating'] = sanitize_text_field( $_POST['user_rating'] );
		}

		if ( ! empty( $error_message ) ) {
			wp_send_json_error( array( 'field_error' => $error_message ) );
		}

		$query_success = $wpdb->insert( 'wp_user_review_form', $applicant_data );

		if ( $query_success ) {
			wp_send_json_success(
				array(
					'message' => esc_html__( 'Your Review Has Been Submitted Successfully', 'ritee-user-review-form' )
				)
			);
		} else {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Sorry, Your review cannot be submitted at this moment. Please try again some time later', 'ritee-user-review-form' )
				)
			);
		}
	}
}
