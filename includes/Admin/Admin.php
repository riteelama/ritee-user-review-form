<?php

/**
 * 
 * UserReviewForm Admin
 * 
 * @class Admin
 * @version 1.0.0
 * @package UserReviewForm/Admin
 */

 namespace UserReviewForm\Admin;

 if(!defined('ABSPATH')){
    exit;
}


/**
 * Admin Class
 */
class Admin {

    /**
     * Hook in tabs.
     */
    public function __construct(){

        $this -> init_hooks();
     }

     /**
      * Initialize hooks
      * 
      * @since 1.0.0
      * 
      * @return void
      */

      private function init_hooks() {
        add_action( 'admin_menu', array($this,'user_review_form_menu' ), 68);
      }

      /**
	 * Add  menu item.
	 */
	public function user_review_form_menu() {
		$template_page = add_menu_page(
			__( 'User Reviews', 'ritee-user-review-form' ),
			__( 'User Reviews', 'ritee-user-review-form' ),
			'manage_options',
			'user-review-form',
			array(
				$this,
				'ritee_user_review_form_list_page',
			), '', 56
		);

		add_action( 'load-' . $template_page, array( $this, 'template_page_init' ) );

	}


    /**
	 * Loads screen options into memory.
	 */

     public function template_page_init(){

     }

     public function ritee_user_review_form_list_page() {
		ob_start();
		echo '<h1>User Review Form Settings</h1>';
		echo ob_get_clean();
	}


	// public function template_page_init() {
	// 	// Table display code here.

	// 	// Day 2
	// 	global $ts_job_application_table_list;

	// 	$ts_job_application_table_list = new ListTable();
	// 	$ts_job_application_table_list->process_actions();

	// 	// Add screen option.
	// 	add_screen_option(
	// 		'per_page',
	// 		array(
	// 			'default' => 20,
	// 			'option'  => 'ts_job_applications_per_page',
	// 		)
	// 	);
	// }

	/**
	 *  Init the Job Application Form List page.
	 */
	// public function ts_job_application_form_list_page() {
		// ob_start();
		// echo '<h1>Job Application Form Settings</h1>';
		// echo ob_get_clean();

		// Day 2
	// 	global $ts_job_application_table_list;
	// 	$ts_job_application_table_list->display_page();
	// }
}
