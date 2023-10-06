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

    //  public function ritee_user_review_form_list_page() {
	// 	ob_start();
	// 	echo '<h1>User Review Form Settings</h1>';
	// 	echo ob_get_clean();
	// }


	public function template_page_init() {
		// Table display code here.


		global $ritee_user_review_table_list;
		$ritee_user_review_table_list = new ListTable();
		$ritee_user_review_table_list->process_actions();

		// Add screen option.
		add_screen_option(
			'per_page',
			array(
				'default' => 20,
				'option'  => 'ritee_user_review_per_page',
			)
		);
	}

	/**
	 *  Init the Job Application Form List page.
	 */
	public function ritee_user_review_form_list_page() {
		ob_start();
		echo '<h1>User Review Form Settings</h1>';
		echo ob_get_clean();

		global $ritee_user_review_table_list;
		$ritee_user_review_table_list->display_page();
	}
}
