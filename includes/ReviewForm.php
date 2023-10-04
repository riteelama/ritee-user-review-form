<?php 

/**
 * User_Review_form
 * 
 * @package User_Review_Form
 * @since 1.0.0
 */

 namespace UserReviewForm;

//  use UserReviewForm\Admin\Admin;

if(!defined('ABSPATH')){
    exit;
}

if( ! class_exists('ReviewForm') ) : 
    /**
     * Main ReviewForm Class
     * 
     * @class ReviewForm
     */

     final class ReviewForm{

        /**Instance of this class.
         * 
         * @var object
         */

         protected static $instance = null;

         /**
          * Instance of Install Class.
          * 
          * @since 1.0.0
          */

          public $install = null;

          /**
           * Admin class instance
           * 
           * @var \Admin
           * @since 1.0.0
           */

           public $admin = null;

           /**
            * Return an instance of this class
            * 
            * @return object A single instance of this class.
            */

		/**
		 * Return an instance of this class
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
     /**
      * Constructor
      * 
      * @since 1.0.0
      */

      private function __construct(){
        require 'CoreFunctions.php';
        add_action('admin_notices','user_review_form_compatibility');

        //Action and Filters
        add_filter('plugin_action_links_' .plugin_basename(RITEE_USER_REVIEW_FORM_PLUGIN_FILE),array($this, 'plugin_action_links'));
        add_action('init',array($this,'includes'));

        register_activation_hook(__FILE__,array('Install','install'));
      }

      /**
       * Includes
       */

       public function includes(){
        // Files to include
        $this -> install = new Install();

        //Class admin
        if($this->is_admin()){
            //require file.
            $this->admin = new Admin();
        }
       }

        /**
		 * Check if is admin or not and load the correct class
		 *
		 * @return bool
		 * @since 1.0.0
		 */
		public function is_admin() {
			$check_ajax    = defined( 'DOING_AJAX' ) && DOING_AJAX;
			$check_context = isset( $_REQUEST['context'] ) && $_REQUEST['context'] == 'frontend';

			return is_admin() && ! ( $check_ajax && $check_context );
		}

        /**
         * Display action links in the Plugin list table
         * 
         * @param array $actions Add plugin action links
         * 
         * @return array
         */

         public function plugin_action_links($actions){
            $new_actions = array(
                'settings' => '<a href="' . admin_url( 'admin.php?page=ritee-user-review-form' ) . '" title="' . esc_attr( __( 'View User Review Form Settings', 'ritee-user-review-form' ) ) . '">' . __( 'Settings', 'ritee-user-review-form' ) . '</a>',
            );

            return array_merge($new_actions,$actions);
         }

         /**
          * Get the plugin url.
          *
          * @return string
          */
          public function plugin_url(){
            return untrailingslashit(plugins_url('/',__FILE__));
          }
     }
        endif;