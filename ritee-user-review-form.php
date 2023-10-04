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

//  add_action( 'init', 'ritee_register_custom_post_type' );
//  function ritee_register_custom_post_type() {
//     register_post_type( 'reviews', 
//         array(
//             'labels' => array(
//                 'name' => 'Reviews'
//             ),
//             'public' => true,
//         )
//     );
//  }

//  add_shortcode( 'ritee_review_form', 'ritee_review_form_func' );
// function ritee_review_form_func( $atts ) {
// 	$atts = shortcode_atts( array(
// 		'foo' => 'no foo',
// 		'baz' => 'default baz'
// 	), $atts, 'bartag' );

//    $form_path = 'templa';

// 	return "";
// }

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

user_review_form();