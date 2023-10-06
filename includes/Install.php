<?php 
/**
 * User_Review_Form Install
 * 
 * @package User_Review_Form/Install
 * @since 1.0.0
 */

 namespace UserReviewForm;

 if(!defined('ABSPATH')){
    exit;
}

if( ! class_exists ( 'Install' )) :

    /**
     * Install Class
     * 
     * @class Install
     */

     class Install {

        /**
         * Initial actions to run when install class is run.
         * 
         * @since 1.0.0
         */

         public static function init(){

            add_action('admin_init',array(__CLASS__,'install'));
         }

      /**
		 * Install actions when plugin is activated.
		 *
		 * This function is hooked into admin_init to affect admin only.
		 */
		public static function install() {

			if ( ! is_blog_installed() ) {
				return;
			}

			// Check if already installed.
			if ( get_option( 'ritee_user_review_form_installed', false ) ) {
				return;
			}

			// Check if already in the process of installing.
			if ( 'yes' === get_transient( 'ritee_user_review_form_installing' ) ) {
				return;
			}

			// If we made it till here nothing is running yet, lets set the transient now.
			set_transient( 'ritee_user_review_form_installing', 'yes', MINUTE_IN_SECONDS * 10 );

			! defined( 'RITEE_USER_REVIEW_FORM_INSTALLING' ) && define( 'RITEE_USER_REVIEW_FORM_INSTALLING', true );

			self::create_tables();

			delete_transient( 'ritee_user_review_form_installing' );
			update_option( 'ritee_user_review_form_installing', true );
		}

		/**
		 * Create table which the plugin will need to function;
		 */
		private static function create_tables() {
			global $wpdb;

			$wpdb->hide_errors();
			$table_name = $wpdb->prefix . 'user_review_form';

			// Check if the table already exists
			$table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name;

			if (!$table_exists) {
				$collate = '';

				if ($wpdb->has_cap('collation')) {
					$collate = $wpdb->get_charset_collate();
				}

				require_once ABSPATH . 'wp-admin/includes/upgrade.php';

				$table_name = $wpdb->prefix . 'user_review_form';
				$charset_collate = $collate;

				$sql = "
					   CREATE TABLE IF NOT EXISTS $table_name (
						ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
						first_name varchar(255) NOT NULL,
						last_name varchar(255) NOT NULL,
                  email varchar(255) NOT NULL,
                  password varchar(255) NOT NULL,
                  username varchar(255) NOT NULL,
						review text NOT NULL,
                  rating double precision,
                  submitted_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
						PRIMARY KEY (ID)
					) $charset_collate;
				";

				dbDelta($sql);
				error_log( print_r( dbDelta($sql), true ) );
			}
		}

     }
   endif;

   Install::init();