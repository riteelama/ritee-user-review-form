<?php
/**
 *  Shortcodes.
 *
 * @class    Shortcodes
 * @version  1.0.0
 * @package  UserReviewForm/Classes
 */

namespace  UserReviewForm;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcodes Class
 */
class Shortcodes {

	/**
	 * Init Shortcodes.
	 */
	public function __construct() {
        error_log(print_r("hello",true));
		$shortcodes = array(
			'user_review_form'        => __CLASS__ . '::user_review_form',
		);

		foreach ( $shortcodes as $shortcode => $function ) {
            $shortcode = apply_filters( "{$shortcode}_shortcode_tag", $shortcode );
			add_shortcode( $shortcode, $function );
		}
	}

	/**
	 * Application Form shortcode.
	 *
	 * @param mixed $atts Attributes.
	 */
	public static function user_review_form( $atts ) {
       
		ob_start();
		self::render_review_form();
		return ob_get_clean();
	}

	/**
	 * Output for Application Form.
	 *
	 * @since 1.0.0
	 */
	public static function render_review_form() {

		// Day 2
		/**
		 * Enqueue the frontend form style.
		 */
		wp_enqueue_style( "ritee-user-review-form-style", RITEE_USER_REVIEW_FORM_ASSETS_URL . '/css/ritee-user-review-form.css', array(), RITEE_USER_REVIEW_FORM_VERSION );

		
		/**
		 * Enqueue the frontend form script.
		 */
		wp_enqueue_script( "ritee-user-review-form-script", RITEE_USER_REVIEW_FORM_ASSETS_URL . '/js/ritee-user-review-form.js', array( 'jquery' ), RITEE_USER_REVIEW_FORM_VERSION );

		/**
		 * Localize parameters to be used in the script.
		 */
		// wp_localize_script(
		// 	"ts-job-application-form-script",
		// 	"ts_job_application_form_script_params",
		// 	array(
		// 		'ajax_url'                              => admin_url( 'admin-ajax.php' ),
		// 		'ts_job_application_form_submit_nonce' => wp_create_nonce( 'ts_job_application_form_submit_nonce' ),
		// 		'ts_job_application_form_submit_button_text' => esc_html__( 'Submit', 'ts-job-application-form'),
		// 		'ts_job_application_form_submitting_button_text' => esc_html__( 'Submitting ...', 'ts-job-application-form')
		// 		)
		// 	);

		if ( is_user_logged_in() ) {
            
			include RITEE_USER_REVIEW_FORM_TEMPLATE_PATH . '/ritee-user-review-form-page.php';
		}
	}

}
