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

     }