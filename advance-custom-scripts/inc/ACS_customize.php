<?php
if ( ! defined( 'ABSPATH' ) ) //Directly not access
     exit;

/*
* ACS Customization
*/
class ACS_customize {
    public function __construct(){
        add_action('wp_enqueue_scripts', array($this, 'acs_enqueue_all_scripts'),100);
        add_action('admin_enqueue_scripts', array($this, 'acs_admin_enqueue_all_scripts'),100);
        
    }

    /*
    * Forntend
    */
    public function acs_enqueue_all_scripts(){
        global $post_type;
        
        if ( $post_type == 'acs_custom_script' ) {
            return;
        }
        
        //global $post;
        //Arguments of WP_Query
        $args = array( 'post_type' => 'acs_custom_script', 'post_status' => 'publish', 'orderby' => 'ID', 'order' => 'ASC', 'posts_per_page' => -1 );

        $acsposts = new WP_Query( $args );
        
        if($acsposts->have_posts()):
        while($acsposts->have_posts()) {
        $acsposts->the_post();
            
        $acs_enq_all_css_js = get_post_meta( get_the_ID(), 'acs_enq_all_css_js', true );
        $acs_cssfile_site_location = get_post_meta(get_the_ID(),'acs_cssfile_site_location', true);
        $acs_jsfile_site_location = get_post_meta(get_the_ID(),'acs_jsfile_site_location', true);
        $acs_cssfile_location = get_post_meta( get_the_ID(), 'acs_cssfile_location', true );
        $acs_jsfile_location = get_post_meta( get_the_ID(), 'acs_jsfile_location', true );
        $acs_cssfile_priority = get_post_meta( get_the_ID(), 'acs_cssfile_priority', true );
        $acs_jsfile_priority = get_post_meta( get_the_ID(), 'acs_jsfile_priority', true );
            
            
        //Enqueue css file
        if($acs_enq_all_css_js == 'only_css' && $acs_cssfile_site_location == 'frontend'){
            wp_enqueue_style('acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'. get_the_ID().'.css');
        }
            
        //Enqueue js file
        if($acs_enq_all_css_js == 'only_js' && $acs_jsfile_site_location == 'frontend'){
            
            wp_enqueue_script('acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'.get_the_ID().'.js', array('jquery'), null, true);
        }

        //Enqueue all css and js 
        if($acs_enq_all_css_js == 'all_css_js'):
        if($acs_cssfile_site_location == 'frontend'){
            foreach( glob( wp_upload_dir()['basedir'].'/acs-custom-scripts/'.get_the_ID().'.css' ) as $file ) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_style( 'acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'.$filename);
            }
        }

        if($acs_jsfile_site_location == 'frontend'){
            foreach( glob( wp_upload_dir()['basedir'].'/acs-custom-scripts/'.get_the_ID().'.js' ) as $file ) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_script( 'acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'.$filename, array('jquery'), null, true);
            }
            
        }
        endif;
    }
    wp_reset_postdata();
    endif;

    }

    
    /*
    * Admin area 
    */
    public function acs_admin_enqueue_all_scripts(){
        global $post_type;
        
        if ( $post_type == 'acs_custom_script' ) {
            return;
        }
        
        //global $post;
        //Arguments of WP_Query
        $args = array( 'post_type' => 'acs_custom_script', 'post_status' => 'publish', 'orderby' => 'ID', 'order' => 'ASC', 'posts_per_page' => -1 );

        $acsposts = new WP_Query( $args );
        
        if($acsposts->have_posts()):
        while($acsposts->have_posts()) {
        $acsposts->the_post();
            
        $acs_enq_all_css_js = get_post_meta( get_the_ID(), 'acs_enq_all_css_js', true );
        $acs_cssfile_site_location = get_post_meta(get_the_ID(),'acs_cssfile_site_location', true);
        $acs_jsfile_site_location = get_post_meta(get_the_ID(),'acs_jsfile_site_location', true);
        $acs_cssfile_location = get_post_meta( get_the_ID(), 'acs_cssfile_location', true );
        $acs_jsfile_location = get_post_meta( get_the_ID(), 'acs_jsfile_location', true );
        $acs_cssfile_priority = get_post_meta( get_the_ID(), 'acs_cssfile_priority', true );
        $acs_jsfile_priority = get_post_meta( get_the_ID(), 'acs_jsfile_priority', true );
            
            
        //Enqueue css file
        if($acs_enq_all_css_js == 'only_css' && $acs_cssfile_site_location == 'admin'){
            wp_enqueue_style('acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'. get_the_ID().'.css');
        }
            
        //Enqueue js file
        if($acs_enq_all_css_js == 'only_js' && $acs_jsfile_site_location == 'admin'){
            
            wp_enqueue_script('acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'.get_the_ID().'.js', array('jquery'), null, true);
        }

        //Enqueue all css and js 
        if($acs_enq_all_css_js == 'all_css_js'):
        if($acs_cssfile_site_location == 'admin'){
            foreach( glob( wp_upload_dir()['basedir'].'/acs-custom-scripts/'.get_the_ID().'.css' ) as $file ) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_style( 'acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'.$filename);
            }
        }

        if($acs_jsfile_site_location == 'admin'){
            foreach( glob( wp_upload_dir()['basedir'].'/acs-custom-scripts/'.get_the_ID().'.js' ) as $file ) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_script( 'acs-'.get_the_ID(), content_url().ACS_FILES_DIR.'/'.$filename, array('jquery'), null, true);
            }
            
        }
        endif;
    }
    wp_reset_postdata();
    endif;

    }
    
}
new ACS_customize();