<?php 
if ( ! defined( 'ABSPATH' ) ) //Directly not access
     exit;

/*
* Save editor data
*/
add_action('save_post', 'acs_editor_save_meta');
function acs_editor_save_meta( $post_id ) {

  if( !isset( $_POST['acs_editor_nonce'] ) || !wp_verify_nonce( $_POST['acs_editor_nonce'],'acs_editor_metabox_nonce') ) 
    return;

  if ( defined ('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
    return;
  }
  if ( !current_user_can( 'administrator' ))
    return;
    
  if ( !current_user_can( 'edit_post', $post_id ))
    return;
/*
  if ( isset($_POST['acs_editor_html']) ) {
    update_post_meta($post_id, 'acs_editor_html', wp_filter_post_kses($_POST['acs_editor_html']));      
  }
*/
    
  if ( isset($_POST['acs_editor_css']) ) {
    update_post_meta($post_id, 'acs_editor_css',  wp_unslash($_POST['acs_editor_css'])); 
      
  }

  if ( isset($_POST['acs_editor_js']) ) {
    update_post_meta($post_id, 'acs_editor_js',  wp_unslash($_POST['acs_editor_js']));      
  }
/*
  if ( isset($_POST['acs_editor_php']) ) {
    update_post_meta($post_id, 'acs_editor_php',  htmlentities($_POST['acs_editor_php']));      
  }
*/

}

/*
* Save file type
*/
add_action('save_post', 'acs_file_type_save_meta');
function acs_file_type_save_meta( $post_id ) {

  if( !isset( $_POST['acs_filetype_nonce'] ) || !wp_verify_nonce( $_POST['acs_filetype_nonce'],'acs_filetype_metabox_nonce') ) 
    return;

  if ( !current_user_can( 'edit_post', $post_id ))
    return;

  if ( isset($_POST['acs_file_type']) ) {        
    update_post_meta($post_id, 'acs-file-type', sanitize_text_field($_POST['acs_file_type']));      
  }

}

/*
* Save linking options
*/
add_action('save_post', 'acs_file_linking_save_meta');
function acs_file_linking_save_meta( $post_id ) {

  if( !isset( $_POST['acs_linking_nonce'] ) || !wp_verify_nonce( $_POST['acs_linking_nonce'],'acs_linking_metabox_nonce') ) 
    return;

  if ( !current_user_can( 'edit_post', $post_id ))
    return;

  if ( isset($_POST['acs_cssfile_linking_type']) ) {        
    update_post_meta($post_id, 'acs_cssfile_linking_type', sanitize_text_field($_POST['acs_cssfile_linking_type']));      
  }

  if ( isset($_POST['acs_jsfile_linking_type']) ) {        
    update_post_meta($post_id, 'acs_jsfile_linking_type', sanitize_text_field($_POST['acs_jsfile_linking_type']));      
  }

  if ( isset($_POST['acs_htmlfile_priority']) ) {        
    update_post_meta($post_id, 'acs_htmlfile_priority', sanitize_text_field($_POST['acs_htmlfile_priority']));      
  }

  if ( isset($_POST['acs_htmlfile_location']) ) {        
    update_post_meta($post_id, 'acs_htmlfile_location', sanitize_text_field($_POST['acs_htmlfile_location']));      
  }

  if ( isset($_POST['acs_cssfile_location']) ) {        
    update_post_meta($post_id, 'acs_cssfile_location', sanitize_text_field($_POST['acs_cssfile_location']));      
  }

  if ( isset($_POST['acs_cssfile_site_location']) ) {        
    update_post_meta($post_id, 'acs_cssfile_site_location', sanitize_text_field($_POST['acs_cssfile_site_location']));      
  }

  if ( isset($_POST['acs_cssfile_priority']) ) {        
    update_post_meta($post_id, 'acs_cssfile_priority', sanitize_text_field($_POST['acs_cssfile_priority']));      
  }

  if ( isset($_POST['acs_jsfile_location']) ) {        
    update_post_meta($post_id, 'acs_jsfile_location', sanitize_text_field($_POST['acs_jsfile_location']));      
  }

  if ( isset($_POST['acs_jsfile_site_location']) ) {        
    update_post_meta($post_id, 'acs_jsfile_site_location', sanitize_text_field($_POST['acs_jsfile_site_location']));      
  }

  if ( isset($_POST['acs_jsfile_priority']) ) {        
    update_post_meta($post_id, 'acs_jsfile_priority', sanitize_text_field($_POST['acs_jsfile_priority']));      
  }

  if ( isset($_POST['acs_enq_all_css_js']) ) {        
    update_post_meta($post_id, 'acs_enq_all_css_js', sanitize_text_field($_POST['acs_enq_all_css_js']));      
  }

}
