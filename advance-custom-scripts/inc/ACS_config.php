<?php

if ( ! defined( 'ABSPATH' ) ) //Directly not access
     exit;

/*
* ACS file configuration
*/
class ACS_config {
    public function __construct(){
        // Create the dir if it doesn't exist
        if ( ! file_exists( ACS_UPLOAD_DIR ) ) {
            wp_mkdir_p( ACS_UPLOAD_DIR );
        }
        
        add_action( 'init', array($this, 'acs_create_file') );
        add_action( 'admin_enqueue_scripts', array($this, 'acs_enqueue_scripts') );
        add_action( 'admin_enqueue_scripts', array($this, 'codemirror_enqueue_scripts') );
    }
    
    /*
    * ACS file create
    */
    public function acs_create_file(){
    //Arguments of WP_Query
    $args = array(  
       'post_type' => 'acs_custom_script',
       'post_status' => 'publish',
    );

    $acscssjs = new WP_Query( $args );

    if($acscssjs->have_posts()):
    while($acscssjs->have_posts()){
        $acscssjs->the_post();


        $acs_file_type = get_post_meta( get_the_ID(), 'acs-file-type', true ); //File extension

        //file create start
        if($acs_file_type){

            switch ($acs_file_type) {
                case 'html':
                    $acs_content = sanitize_text_field(get_post_meta( get_the_ID(), 'acs_editor_html', true ));
                    break;
                case 'css':
                    $acs_content = sanitize_text_field(get_post_meta( get_the_ID(), 'acs_editor_css', true ));
                    break;
                case 'js':
                    $acs_content = sanitize_text_field(get_post_meta( get_the_ID(), 'acs_editor_js', true ));
                    break;
                case 'php':
                    $acs_content = sanitize_text_field(get_post_meta( get_the_ID(), 'acs_editor_php', true ));
                    break;
            }

            if(!empty(trim($acs_content))){

                $acs_file = fopen( ACS_DIRECTORY.'/'.get_the_id().'.'.$acs_file_type.'', 'w') or die('Unable to open file!' );
                fwrite($acs_file, $acs_content);
                fclose($acs_file);

            }else{
                if(file_exists(ACS_DIRECTORY.'/'.get_the_id().'.'.$acs_file_type.'')){
                    unlink(ACS_DIRECTORY.'/'.get_the_id().'.'.$acs_file_type.'');
                }
            }

        }
        //file create End

    }
    wp_reset_postdata();
    endif;
    }

    /*
    * Enqueue ACS Scripts
    */
    public function acs_enqueue_scripts() {
        wp_enqueue_script('acs-script', plugins_url('/assets/js/acs-script.js', dirname(__FILE__)), array('jquery'), null, true);
        wp_enqueue_style('acs-style', plugins_url( '/assets/css/acs-style.css', dirname(__FILE__)), array('wp-codemirror'));
        switch(get_option('acs_select_theme')){
            case '3024-night':
                wp_enqueue_style('acs-theme-night', plugins_url( '/assets/css/themes/3024-night.css', dirname(__FILE__)), array('wp-codemirror'));
                break;
            case 'cobalt':
                wp_enqueue_style('acs-theme-cobalt', plugins_url( '/assets/css/themes/cobalt.css', dirname(__FILE__)), array('wp-codemirror'));
                break;
        }

    }

    /*
    * Enqueue ACS Editor Scripts
    */
    public function codemirror_enqueue_scripts($hook) {

        $cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
        wp_localize_script('jquery', 'cm_settings', $cm_settings);

        wp_enqueue_script('wp-theme-plugin-editor');
        wp_enqueue_style('wp-codemirror');

    }
}
new ACS_config();