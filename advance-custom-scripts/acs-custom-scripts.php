<?php
/**
 * Plugin Name: Advance Custom Script
 * Description: Easily add Custom CSS or JS to your website with an awesome editor.
 * Version: 1.01
 * Author: code4webs.com 
 * Author URI: https://www.code4webs.com
 * License: GPL2
 * Textdomain: advance_custom_script
 * Domain Path: /languages/
 */
if ( ! defined( 'ABSPATH' ) ) //Directly not access
     exit;

class ACS_custom_script {
    public function __construct(){
        $this->acs_path_define();
        add_action('init', array($this, 'acs_post_type'));
        $this->acs_metaboxes();
    }
    
    /*
    * Define plugin directories
    */
    public function acs_path_define(){
        $dir = wp_upload_dir();
        define('ACS_DIRECTORY', $dir['basedir'] . '/acs-custom-scripts');
        define('ACS_UPLOAD_DIR', $dir['basedir'] . '/acs-custom-scripts');
        define('ACS_FILES_DIR', '/uploads/acs-custom-scripts');
        define( 'ACS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
    }
    
    /*
    * Register ACS post type
    */
    public function acs_post_type(){

        $labels = array(
                'name'                   => _x( 'ACS Script', 'advance_custom_script'),
                'singular_name'          => _x( 'ACS Script', 'advance_custom_script'),
                'add_new'                => _x( 'Add New Script', 'advance_custom_script'),
                'add_new_item'           => __( 'Add New Custom Script', 'advance_custom_script'),
                'new_item'               => __( 'New Custom Script', 'advance_custom_script'),
                'edit_item'              => __( 'Edit Script', 'advance_custom_script'),
                'view_item'              => __( 'View Script', 'advance_custom_script'),
                'view_items'             => __( 'View Scripts', 'advance_custom_script'),
                'search_items'           => __( 'Search Scripts', 'advance_custom_script'),
                'not_found'              => __( 'No Scripts Found', 'advance_custom_script'),
                'not_found_in_trash'     => __( 'No Scripts Found In Trash', 'advance_custom_script'),
                'parent_item_colon'      => __( 'Parent Scripts', 'advance_custom_script'),
                'all_items'              => __( 'All Scripts', 'advance_custom_script'),
                'item_published'         => __( 'Code Published', 'advance_custom_script'),
                'item_published_privately'    => __( 'Code Published Privately', 'advance_custom_script'),
                'item_reverted_to_draft'    => __( 'Code reverted to draft', 'advance_custom_script'),
                'item_scheduled'    => __( 'Code scheduled', 'advance_custom_script'),
                'item_updated'    => __( 'Script updated', 'advance_custom_script'),
            );

        register_post_type('acs_custom_script', array(
            'labels' => $labels,
            'supports'   => array('title', 'author'),
            'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
            'menu_icon'  => 'dashicons-welcome-write-blog',
            'publicly_queryable' => false,  // you should be able to query it
            'show_ui' => true,  // you should be able to edit it in wp-admin
            'exclude_from_search' => true,  // you should exclude it from search results
            'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
            'has_archive' => false,  // it shouldn't have archive page
            'rewrite' => false,  // it shouldn't have rewrite rules
        ));
        
    }
    
    
    public function acs_metaboxes(){
        //acs metabox
        require_once(ACS_PLUGIN_PATH.'/inc/acs_metaboxs.php');
        //acs frontend
        require_once(ACS_PLUGIN_PATH.'/inc/acs_frontend.php');
        //acs save data
        require_once(ACS_PLUGIN_PATH.'/inc/acs_save_data.php');
    }
    
}
new ACS_custom_script();


/*
* Require ACS admin
*/
require_once(ACS_PLUGIN_PATH.'/inc/acs_admin.php');

/*
* ACS config
*/
require_once(ACS_PLUGIN_PATH.'/inc/ACS_config.php');

/*
* ACS customize
*/
require_once(ACS_PLUGIN_PATH.'/inc/ACS_customize.php');