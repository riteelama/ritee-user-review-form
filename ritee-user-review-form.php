<?php
/**
 * Plugin Name: Ritee User Review Form
 * Plugin URI: https://wordpress.org/plugins
 * Description: User Review form for providing the review to our site in WordPress Form.
 * Version: 1.0.0
 * Author: Ritee Lama
 * Author URI: http://riteelama.com.np
 * Text Domain: ritee-user-review-form
 * Domain Path: /languages/
 *
 * Copyright: © 2022 Ritee.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package User_Review_Form
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

use UserReviewForm\ReviewForm;

if(!defined('RITEE_USER_REVIEW_FORM_VERSION')){
    define('RITEE_USER_REVIEW_FORM_VERSION','1.0.0');
}

if(!defined('RITEE_USER_REVIEW_FORM_PLUGIN_FILE')){
    define('RITEE_USER_REVIEW_FORM_PLUGIN_FILE',__FILE__);
}

function user_review_form(){
    return ReviewForm::get_instance();
}

// Define constant that provides url of the current directory where current file resides.
if ( ! defined( 'RITEE_USER_REVIEW_FORM_URL' ) ) {
	define( 'RITEE_USER_REVIEW_FORM_URL', plugin_dir_url( __FILE__ ) );
}

// Define constant that provides the url to the assets file which contains js, css and images file need for the plugin.
if ( ! defined( 'RITEE_USER_REVIEW_FORM_ASSETS_URL' ) ) {
	define( 'RITEE_USER_REVIEW_FORM_ASSETS_URL', RITEE_USER_REVIEW_FORM_URL . 'assets' );
}

// Define constant that provides full path of the current directory where current file resides.
if ( ! defined( 'RITEE_USER_REVIEW_FORM_DIR' ) ) {
	define( 'RITEE_USER_REVIEW_FORM_DIR', plugin_dir_path( __FILE__ ) );
}

// Define constant that provides the full path to the templates file.
if ( ! defined( ' RITEE_USER_REVIEW_FORM_TEMPLATE_PATH' ) ) {
	define( 'RITEE_USER_REVIEW_FORM_TEMPLATE_PATH', RITEE_USER_REVIEW_FORM_DIR . 'templates' );
}

user_review_form();