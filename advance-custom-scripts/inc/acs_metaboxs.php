<?php
if ( ! defined( 'ABSPATH' ) ) //Directly not access
     exit;

/*
* register metabox
*/
add_action( 'add_meta_boxes', 'acs_file_metabox' );
function acs_file_metabox() {

    add_meta_box( 
        'acs_file_type', 
        __( 'Code Type', 'advance_custom_script'), 
        'acs_file_type_metabox_callback', 
        'acs_custom_script', 
        'side', 
        'high'
    );

    add_meta_box( 
        'acs_file_editor', 
        __( 'Custom code', 'advance_custom_script'), 
        'acs_file_editor_metabox_callback', 
        'acs_custom_script', 
        'normal', 
        'default'
    ); 

    add_meta_box(
        'acs_file_linking', 
        __( 'Linking Options', 'advance_custom_script'), 
        'acs_file_linking_metabox_callback', 
        'acs_custom_script', 
        'side', 
        'high'
    ); 
}