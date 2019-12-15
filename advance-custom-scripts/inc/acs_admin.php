<?php 
if ( ! defined( 'ABSPATH' ) ) //Directly not access
     exit;

/*
* Create settings field
*/
add_action('admin_init','acs_setting_fields');
function acs_setting_fields(){
    add_settings_section(
		'acs_settings_sec',			// ID of section
		'Settings',		            // Title
		 null,						// Call Back Function
		'acs-settings-sec'		    // Page
	);
    
    add_settings_field(
		'acs_select_theme',		    // ID
		'Select Theme',			    // Title
		'acs_select_theme',			// Call Back Function
		'acs-settings-sec',		    // page
		'acs_settings_sec'			// Section
	);
    
    register_setting('acs_settings_sec','acs_select_theme');
}

/*
* Acs settings field
*/
function acs_select_theme() {
    $acs_theme = get_option('acs_select_theme');
?>
<select name="acs_select_theme" id="acs_select_theme">
    <option value="<?php echo esc_html('default'); ?>" <?php if($acs_theme == 'default'){echo 'selected';} ?>>Default</option>
    <option value="<?php echo esc_html('3024-night'); ?>" <?php if($acs_theme == '3024-night'){echo 'selected';} ?>>Night</option>
    <option value="<?php echo esc_html('cobalt'); ?>" <?php if($acs_theme == 'cobalt'){echo 'selected';} ?>>Cobalt</option>
</select>
<?php
}

/*
* Add settings page
*/
add_action('admin_menu', 'acs_admin_settings_page');
function acs_admin_settings_page(){
    add_submenu_page('edit.php?post_type=acs_custom_script', 'ACS Settings', 'Settings', 'manage_options', 'acs_settings', 'acs_settings_callback');  
}

/*
* ACS settings form
*/
function acs_settings_callback(){
echo '<form action="options.php" method="post">';
    settings_errors();
    settings_fields('acs_settings_sec');
    do_settings_sections('acs-settings-sec');
    submit_button();
echo '</form>';
}